<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SessionAuth
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

        if(Session::has('loggedID')){

            if( $request->route('id') ){
                // return redirect()->route('indexRoute')->with('error',"There Is A Route ID");
                if( Session::get('loggedID') == $request->route('id') ){
                    return $next($request);
                }else{
                    Auth::guard( Session::get('loggedType') )->logout();
                    Session::forget('loggedID');
                    Session::forget('loggedType');
                    return redirect()->route('indexRoute')->with('error',"You Are Not Logged In");
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
