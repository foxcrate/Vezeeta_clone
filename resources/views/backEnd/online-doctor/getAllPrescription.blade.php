@extends('backEnd.layoutes.mastar')
@section('title','Doctor All Prescription')
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
                <h6 class="h5 text-white">{{$online_doctor->online == 1 ? 'online' : 'ofline'}}</h6>
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
        <!-- sss -->
        <div class="container row col-12 ml-auto mr-auto mt-5">

            <ul class="nav nav-pills col-7 ml-auto mr-auto mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link search-pres active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Prescription</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link search-pres" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Test</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link search-pres" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Rediology</a>
                </li>
            </ul>
            <div class="container">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="header-body">
                            <div class="row col-12 pt-5">
                                <!-- roachata -->
                                @if($patient->Raoucheh)
                                    @foreach($patient->Raoucheh as $Raoucheh)
                                        @if(auth()->guard('online_doctor')->user()->id == $Raoucheh->online_doctor_id)
                                            <div class="pills-main pills-main-yellow col-xl-9 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                            <div class="row col-lg-8 ml-5 mt-5">
                                                <div class="row col-lg-12">
                                                <div class="col-4">
                                                    <h5 class="font-weight-bold text-primary">Dr.</h5>
                                                </div>
                                                <div class="col-5">
                                                    <h5 class="">{{auth('online_doctor')->user()->name }}</h5>
                                                </div>
                                                </div>
                                                <div class="row col-12 ">
                                                <div class="col-4">
                                                    <h5 class="font-weight-bold text-primary">Speciality :</h5>
                                                </div>
                                                <div class="col-5">
                                                    <h5 class="">{{$Raoucheh->online_doctor->special->name}}</h5>
                                                </div>
                                                </div>
                                                <div class="row col-12 ">
                                                <div class="col-4">
                                                    <h5 class="font-weight-bold text-primary">Date:</h5>
                                                </div>
                                                <div class="col-5">
                                                    <h5 class="">{{date('d/m/Y',$Raoucheh->date)}}</h5>
                                                </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-3 mt-5">
                                                <h5 class="font-weight-bold h3 text-uppercase">{{auth()->guard('hosptail')->user()->hosptailName}}</h5>
                                            </div> --}}
                                            <div class="row col-lg-10 mb-2 ml-5">
                                                <div class="col-3">
                                                <h5 class="font-weight-bold text-primary">Patient State :</h5>
                                                </div>
                                                <div class="col-5">
                                                <h5 class="">{{$Raoucheh->prescription}}</h5>
                                                </div>
                                            </div>
                                            <hr class="col-lg-11 ml-auto mr-auto mb-5" />
                                            <div class="row col-lg-12 mb-3">
                                                <div class="col-10 ml-auto mr-auto">
                                                    <h5 class="font-weight-bold text-primary">Medication</h5>
                                                </div>
                                                @if($Raoucheh->medication)
                                                    <div class="col-10 ml-auto mr-auto">
                                                    <table class="table">
                                                        <tbody>
                                                        <tr>
                                                            <th class="text-center">Medication Name</th>
                                                            <th class="text-center">Times Day</th>
                                                            <th class="text-center">Time</th>
                                                        </tr>
                                                        @foreach($Raoucheh->medication as $medication)
                                                        <tr>
                                                            <td class="text-center border-0 h5">{{$medication['name']}}</td>
                                                            <td class="text-center border-0 h5">{{$medication['times_day']}}</td>
                                                            <td class="text-center border-0 h5">{{$medication['time']}}</td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                @endif
                                            </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="col-lg-12 alert alert-danger">No Data</p>
                                @endif
                      <!-- roachata -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="header-body">
                            <div class="row col-12 pt-5">
                                @if($patient->patient_analzes)
                                  @foreach($patient->patient_analzes as $p_analzes)

                                          <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                              <div class="col-12">
                                                  <h5 class="mt-4 float-right">{{date('d/m/Y',$p_analzes->date)}}</h5>
                                              </div>
                                              @foreach($p_analzes->test_name as $t)
                                              <div class="row col-12 mb-3">
                                                <div class="col-4">
                                                    <h5 class="font-weight-bold">Test Name</h5>
                                                </div>
                                                <div class="col-8">
                                                    <h5 class="">{{$t['test_name']}}</h5>
                                                </div>

                                            </div>
                                            <div class="row col-12 mb-3">
                                                <div class="col-4">
                                                    <h5 class="font-weight-bold">Test Description</h5>
                                                </div>
                                                <div class="col-8">
                                                    <h5 class="">{{$t['test_description']}}</h5>
                                                    <!-- get result -->
                                                {{-- <p>{{$p_analzes->result->id}}</p> --}}
                                                <!-- get result -->
                                                </div>

                                                <div class="col-7">
                                                    @if($p_analzes->link)
                                                        <a target="_blank" id = "link_result_show" href="{{$p_analzes->link['URLLink']}}">{{$p_analzes->link['name']}}</a>
                                                    @else
                                                        <div class="alert alert-danger">No Result</div>
                                                    @endif
                                                </div>
                                            </div>
                                              @endforeach
                                          </div>

                                  @endforeach


                                    @else
                                    <p class="alert alert-danger">No Data</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="header-body">
                            <div class="row col-12 pt-5">
                                @if($patient->patient_rays)
                                    @foreach($patient->patient_rays as $patient_rays)
                                        <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                            <div class="col-12">
                                                <h5 class="mt-4 float-right">{{date('d/m/Y',$patient_rays->date)}}</h5>
                                            </div>
                                            @foreach($patient_rays->ray_name as $r)
                                                <div class="row col-12 mb-3">
                                                    <div class="col-4">
                                                        <h5 class="font-weight-bold">Radiology Name</h5>
                                                    </div>

                                                    <div class="col-8">
                                                        <h5 class="">{{$r['ray_name']}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row col-12 mb-3">
                                                    <div class="col-4">
                                                        <h5 class="font-weight-bold">Radiology Description</h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 class="">{{$r['ray_description']}}</h5>
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

                                    @endforeach
                                    @else
                                        <p class="alert alert-danger">No Data</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- aa -->
    </div>
</div>




@stop
