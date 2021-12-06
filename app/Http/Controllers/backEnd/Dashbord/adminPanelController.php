<?php

namespace App\Http\Controllers\backEnd\Dashbord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\models\Admin;

class adminPanelController extends Controller
{
    public function login(){
        return view('backEnd.dashbord.login');
    }

    public function postLogin(Request $request){
        $attmp = $request->only('email','password');
        if(Auth::guard('admin')->attempt($attmp)) {
            return redirect()->route('adminPanel.homepage');
        }
        return redirect()->back();
    }

    public function logout(){
        auth()->guard('admin')->logout();
        // return dd(auth('admin')->user());
        return redirect()->route('adminPanel.login');
    }
    public function homepage(){
        return view('backEnd.dashbord.homepage');
    }
}
