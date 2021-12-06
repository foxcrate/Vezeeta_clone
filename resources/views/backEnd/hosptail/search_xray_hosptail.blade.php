@extends('backEnd.layoutes.mastar')
@section('title',$patient->firstName . ' ' . $patient->middleName)
@section('content')
@include('backEnd.hosptail.sidenav')
<div class="d-flex bg-page" id="wrapper">
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar links -->
            <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
            <ul class="navbar-nav align-items-center ml-md-auto">
            </ul>
            <ul class="navbar-nav float-right ">
              <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                      <img alt="Image placeholder" src="@if($hosptail->image) {{url('uploads/hosptail/' . $hosptail->image)}} @else {{url('uploads/' . $hosptail->image)}}@endif">
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
      <div class="row pt-5 ">
        <div class="col-md-12 slide-img mb-5 mr-auto ml-auto ">
          <img class="d-xs-none ml-5" id="about-img" src="{{url('imgs/s1.jpg')}}" height="300" width="895" alt="Responsive image">
        </div> 
        <div class="col-lg-6 mb-5 mr-auto ml-auto">
          <!-- Button trigger modal -->
          <div class="text-center">
            <button type="button" class="btn btn-primary text-white col-8 h5" data-toggle="modal" data-target="#Testing">
              <i class="fas fa-eye mr-2"></i> Show
            </button>
          </div>
          <!-- Modal -->
            <div class="modal fade" id="Testing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-12">
                      <div class="pills-main-yellow col-xl-10 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                        <div class="col-12">
                          {{-- @if(count($patient->patient_analzes) > 0)
                          <h5 class="mt-4 float-right">{{$patient->patient_analzes[0]->created_at}}</h5>
                          @else
                          <div class="alert alert-danger">No Test</div>
                          @endif --}}
                        </div>
                        <div class="row col-12 mb-3">
                          <div class="col-4">
                            <h5 class="font-weight-bold mb-3">Test</h5>
                          </div>

                          <div class="col-10 ml-auto mr-auto">
                              <form action="{{route('add_result_test',$hosptail->id)}}" multiple="multiple" method="POST" enctype="multipart/form-data">
                                  {{csrf_field()}}
                                  <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                  @if($patient->patient_analzes)
                                      @foreach($patient->patient_analzes as $test)
                                        @foreach(json_decode($test->test_name) as $t)
                                          <input @if($test->result) disabled @endif name = "test_id[]" value="{{$test->id}}" type="checkbox" class="mr-2"><span class="font-weight-bold">{{$t->test_name}}</span><br>
                                        @endforeach
                                    @endforeach
                                  @else
                                  <div class="alert alert-danger">No Test</div>
                                  @endif
                                  {{-- @foreach($patient as $test)
                                    @foreach($test->patient_analzes as $patient_test)
                                          <input @if($patient_test->result) disabled @endif name = "test_id[]" value="{{$patient_test->id}}" type="checkbox" class="mr-2"><span class="font-weight-bold">{{$patient_test->name}}</span><br>
                                    @endforeach
                                  @endforeach --}}
                                  <input type="file" class="form-control mt-3 mb-3" name = "result_name">
                                  <input type="submit" class="float-right btn btn-success" value="Upload">
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
        <div class="col-lg-6 mb-5 mr-auto ml-auto">
          <!-- Button trigger modal -->
          <div class="text-center">
            <button type="button" class="btn btn-primary text-white col-lg-8 h5" data-toggle="modal" data-target="#TestingChild">
              <i class="fas fa-eye mr-2"></i> Show Children Test
            </button>
          </div>
          <!-- Modal -->
            <div class="modal fade" id="TestingChild" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelChild" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelChild">Test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-12">
                      <div class="pills-main-yellow col-xl-10 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                        <div class="col-12">
                          {{-- @if(count($patient->patient_analzes) > 0)
                          <h5 class="mt-4 float-right">{{$patient->patient_analzes[0]->created_at}}</h5>
                          @else
                          <div class="alert alert-danger">No Test</div>
                          @endif --}}
                        </div>
                        <div class="row col-12 mb-3">
                          <div class="col-4">
                            <h5 class="font-weight-bold mb-3">Test</h5>
                          </div>

                          <div class="col-10 ml-auto mr-auto">
                            
                              <form action="{{route('hosptail_child_add_Result_test',$hosptail->id)}}" multiple="multiple" method="POST" enctype="multipart/form-data">
                                  {{csrf_field()}}
                                  
                                  @if($patient->childern)
                                      @foreach($patient->childern as $ch)
                                      <input type="hidden" name="child_id" value="{{$ch->id}}">
                                        @foreach($ch->test_child as $t)
                                          @foreach(json_decode($t->test_name) as $test_name)
                                          <input @if($t->result) disabled @endif name = "test_child_id[]" value="{{$t->id}}" type="checkbox" class="mr-2"><span class="font-weight-bold">{{$test_name->test_name}}</span><br>
                                          @endforeach
                                          
                                        @endforeach
                                    @endforeach
                                  @else
                                  <div class="alert alert-danger">No Test</div>
                                  @endif
                                  {{-- @foreach($patient as $test)
                                    @foreach($test->patient_analzes as $patient_test)
                                          <input @if($patient_test->result) disabled @endif name = "test_id[]" value="{{$patient_test->id}}" type="checkbox" class="mr-2"><span class="font-weight-bold">{{$patient_test->name}}</span><br>
                                    @endforeach
                                  @endforeach --}}
                                  <input type="file" class="form-control mt-3 mb-3" name = "result_name">
                                  <input type="submit" class="float-right btn btn-success" value="Upload">
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
      
      </div>
      </div>
   
@include('backEnd.layoutes.footer')
    </div>
</div>
@stop
