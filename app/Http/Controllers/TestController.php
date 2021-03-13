<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;

class TestController extends Controller
{

    public function test()
    {
//        event(new TestEvent());
    }
}
