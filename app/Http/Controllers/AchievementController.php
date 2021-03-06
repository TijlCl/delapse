<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AchievementRepository;
use App\Http\Resources\AchievementResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{

    private AchievementRepository $achievementRepository;

    /**
     * FriendsController constructor.
     * @param AchievementRepository $achievementRepository
     */
    public function __construct(AchievementRepository $achievementRepository)
    {
        $this->achievementRepository = $achievementRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $achievements = $this->achievementRepository->getByUser(Auth::id(), ['image']);
        return AchievementResource::collection($achievements);
    }

    /**
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getByUser(Request $request, int $userId)
    {
        $achievements = $this->achievementRepository->getByUser($userId, ['image']);
        return AchievementResource::collection($achievements);
    }
}
