<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class CheckIfBlocked
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
            $is_blocked = Auth::user()->is_blocked;
            if ($is_blocked)
            {
                Auth::logout();
                return response()->json(['error' => 'you are blocked'], 200);

            }
            return $next($request);
        }
        return response()->json(['error' => 'authentication error'], 200);

    }
}
