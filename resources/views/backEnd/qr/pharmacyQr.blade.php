@extends('backEnd.layoutes.mastar')
@section('title','Pharmacy Qr')
@section('content')
<div class="d-flex" id="wrapper">
    @include('backEnd.pharmacy.slidenav')
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
                <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                    <!-- Search form -->
                    <ul class="navbar-nav align-items-center ml-md-auto">
                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                      <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if(!$pharmacy->image)
                                    <img alt="Image placeholder" src="{{ asset('uploads/default.png') }}"  width="200" height="40">
                                @else
                                    <img alt="Image placeholder" src="{{ $pharmacy->image }}"  width="200" height="40">
                                @endif
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
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-md-10 ml-auto mr-auto mb-4 pharmacy_item">
                        <div class="m-5 col-lg-6 mr-auto ml-auto">
                            {!! QrCode::size(400)->generate($pharmacy->idCode); !!}
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
