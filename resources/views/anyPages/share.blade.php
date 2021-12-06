@extends('backEnd.layoutes.mastar')
@section('title','Share page')
@section('content')
<div class="d-flex bg-page" id="wrapper">
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
    <!-- /#sidebar-wrapper -->

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
                          <img alt="Image placeholder" src="@if($patient->image) {{url('uploads/patien/' . $patient->image)}} @else {{url('uploads/' . $patient->image)}}@endif">
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
        <!-- informationContent -->
        <div class="container-fluid">
            <div class="header mt-5 mb-4">
                <div class="container-fluid card col-11 p-4">
                  <div class="header-body row ml-auto mr-auto">
                    <div class="col-md-6 p-3">
                      <img class="" src="{{url('imgs/underconstruction.svg')}}" width="600" alt="Responsive image">
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <!--Start-Footer-->
        @include('backEnd.layoutes.footer')
        <!--End-Footer-->
    </div>
  </div>



@stop