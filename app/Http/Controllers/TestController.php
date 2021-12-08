<?php

namespace App\Http\Controllers;

use App\models\Clinic;
use App\models\hospitalAppointment;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){

        $c = Clinic::find(1);
        $cp = hospitalAppointment::find(1);

        return $cp->clinic;

    }
}
