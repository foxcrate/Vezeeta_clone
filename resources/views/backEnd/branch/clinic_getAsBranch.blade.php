@extends('backEnd.layoutes.mastar')
@section('title','Choose .. ')
@section('content')
<!--Welcome-->
<div id="myModal" class="modal" role="dialog">
    <div class="mr-auto ml-auto mt-5">
      <!-- Modal content-->
      <img src="{{url('imgs/welcome1.png')}}" width="">
    </div>
  </div>
  <!--End-Welcome-->
  <div class="d-flex bg-as" id="wrapper">
    <!-- Sidebar -->
    @include('backEnd.branch.clinic_sidenav')
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbarp navbar-top navbar-expand navbar-dark">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar links -->
                <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                <!-- Search form -->
                {{-- <ul class="float-lg-right pr-5">
                  <div class="toggle toggle__wrapper">
                    <div id="toggle-example-1" role="switch" aria-checked="false" class="toggle__button">
                      <div class="toggle__switch"></div>
                    </div>
                  </div>
                </ul> --}}
                <ul class="navbar-nav align-items-center ml-md-auto">
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="ni ni-bell-55 mr-lg-3 mt-lg-1" style="font-size: 15pt;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                      <!-- Dropdown header -->
                      <div class="px-3 py-3">
                        <p class="text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</p>
                      </div>
                      <!-- List group -->
                      <div class="list-group-noti list-group-flush">
                        <a href="#!" class="list-group-item list-group-item-action">
                          <div class="row align-items-center">
                            <div class="col-auto mb-3">
                              <!-- Avatar -->
                              <img alt="Image placeholder" src="{{url('imgs/team-1.jpg')}}" class="avatar rounded-circle">
                            </div>
                            <div class="col ml--2">
                              <div class="d-flex justify-content-between align-items-center">
                                <div>
                                  <h6 class="text-gray-d">John Snow</h6>
                                </div>
                                <div class="text-right text-muted">
                                  <small class="text-primary">2 hrs ago</small>
                                </div>
                              </div>
                              <p class="">Lets meet at Starbucks at 11:30. Wdyt?</p>
                            </div>
                          </div>
                        </a>
                        <a href="#!" class="list-group-item list-group-item-action">
                          <div class="row align-items-center">
                            <div class="col-auto mb-3">
                              <!-- Avatar -->
                              <img alt="Image placeholder" src="{{url('imgs/team-1.jpg')}}" class="avatar rounded-circle">
                            </div>
                            <div class="col ml--2">
                              <div class="d-flex justify-content-between align-items-center">
                                <div>
                                  <h6 class="text-gray-d">John Snow</h6>
                                </div>
                                <div class="text-right text-muted">
                                  <small class="text-primary">3 hrs ago</small>
                                </div>
                              </div>
                              <p class="">A new issue has been reported for Argon.</p>
                            </div>
                          </div>
                        </a>
                      </div>
                      <!-- View all -->
                      <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                    </div>
                  </li>
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                  <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                          <img alt="Image placeholder" src="@if($clinic->image) {{url('uploads/clinic/' . $clinic->image)}} @else {{url('uploads/' . $clinic->image)}}@endif">
                        </span>
                        <div class="media-body ml-3 mr-3 d-lg-block">
                          <h6 class="mb-0 font-weight-bold text-white">Mohamed Ahmed</h6>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>
        <!-- informationContent -->
        <div class="container-fluid" style="margin-top: 210px; margin-bottom: 170px;">
          <div class="header">
          <h3 class="text-white ml-5 mt-5" style="font-size:70pt" >Welcome {{$clinic->clinicName}}.</h3>
          <h6 class="text-white ml-5 mt-5" style="font-size:45pt" >{{$branch->name}}.</h6>
          <h2 class="text-white ml-5 mt-5">Choose a Login With ... </h2>
            <div class="container-fluid row mt-5 mb-5 text-center">
              <div class="col-md-3">
                <a href="{{route('clinic_branch_login_doctor',[$clinic->id,$branch->id])}}"><img class="img-doctor" src="{{url('imgs/doctor0.png')}}" height="" width="170" alt="Responsive image"></a>
              </div>

              @if($branch->is_xray == 1)
              <div class="col-md-3">
                <a href="{{route('clinic_get_search_xray',$clinic->id)}}"><img class="img-x-ray" src="{{url('imgs/xray0.png')}}" height="" width="170" alt="Responsive image"></a>
              </div>
              @endif
              @if($branch->is_lab == 1)
              <div class="col-md-3">
                <a href="{{route('clinic_get_search_lab',$clinic->id)}}"><img class="img-labs" src="{{url('imgs/labs0.png')}}" height="" width="170" alt="Responsive image"></a>
              </div>
              @endif
              @if($branch->is_pharmacy == 1)
              <div class="col-md-3">
                <a href="{{route('clinic_get_search_pharmacy',$clinic->id)}}"><img class="img-pharmacy" src="{{url('imgs/pharm0.png')}}" height="" width="170" alt="Responsive image"></a>
              </div>
              @endif
            </div>
          </div>
        </div>
        <!--Start-Footer-->
        @include('backEnd.layoutes.footer')
      <!--End-Footer-->
    </div>
  </div>



@stop