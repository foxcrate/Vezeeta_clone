@extends('backEnd.layoutes.mastar')
@section('title','Doctor Homepage')
@section('content')
<!--start-Navbar-->
@include('backEnd.layoutes.navbar')
<!--End-Navbar-->
<div class="bg-waves">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--Start-Ada-->
    <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide" style="margin-top: 120px;" data-ride="carousel">
          <ol class="carousel-indicators ml-auto mr-auto">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{url('imgs/3.png')}}" height="550" class="d-block w-100" alt="..." style="border-radius:15px;">
            </div>
            <div class="carousel-item">
              <img src="{{url('imgs/4.png')}}" height="550" class="d-block w-100" alt="..." style="border-radius:15px;">
            </div>
            <div class="carousel-item">
              <img src="{{url('imgs/1.png')}}" height="550" class="d-block w-100" alt="..." style="border-radius:15px;">
            </div>
            <div class="carousel-item">
              <img src="{{url('imgs/5.png')}}" height="550" class="d-block w-100" alt="..." style="border-radius:15px;">
            </div>
            <div class="carousel-item">
              <img src="{{url('imgs/6.png')}}" height="550" class="d-block w-100" alt="..." style="border-radius:15px;">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
      </div>
    </div>
    <!--End-Ada-->
    <div class="container">
        <div class="row content-info col-lg-12 ml-auto mr-auto p-4 mt-5">
          <div class="col-2 mt-2">
            @if(!$online_doctor->image)
                <img src="{{asset('uploads/default.png')}}" width="120" height="120" class="rounded-circle">
            @else
                <img src="{{$online_doctor->image}}" class="rounded-circle" width="120" height="120">
            @endif
          </div>
          <div class="col-8">
            <h4 class="text-dark mt-3 font-weight-bold text-capitalize">{{'Dr. ' . $online_doctor->name}}</h4>
            {{-- <h1>{{env('APP_NAME')}}</h1> --}}
            <h5 class="text-dark">{{$online_doctor->idCode}}</h5>
              <div class="row">
                <h5 class="col-lg-4 text-dark">Classic Level</h5>
                {{-- <h1>{{$online_doctor->id}}</h1> --}}
                <h5 class="col-lg-4 text-dark">{{ $online_doctor->poients }} Point</h5>
              </div>
          </div>
          <div class="col-2">
            <a href="{{route('online_doctor.edit',$online_doctor->id)}}"><img src="{{url('imgs/edit.svg')}}" height="40" class="d-block w-100 mb-5" alt="..."></a>
            {{-- <a href="#"><img src="{{url('imgs/report.svg')}}" height="40" class="d-block w-100 mt-5" alt="..." ></a> --}}
          </div>

        </div>
    </div>
    <!--Start-Serv-->
    <div class="row col-lg-6 ml-auto mr-auto text-center mt-5">
      <div class="col-lg-6 ml-auto mr-auto">
        <div class="content-switch ml-auto mr-auto">
          <div class="row mt-3">
            <form id="form_update_homecare" action="{{route('doctor_update_homecare',$online_doctor->id)}}" method="POST">
              {{ csrf_field() }}
              <div class="col-lg-6">
                <div class="onoffswitch">
                  <input type="checkbox" name="homecare" class="onoffswitch-checkbox" id="myonoffswitchH" value="{{$online_doctor->homecare == 1 ? 1 : 0}}" {{$online_doctor->homecare == 1 ? 'checked' : ''}}>
                  <label class="onoffswitch-label" for="myonoffswitchH">
                      <script>
                          $('#myonoffswitchH').on('change', function() {
                              this.value =
                              this.checked ? 1 : 0;
                              $("#form_update_homecare").submit();
                          });
                      </script>
                      <div class="onoffswitch-inner"></div>
                      <div class="onoffswitch-switch"></div>
                  </label>
                </div>
              </div>
            </form>
            <div class="col-lg-6">
              <a type="button" href="" class="doctor_show_request" style="text-decoration: none;" data-toggle="modal" data-target="#exampleModal1">
                <i class="fa fa-bell fa-fw ml-lg-5 mt-lg-1 text-light" style="font-size: 20pt;"></i><span class="text-light" > Requests </span>
              </a>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel1">Home Care Request</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @if($online_doctor->homecare_Request)
                      @foreach($online_doctor->homecare_Request as $homecareRequest)
                        <div class="col-lg-10 ml-auto mr-auto modal-body">
                          <div class="row request-label p-3">
                            <div class="col-lg-6 mb-auto mt-auto">
                              <h1 class="h4 ml-auto">{{$homecareRequest->patient->name}}</h1>
                              <h6 class="h5 ml-auto">{{$homecareRequest->patient->idCode}}</h6>
                            </div>
                            <div class="col-lg-6 mb-auto mt-auto text-right">
                              <form class="col-5" id="homecare_accept_request" action="" method="" style="display:inline-block">
                                {{ csrf_field() }}
                                <input type="hidden" name="doctor_id" id="online_doctor_id" value="{{$online_doctor->id}}">
                                <input type="hidden" name="homecare_request_id" value="{{$homecareRequest->id}}">
                                <input id="homecare_btn_accept_request" type="submit" value="Accept" class="col-12 m-2 btn btn-success">
                              </form>
                              <form class="col-5" id="homecare_decline_request" action="" method="" style="display:inline-block">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="doctor_id" value="{{$online_doctor->id}}">
                                  <input type="hidden" name="homecare_request_id" value="{{$homecareRequest->id}}">
                                  <input id="homecare_btn_decline_request" type="submit" {{$homecareRequest->is_accept == true ? 'disabled' : ''}} value="Decline" class="col-12 m-2 btn btn-danger">
                              </form>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <img src="{{url('imgs/homeware.svg')}}" height="60" class="d-block w-100 mt-2 mb-4" alt="...">
            <h5 class="text-dark font-weight-bold ml-auto mr-auto">Home Care</h5>
          </div>
        </div>
      </div>
        <div class="col-lg-6 ml-auto mr-auto">
          <div class="content-switch ml-auto mr-auto">
            <div class="row mt-3">
              <form id="form_update_online" action="{{route('doctor_update_online',$online_doctor->id)}}" method="POST">
                {{ csrf_field() }}
                <div class="col-lg-6">
                  <div class="onoffswitch">
                    <input type="checkbox" name="online" class="onoffswitch-checkbox" id="myonoffswitchO" value="{{$online_doctor->online == 1 ? 1 : 0}}" {{$online_doctor->online == 1 ? 'checked' : ''}}>

                    <label class="onoffswitch-label" for="myonoffswitchO">
                        <script>
                            $('#myonoffswitchO').on('change', function() {
                                this.value =
                                this.checked ? 1 : 0;
                                $("#form_update_online").submit();
                            });
                        </script>
                        <div class="onoffswitch-inner"></div>
                        <div class="onoffswitch-switch"></div>
                    </label>
                  </div>
                </div>
              </form>
              <div class="col-lg-6">
                <a type="button" class="doctor_show_request" style="text-decoration: none;" href="" data-toggle="modal" data-target="#exampleModal">
                  <i class="fa fa-bell fa-fw ml-lg-5 mt-lg-1 text-light" style="font-size: 20pt;"></i> <span class="text-light" > Requests </span>
                </a>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Online Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @if($online_doctor->pRequests)
                        @foreach($online_doctor->pRequests as $Prequest)
                        {{-- {{$Prequest}}; --}}
                        <div class="col-lg-10 ml-auto mr-auto modal-body">
                          <div class="row request-label p-3">
                            <div class="col-lg-6 mb-auto mt-auto">
                              <h1 class="h4 ml-auto">{{$Prequest->patient->firstName .' ' . $Prequest->patient->lastName}}</h1>
                              <h6 class="h5 ml-auto">{{$Prequest->patient->idCode}}</h6>
                            </div>
                            <div class="col-lg-6 mb-auto mt-auto text-right">
                              <form class="col-5" id="form_accept_request" action="" method="" style="display:inline-block">
                                {{ csrf_field() }}
                                <input type="hidden" name="doctor_id" value="{{$online_doctor->id}}">
                                <input type="hidden" name="request_id" value="{{$Prequest->id}}">
                                <input id="btn_accept_request" type="submit" value="Accept" class="col-12 m-2 btn btn-success">
                              </form>
                              <form class="col-5" id="form_decline_request" action="" method="" style="display:inline-block">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="doctor_id" value="{{$online_doctor->id}}">
                                  <input type="hidden" name="request_id" value="{{$Prequest->id}}">
                                  <input id="btn_decline_request" type="submit" {{$Prequest->is_accept == true ? 'disabled' : ''}} value="Decline" class="col-12 m-2 btn btn-danger">
                              </form>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <img src="{{url('imgs/hello.svg')}}" height="80" class="d-block w-100 mt-2 mb-1" alt="...">
            <h5 class="text-dark font-weight-bold ml-auto mr-auto">Online</h5>
          </div>
        </div>
    </div>
    <div class="row col-lg-6 ml-auto mr-auto text-center mt-5">
      <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{route('get_doctor_search_patient',$online_doctor->id)}}"><img src="{{url('imgs/icon_png/patient.svg')}}" height="80" class="d-block w-100 mt-2" alt="..."></a>
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">Patient</h5>
        {{-- <h1>{{ config('app.url') }}</h1> --}}
      </div>
      <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{route('doctor.club',$online_doctor->id)}}"><img src="{{url('imgs/logo.svg')}}" height="90" class="d-block w-100 mt-2" alt="..."></a>
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">Club</h5>
      </div>
      <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{ route('doctor.qr.index',$online_doctor->id) }}"><img src="{{url('imgs/qrCode.svg')}}" height="80" class="d-block w-100 mt-2" alt="..."></a>
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">QR Code</h5>
      </div>
    </div>
    <div class="row col-lg-6 ml-auto mr-auto text-center">
      <div class="col-lg-4 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{route('online_doctor_get_myWork',$online_doctor->id)}}"><img src="{{url('imgs/stethoscope.svg')}}" height="70" class="w-80 mt-3" alt="..."></a>
        </div>
        <h5 class="col text-dark font-weight-bold ml-auto mr-auto">My Work</h5>
      </div>
      <div class="col-lg-4 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{route('get.doctor.schedules',$online_doctor->id)}}"><img src="{{url('imgs/calendar.png')}}" height="70" class="w-80 mt-3" alt="..."></a>
        </div>
        <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Appointments</h5>
      </div>
      <div class="col-lg-4 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="#"><img src="{{url('imgs/insurance.png')}}" height="70" class="w-80 mt-3" alt="..."></a>
        </div>
        <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Insurance</h5>
      </div>

    </div>
    <div class="row col-lg-6 ml-auto mr-auto text-center">
        <div class="col-lg-3 ml-auto mr-auto">
            <div class="content-item ml-auto mr-auto">
              <a href="{{ route('doctor.orders',$online_doctor->id) }}"><img src="{{url('imgs/insurance.png')}}" height="70" class="w-80 mt-3" alt="..."></a>
            </div>
            <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Orders</h5>
          </div>
          <div class="col-lg-3 ml-auto mr-auto">
            <div class="content-item ml-auto mr-auto">
                <a href="{{route('online_doctor.logout')}}"><img src="{{url('imgs/logout.png')}}" height="70" class="w-80 mt-3" alt="..."></a>
            </div>
            <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Logout</h5>
          </div>
          <div class="col-lg-3 ml-auto mr-auto">

          </div>
    </div>
    <div class="row col-lg-6 ml-auto mr-auto text-center mb-5">
        <div class="col-lg-12 ml-auto mr-auto">
            <div class="row content-item ml-auto mr-auto" style="width: 640px; height: 120px;">
                <div class="row col-lg-8">
                    <a class="col-lg-4 ml-5" href="{{route('online_doctor_get_myWork',$online_doctor->id)}}"><img src="{{url('imgs/familyicon.svg')}}" height="100" class="mt-auto mb-auto" alt="..."></a>
                    <h5 class="col-lg-5 text-dark font-weight-bold mt-auto mb-auto">Family Doctor</h5>
                </div>
                <div class="col-lg-2 m-auto">
                    <a type="button" class="" data-toggle="modal" data-target="#exampleModalfd">
                        <i class="fa fa-bell fa-fw ml-lg-5 mt-lg-1 text-light" style="font-size: 20pt;"></i>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalfd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Family Doctor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div id="resultAccept" class="alert alert-success" style="display:none">Accepted Request Successfuly</div>
                            <div id="declineResult" class="alert alert-success" style="display:none">Decline Request Successfuly</div>
                            <div class="col-lg-10 ml-auto mr-auto modal-body">
                                <div class="row request-label p-3" id="RequestContentDoctor">
                                    <div id="" class="row col-lg-10">
                                        <div class="col-lg-8">
                                            @if($online_doctor->doctorFamily)
                                                @foreach($online_doctor->doctorFamily as $doc)
                                                    @if($doc->is_accept == 0)
                                                        <h4 class="col-lg-10 font-weight-bold" >{{ $doc->patient->firstName . ' ' . $doc->patient->lastName }}</h4>
                                                        <h5 class="col-lg-10 font-weight-bold" >{{ $doc->patient->idCode }}</h5>
                                                        <form id="acceptRequestDoctor" class="col-lg-2 mb-auto mt-auto" action="" method="POST">
                                                            {{ csrf_field() }}
                                                            <input type = "hidden" name="doctor_id" value="{{ $online_doctor->id }}">
                                                            <input type="hidden" name="patient_id" id="patient_id" value="{{ $doc->patient->id }}">
                                                            <input type="submit" value="Accept" class="btn btn-success">
                                                        </form>
                                                        <form id="declineRequestDoctor" class="col-lg-2 mb-auto mt-auto" action="" method="POST">
                                                            {{ csrf_field() }}
                                                            <input type = "hidden" name="doctor_id" value="{{ $online_doctor->id }}">
                                                            <input type="hidden" name="patient_id" value="{{ $doc->patient->id }}">
                                                            <input type="submit" value="Decline" class="btn btn-danger">
                                                        </form>
                                                    @endif
                                                @endforeach
                                            @endif

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
    <!--End-Serv-->
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
        // alert( $("#online_doctor_id").val() );
        e.preventDefault();
        var formData = new FormData($("#form_accept_request")[0])
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
                    //window.location = "https://localhost/paientHistory/public/en/dashbord/doctor/" + $("#online_doctor_id").val() + "/profile_patient/" + $("#patient_id").text();
                    window.location = '{{ config('app.url') }}' + "/public/en/dashbord/doctor/" + $("#online_doctor_id").val() +  document.getElementById("online_doctor_id").value + "/profile_patient/" + $("#patient_id").text();
                    $("#btn_accept_request").attr("disabled","disabled");
                }
            },

        });
      });

      $("#homecare_btn_decline_request").on('click',function(e){
        e.preventDefault();
        var formData = new FormData($("#form_decline_request")[0]);
        $.ajax({
            type:"post",
            url: "{{route('patient.homecare.declineRequest')}}",
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

      $("#homecare_btn_accept_request").on('click',function(e){
        e.preventDefault();
        var formData = new FormData($("#homecare_accept_request")[0]);
        $.ajax({
            type:"post",
            url: "{{route('patient.homecare.acceptRequest')}}",
            data:formData,
            processData: false,
            contentType: false,
            cache: false,
            success:function(data){
                if(data.status == true){
                    console.log("done");
                    $('#homecare_accept_request').each(function(){
                        this.reset();
                    });
                    window.location.reload();
                    $("#homecare_btn_decline_request").attr("disabled","disabled");
                    $("#homecare_btn_accept_request").attr("disabled","disabled");
                }
            },

        });
      });

      $("#acceptRequestDoctor").on('submit',function(e){
        e.preventDefault();
        var formData = $("#acceptRequestDoctor")[0],
            data = new FormData(formData);
        $.ajax({
            type : "POST",
            url : "{{ route('acceptRequestDoctor') }}",
            data : data,
            processData: false,
            contentType: false,
            cache: false,
            success:function(data){
                $("#resultAccept").fadeIn(600).delay(600).fadeOut(300);
                $("#RequestContentDoctor").fadeOut(500);
            }
        });
      });

      $("#declineRequestDoctor").on('submit',function(e){
        e.preventDefault();
        var formData = $("#declineRequestDoctor")[0],
            data = new FormData(formData);
            $.ajax({
                type : "POST",
                url : "{{ route('declineRequestDoctor') }}",
                data : data,
                processData: false,
                contentType: false,
                cache: false,
                success:function(data){
                    $("#declineResult").fadeIn(600).delay(600).fadeOut(300);
                    $("#RequestContentDoctor").fadeOut(500);
                }
            });
      });
    </script>
@endsection
