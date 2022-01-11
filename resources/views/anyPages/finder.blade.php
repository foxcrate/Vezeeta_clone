@extends('backEnd.layoutes.mastar')
@section('title','Finder')
@section('content')
<div class="d-flex bg-veiwdoctor" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">

        <nav class="navbarp navbar-top navbar-expand navbar-dark border-bottom">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar links -->
                <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                <!-- Search form -->

                <ul class="navbar-nav align-items-center ml-md-auto">
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-bell fa-fw mr-lg-3 mt-lg-1" style="font-size: 15pt;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                      <!-- Dropdown header -->
                      <div class="px-3 py-3">
                        <p class="text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</p>
                      </div>
                      <!-- List group -->
                     @include('backEnd.patien.notifacation')

                    </div>
                  </li>
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                  <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if(auth()->guard('patien'))
                          <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if(!$patient->image)
                                    <img src="{{ asset('uploads/default.png') }}" class="rounded-circle">
                                @else
                                    <img src="{{$patient->image}}" class="rounded-circle">
                                @endif
                            </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                              <h6 class="mb-0 font-weight-bold text-white">{{$patient->firstName . ' ' . $patient->lastName}}</h6>
                            </div>
                          </div>
                          @elseif(auth()->guard('hosptail'))
                          <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                              <img alt="Image placeholder" src="@if($hosptail->image) {{url('uploads/hosptail/' . $hosptail->image)}} @else {{url('uploads/' . $hosptail->image)}}@endif">
                            </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                              <h6 class="mb-0 font-weight-bold text-white">{{$patient->hosptailName}}</h6>
                            </div>
                          </div>
                          @elseif(auth()->guard('clinic'))
                          <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                              <img alt="Image placeholder" src="@if($clinic->image) {{url('uploads/clinic/' . $clinic->image)}} @else {{url('uploads/' . $clinic->image)}}@endif">
                            </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                              <h6 class="mb-0 font-weight-bold text-white">{{$patient->clinicName}}</h6>
                            </div>
                          </div>
                          @elseif(auth()->guard('xray'))
                          <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                              <img alt="Image placeholder" src="@if($xray->image) {{url('uploads/xray/' . $xray->image)}} @else {{url('uploads/' . $xray->image)}}@endif">
                            </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                              <h6 class="mb-0 font-weight-bold text-white">{{$xray->xrayName}}</h6>
                            </div>
                          </div>
                          @elseif(auth()->guard('lab'))
                          <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                              <img alt="Image placeholder" src="@if($labs->image) {{url('uploads/lab/' . $labs->image)}} @else {{url('uploads/' . $labs->image)}}@endif">
                            </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                              <h6 class="mb-0 font-weight-bold text-white">{{$patient->labsName}}</h6>
                            </div>
                          </div>
                          @elseif(auth()->guard('pharmacy'))
                          <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                              <img alt="Image placeholder" src="@if($pharmacy->image) {{url('uploads/pharmacy/' . $pharmacy->image)}} @else {{url('uploads/' . $pharmacy->image)}}@endif">
                            </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                              <h6 class="mb-0 font-weight-bold text-white">{{$pharmacy->pharmacyName}}</h6>
                            </div>
                          </div>
                          @endif
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <div class="container-fluid">
            <div class="finder-background">
                <div class="col-lg-8 ml-auto mr-auto text-center mb-5">
                    <img src="{{url('imgs/finder/finder.png')}}" width="300" style="margin-top: 15%;">
                </div>
                <div class="finder-layouts">
                    <div class="find-layout">
                        <a href="{{route('finder.doctor',$patient->id)}}">
                            <img src="{{url('imgs/finder/DOCTORF.png')}}" width="90">
                            <p>Doctor</p>
                        </a>
                    </div>
                </div>
                <div class="find-layout">
                    <a href="{{route('finder.nurse',$patient->id)}}">
                        <img src="{{url('imgs/finder/nurse.png')}}" width="90">
                        <p>Nurse</p>
                    </a>
                </div>
                <div class="find-layout">
                    <a href="{{route('finder.pharmacy',$patient->id)}}">
                        <img src="{{url('imgs/finder/PHARM.png')}}" width="90">
                        <p>Pharmacy</p>
                    </a>
                </div>
                <div class="find-layout">
                    <a href="{{route('finder.xray',$patient->id)}}">
                        <img src="{{url('imgs/finder/XRAYS.png')}}" width="90">
                        <p>X-Ray</p>
                    </a>
                </div>
                <div class="find-layout">
                    <a href="{{route('finder.lab',$patient->id)}}">
                        <img src="{{url('imgs/finder/LABS.png')}}" width="90">
                        <p>Labs</p>
                    </a>
                </div>
            </div>
            </div>
        </div>
    </div>
    {{-- <div id="page-content-wrapper">
        <div class="main-content bg-as" id="panel">
            <div class="container-fluid mt-5">
                <div class="col-lg-12 ml-auto mr-auto text-center mb-5">
                    <img src="{{url('imgs/finder/finder.png')}}" class="text-center" width="350" style="margin-top: 12%">
                </div>
                <div class="find-layout">
                    <div class="find-card">
                        <a class="">
                            <a href="{{route('finder.doctor',$patient->id)}}"><img src="{{url('imgs/finder/DOCTORF.png')}}" width="90"></a>
                            <a href="{{route('finder.doctor',$patient->id)}}" class="h4 text-dark font-weight-bold mt-3 text-decoration">Doctor</a>
                        </a>
                    </div>
                    <div>
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.nurse',$patient->id)}}"><img src="{{url('imgs/finder/nurse.png')}}" width="90"></a>
                            <a href="{{route('finder.nurse',$patient->id)}}" class="h5 text-dark font-weight-bold mt-3 text-decoration col">Nurse</a>
                        </div>
                    </div>
                    <div>
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.pharmacy',$patient->id)}}"><img src="{{url('imgs/finder/PHARM.png')}}" width="90"></a>
                            <a href="{{route('finder.pharmacy',$patient->id)}}" class="h5 text-dark font-weight-bold mt-3 text-decoration">Pharmacy</a>
                        </div>
                    </div>
                    <div>
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.xray',$patient->id)}}"><img src="{{url('imgs/finder/XRAYS.png')}}" width="90"></a>
                            <a href="{{route('finder.xray',$patient->id)}}" class="h4 text-dark font-weight-bold mt-3 text-decoration col">X-Ray</a>
                        </div>
                    </div>
                    <div>
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.lab',$patient->id)}}"><img src="{{url('imgs/finder/LABS.png')}}" width="90"></a>
                            <a href="{{route('finder.lab',$patient->id)}}" class="h4 text-dark font-weight-bold mt-3 text-decoration col">Labs</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div> --}}
</div>
@endsection




