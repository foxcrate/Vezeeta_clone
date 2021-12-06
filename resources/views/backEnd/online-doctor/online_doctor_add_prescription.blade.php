@extends('backEnd.layoutes.mastar')
@section("content")
@section('title','Add Prescription To ' . $patient->firstName . $patient->lastName)
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

        <div class="container-fluid">
          <div class="row border-bottom mb-5">
            <div class = "container">
                <div id="success_msg" class="alert alert-success" style="display:none">prescrption successfuly</div>
                <div id="error_msg" class="alert alert-danger" style="display: none">Sory the filed is required</div>
            </div>
            <form action="{{route("post_add_prescription_patient",[$online_doctor->id,$patient->id])}}" id="" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="patient_id" value="{{$patient->id}}">
                <input type="hidden" name="online_doctor_id" value="{{$online_doctor->id}}">

                {{-- @if(Auth::guard('online_doctor')->check())
                <input type = "hidden" name = "doctor_id" value = "{{auth('online_doctor')->user()->id}}">
                @endif --}}
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
                                        <input maxlength="3" class="ml-1" type="number" name="diabetics" placeholder="Diabetics">
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
                                        <input name="weight" type="number" class="pl-20" placeholder="Weight" />
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
                                            <option value="Upper">Upper</option>
                                            <option value="Lower">Lower</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mr-auto ml-auto">
                                        <select name = "jaw_direction" class="ui selection dropdown">
                                            <option hidden>Direaction</option>
                                            <option value="Right">Right</option>
                                            <option value="Left">Left</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mr-auto ml-auto">
                                        <select name = "teeth_type" class="ui selection dropdown">
                                            <option hidden >3</option>
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                            <option value="3rd">3rd</option>
                                            <option value="4th">4th</option>
                                            <option value="5th">5th</option>
                                            <option value="6th">6th</option>
                                            <option value="7th">7th</option>
                                            <option value="8th">8th</option>
                                            {{--  <option value="9th">9th</option>
                                            <option value="10th">10th</option>
                                            <option value="11th">11th</option>
                                            <option value="12th">12th</option>
                                            <option value="13th">13th</option>
                                            <option value="14th">14th</option>
                                            <option value="15th">15th</option>
                                            <option value="16th">16th</option>  --}}
                                        </select>
                                    </div>
                                @endif
                                @if(auth()->guard('doctor')->user()->Primary_Speciality == 'Ophthalmologist')
                                    <div div class="col-xl-11 col-md-4 mb-5 text-center">
                                        <div class="row mb-4">
                                            <div class="col-md-6 mr-auto ml-auto">
                                                <select name = "eye_type" class="ui selection dropdown col-12">
                                                    <option value="">Eye type</option>
                                                    <option value="Right">Right</option>
                                                    <option value="Left">Left</option>
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
                                    <td style="border-top: none;"><input name="medication[0][name]" class="select_custom col-lg-8 ml-auto mr-auto form-control  required" placeholder="Mediction" /></td>
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
                              <div class="col-lg-5 col-md-4 mr-auto ml-auto redolgy">
                                <div class="ui input col-12">
                                  <input name="rayName[0][ray_description]" class="form-control item_type" type="text" placeholder="Prescription">
                                </div>
                              </div>
                              <button type="button" class="btn btn-danger" id="remove_rediology"><i class="fa fa-times"></i></button>
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
                              <button type="button" class="btn btn-danger" id="remove_Test"><i class="fa fa-times"></i></button>
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
                  </div>

                <input type="submit" class="btn btn-primary col-12 " value="Submit">
            </form>
          </div>
        </div>


        <script src="{{url('js/app.js')}}"></script>
        @include("backEnd.layoutes.footer")

    </div>
  </div>

@endsection
@section('scripts')
  <script>
      $(function () {
            $('#more_fields').click(function(){
            $('.field_group:first').clone(true).hide().insertAfter('.field_group:last').slideDown('slow');
                var last = $('.field_group:last');
                var current =  $(".field_group").length - 1;
                //last.append(new_button.clone(true));
                last.find('select').val([]);
                last.find('input.select_custom').attr("name", "medication[" + current + "][name]").val('');
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
                last.find('input.item_type').attr("name", "rayName[" + current + "][ray_description]").val('');
            });
            $("body").on("click", "#remove_rediology", function () {
                $(this).closest(".field_group2").hide();
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
                last.find('input.item_type').attr("name", "testName[" + current + "][test_description]").val('');
            });
            $("body").on("click", "#remove_Test", function () {
                $(this).closest(".field_group1").hide();
            });
        });
        @include('includes.temperture')
    </script>

    @stop
