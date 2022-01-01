@extends('backEnd.layoutes.mastar')
@section("content")
@section('title','show Profile patient')
@include("backEnd.online-doctor.sidenav")

<div class="d-flex " id="wrapper">
    <div id="page-content-wrapper">
        <nav class="navbarp navbar-top navbar-expand navbar-dark">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar links -->
                <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                <!-- Search form -->
                <ul class="float-lg-right pr-3">

                </ul>
                <h6 class="h5 text-white">{{$online_doctor->online == 1 ? 'online' : 'ofline'}}</h6>
                <ul class="navbar-nav align-items-center ml-md-auto">
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                  <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            @if(!$online_doctor->image)
                                <img alt="Image placeholder" src="{{ asset('uploads/defualt.jpg') }}" width="50" height="40">
                            @else
                                <img alt="Image placeholder" src={{ asset($online_doctor->image) }} width="50" height="40">
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

        <div class="container-fluid">
          <div class="row border-bottom mb-5">
            <h5 style="display:none" class="font-weight-bold" id="doctor_name">{{$online_doctor->name}}</h5>
            <div class="row col-3 ml-auto mr-auto text-center mt-3">
                {{-- https://localhost/phistory/uploads/ --}}
                {{-- <h1> {{ $patient->image }} </h1> --}}

              {{-- <img class="rounded-circle" src= @if($online_doctor->image) {{url($patient->image)}} @else {{url('uploads/' . $online_doctor->image)}}@endif  width="90" height="90"/> --}}
            <img class="rounded-circle" src= @if($online_doctor->image) {{url($patient->image)}} {{-- {{asset('/imgs/03.jpg')}} --}} @else {{url('https://localhost/phistory/public/imgs/03.jpg')}} @endif width="90" height="90"/>
              <h4 id ="patient_name" class="mt-5 col-lg-8 text-capitalize">{{$patient->firstName . ' ' . $patient->lastName}}</h4>
            </div>
            <a href="{{route("online_doctor_show_profile_patient",[$online_doctor->id,$patient->id])}}" class="col-lg-3 ml-auto mr-auto text-center mt-4 text-decoration">
              <div class="row col-lg-10 ml-auto mr-auto border-call">
                <img class="ml-2" src="{{url('imgs/icon_png/Patient.svg')}}" width="50"/>
                <h5 class="col-lg-9 mt-3 text-dark font-weight-bold">Show Profile</h5>
              </div>
            </a>
            <a href="{{route('add_prescription_patient',[$online_doctor->id,$patient->id])}}" class="col-lg-3 ml-auto mr-auto text-center mt-4 text-decoration">
              <div class="row col-lg-10 ml-auto mr-auto border-call">
                <img class="ml-2" src="{{url('imgs/doctor_online/file-prescription.svg')}}"  width="40"/>
                <h5 class="col-lg-9 mt-3 text-dark font-weight-bold ">Add Prescription</h5>
              </div>
            </a>
            <div class="col-lg-2 ml-auto mr-auto text-center mt-5 mb-5">
              <a href="{{route('end_delete_request',[$online_doctor->id,$patient_request->id])}}" class="btn btn-danger col-lg-9 p-2">End Call</a>
            </div>
          </div>
        </div>

        <div id="app" class="col-lg-12 mb-5">
          <Message :patient="{{$patient}}" :doctor="{{$online_doctor}}" :userauth="{{$online_doctor}}" :chat="{{$chat}}"></Message>
        </div>
        <script src="{{url('js/app.js')}}"></script>
        @include("backEnd.layoutes.footer")

    </div>
  </div>

  @stop
