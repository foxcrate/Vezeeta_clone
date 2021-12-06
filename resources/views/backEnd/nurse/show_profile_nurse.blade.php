@extends('backEnd.layoutes.mastar')
@section('title','Profile ' . $nurse->name)
@section('content')
<!-- Sidenav -->
  <div class="d-flex bg-page" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        <!-- Topnav -->
        <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar links -->
                <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                <!-- Search form -->
                <ul class="navbar-nav align-items-center ml-md-auto">
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-bell fa-fw mr-lg-3 mt-lg-1" style="font-size: 15pt;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                      <!-- Dropdown header -->
                      <div class="px-3 py-3">
                        <p class="text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</p>
                      </div>
                      <!-- List group -->
                      <div class="list-group-noti list-group-flush">

                      </div>
                      <!-- View all -->
                      <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                    </div>
                  </li>
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                  <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            @if(!$nurse->image)
                                <img alt="Image placeholder" src="{{asset('uploads/default.png')}}">
                            @else
                                <img alt="Image placeholder" src="{{$nurse->image}}">
                            @endif
                        </span>
                        <div class="media-body ml-3 mr-3 d-lg-block">
                          <h6 class="mb-0 font-weight-bold text-white">{{$nurse->name}}</h6>
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
                @if(!$nurse->image)
                    <img src="{{ asset('uploads/default.png') }}" alt="" width="210" height="230">
                @else
                    <img src="{{ $nurse->image }}" alt="" width="210" height="230">
                @endif

            </div>
            <div class="col-8 mt-5">
              <div class="col-12 mt-3">
                <h2 class="font-weight-bold">{{$nurse->name}}</h2>
              </div>
              <div class="col-12 mt-3">
                <h5 class="text-dark font-weight-bold">{{$nurse->IdCode}}</h5>
              </div>
              <div class="col-12">
                <h5 class="text-dark text-capitalize">{{$nurse->gender}}</h5>
              </div>
              <div class="col-12 mt-3">
                <h5 class="text-dark text-capitalize">{{$nurse->information}}</h5>
              </div>

            </div>
            <div class="col-6 ml-auto mr-auto text-center mt-3 mb-5">
                <p id="request_message"style = "display:none" class="alert alert-success">Request added</p>
                @if(!$patient->pRequest)
                <form id = "add_request" action="" method = "POST">
                  {{ csrf_field() }}
                    <input id="patient_id" type="hidden" name="patient_id" value="{{$patient->id}}">
                    <input id = "nurse_id" type="hidden" name="nurse_id" value="{{$nurse->id}}">
                    <button id = "request_submit" type="submit"class="btn btn-primary col-12 mt-5 h4"> Call Nurse</button>
                </form>
                @endif
            </div>
          </div>
        </div>
        @include('backEnd.layoutes.footer')
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
  <script>
    $("#request_submit").on('click',function(e){
      e.preventDefault();
      var formData = new FormData($("#add_request")[0]);
      $.ajax({
          type:"post",
          url: "{{route('nurse_add_request')}}",
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
                  window.location = "https://localhost/paientHistory/public/en/dashbord/nurse/patient/" + $("#patient_id").val() + "/nurse/" + $("#nurse_id").val();

              }
          },

      });
    });
  </script>

@stop

