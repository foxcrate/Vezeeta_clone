<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PatientResetPasswordNotification;
use Carbon\Carbon;
class Admin extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['username','email','password'];
}
