<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class is_Doctor
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
        if(auth()->guard('doctor')->check() ){
            return $next($request);
        }
        return redirect()->route('loginDoctor',auth()->guard('hosptail')->user()->id);
        
    }
}
