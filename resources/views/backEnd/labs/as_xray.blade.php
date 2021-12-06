@extends('backEnd.layoutes.mastar')
@section('title','Choose .. ')
@section('content')
    <!--Welcome-->
    <div id="myModal" class="modal" role="dialog">
        <div class="mr-auto ml-auto mt-5">
            <!-- Modal content-->
            <img src="imgs/welcome1.png" width="">
        </div>
    </div>
    <!--End-Welcome-->
    <div class="d-flex bg-as" id="wrapper">
        <!-- Sidebar -->
    @include('backEnd.labs.slidenav')
    <!-- sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
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

                        </ul>
                        <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                            <li class="nav-item dropdown">
                                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                              <img alt="Image placeholder" src="@if($labs->image) {{url('uploads/lab/' . $labs->image)}} @else {{url('uploads/' . $labs->image)}}@endif">
                            </span>
                                        <div class="media-body ml-3 mr-3 d-lg-block">
                                            <h6 class="mb-0 font-weight-bold text-white">{{$labs->labsName}}</h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- informationContent -->
            <div class="container-fluid " style="margin-top: 250px; margin-bottom: 170px;">
              <div class="header">
              <h3 class="text-white ml-5 mt-5" style="font-size:70pt" >Welcome {{$labs->labsName}}.</h3>
              <h2 class="text-white ml-5 mt-5">Choose a Login With ... </h2>
                <div class="header">
                    <div class="container-fluid row mt-5 mb-5 text-center">
                        <div class="col-md-3">
                            <a href="{{route('labs.profile',$labs->id)}}"><img class="" src="{{url('imgs/labs0.png')}}" height="" width="150" alt="Responsive image"></a>
                        </div>

                        @if($labs->is_xray == 1)
                            <div class="col-md-2">
                                <a href="#"><img class="" src="{{url('imgs/xray0.png')}}" height="" width="150" alt="Responsive image"></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--Start-Footer-->
        @include('backEnd.layoutes.footer')
        <!--End-Footer-->
    </div>



@stop
