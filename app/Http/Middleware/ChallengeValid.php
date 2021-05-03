<?php

namespace App\Http\Middleware;

use App\Models\ChallengeUser;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class ChallengeValid
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

        if($challengeUser == null || $challengeUser['invalid_at'] < Carbon::now()){
            return response()->json(['error' => 'Forbidden.'], 403);
        }

        return $next($request);
    }
}
