@extends('backEnd.layoutes.mastar')
@section('title','Doctor Appoinments')
@section('content')
@include('backEnd.online-doctor.sidenav')
<div class="d-flex bg-page" id="wrapper">
    <div id="page-content-wrapper">
         <!-- main content -->
        <div class="main-content" id="panel">
            <!-- Topnav -->
            <nav class="navbarp navbar-top navbar-expand navbar-dark">
                <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                    <!-- Search form -->
                    <ul class="float-lg-right pr-3">
                      {{-- <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
                        <label class="onoffswitch-label" for="myonoffswitch">
                            <div class="onoffswitch-inner"></div>
                            <div class="onoffswitch-switch"></div>
                        </label>
                    </div> --}}
                    </ul>
                    {{--  <h6 class="h5 text-white">{{$online_doctor->online == 1 ? 'online' : 'ofline'}}</h6>  --}}
                    <ul class="navbar-nav align-items-center ml-md-auto">
                      <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fa fa-bell fa-fw mr-lg-3 mt-lg-1" style="font-size: 15pt;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">

                          <div class="px-3 py-3">
                            <p class="text-muted m-0">You have <strong class="text-primary">{{$online_doctor->pRequests->count()}}</strong> notifications Requests.</p>
                          </div>

                          @include("backEnd.online-doctor.notifacation_request")

                        </div>
                      </li>
                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                      <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if(!$online_doctor->image)
                                    <img alt="Image placeholder" src="{{ asset('uploads/defualt.jpg') }}" width="50" height="40">
                                @else
                                    <img alt="Image placeholder" src="{{ $online_doctor->image }}" width="50" height="40">
                                @endif
                            </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                              <h6 class="mb-0 font-weight-bold text-white">{{$online_doctor->name}}</h6>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
            </nav>
            <div class="container mt-5 mb-5">
                <div class="col-md-11 ml-auto mr-auto mb-2 pharmacy_item">
                    @foreach($online_doctor->appointments as $appointments)
                        @foreach ($appointments->doctor_scudule as $scudule)
                            <div class="card-appo mb-5">
                                <div class="">
                                    <div class="row col mr-auto ml-auto pt-3 pl-3 pr-3">
                                        {{-- <div class="alert alert-secondary col-lg-12" role="alert">
                                            <h4 class="mt-auto mb-auto">{{$scudule->is_accept == '1' ? 'Booking is  Accepted !'  : 'Pending ..'}}</h4>
                                        </div> --}}
                                        <div class="col-lg-2 mr-auto ml-auto p-3">
                                            @if(!$scudule->patient->image)
                                                <img width="140" height="140" class="rounded-circle" alt="Image placeholder" src="{{asset('uploads/default.png')}}">
                                            @else
                                                <img width="140" height="140" class="rounded-circle" alt="Image placeholder" src="{{$scudule->patient->image}}">
                                            @endif
                                        </div>
                                        <div class="col-lg-10 pl-5">
                                            <div class="h3 font-weight-bold text-capitalize mb-4">
                                                Patient Name : {{ $scudule->patient->name}}
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <div class="col-1">
                                                    <img src="{{url('imgs/location.svg')}}" width="25" class="mr-3"  >
                                                </div>
                                                <div class="col-8">
                                                    {{$scudule->appoiment->address}}
                                                </div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <div class="col-1">
                                                    <img src="{{url('imgs/money.svg')}}" width="25" class="mr-3">
                                                </div>
                                                <div class="col-8">
                                                    Fees: {{$scudule->appoiment->fees}} EGP
                                                </div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <div class="col-1">
                                                    <img src="{{url('imgs/wiating.svg')}}" width="25" class="mr-3"  >
                                                </div>
                                                <div class="col-8">
                                                    Waiting Time: {{$scudule->appoiment->wating}}
                                                </div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <div class="col-1">
                                                    <img src="{{url('imgs/phone.svg')}}" width="25" class="mr-3"  >
                                                </div>
                                                <div class="col-5">
                                                    {{$scudule->patient->phoneNumber}}
                                                </div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <div class="col-1">
                                                    <img src="{{url('imgs/calendar.svg')}}" width="25" class="mr-3"  >
                                                </div>
                                                <div class="col-5">
                                                    {{$scudule->day_name}}
                                                </div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <div class="col-1">
                                                    <img src="{{url('imgs/wall-clock.svg')}}" width="25" class="mr-3"  >
                                                </div>
                                                <div class="col-5">
                                                    {{$scudule->time}}
                                                </div>
                                            </div>
                                        </div>
                                        @if($scudule->is_accept == 0)
                                            <div class="row col-lg-12 mb-2 mt-3 ml-auto d-flex justify-content-end">
                                                <form action="{{route('doctor_acceptSchedules',$scudule->id)}}" method="POST" class="col-lg-2">
                                                    {{ csrf_field() }}
                                                    <input type="submit" value="Accept" class="col-lg-12 btn btn-primary h5">
                                                </form>
                                                <form action="{{route('doctor_DeclineSchedules',$scudule->id)}}" method="POST" class="col-lg-2">
                                                    {{ csrf_field() }}
                                                    <input type="submit" value="Decline" class="col-lg-12 btn btn-outline-primary h5">
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

@stop
