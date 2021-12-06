@extends('backEnd.layoutes.mastar')
@section('title',$patient->firstName . ' ' . $patient->middleName)
@section('content')

<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.hosptail.sidenav')
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar links -->
                <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                <ul class="navbar-nav align-items-center ml-md-auto">

                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                  <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                          <img alt="Image placeholder" src="@if($hosptail->image) {{url('uploads/lab/' . $hosptail->image)}} @else {{url('uploads/' . $hosptail->image)}}@endif">
                        </span>
                        <div class="media-body ml-3 mr-3 d-lg-block">
                          <h6 class="mb-0 font-weight-bold text-white">{{$hosptail->hosptailName}}</h6>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>

    <!-- informationContent -->
    <div class="container mb-5">
        @if(session('success_msg'))
            <div class="alert alert-success">
                {{session('success_msg')}}
            </div>
        @endif
        <div class="row pt-5">
          <div class="col-md-12 slide-img mb-5 mr-auto ml-auto ">
            <img class="d-xs-none ml-5" id="about-img" src="{{url('imgs/s1.jpg')}}" height="300" width="895" alt="Responsive image">
          </div>
          <div class="col-xl-6 col-md-4 mb-5 mr-auto ml-auto">
            <!-- Button trigger modal -->
            <div class="text-center">
              <button type="button" class="btn btn-primary text-white col-8 h4" data-toggle="modal" data-target="#Testing">
                <i class="fas fa-eye mr-2"></i> Show
              </button>
            </div>
            <!-- Modal -->
              <div class="modal fade" id="Testing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Testing </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="col-md-12">
                        <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                          <div class="col-12">
                            {{-- @if(count($last_rays) > 0)
                            <h5 class="mt-4 float-right">{{$last_rays[0]->created_at}}</h5>
                            @else
                            <div class="alert alert-danger">No Ridelogy</div>
                            @endif --}}
                          </div>
                          <div class="row col-12 mb-3">
                            <div class="col-4">
                              <h5 class="font-weight-bold">Ridelogy</h5>
                            </div>
                            <div class="col-10">
                                <form action="{{route('add_result_ray',$hosptail->id)}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                    @if($patient->patient_rays)
                                        @foreach($patient->patient_rays as $patient_rays)
                                            @foreach(json_decode($patient_rays->ray_name) as $r)
                                            <input @if($patient_rays->result) disabled @endif name = "ray_id[]" value="{{$patient_rays->id}}" type="checkbox" class="mr-2"><span class="font-weight-bold">{{$r->ray_name}}</span><br>
                                            @endforeach
                                        @endforeach
                                        @else
                                        <div class="alert alert-danger">No Ridelogy</div>
                                    @endif
                                    <input type="file" class="form-control mt-3 mb-3" name = "result_name">
                                    <input type="submit" class="float-right btn btn-success" value="Upload">
                                </form>
                            </div>
                          </div>
                          <div class="row col-12 mb-3">
                            {{-- <div class="col-4">
                              <h5 class="font-weight-bold">Rideology</h5>
                            </div>
                            <div class="col-8">
                              <h5 class="">High Blood Pressure</h5>
                            </div>
                            <div class="col-4">
                              <h5 class="font-weight-bold"></h5>
                            </div>
                            <div class="col-8">
                              <h5 class="">High Blood Pressure</h5>
                            </div> --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-xl-6 col-md-4 mb-5 mr-auto ml-auto">
            <!-- Button trigger modal -->
            <div class="text-center">
              <button type="button" class="btn btn-primary text-white col-8 h4" data-toggle="modal" data-target="#RayChild">
                <i class="fas fa-eye mr-2"></i> Show Ray Children
              </button>
            </div>
            <!-- Modal -->
              <div class="modal fade" id="RayChild" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelChild" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabelChild">Ridelogy </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="col-md-12">
                        <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                          <div class="col-12">
                            {{-- @if(count($last_rays) > 0)
                            <h5 class="mt-4 float-right">{{$last_rays[0]->created_at}}</h5>
                            @else
                            <div class="alert alert-danger">No Ridelogy</div>
                            @endif --}}
                          </div>
                          <div class="row col-12 mb-3">
                            <div class="col-4">
                              <h5 class="font-weight-bold">Ridelogy</h5>
                            </div>
                            <div class="col-10">
                              
                                <form action="{{route('hosptail_child_add_Result_rays',$hosptail->id)}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                   
                                    @if($patient->childern)
                                    @foreach($patient->childern as $ch)
                                    <input type="hidden" name="child_id" value="{{$ch->id}}">
                                    @foreach($ch->ray_child as $r)
                                        @foreach(json_decode($r->ray_name) as $ray_name)
                                        <input @if($r->result) disabled @endif name = "ray_child_id[]" value="{{$r->id}}" type="checkbox" class="mr-2"><span class="font-weight-bold">{{$ray_name->ray_name}}</span><br>
                                        @endforeach 
                                    @endforeach
                                    @endforeach
                                    @else
                                    <div class="alert alert-danger">No Ridelogy</div>
                                    @endif
                                    <input type="file" class="form-control mt-3 mb-3" name = "result_name">
                                    <input type="submit" class="float-right btn btn-success" value="Upload">
                                </form>
                            </div>
                          </div>
                          <div class="row col-12 mb-3">
                            {{-- <div class="col-4">
                              <h5 class="font-weight-bold">Rideology</h5>
                            </div>
                            <div class="col-8">
                              <h5 class="">High Blood Pressure</h5>
                            </div>
                            <div class="col-4">
                              <h5 class="font-weight-bold"></h5>
                            </div>
                            <div class="col-8">
                              <h5 class="">High Blood Pressure</h5>
                            </div> --}}
                          </div>
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
