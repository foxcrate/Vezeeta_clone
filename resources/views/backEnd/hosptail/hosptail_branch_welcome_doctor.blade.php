@extends('backEnd.layoutes.mastar')
@section('title','Welcome Doctor')
@section('content')
    <div class="d-flex bg-page" id="wrapper">
        <!-- Page Content -->
        <div class="ml-auto mr-auto">
            <!-- informationContent -->
            <div class="container-fluid">
                <div class="header" style="margin-top:80px; margin-bottom:80px;">
                    <div class="card col-12 p-5">
                        <div class="header-body row">
                            <div class="col-md-5 mb-5 mt-5 text-center">
                                <h3 style="font-size:40pt; font-weight: bold; color: #5bb05d; margin-bottom: 20px; ">Congratulation !</h1>
                                    <h6 class="h3 font-weight-bold mb-4">You Are Now A Member of <br/><br/> <span style="font-size:30pt;"><img class="mr-3" src="{{url('imgs/logo.svg')}}" width="60"><span style="color:#27a0d6;">p</span>History Club Family</span>History Club Family</span></h6>
                                    <h6 class="h3 mb-3 font-weight-bold">Welcome <span style="font-size:22pt; font-weight: bold; margin-bottom: 15px;" >{{'Dr.' . $doctor->name}}</span></h6>
                                    <h6 class="h3 mb-5 font-weight-bold">Your ID <span style="font-size:22pt; font-weight: bold; margin-bottom:15px;" >{{str_replace('+','D',$doctor->IdCode)}}</span></h6>
                                    <a href="{{route('branch_doctor_profile',[$hosptail->id,$branch->id])}}"><button class="btn btn-success h4 mt-3">Show Your Profile</button></a>
                            </div>
                            <div class="col-md-7 p-5 mb-auto mt-auto">
                                <img class="m-auto" src="{{url('imgs/cong.svg')}}" width="700" alt="Responsive image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!--Start-Footer-->
        @include('backEnd.layoutes.footer')
        <!--End-Footer-->
@stop
