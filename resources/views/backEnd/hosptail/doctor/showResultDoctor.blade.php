@extends('backEnd.layoutes.mastar')
@section('title','Show Doctor Result')
@section('content')
<div class="d-flex bg-page" id="wrapper">
    <!-- Sidebar -->
    @include('backEnd.hosptail.sidenav')
    <div id="page-content-wrapper">
        <nav class="navbarp navbar-top navbar-expand navbar-dark border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                    <ul class="navbar-nav align-items-center ml-md-auto">

                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        @if(!$hosptail->image)
                                        <img alt="Image placeholder" src="{{ asset('uploads/default.png') }}">
                                        @else
                                        <img alt="Image placeholder" src="{{ $hosptail->image }}">
                                        @endif

                                    </span>
                                    <div class="media-body ml-3 mr-3 d-lg-block">
                                        <h6 class="mb-0 font-weight-bold text-white">{{$hosptail->hosptailName}}</h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @if($doctors)
    @foreach($doctors as $doctor)
        <div class="col-md-6 ml-auto mr-auto mb-4 mt-5 pharmacy_item" data-lat="{{$doctor->latitude}}" data-lng="{{$doctor->longitude}}" data-distance=".distance_{{$doctor->id}}">
            <div class="card-finder">
                    <div class="row col-lg-12 mr-auto ml-auto">
                        <div class="col-lg-3">
                            @if(!$doctor->image)
                            <img class="rounded-circle" alt="Image placeholder" src="{{asset('uploads/default.png')}}" width="90" height="90">
                            @else
                            <img class="rounded-circle" alt="Image placeholder" src="{{$doctor->image}}" width="90" height="90">
                            @endif
                        </div>
                        <div class="col-lg-8 mt-3">
                            <div class="row h5 text-dark text-capitalize mb-2">
                                <div class="col-1"><img src="{{url('imgs/doctor.svg')}}" width="30" class="mr-3"></div>
                                <div class="col-10 ml-3 mt-1 mb-3">{{$doctor->name}}</div>
                            </div>
                            <div class="row h5 text-dark text-capitalize mb-2">
                                <div class="col-1"><img src="{{url('imgs/infodoctor.svg')}}" width="30" class="mr-3"></div>
                                <div class="col-10 ml-3 mb-3">{{$doctor->special->name}}</div>
                            </div>
                            <div class="row h5 text-dark text-capitalize">
                                <div class="col-1"><img src="{{url('imgs/phone.svg')}}" width="25" class="mr-3"></div>
                                <div class="col-10 ml-3 mb-2">{{$doctor->phoneNumber}}</div>
                            </div>
                        </div>

                        <form action="{{ route('appointmentsDoctor') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                            <input type="hidden" name="doctor_name" value="{{ $doctor->name }}">
                            <input type="hidden" name="doctor_address" value="{{ $doctor->address}}">
                            <input type="hidden" name="doctor_idCode" value="{{ $doctor->idCode}}">
                            <input type="hidden" name="doctor_phoneNumber" value="{{ $doctor->phoneNumber }}">
                            <input type="hidden" name="doctor_special" value="{{ $doctor->special->name }}">
                            <input type="hidden" name="doctor_lat" value="{{ $doctor->latitude }}">
                            <input type="hidden" name="doctor_lan" value="{{ $doctor->longitude }}">
                            <input type="hidden" name="doctor_image" value="{{ $doctor->image }}">
                            <input type="hidden" name="hosptail_id" value="{{ $hosptail->id }}">
                            @php
                                $doc  = \App\models\hospitalAppointment::where('hospital_id',$hosptail->id)->first();
                            @endphp
                            @if(!$doc)
                                <button class="btn btn-primary"type="submit">Add Doctor</button>
                            @endif
                        </form>
                    </div>
            </div>

    @endforeach

@endif
    </div>

</div>



@stop
