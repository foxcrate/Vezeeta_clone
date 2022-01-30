@extends('backEnd.layoutes.mastar')
@section('title','Orders')
@section('content')
<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.xray.slidenav')
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            <!-- Topnav -->
            <nav class="navbarp navbar-top navbar-expand navbar-dark border-bottom">
                <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                    <!-- Search form -->
                    <ul class="navbar-nav align-items-center ml-md-auto">
                      <li class="nav-item dropdown">


                      </li>
                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                      <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if(!$xray->image)
                                    <img alt="Image placeholder" src="{{ asset('uploads/default.png') }}" width="80" height="80">
                                @else
                                    <img alt="Image placeholder" src="{{$xray->image}}" width="80" height="80">
                                @endif
                            </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                              <h6 class="mb-0 font-weight-bold text-white">{{$xray->xrayName}}</h6>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
            </nav>
            <div class="container mt-2">
                <div class="row mb-5 mt-5">
                    <div class="col-1 mb-auto mt-auto">
                        <img class="mt-2" src="{{url('imgs/x-ray.svg')}}" height="60" alt="...">
                    </div>
                    <div class="col-5 mb-auto mt-auto">
                        <h3 class="font-weight-bold mt-2 ml-4">Xray Orders</h3>
                    </div>
                </div>
                <table class="table table-bordered bg-white">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">id Code Xray</th>
                        <th scope="col">id Code Patient</th>
                      </tr>
                    </thead>
                    <tbody>
                    @isset($xrayOrders)
                        @foreach($xrayOrders as $key => $xrayOrder)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $xrayOrder->idEnterprise }}</td>
                                <td>{{ $xrayOrder->idPatient }}</td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>

        </div>
    </div>




@stop
