<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ChallengeUserRepository;
use App\Http\Resources\ChallengeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
    private ChallengeUserRepository $challengeUserRepository;


    public function __construct(ChallengeUserRepository $challengeUserRepository)
    {
        // middleware
        $this->middleware('challenge_user_ownership')->only(['show']);

        $this->challengeUserRepository = $challengeUserRepository;
    }

    /**
     * @param int $challengeUserId
     * @return ChallengeResource
     */
    public function show(int $challengeUserId)
    {
        $challenge = $this->challengeUserRepository->find($challengeUserId, ['challenge.image']);
        return new ChallengeResource($challenge);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getActiveChallenges(Request $request)
    {
        $challenges = $this->challengeUserRepository->getWeeklyChallenges(Auth::id(), ['challenge.image']);

        return ChallengeResource::collection($challenges);
    }
}
