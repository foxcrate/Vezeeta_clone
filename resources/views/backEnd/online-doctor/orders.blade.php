@extends('backEnd.layoutes.mastar')
@section('title','Orders')
@section('content')
@include("backEnd.online-doctor.sidenav")
<div class="d-flex bg-page" id="wrapper">
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            <nav class="navbarp navbar-top navbar-expand navbar-dark">
                <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                    <!-- Search form -->
                    <ul class="float-lg-right pr-3">
                      {{-- <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
                        <label class="onoffswitch-label" for="myonoffswitch">
                            <div class="onoffswitch-inner"></div>
                            <div class="onoffswitch-switch"></div>
                        </label>
                    </div> --}}
                    </ul>
                    {{--  <h6 class="h5 text-white">{{$online_doctor->online == 1 ? 'online' : 'ofline'}}</h6>  --}}
                    <ul class="navbar-nav align-items-center ml-md-auto">
                      <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fa fa-bell fa-fw mr-lg-3 mt-lg-1" style="font-size: 15pt;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">

                          <div class="px-3 py-3">
                            <p class="text-muted m-0">You have <strong class="text-primary">{{$online_doctor->pRequests->count()}}</strong> notifications Requests.</p>
                          </div>

                          @include("backEnd.online-doctor.notifacation_request")

                        </div>
                      </li>
                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                      <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if(!$online_doctor->image)
                                    <img alt="Image placeholder" src="{{ asset('uploads/defualt.jpg') }}" width="50" height="40">
                                @else
                                    <img alt="Image placeholder" src="{{ $online_doctor->image }}" width="50" height="40">
                                @endif
                            </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                              <h6 class="mb-0 font-weight-bold text-white">{{$online_doctor->name}}</h6>
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
                        <img class="mt-2" src="{{url('imgs/icon_png/onlineDoctor.svg')}}" height="60" alt="...">
                    </div>
                    <div class="col-5 mb-auto mt-auto">
                        <h3 class="font-weight-bold mt-2">Doctor Orders</h3>
                    </div>
                </div>
                <table class="table table-bordered bg-white">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">id Code Doctor</th>
                        <th scope="col">id Code Patient</th>
                      </tr>
                    </thead>
                    <tbody>
                    @isset($doctorQr)
                        @foreach($doctorQr as $key => $doctorQr)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $labOrder->idEnterprise }}</td>
                                <td>{{ $labOrder->idPatient }}</td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
