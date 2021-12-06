@extends('backEnd.layoutes.mastar')
@section('title','Choose .. ')
@section('content')
<!--Welcome-->
<div id="myModal" class="modal" role="dialog">
    <div class="mr-auto ml-auto mt-5">
      <!-- Modal content-->
      <img src="{{url('imgs/welcome1.png')}}" width=>
    </div>
  </div>
  <!--End-Welcome-->
  <div class="d-flex bg-as" id="wrapper">
    <!-- Sidebar -->
    @include('backEnd.pharmacy.slidenav')
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
                  
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                  <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                          <img alt="Image placeholder" src="@if($pharmacy->image) {{url('uploads/lab/' . $pharmacy->image)}} @else {{url('uploads/' . $pharmacy->image)}}@endif">
                        </span>
                        <div class="media-body ml-3 mr-3 d-lg-block">
                          <h6 class="mb-0 font-weight-bold text-white">{{$pharmacy->pharmacyName}}</h6>
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
          <h3 class="text-white ml-5 mt-5" style="font-size:70pt" >Welcome {{$branch->name}}.</h3>
          <h2 class="text-white ml-5 mt-5">Choose a Login With ... </h2>
            <div class="container-fluid row mt-5 mb-5 text-center">
              
              <div class="col-md-3">
                <a href="{{route('pharmacy.profile',$pharmacy->id)}}"><img class="img-pharmacy" src="{{url('imgs/pharm1.png')}}" height="" width="170" alt="Responsive image"></a>
              </div>
              
              @if($branch->is_xray == 1)
              <div class="col-md-3">
                <a href="#"><img class="img-x-ray" src="{{url('imgs/xray0.png')}}" height="" width="170" alt="Responsive image"></a>
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