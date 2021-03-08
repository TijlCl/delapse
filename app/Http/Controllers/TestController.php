<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Jobs\TestJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{

    public function test()
    {
    }
}
