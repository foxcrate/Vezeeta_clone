@extends('backEnd.layoutes.mastar')
@section('title',$patient->firstName . ' ' . $patient->middleName)
@section('content')
@include('backEnd.clinic.slidenav')
<!-- Main content -->
@php
  $count = $patient->patinets_data;
@endphp
<!-- check if isset profile -->
@if($count)
<div class="d-flex bg-page" id="wrapper">
    <div id="page-content-wrapper">
    <!-- Topnav -->
    <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
        <div class="container-fluid p-3">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar links -->
            <button class="btn btn-outline-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars text-white" aria-hidden="true"></i></button>
            <!-- Search form -->
            <div class="col-6 ml-lg-5">
                    <h4 class="card-title text-uppercase text-white mb-2">
                        @if(Auth::guard('doctor')->check())
                        Dr {{auth()->guard('doctor')->user()->name}}</h4>
                    <h5 class="card-title text-uppercase text-white mb-0">{{auth()->guard('doctor')->user()->IdCode}}</h5>
                    <h5 class="card-title text-white mb-0">{{auth()->guard('doctor')->user()->Primary_Speciality}}</h5>
                    <span class="h4 font-weight-bold mb-0"></span>@endif
            </div>
            <div class="col-6 name-hos">
                <h4 class="card-title text-uppercase text-white mb-0">{{$clinic->clinicName}}</h4>
                <h5 class="card-title text-uppercase text-white mb-0">{{$clinic->address}}</h5>
            </div>
          </div>
        </div>
    </nav>
        <div class="container-fluid">
            <div class="header">
                <div class="container-fluid col-lg-9 col-md-12">
                    <div class="row pt-5">
                        <div class="col-lg-12 ml-auto mr-auto">
                            <div class="pills-main card p-3 card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div>
                                                <img alt="Image placeholder" src="{{url('imgs/bro.png')}}" width="80" class="rounded-circle">
                                            </div>
                                        </div>
                                        <div class="col">
                                           <a href="{{route('clinic_get_patien_profile',[$clinic->id,$patient->id])}}"><h4 class="text-black card-title text-uppercase mb-3">{{$patient->firstName . ' ' . $patient->lastName}}</h4></a>
                                                <h5 class="card-title text-uppercase mb-0">{{$patient->IdCode}}</h5>
                                                <h5 class="card-title text-uppercase text-muted mb-0">25 Age</h5>
                                                <span class="h4 font-weight-bold mb-0"></span>
                                                {{--<h4 class="card-title text-uppercase mb-3">{{$patient->firstName . ' ' . $patient->lastName}}</h4>--}}
                                        </div>
                                        <div class="col-3 text-center">
                                            <button class="col-10 btn btn-success h4 mt-sm-2"><a class = "text-white text-decoration" href="{{route('clinic_old_prescription',[$clinic->id,$patient->id])}}">Doctor Prescription </a></button>
                                        </div>
                                        <div class="col-3 text-center">
                                            <button class="col-10 btn btn-primary h4 mt-sm-2"><a class = "text-white text-decoration" href="{{route('clinic_getAllPrescription',[$clinic->id,$patient->id])}}">All Prescription </a></button>
                                        </div>
                                        <div class="col-12">
                                            <button class="col-3 float-right btn btn-danger h4 "><a class = "text-white text-decoration" href="{{route('clinic_doctor.logout',$doctor->id)}}">Log out </a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- form add prescreption -->
            <div class = "container">
                <div id="success_msg" class="alert alert-success" style="display:none">prescrption successfuly</div>
                <div id="error_msg" class="alert alert-danger" style="display: none">Sory the filed is required</div>
            </div>
            <form action="{{route("store_clinic_Raoucata")}}" id="clinic_add_prescription" method="POST">
                {{csrf_field()}}
                <input type="text" name="clinic_id" value="{{$clinic->id}}" style="display: none">
                <input type="hidden" name="patient_id" value="{{$patient->id}}">
                @if(Auth::guard('doctor')->check())
                <input type = "hidden" name = "doctor_id" value = "{{auth('doctor')->user()->id}}">
                @endif
                <div class="container-fluid">
                    <div class="pills-main-green col-md-9 ml-auto mr-auto card mt-5 p-3">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <img src="{{url('imgs/prescription.svg')}}" class="col-1 ml-3 mb-3" width="50">
                                    <label class="title-label">Prescription</label>
                                    <div class="ui input col-9">
                                        <input class="col-lg-12 ml-3" type="text" name="prescription" placeholder="prescription">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 mt-4">
                                    <img src="{{url('imgs/1.png')}}" class="col-2 ml-3 mb-3" width="50">
                                    <label class="title-label">Temperature</label>
                                    <div class="ui input col-6">
                                        <input id = "idcrd" onchange="addZeroes(this)" oninput="restrictAlphas(event)" maxlength="4" oninput="restrictAlphasDis(event)" class="ml-3" type="text" name="temperature" placeholder="Temperature">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <img src="{{url('imgs/2.png')}}" class="col-2 ml-3 mb-3" width="50">
                                    <label class="title-label">Diabetes</label>
                                    <div class="ui input col-6">
                                        <input maxlength="3" class="ml-1" type="text" name="diabetics" placeholder="Diabetics">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <img src="{{url('imgs/4.png')}}" class="col-2 ml-3 mb-3" width="50">
                                    <label class="title-label">Blood Pressure</label>
                                    <div class="ui input col-6">
                                        <input oninput="" maxlength = "6" class="" type="text" name="blood_pressure" placeholder="Ex : 120/80" required = "required">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4 widtht">
                                    <img src="{{url('imgs/3.png')}}" class="col-2 ml-3 mb-3" width="50">
                                    <label class="title-label" style="margin-right: 130px;">Weight</label>
                                    <select name="width_type" class=" col-1 ui selection dropdown zindex">
                                        <option value="pound">Lbs</option>
                                        <option value="kg">KG</option>
                                        <option value="St">St</option>
                                    </select>
                                    <div class="ui input col-6 margin-select">
                                        <input name="weight" type="text" class="pl-20" placeholder="Weight" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4 text-center mt-5">
                                @if(Auth::guard('doctor')->check())
                                @if(auth()->guard('doctor')->user()->Primary_Speciality == 'Dentist')
                                <div class="col-12">
                                <img src="{{url('imgs/teeth.svg')}}" class="col-1 ml-3 mb-3" width="50">
                                </div>
                                    <div class="col-md-4 mr-auto ml-auto">
                                        <select name = "jaw_type" class="ui selection dropdown">
                                            <option hidden >Type</option>
                                            <option value="upper">Upper</option>
                                            <option value="lower">Lower</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mr-auto ml-auto">
                                        <select name = "jaw_direction" class="ui selection dropdown">
                                            <option hidden>Direaction</option>
                                            <option value="right">Right</option>
                                            <option value="left">Left</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mr-auto ml-auto">
                                        <select name = "teeth_type" class="ui selection dropdown">
                                            <option hidden >3</option>
                                            <option value="one">1</option>
                                            <option value="two">2</option>
                                            <option value="three">3</option>
                                            <option value="four">4</option>
                                            <option value="five">5</option>
                                            <option value="six">6</option>
                                        </select>
                                    </div>
                                @endif
                                @if(auth()->guard('doctor')->user()->Primary_Speciality == 'Ophthalmologist')
                                    <div div class="col-xl-11 col-md-4 mb-5 text-center">
                                        <div class="row mb-4">
                                            <div class="col-md-6 mr-auto ml-auto">
                                                <select name = "eye_type" class="ui selection dropdown col-12">
                                                    <option value="">Eye type</option>
                                                    <option value="right">Right</option>
                                                    <option value="left">Left</option>
                                                </select>
                                            </div>
                                        </div><hr/>
                                    </div>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="pills-main-teal col-md-9 ml-auto mr-auto card mt-5 p-3">
                        <div class="form-group mt-5">
                            <div class="row mb-3">
                                <table class=" ml-auto mr-auto table field_group">
                                    <td style="border-top: none;"><input name="medication[0][medication_name]" class="select_custom col-lg-8 ml-auto mr-auto form-control  required" placeholder="Mediction" /></td>
                                    <td style="border-top: none;" >
                                      <select name="medication[0][times_day]" class=" item_type col-lg-8 custom-select required" id="inputGroupSelect01">
                                        <option hidden>Times Day</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="If necessity">If necessity</option>
                                      </select>
                                    </td>
                                    <td style="border-top: none;">
                                      <select name="medication[0][time]" class="col-lg-8 custom-select time required" id="inputGroupSelect01">
                                        <option hidden>Time</option>
                                        <option value="Before Eating">Before Eating</option>
                                        <option value="After Eating">After Eating</option>
                                      </select>
                                    </td>
                                    <td style="border-top: none;"><button type="button" class="btn btn-danger" id="remove"><i class="fa fa-times"></i></button></td>
                                    <tbody style="border-top: none;" class="col-lg-12" id="TextBoxContainer">
                                    </tbody>
                                </table>
                                <div class="form-group col-11 ml-5">
                                    <button id="more_fields" type="button" class="btn btn-success col-2 mt-3 float-right h5" data-toggle="tooltip" data-original-title="Add more controls"><i class="fa fa-plus"></i>&nbsp; Add&nbsp;</button>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid ">
                    <div class="row mb-5">
                      <div class="pills-main-orange card mt-5 p-3 col-lg-9 col-md-5 ml-auto mr-auto">
                        <div class="container ml-auto mr-auto">
                          <label class="row container mb-5 mt-2 h6 font-weight-bold" style="font-size: 20pt; line-height: 5rem;"><img src="{{url('imgs/x-ray.svg')}}" class="mr-5" width="70">Radiology</label>
                          <div class="col-md-12">
                            <div class="row col-12 form-group field_group2">
                              <div class="col-lg-5 mr-auto ml-auto">
                                <div class="col-12">
                                  <div class="inline field">
                                    <select name="rayName[0][ray_name]" class="col-12 custom-select select_custom" id="inputGroupSelect01">
                                      @foreach($rays as $ray)
                                      <option hidden>Choose</option>
                                      <option value="{{$ray->name}}">{{$ray->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-5 col-md-4 mr-auto ml-auto">
                                <div class="ui input col-12">
                                  <input name="rayName[0][ray_description]" class="form-control item_type" type="text" placeholder="Prescription">
                                </div>
                              </div>
                              <button type="button" class="btn btn-danger" id="removeRei"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="form-group" id="TextBoxrediology">
                            </div>
                            <div class="form-group col-11 ml-5">
                              <button id="btnAddrediology" type="button" class="btn btn-success col-2 mt-3 float-right h5" data-toggle="tooltip" data-original-title="Add more controls"><i class="fa fa-plus"></i>&nbsp; Add&nbsp;</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pills-main-yellow card mt-5 p-3 col-lg-9 col-md-6 ml-auto mr-auto">
                        <div class="container ml-auto mr-auto">
                          <label class="row container mb-5 mt-2 h6 font-weight-bold" style="font-size: 20pt; line-height: 5rem;"><img src="{{url('imgs/labs.svg')}}" class="mr-5" width="70">Test</label>
                          <div class="col-md-12">
                            <div class="row col-12 form-group field_group1">
                              <div class="col-lg-5 mr-auto ml-auto">
                                <div class="col-12">
                                  <div class="inline field">
                                    <select name="testName[0][test_name]" class="col-12 custom-select select_custom" id="inputGroupSelect01">
                                      @foreach($analyzes as $ana)
                                      <option hidden>Choose</option>
                                      <option value="{{$ana->name}}">{{$ana->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-5 mr-auto ml-auto">
                                <div class="ui input col-12">
                                  <input name="testName[0][test_description]" type="text" class="form-control item_type" placeholder="Prescription">
                                </div>
                              </div>
                              <button type="button" class="btn btn-danger" id="removeTest"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="form-group" id="TextBoxtest">
                            </div>
                            <div class="form-group col-11 ml-5">
                              <button id="btnAddtest" type="button" class="btn btn-success col-2 mt-3 float-right h5" data-toggle="tooltip" data-original-title="Add more controls"><i class="fa fa-plus"></i>&nbsp; Add&nbsp;</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-8 ml-auto mr-auto text-center mb-5">
                        <input type="submit" class="col-4 btn btn-success " value="Submit">
                    </div>
                </div>
            </form>

        </div>
    <!-- Footer -->
    @include('backEnd.layoutes.footer')
    <!-- footer -->
    </div>
  </div>
  @else
  <!-- container -->
  <div class="container">
    <p class="alert alert-danger mb-4">Sorry, there is no data</p>
  </div>
  <!-- container -->
  @endif

@stop

@section('scripts')
  <script>
      $(function () {
            $('#more_fields').click(function(){
            $('.field_group:first').clone(true).hide().insertAfter('.field_group:last').slideDown('slow');
                var last = $('.field_group:last');
                var current =  $(".field_group").length - 1;
                //last.append(new_button.clone(true));
                last.find('select').val([]);
                last.find('input.select_custom').attr("name", "medication[" + current + "][medication_name]");
                last.find('select.item_type').attr("name", "medication[" + current + "][times_day]");
                last.find('select.time').attr("name", "medication[" + current + "][time]");
            });
            $("body").on("click", "#remove", function () {
                $(this).closest("tr").remove();
            });
        });

        /* clinic add rediology */
        $(function(){
            $('#btnAddrediology').click(function(){
            $('.field_group2:first').clone(true).hide().insertAfter('.field_group2:last').slideDown('slow');
                var last = $('.field_group2:last');
                var current =  $(".field_group2").length - 1;
                //last.append(new_button.clone(true));
                last.find('select').val([]);
                last.find('select.select_custom').attr("name", "rayName[" + current + "][ray_name]");
                last.find('input.item_type').attr("name", "rayName[" + current + "][ray_description]");
            });
            $("body").on("click", "#removeRei", function () {
                $(this).closest(".field_group2").remove();
            });
        });
        $(function(){
            $('#btnAddtest').click(function(){
            $('.field_group1:first').clone(true).hide().insertAfter('.field_group1:last').slideDown('slow');
                var last = $('.field_group1:last');
                var current =  $(".field_group1").length - 1;
                //last.append(new_button.clone(true));
                last.find('select').val([]);
                last.find('select.select_custom').attr("name", "testName[" + current + "][test_name]");
                last.find('input.item_type').attr("name", "testName[" + current + "][test_description]");
            });
            $("body").on("click", "#removeTest", function () {
                $(this).closest(".field_group1").remove();
            });
        });
    @include('includes.temperture')
      /* clinic add prescreption */
    $("#recata_submit").on('click',function(e){
        e.preventDefault();
        var formData = new FormData($("#clinic_add_prescription")[0]);
        $.ajax({
            type:"post",
            url: "{{route('store_clinic_Raoucata')}}",
            data:formData,
            processData: false,
            contentType: false,
            cache: false,
            success:function(data){
                if(data.status == true){
                    $("#success_msg").show().delay(800).fadeOut();
                    $( '#clinic_add_prescription' ).each(function(){
                        this.reset();
                    });
                }
            },
            error:function(data){
                if(data.status == false){
                    $("#error_msg").show();
                }
            },
        });
    });
    /* clinic add prescreption */
      /* clinic add rideology */
      $("#redeology_submit").on('click',function(e){
          e.preventDefault();
          var formData = new FormData($("#clinic_add_rideology")[0]);
          $.ajax({
              type:"post",
              url: "{{route('patient_add_rays')}}",
              data:formData,
              processData: false,
              contentType: false,
              cache: false,
              success:function(data){
                  if(data.status == true){
                      $("#success_msg_ridoelgy").show().delay(800).fadeOut();
                      $( '#clinic_add_rideology' ).each(function(){
                          this.reset();
                      });
                  }
              },
              error:function(data){
                  if(data.status == false){
                      $("#error_msg_ridoelgy").show();
                  }
              },
          });
      });
      /* clinic add rideology */
      /* clinic add test */
      $("#test_submit").on('click',function(e){
          e.preventDefault();
          var formData = new FormData($("#clinic_add_test")[0]);
          $.ajax({
              type:"post",
              url: "{{route('patient_add_analzes')}}",
              data:formData,
              processData: false,
              contentType: false,
              cache: false,
              success:function(data){
                  if(data.status == true){
                      $("#success_msg_test").show().delay(800).fadeOut();
                      $( '#clinic_add_test' ).each(function(){
                          this.reset();
                      });
                  }
              },
              error:function(data){
                  if(data.status == false){
                      $("#error_msg_test").show();
                  }
              },
          });
      });
      /* clinic add test */

  </script>
@stop
