<?php

namespace App\Http\Middleware;

use Closure;

class is_Doctor_clinic
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
        if(auth()->guard('doctor')->check()){
            return $next($request);
        }
        return redirect()->route('clinic_login_doctor',auth()->guard('clinic')->user()->id);
    }
}
