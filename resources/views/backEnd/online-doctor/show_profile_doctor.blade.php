@extends('backEnd.layoutes.mastar')
@section("content")
@section('title','Profile online doctor')
@include("backEnd.patien.slidenav")

<div class="d-flex" id="wrapper">
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
                                <img alt="Image placeholder" src="{{ asset('uploads/default.jpg') }}" width="50" height="40">
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
        <div class="container card-nurse mt-5 mb-5">
          <div class="row">
            <div class="col-3 ml-auto mr-auto text-center mt-5">
              <img class = "rounded-circle" src="@if($online_doctor->image) {{url($online_doctor->image)}} @else {{url('https://localhost/phistory/public/imgs/03.jpg')}}@endif"  width="210" height="210"/>
            </div>
            <div class="col-8 mt-5">
              <div class="col-12 mt-3">
                <h3 class="font-weight-bold">Dr.{{$online_doctor->name}}</h3>
              </div>
              <div class="col-12 mt-3">
                <h4 class="font-weight-bold text-dark">{{$online_doctor->special->name}}</h4>
              </div>
              <div class="col-8 mt-3">
                <h6 class="text-gray-d">{{$online_doctor->information}}</h5>
              </div>
              <div class="row col-6 mt-5">
                <div class="col-3 text-center">
                  <img src="{{url('imgs/doctor_online/2.png')}}"  width="50"/>
                </div>
                <div class="col-3 text-center">
                  <img src="{{url('imgs/doctor_online/3.png')}}"  width="50"/>
                </div>
                <div class="col-3 text-center">
                  <img src="{{url('imgs/doctor_online/1.png')}}"  width="50"/>
                </div>
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
            <div class="col-6 ml-auto mr-auto text-center mt-3 mb-4">

              <p id="request_message"style = "display:none" class="alert alert-success">Request added</p>
              @if(!$patient->pRequest)
              <form id = "add_request" action="" method = "POST">
                {{ csrf_field() }}
                  <input id="patient_id"type="hidden" name="patient_id" value="{{$patient->id}}">
                  <input id="doctor_id"type="hidden" name="doctor_id" value="{{$online_doctor->id}}">
                  {{-- <input id="request_id" type="hidden" name="request_id" value="{{$patient->pRequest}}"> --}}

                  <input id = "request_submit" type="submit" value="Call Doctor" class="btn btn-primary btn -block col-12 mt-5">
              </form>
              @endif
              @if($patient->pRequest)
              <p id = "request_id" style="display:none">{{$patient->pRequest->id}}</p>
              @endif



            </div>
          </div>
        </div>

        @include("backEnd.layoutes.footer")

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
  <script>



    $("#request_submit").on('click',function(e){
      e.preventDefault();
      var formData = new FormData($("#add_request")[0]);
      $.ajax({
          type:"post",
          url: "{{route('patient_add_request')}}",
          data:formData,
          processData: false,
          contentType: false,
          cache: false,
          success:function(data){
              if(data.status == true){
                  console.log("done");
                  $( '#add_request' ).each(function(){
                      this.reset();
                  });
                  $("#request_message").show(400).delay(500).hide(400);
                  $("#add_request").hide().delay(1000);
                  location.reload();

                //   window.location = "https://localhost/paientHistory/public/en/dashbord/patient/" + $("#patient_id").val() +"/doctor/"+ $("#doctor_id").val();
                window.location = {!! json_encode( config('app.url') ) !!} + "/public/en/dashbord/patient/" + $("#patient_id").val() +"/doctor/"+ $("#doctor_id").val();


              }
          },

      });
    });

  </script>
  @stop
