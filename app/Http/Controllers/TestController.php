<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Http\Repositories\AchievementRepository;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;

class TestController extends Controller
{

    public function test(AchievementRepository $achievementRepository)
    {
        $a = $achievementRepository->getByUser(3);
        $r = 0;
//        event(new TestEvent());
    }
}
