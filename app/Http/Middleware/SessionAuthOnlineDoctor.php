<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SessionAuthOnlineDoctor
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

        //return $next($request);

        if(Session::has('OnlineDoctorLogged') ){

            if( $request->route('id') ){
                // return redirect()->route('indexRoute')->with('error',"There Is A Route ID");
                if( Session::get('OnlineDoctorLoggedID') == $request->route('id') ){
                    return $next($request);
                }else{
                    // Auth::guard( 'online_doctor' )->logout();

                    // Session::forget('OnlineDoctorLoggedID');
                    // Session::forget('OnlineDoctorLogged');

                    return redirect()->route('indexRoute')->with('error',"You Are Not Authenticated");
                }

            }else{
                // return redirect()->route('indexRoute')->with('error',"There Isn't A Route ID");
                return $next($request);

            }

        }
        else{
            return redirect()->route('indexRoute')->with('error',"You Are Not Logged In");
        }

    }


}
