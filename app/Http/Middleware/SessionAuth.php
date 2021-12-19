<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

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

        if(Session::has('loggedID')){

            // if($request->has('id')){
            //     return redirect()->route('indexRoute')->with('error',"You Are Not Logged In");
            // }

            // if($request->has(route('id'))){
                if( Session::get('loggedID') == $request->route('id') ){
                    return $next($request);
                }else{
                    Session::forget('loggedID');
                    Session::forget('loggedType');
                    return redirect()->route('indexRoute')->with('error',"You Are Not Logged In");
                }
            // }

        }
        else{
            return redirect()->route('indexRoute')->with('error',"You Are Not Logged In");
        }

    }
}
