@extends('backEnd.layoutes.mastar')
@section('title','Profile online doctor')
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
                {{-- <h6 class="h5 text-white">{{$online_doctor->online == 1 ? 'online' : 'ofline'}}</h6> --}}
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
        <!-- informationContent -->
        <div class="container card-nurse" style="margin-top:110px; margin-bottom:110px;">
          <div class="row">
            <div class="col-3 ml-auto mr-auto text-center mt-5">
              <img class ="rounded-circle" src="{{ $online_doctor->image }}"  width="180" height="180"/>
            </div>

                {{-- <div class="row col-3 ml-auto mr-auto text-center mt-5 pt-5">
                  <div class="col-4 ml-auto mr-auto text-center">
                    <img src="{{url('imgs/doctor_online/2.png')}}"  width="60"/>
                  </div>
                  <div class="col-4 ml-auto mr-auto text-center">
                    <img src="{{url('imgs/doctor_online/3.png')}}"  width="60"/>
                  </div>
                  <div class="col-4 ml-auto mr-auto text-center">
                    <img src="{{url('imgs/doctor_online/1.png')}}"  width="60"/>
                  </div>
                </div> --}}

              <div class="col-8 mt-5">
                <div class="col-12 mt-3">
                  <h3 class="font-weight-bold text-capitalize">Dr.{{$online_doctor->name}}</h3>
                  <span id="online_doctor_id" style="display:none">{{$online_doctor->id}}</span>
                </div>
                <div class="col-12 mt-3">
                  <h4 class="font-weight-bold text-dark">{{$online_doctor->special->name}}</h4>
                </div>
                <div class="col-12 mt-3">
                  <h6 class="text-gray-d">{{$online_doctor->information}}</h5>
                </div>
                {{-- <div class="row col-3 ml-auto mr-auto text-center mt-5 mb-5 pt-5">
                  <div class="col-4 ml-auto mr-auto text-center">
                    <img src="{{url('imgs/doctor_online/chatn.svg')}}"  width="40"/>
                    <h3 class="font-weight-bold text-primary mt-3">133</h3>
                  </div>
                  <div class="col-4 ml-auto mr-auto text-center">
                    <img src="{{url('imgs/doctor_online/phonen.svg')}}"  width="40"/>
                    <h3 class="font-weight-bold text-primary mt-3">133</h3>
                  </div>
                  <div class="col-4 ml-auto mr-auto text-center">
                    <img src="{{url('imgs/doctor_online/speech-bubblen.svg')}}"  width="40"/>
                    <h3 class="font-weight-bold text-primary mt-3">133</h3>
                  </div>
                </div> --}}
              </div>
                <div class="col-8 ml-auto mr-auto text-center mt-5 mb-5">
                  <a href = "{{route('online_doctor.logout')}}" class="col-8 btn btn-danger h4">Logout</a>
                </div>
          </div>
        </div>

        @include("backEnd.layoutes.footer")
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
  <script>
    $("#btn_decline_request").on('click',function(e){
      e.preventDefault();
      var formData = new FormData($("#form_decline_request")[0]);
      $.ajax({
          type:"post",
          url: "{{route('doctor_decline_request')}}",
          data:formData,
          processData: false,
          contentType: false,
          cache: false,
          success:function(data){
              if(data.status == true){
                  console.log("done");
                  $( '#form_decline_request' ).each(function(){
                      this.reset();
                  });
                  $("#notifation_container").hide(500);
                  window.location.reload();

              }
          },

      });
    });

    $("#btn_accept_request").on('click',function(e){
      e.preventDefault();
      var formData = new FormData($("#form_accept_request")[0]);
      $.ajax({
          type:"post",
          url: "{{route('doctor_accept_request')}}",
          data:formData,
          processData: false,
          contentType: false,
          cache: false,
          success:function(data){
              if(data.status == true){
                  console.log("done");
                  $( '#form_accept_request' ).each(function(){
                      this.reset();
                  });
                  $("#btn_decline_request").attr("disabled","disabled");
                  window.location = "https://localhost/paientHistory/public/en/dashbord/doctor/" + $("#online_doctor_id").text() + "/profile_patient/" + $("#patient_id").text() + "/request/" + $("#request_id").text() + "/chat/" + $("#chat_id").text();
                  $("#btn_accept_request").attr("disabled","disabled");


              }
          },

      });
    });
  </script>

  @endsection
