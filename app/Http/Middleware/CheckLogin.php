<?php

namespace App\Http\Middleware;

use Closure;
use Cache;

class CheckLogin
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
        $sess_key = $request->header('sess_key');
        if(!Cache::get($sess_key)){
            return false;
        }
        $user_arr = Cache::get($sess_key);
        Cache::put($sess_key,$user_arr,120);

        return $next($request);
    }
}
