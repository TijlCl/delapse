<?php

namespace App\Http\Middleware;

use App\Models\Event;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $event = Event::where('id', $request->event)->first();

        if($event == null || $event['user_id'] !== Auth::id()){
            return back()->withInput();
        }

        return $next($request);
    }
}
