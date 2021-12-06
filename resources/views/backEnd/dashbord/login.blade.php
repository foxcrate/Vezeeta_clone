@extends('backEnd.dashbord.layout')
@section('title','Admin Login')
@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
            <form class="login100-form validate-form" action="{{ route('adminPanel.postlogin') }}" method="POST">
                {{ csrf_field() }}
                {{--  {{ dd(auth('admin')->user()->id) }}  --}}
                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input required="required" class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>

                <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                    <input required="required" class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>

                <div class="container-login100-form-btn m-t-20">
                    <input type="submit" class="login100-form-btn" value="Login">
                </div>
            </form>
        </div>
    </div>
</div>


@stop

