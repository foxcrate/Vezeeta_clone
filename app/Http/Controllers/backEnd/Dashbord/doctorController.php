<?php

namespace App\Http\Controllers\backEnd\Dashbord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\OnlineDoctor;
class doctorController extends Controller
{
    public function index(){
        $doctors = OnlineDoctor::get(['id']);
        return $doctors;
    }
}
