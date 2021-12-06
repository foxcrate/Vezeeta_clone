@extends('backEnd.layoutes.mastar')
@section("content")
@section('title','Profile online doctor')
@include("backEnd.patien.slidenav")

<div class="d-flex" id="wrapper">
    <div id="page-content-wrapper">
        @include('includes.patientNav')
        <!-- informationContent -->
        <div class="container card-nurse " style="margin-top:95px; margin-bottom:95px;">
          <div class="row">
            <div class="col-3 ml-auto mr-auto text-center mt-5">
                @if(!$online_doctor->image)
                <img class = "rounded-circle" src="{{ asset('uploads/default.png') }}"  width="210" height="210"/>
                @else
                    <img class = "rounded-circle" src="{{ $online_doctor->image }}"  width="210" height="210"/>
                @endif
            </div>
            <div class="col-8 mt-5">
              <div class="col-12 mt-3">
                <h3 class="font-weight-bold">Dr.{{$online_doctor->name}}</h3>
              </div>
              <div class="col-12 mt-3">
                <h4 class="font-weight-bold text-dark">{{$online_doctor->special->name}}</h4>
              </div>
              <div class="col-8 mt-3">
                <h5 class="text-gray-d">{{$online_doctor->information}}</h5>
              </div>
              {{--  <div class="col-8 mt-3">
                <h6 class="text-gray-d">{{$online_doctor->phoneNumber}}</h5>
              </div>  --}}
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
            </div>
            <div class="col-6 ml-auto mr-auto text-center mt-3 mb-4">

              <p id="request_message"style = "display:none" class="alert alert-success">Request added</p>
              @if(!$patient->homecare_Request)
              <form id = "add_request_homecare" action="" method = "POST">
                {{ csrf_field() }}
                  <input id="patient_id"type="hidden" name="patient_id" value="{{$patient->id}}">
                  <input id="doctor_id"type="hidden" name="doctor_id" value="{{$online_doctor->id}}">
                  <input id = "request_submit" type="submit" value="Call Doctor" class="btn btn-primary btn-block col-12 mt-5">
              </form>
              @endif
              @if($patient->homecare_Request)
              <p id = "request_id" style="display:none">{{$patient->homecare_Request->id}}</p>
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
      var formData = new FormData($("#add_request_homecare")[0]);
      $.ajax({
          type:"post",
          url: "{{route('patient.homecare.addRequest')}}",
          data:formData,
          processData: false,
          contentType: false,
          cache: false,
          success:function(data){
              if(data.status == true){
                  console.log("done");
                  $( '#add_request_homecare' ).each(function(){
                      this.reset();
                  });
                  $("#request_message").show(400).delay(500).hide(400);
                  $("#add_request_homecare").hide().delay(1000);
                  location.reload();
              }
          },

      });
    });

  </script>
  @stop
