<?php

namespace App\Http\Middleware;

use App\Models\ChallengeUser;
use App\Models\Event;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeUserOwnership
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
        $challengeUser = ChallengeUser::where('id', $request->challenge_user)->first();

        if($challengeUser == null || $challengeUser['user_id'] !== Auth::id()){
            return back()->withInput();
        }

        return $next($request);
    }
}
