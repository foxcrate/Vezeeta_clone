@extends('backEnd.layoutes.mastar')
@section('title','Child All Presciption')
@section('content')
@include('backEnd.hosptail.sidenav')
@php 
    $rocata_child = $child->rocatas;
    $test_child = $child->test_child;
    $ray_child = $child->ray_child;
@endphp
<div class="d-flex img-pop" id="wrapper">
    <div id="page-content-wrapper">
        <!-- Topnav -->
        @include('includes.patientNav')
        <div class="container-fluid">
            <div class="header img-header pb-6">
              <div class="container-fluid" style="margin-top:130px; margin-bottom:130px;">
                <nav class="col-8 ml-auto mr-auto">
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link font-weight-bold text-primary active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Prescription</a>
                    <a class="nav-item nav-link font-weight-bold text-primary" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tests</a>
                    <a class="nav-item nav-link font-weight-bold text-primary" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Radiology</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="header-body">
                      <div class="row pt-5">
                        <!-- roachata -->
                        @if($rocata_child)
                        @foreach($rocata_child as $rocata_child)
                        @if(auth()->guard('doctor')->user()->id == $rocata_child->doctor_id)
                          <div class="pills-main pills-main-yellow col-xl-9 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                            <div class="row col-lg-8 ml-5 mt-5">
                              <div class="row col-lg-12">
                                <div class="col-4">
                                  <h5 class="font-weight-bold text-primary">Dr.</h5>
                                </div>
                                <div class="col-5">
                                  <h5 class="">{{auth()->guard('doctor')->user()->name}}</h5>
                                </div>
                              </div>
                              <div class="row col-12 ">
                                <div class="col-4">
                                  <h5 class="font-weight-bold text-primary">Speciality :</h5>
                                </div>
                                <div class="col-5">
                                  <h5 class="">{{auth()->guard('doctor')->user()->Primary_Speciality}}</h5>
                                </div>
                              </div>
                              <div class="row col-12 ">
                                <div class="col-4">
                                  <h5 class="font-weight-bold text-primary">Date:</h5>
                                </div>
                                <div class="col-5">
                                  <h5 class="">{{$rocata_child->created_at}}</h5>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 mt-5">
                              <h5 class="font-weight-bold h3 text-uppercase">{{auth()->guard('hosptail')->user()->hosptailName}}</h5>
                            </div>
                            <div class="row col-lg-10 mb-2 ml-5">
                              <div class="col-3">
                                <h5 class="font-weight-bold text-primary">Patient State :</h5>
                              </div>
                              <div class="col-5">
                                <h5 class="">{{$rocata_child->prescription}}</h5>
                              </div>
                            </div>
                            <hr class="col-lg-11 ml-auto mr-auto mb-5" />
                            <div class="row col-lg-12 mb-3">
                                <div class="col-10 ml-auto mr-auto">
                                    <h5 class="font-weight-bold text-primary">Medication</h5>
                                </div>
                                @if($rocata_child->medication)
                                  <div class="col-10 ml-auto mr-auto">
                                    <table class="table">
                                      <tbody>
                                        <tr>
                                          <th class="text-center">Medication Name</th>
                                          <th class="text-center">Times Day</th>
                                          <th class="text-center">Time</th>
                                        </tr>
                                        @foreach(json_decode($rocata_child->medication) as $medication)
                                        <tr>
                                          <td class="text-center border-0 h5">{{$medication->name}}</td>
                                          <td class="text-center border-0 h5">{{$medication->times_day}}</td>
                                          <td class="text-center border-0 h5">{{$medication->time}}</td>
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
                  <!-- analzes -->
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      <div class="header-body">
                          <div class="row pt-5">
                              @if($test_child)
                                    @foreach($test_child as $test_child)
                                        @if(auth()->guard('doctor')->user()->id == $test_child->doctor_id)
                                            <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                                <div class="col-12">
                                                    <h5 class="mt-4 float-right">{{$test_child->created_at}}</h5>
                                                </div>
                                                @foreach(json_decode($test_child->test_name) as $t)
                                                <div class="row col-12 mb-3">
                                                  <div class="col-4">
                                                      <h5 class="font-weight-bold">Test Name</h5>
                                                  </div>
                                                  <div class="col-8">
                                                      <h5 class="">{{$t->test_name}}</h5>
                                                  </div>
                                                  
                                              </div>
                                              <div class="row col-12 mb-3">
                                                  <div class="col-4">
                                                      <h5 class="font-weight-bold">Test Description</h5>
                                                  </div>
                                                  <div class="col-8">
                                                      <h5 class="">{{$t->test_description}}</h5>
                                                      <!-- get result -->
                                                  {{-- <p>{{$p_analzes->result->id}}</p> --}}
                                                  <!-- get result -->
                                                  </div>
  
                                                  @if($test_child->result)
                                                  <h5 class="font-weight-bold" id = "btn_result">Result : </h5>
                                                  <a id = "link_result_show" href="{{url('uploads/pdf_file/result/analzes/' . $p_analzes->result->name)}}">{{$p_analzes->result->name}}</a>
                                                  @else
                                                  <div class="alert alert-danger">No Result</div>
                                                  @endif
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
                  <!-- analzes -->
                  <!-- rays -->
                  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                      <div class="header-body">
                          <div class="row pt-5">
                              @if($ray_child)
                                  @foreach($ray_child as $ray_child)
                                  @if(auth()->guard('doctor')->user()->id == $ray_child->doctor_id)
                                  <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                    <div class="col-12">
                                        <h5 class="mt-4 float-right">{{$ray_child->created_at}}</h5>
                                    </div>
                                    @foreach(json_decode($ray_child->ray_name) as $r)
                                    <div class="row col-12 mb-3">
                                      <div class="col-4">
                                          <h5 class="font-weight-bold">Radiology Name</h5>
                                      </div>
  
                                      <div class="col-8">
                                          <h5 class="">{{$r->ray_name}}</h5>
                                      </div>
                                  </div>
                                  <div class="row col-12 mb-3">
                                      <div class="col-4">
                                          <h5 class="font-weight-bold">Radiology Description</h5>
                                      </div>
                                      <div class="col-8">
                                          <h5 class="">{{$r->ray_description}}</h5>
                                      </div>
                                      @if($ray_child->result)
                                      <h5 class="font-weight-bold" id = "btn_result">Result : </h5>
                                      <a id = "link_result_show" href="{{url('uploads/pdf_file/result/rays/' . $ray_child->result->name)}}">{{$ray_child->result->name}}</a>
                                      @else
                                      <div class="alert alert-danger">No Result</div>
                                      @endif
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
                  <!-- rays -->
                </div>
              </div>
            </div>
          </div>

    </div>
    
    @stop
  