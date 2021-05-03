<?php

namespace App\Http\Controllers;

use App\Http\Actions\StoreFileAction;
use App\Http\DTO\ChallengeUserDTO;
use App\Http\Repositories\ChallengeUserRepository;
use App\Http\Requests\CompleteChallengeRequest;
use App\Http\Resources\ChallengeResource;
use App\Http\Resources\ChallengeUserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
    private ChallengeUserRepository $challengeUserRepository;
    private StoreFileAction $storeFileAction;


    public function __construct(ChallengeUserRepository $challengeUserRepository, StoreFileAction $storeFileAction)
    {
        // middleware
        $this->middleware('challenge_user_ownership')->only(['show', 'completeChallenge']);
        $this->middleware('challenge_valid')->only(['completeChallenge']);

        $this->challengeUserRepository = $challengeUserRepository;
        $this->storeFileAction = $storeFileAction;
    }

    /**
     * @param int $challengeUserId
     * @return ChallengeUserResource
     */
    public function show(int $challengeUserId): ChallengeUserResource
    {
        $challenge = $this->challengeUserRepository->find($challengeUserId, ['challenge.image']);
        return new ChallengeUserResource($challenge);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getActiveChallenges(Request $request)
    {
        $challenges = $this->challengeUserRepository->getWeeklyChallenges(Auth::id(), ['challenge.image']);

        return ChallengeUserResource::collection($challenges);
    }

    public function getCompletedChallenges(Request $request)
    {
        $challenges = $this->challengeUserRepository->getCompletedChallenges(Auth::id(), ['challenge.image']);

        return ChallengeUserResource::collection($challenges);
    }

    /**
     * @param CompleteChallengeRequest $request
     * @param int $challengeUserId
     */
    public function completeChallenge(CompleteChallengeRequest $request, int $challengeUserId)
    {
        if ($request->hasFile('image')){
            $imagePath = $this->storeFileAction->execute($request->file('image'), 'challenge_user_images/');
        }

        $challengeUserDTO = new ChallengeUserDTO(['id' => $challengeUserId,
            'description' => $request['description'],
            'image' => $imagePath ?? null,
            'completed_at' => Carbon::now()
        ]);

        $this->challengeUserRepository->completeChallenge($challengeUserDTO);
    }
}
