@extends('backEnd.layoutes.mastar')
@section('title','Online page')
@section('content')
<div class="d-flex bg-veiwdoctor" id="wrapper">
    <!-- Sidebar -->
    @if(auth()->guard('patien'))
    @include('backEnd.patien.slidenav')
    @elseif(auth()->guard('hosptail'))
    @include('backEnd.hosptail.sidenav')
    @elseif(auth()->guard('clinic'))
    @include('backEnd.clinic.slidenav')
    @elseif(auth()->guard('xray'))
    @include('backEnd.xray.slidenav')
    @elseif(auth()->guard('labs'))
    @include('backEnd.lab.slidenav')
    @elseif(auth()->guard('pharmacy'))
    @include('backEnd.pharmacy.slidenav')
    @endif

    <!-- Page Content -->
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
      <div class="container-fluid pb-5">
        <div class="row mt-5 mb-2">
          <img src="{{url('imgs/online-d.svg')}}" class="ml-auto mr-auto" width="500" style="margin-bottom: 50px;" />
        </div>
        <div class="row container ml-auto mr-auto mb-5">
          <div id="tab-sidebar" class="row col-lg-12 mr-auto ml-auto" role="tablist" aria-orientation="vertical">
            @foreach($doctorSp as $sp)
              <div class="item-spcailty col-lg-3 m-1 font-weight-bold h6 mr-auto ml-auto text-center">
                  <a class="text-spcailty font-weight-bold text-decoration " href="{{route("showDoctors",[$patient->id,$sp->id])}}">{{$sp->name}}</a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      @include('backEnd.layoutes.footer')
    </div>
</div>
@stop

