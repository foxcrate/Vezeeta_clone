<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class SessionAuthPatient
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

        if(Session::has('PatientLogged') ){

            if( $request->route('id') ){
                // return redirect()->route('indexRoute')->with('error',"There Is A Route ID");
                if( Session::get('PatientLoggedID') == $request->route('id') ){
                    return $next($request);
                }else{
                    // Auth::guard( 'patien' )->logout();

                    // Session::forget('PatientLoggedID');
                    // Session::forget('PatientLogged');

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
