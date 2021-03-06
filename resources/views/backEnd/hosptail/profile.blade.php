@extends('backEnd.layoutes.mastar')
@section('title','Profile')
@section('content')
<!-- Sidenav -->
<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.hosptail.sidenav')
<div id="page-content-wrapper">
    <!-- Topnav -->
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
                      <img alt="Image placeholder" src="{{url('uploads/hosptail/' . $hosptail->image)}}">
                    </span>
                    <div class="media-body ml-3 mr-3 d-lg-block">
                      <h6 class="mb-0 font-weight-bold text-white">{{$hosptail->firstName . ' ' . $hosptail->middleName}}</h6>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <!-- informationContent -->
    <div class="container-fluid">
      <div class="header pb-6">
      <div class="header" style="margin-top: 250px; margin-bottom: 250px;">
            <div class="container-fluid">
              <div class="header-body">
                <div class="row mt-3">
                  <div class="col-xl-9 pt-2 pr-4 pl-4 pb-5 mr-auto ml-auto">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        @foreach($errors->all() as $error)
                        <div class="col-8 ml-auto mr-auto alert alert-danger">{{$error}}</div>
                        @endforeach
                        <h5 class="col-8 ml-auto mr-auto font-weight-bold p-4">Enter Patient ID </h5>
                        <form action="{{route('hosptail.patient.search',[$hosptail->id,auth()->guard('doctor')->user()->id])}}" method="GET">
                            <div class="row m-1">
                                <div class="col-md-8 mr-auto ml-auto ui input large mb-3">
                                <input id="name" class="" type="text" name="search" placeholder="Enter Your ID" required = "required" value = "P">
                                </div>
                                <div class="col-md-8 mr-auto ml-auto ui input mt-3 mb-3">
                                <button class="btn btn-primary col-md-12"><i class="fa fa-search mr-2" aria-hidden="true"></i>Search</button>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    @include('backEnd.layoutes.footer')
</div>
</div>

@stop
@section('scripts')
  <script>
    /* write one char and numper only */
    var btn = document.getElementById("name");
    btn.addEventListener("keypress", function (evt) {
        if(btn.value.length===0 &&(evt.keyCode < 57||evt.keyCode < 48)){
                    evt.preventDefault();
        }else if(btn.value.length>0 &&(evt.keyCode < 48 || evt.keyCode > 57)) {
                evt.preventDefault();
        }

    });

    /* write one char and numper only */
  </script>
@stop
