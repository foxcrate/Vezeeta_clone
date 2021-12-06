@extends('backEnd.layoutes.mastar')
@section('title','Profile')
@section('content')
<!-- Sidenav -->

<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.clinic.slidenav')
<!-- main content -->
<div id="page-content-wrapper">
    <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar links -->
            <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
            <!-- Search form -->
            <ul class="float-lg-right pr-5">
              {{-- <div class="toggle toggle__wrapper">
                <div id="toggle-example-1" role="switch" aria-checked="false" class="toggle__button">
                  <div class="toggle__switch"></div>
                </div>
              </div> --}}
            </ul>
            <ul class="navbar-nav align-items-center ml-md-auto">

            </ul>
            <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
              <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                      <img alt="Image placeholder" src="@if($clinic->image) {{url('uploads/clinic/' . $clinic->image)}} @else {{url('uploads/' . $clinic->image)}}@endif">
                    </span>
                    <div class="media-body ml-3 mr-3 d-lg-block">
                      <h6 class="mb-0 font-weight-bold text-white">{{$clinic->clinicName}}</h6>
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
        <div class="header" style="margin-top: 250px; margin-bottom: 250px;">
            <div class="container-fluid">
              <div class="header-body">
                <div class="row mt-3">
                  <div class="col-lg-10 pt-2 pr-4 pl-4 pb-5 mr-auto ml-auto">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                        <h5 class="col-8 ml-auto mr-auto font-weight-bold p-4">Enter Patient ID</h5>
                        <form action="{{route('clinic.patient.search',[$clinic->id,auth()->guard('doctor')->user()->id])}}" method="GET">
                          <div class="row m-1">
                              <div class="col-md-8 mr-auto ml-auto ui input large mb-3">
                                  <input id = "name" class="form-control" type="text" name="search" placeholder="Enter Your ID" required = "required" value="P">
                              </div>
                              <div class="col-md-8 mr-auto ml-auto ui input mt-3 mb-3">
                                <button class="btn btn-primary col-md-12 h3"><i class="fa fa-search mr-2" aria-hidden="true"></i>Search</button>
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
