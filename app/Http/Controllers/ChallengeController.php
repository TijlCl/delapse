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
        $this->challengeUserRepository = $challengeUserRepository;
    }


    public function getActiveChallenges(Request $request)
    {
        $challenges = $this->challengeUserRepository->getWeeklyChallenges(Auth::id(), ['challenge.image']);

        return ChallengeResource::collection($challenges);
    }
}
