@extends('backEnd.layoutes.mastar')
@section('title','Doctor Old Prescription')
@section("content")
@include("backEnd.online-doctor.sidenav")
<div class="d-flex bg-veiwdoctor" id="wrapper">
    <div id="page-content-wrapper">
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
        <div class="container row col-12 ml-auto mr-auto mt-5">
            @if($rocata->patient_rays)
                @foreach($rocata->patient_rays as $patient_rays)
                    @if(auth()->guard('online_doctor')->user()->id == $patient_rays->online_doctor->id)
                        <div class="pills-main pills-main-yellow col-lg-9 row mr-auto ml-auto mb-4 ">
                            <div class="col-12">
                                <h5 class="mt-4 float-right">{{ date('d/m/Y',$patient_rays->date)}}</h5>
                            </div>
                            @foreach($patient_rays->ray_name as $t)
                                <div class="row col-12 mr-auto ml-auto mb-3">
                                    <div class="col-4">
                                        <h5 class="font-weight-bold">Radiology Name</h5>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="">{{$t['ray_name']}}</h5>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="font-weight-bold">Radiology Description</h5>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="">{{$t['ray_description']}}</h5>
                                        <!-- get result -->
                                    </div>

                                    <div class="col-7">
                                        @if($patient_rays->link)
                                            <a target="_blank" id = "link_result_show" href="{{$patient_rays->link['URLLink']}}">{{$patient_rays->link['name']}}</a>
                                        @else
                                            <div class="alert alert-danger">No Result</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
                @else
                <p class="alert alert-danger">No Data</p>
            @endif
        </div>
    </div>

</div>


@stop
