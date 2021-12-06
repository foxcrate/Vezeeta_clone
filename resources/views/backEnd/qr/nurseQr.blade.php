@extends('backEnd.layoutes.mastar')
@section('title','Nurse Qr')
@section('content')
<div class="d-flex" id="wrapper">
    @include('backEnd.nurse.sidenav')
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
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
                          <div class="list-group-noti list-group-flush">
                            <a href="#!" class="list-group-item list-group-item-action">
                              <div class="row align-items-center">
                                <div class="col-auto mb-3">
                                  <!-- Avatar -->
                                  <img alt="Image placeholder" src="imgs/team-1.jpg" class="avatar rounded-circle">
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
                                  <img alt="Image placeholder" src="imgs/team-1.jpg" class="avatar rounded-circle">
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
                              <img alt="Image placeholder" src="{{$nurse->image}}">
                            </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                              <h6 class="mb-0 font-weight-bold text-white">{{$nurse->name}}</h6>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
            </nav>
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-md-10 ml-auto mr-auto mb-4 pharmacy_item">
                        <div class="m-5 col-lg-6 mr-auto ml-auto">
                            {!! QrCode::size(400)->generate($nurse->idCode); !!}
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
