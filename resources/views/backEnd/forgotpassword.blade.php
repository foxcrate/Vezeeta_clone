@extends('backEnd.layoutes.mastar')
@section('title','Forgot password')
@section('content')
    @include('backEnd.layoutes.navbar')
    <div class="back-ground" style="padding-top:70px; padding-bottom:70px;">
        <div class="container row no-gutters bg-message card ml-auto mr-auto mb-5" style="flex-direction: row; margin-top:120px">
            @if(session('errorEmailMsg'))
                <div style = "margin-top:100px" class="alert alert-danger">{{session('errorEmailMsg')}}</div>
        @endif
        <!--<div class="col-lg-6 order-lg-1 mt-5 text-center">
            <img src="{{url('imgs/restpassword.png')}}" class="img-fluid order-lg-2 mb-lg-5 mt-5" alt="Responsive image" height="400" width="400">
        </div>-->
            <div class="col-12 mt-5 pt-2 mb-5 ml-auto mr-auto">
                <form action="{{route('post_forgot_password')}}" method="POST" class="mt-4">
                    {{ csrf_field() }}
                    <div class="col-6 mt-5 pt-5 mb-5 ml-auto mr-auto">
                        <h1 class="h1 text-center mb-5 font-weight-bold">Forgot Your Password</h1>
                        <div class="col-12 pt-3 form-group">
                            <h4 class="h4 mt-5 mb-3">Please Enter Your Id </h4>
                            <input type="text" name="code" class="form-control col-12 mb-4" placeholder="Enter Your Id" required="required">
                        </div>
                        <div class="col-12 form-group">
                            <input type="submit" value="Enter" class="h4 btn btn-success col-12 text-center">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('backEnd.layoutes.footer')
@stop




