<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class CheckIfDoctorVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            $type = Auth::user()->type;
            $is_verified =Auth::user()->is_verified;
            if (($is_verified&&$type=='doctor') || $type=='user')
            {
                return $next($request);

            }
            Auth::logout();
             return response()->json(['error' => 'you are not verified'], 401);
        }
        return response()->json(['error' => 'authentication error'], 401);

    }
}
