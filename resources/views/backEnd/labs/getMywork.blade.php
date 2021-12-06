@extends('backEnd.layoutes.mastar')
@section('title','My Work')
@section('content')
@include("backEnd.labs.slidenav")
{{-- <div>
    <a href="{{route('online_doctor_add_mywork',$online_doctor->id)}}"><button class="btn btn-primary">Add Work</button></a>
</div> --}}
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
                {{--  <h6 class="h5 text-white">{{$online_doctor->online == 1 ? 'online' : 'ofline'}}</h6>  --}}
                <ul class="navbar-nav align-items-center ml-md-auto">
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="fa fa-bell fa-fw mr-lg-3 mt-lg-1" style="font-size: 15pt;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">

                      <div class="px-3 py-3">
                        {{--  <p class="text-muted m-0">You have <strong class="text-primary">{{$online_doctor->pRequests->count()}}</strong> notifications Requests.</p>  --}}
                      </div>

                      {{--  @include("backEnd.online-doctor.notifacation_request")  --}}

                    </div>
                  </li>
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                  <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            @if(!$labs->image)
                                <img alt="Image placeholder" src="{{ asset('uploads/default.png') }}" width="50" height="40">
                            @else
                                <img alt="Image placeholder" src="{{ $labs->image }}" width="50" height="40">
                            @endif
                        </span>
                        <div class="media-body ml-3 mr-3 d-lg-block">
                          <h6 class="mb-0 font-weight-bold text-white">{{$labs->labsName}}</h6>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>
        <div class="container mt-4">
            <h2 class="font-weight-bold text-primary">Time Table </h2>
            @php
               $count =  \App\models\AppointmentLab::whereNull('xray_id')->count();
            @endphp
                <div class="form-mywork mt-3">
                    <form class="row col-10 ml-auto mr-auto" action="{{route('lab.postMywork')}}" method="POST">
                        {{ csrf_field() }}
                        <input type = "hidden" name="lab_id" value="{{$labs->id}}" >
                        <input type = "hidden" name="idCode" value="{{$labs->idCode}}">
                        <input type="hidden" name="lab_name" value="{{$labs->labsName}}">
                        {{--  <input type="hidden" name="special" value="{{$online_doctor->special->name}}">  --}}
                        <input type="hidden" id="latitude" name="latitude" value="markerCurrent.position.lat()">
                        <input type="hidden" id="longitude" name="longitude" value="markerCurrent.position.lng()">
                        <div class="form-group col-lg-12">
                            <label class="font-weight-bold text-primary">Address</label>
                            <input id="pac-input" type="text" name="address" class="form-control @error('address') is-invalid @enderror">
                            <div id="map" style="height: 500px;width: 500px;"></div>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="font-weight-bold text-primary">Phone No.</label>
                            <input value="{{old('phoneNumber')}}" type="text" name="phoneNumber" class="form-control @error('phoneNumber') is-invalid @enderror">
                            @error('phoneNumber')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row col-lg-12 get_work">
                            <div class="form-group col-lg-3">
                                <label class="font-weight-bold text-primary">Day</label>
                                <select name="appointments[0][day_name]" class="form-control get_day @error('appointments') is-invalid @enderror">
                                    <option hidden>Choose</option>
                                    @foreach($days as $day)
                                        <option value="{{$day->name}}">{{$day->name}}</option>
                                    @endforeach
                                </select>
                                @error('appointments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="font-weight-bold text-primary">From</label>
                                <input type="time" name="appointments[0][from]" class="get_from form-control @error('appointments') is-invalid @enderror">
                                @error('appointments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="font-weight-bold text-primary">To</label>
                                <input type="time" name="appointments[0][to]" class="get_to form-control @error('appointments') is-invalid @enderror">
                                @error('appointments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group col-lg-3">
                            <button id="add_work" type="button" class="btn btn-success">Add</button>
                        </div>
                        {{-- <div class="form-group col-lg-12">
                            <label class="font-weight-bold text-primary">Examination Duration</label>
                            <input value="{{old('wating')}}" type="number" name="wating" class="form-control @error('wating') is-invalid @enderror">
                            @error('wating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="font-weight-bold text-primary">Fees</label>
                            <input value="{{old('fees')}}" type="number" name="fees" class="form-control @error('fees') is-invalid @enderror">
                            @error('fees')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="form-group col-lg-12 text-center mt-3">
                            <input type="submit" value="Add" class="btn btn-primary col-lg-5">
                        </div>
                    </form>
                </div>
                @foreach($labs->appointments_lab as $appoin)
                    <div class="label-work p-3 mb-5">
                        <div class="row col-10 ml-auto mr-auto text-center border-bottom pb-3">
                            <div class="col-lg-1 text-capitalize">{{$appoin->doctor_name}}</div>
                            <div class="col-lg-8">{{$appoin->address}}</div>
                            {{-- <div class="row col-lg-3 mt-3">
                                <form action="#" method="GET" class="col-lg-6">
                                    <button type="submit" class="btn btn-danger h5">Delete</button>
                                </form>
                                <button href="#" class="btn btn-info col-lg-5 h5">Edit</button>
                            </div> --}}
                        </div>
                        <div class="row col-10 ml-auto mr-auto mt-3 text-center">
                            @foreach($appoin->appointments as $apppp)
                                <div class="text-primary h6 col-lg-4">{{$apppp['day_name']}}</div>
                                <div class="col-lg-3">{{$apppp['from']}}</div>
                                <div class="col-lg-3">{{$apppp['to']}}</div>
                            @endforeach
                        </div>
                    </div>
                @endforeach


        </div>
    </div>
</div>

    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&callback=initAutocomplete&libraries=places&v=weekly"
    defer>
</script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $('#add_work').click(function(){
                $('.get_work:first').clone(true).hide().insertAfter('.get_work:last').slideDown('slow');
                    var last = $('.get_work:last');
                    var current =  $(".get_work").length-1;
                    //last.append(new_button.clone(true));
                    last.find('select').val([]);
                    last.find('select.get_day').attr("name", "appointments[" + current + "][day_name]");
                    last.find('input.get_from').attr("name", "appointments[" + current + "][from]");
                    last.find('input.get_to').attr("name", "appointments[" + current + "][to]");
                });
                {{--  $("body").on("click", "#remove_more_fields", function () {
                    $(this).closest(".field_group").hide();
                });  --}}
        });
        @include("includes.GoogleMap")

    </script>

@stop
