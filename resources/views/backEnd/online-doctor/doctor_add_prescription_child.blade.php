@extends('backEnd.layoutes.mastar')
@section('title','profile ' . $child->child_name)
@section('content')
@include('backEnd.online-doctor.sidenav')

<div class="d-flex img-pop" id="wrapper">
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
                            Dr {{$online_doctor->name}}</h4>
                        <h5 class="card-title text-uppercase text-white mb-0">{{$online_doctor->idCode}}</h5>
                        <h5 class="card-title text-white mb-0">{{$online_doctor->Primary_Speciality}}</h5>
                        <span class="h4 font-weight-bold mb-0"></span>
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
                                        <div class="col mt-3">
                                                <h5 class="card-title text-uppercase font-weight-bold ml-4 mb-0">{{$child->child_name}}</h5>
                                                <div class="row mt-4">
                                                    <div class="h5 col-lg-4 text-center">Year</div>
                                                    <div class="h5 col-lg-4 text-center">Month</div>
                                                    <div class="h5 col-lg-4 text-center">Day</div>
                                                </div>
                                                <div class="row">
                                                    <div class="h4 col-lg-4 font-weight-bold text-center text-dark">{{$child->CalcAgeYear}}</div>
                                                    <div class="h4 col-lg-4 font-weight-bold text-center text-dark">{{$child->CalcAgeMonth}}</div>
                                                    <div class="h4 col-lg-4 font-weight-bold text-center text-dark">{{$child->CalcAgeDay}}</div>
                                                </div>
                                                <span class="h4 font-weight-bold mb-0"></span>
                                                {{--<h4 class="card-title text-uppercase mb-3">{{$patient->firstName . ' ' . $patient->lastName}}</h4>--}}
                                        </div>
                                        <div class="col-3 text-center">
                                            <button class="col-12 btn btn-success h4 mt-sm-2"><a class = "text-white text-decoration" href="#">Doctor Prescription </a></button>
                                        </div>
                                        <div class="col-3 text-center">
                                            <button class="col-12 btn btn-primary h4 mt-sm-2"><a class = "text-white text-decoration" href="#">All Prescription </a></button>
                                        </div>
                                        <div class="col-12">
                                            <button class="col-3 float-right btn btn-danger h4 "><a class = "text-white text-decoration" href="#">Logout </a></button>
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
            @include('includes.alerts.success')
            <form action="{{ route('child_store_prescription') }}" id="clinic_add_prescription" method="POST">
                {{csrf_field()}}
                <input type="text" name="child_id" value="{{$child->id}}" style="display: none">
                <input type = "hidden" name = "doctor_id" value = "{{$online_doctor->id}}">
                <div class="container-fluid">
                    <div class="pills-main-green col-md-9 ml-auto mr-auto card mt-5 p-3">
                        <div class="form-group row col-lg-12 mr-auto ml-auto mt-3">
                            <img src="{{url('imgs/prescription.svg')}}" class="col-1 mb-3" width="50">
                            <label class="col-lg-2 font-weight-bold">Prescription</label>
                            <div class="row ui input col-9">
                                <input class="col-lg-12 @error('prescription') is-invalid @enderror" type="text" name="prescription" placeholder="prescription">
                                @error('prescription')
                                    <div class="row col-12 invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                      <select name="medication[0][times_day]" class=" @error('medication') is-invalid @enderror item_type col-lg-8 custom-select required" id="inputGroupSelect01">
                                        <option hidden>Times Day</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="If necessity">If necessity</option>
                                      </select>
                                      @error('medication')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
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
                                    <select name="rayName[0][ray_name]" class="@error('rayName') is-invalid @enderror col-12 custom-select select_custom" id="inputGroupSelect01">
                                      @foreach($rays as $ray)
                                      <option hidden>Choose</option>
                                      <option value="{{$ray->name}}">{{$ray->name}}</option>
                                      @endforeach
                                    </select>
                                    @error('rayName')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
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
                                      @foreach($tests as $ana)
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
                <div class="row col-lg-12 ml-auto mr-auto mb-5">
                    <input type="submit" class="btn btn-primary col-lg-6 ml-auto mr-auto " value="Submit">
                  </div>
            </form>

        </div>
    </div>




    @stop
    @section('scripts')
    <script>
        $(function () {
              $('#more_fields').click(function(){
                  var max = 4;
                  var current1 =  $(".field_group").length;
                  if(current1 < max){
                      $('.field_group:first').clone(true).hide().insertAfter('.field_group:last').slideDown('slow');
                      var last = $('.field_group:last');
                      var current =  $(".field_group").length;
                      //last.append(new_button.clone(true));
                      last.find('select').val([]);
                      last.find('input.select_custom').attr("name", "medication[" + current + "][name]").val('');
                      last.find('select.item_type').attr("name", "medication[" + current + "][times_day]");
                      last.find('select.time').attr("name", "medication[" + current + "][time]");
                      current1++;
                      return false;
                  }
              });
              $("body").on("click", "#remove", function () {
                  var current =  $(".field_group").length;
                  if(current == 1){
                      e.prevent();
                  }else{
                      $(this).closest(".field_group").remove();
                  }

              });
          });

          /* clinic add rediology */
          $(function(){
              $('#btnAddrediology').click(function(){
                  var max = 4;
                  var current1 =  $(".field_group2").length;
                  if(current1 < max){
                      $('.field_group2:first').clone(true).hide().insertAfter('.field_group2:last').slideDown('slow');
                      var last = $('.field_group2:last');
                      var current =  $(".field_group2").length;
                      //last.append(new_button.clone(true));
                      last.find('select').val([]);
                      last.find('select.select_custom').attr("name", "rayName[" + current + "][ray_name]");
                      last.find('input.item_type').attr("name", "rayName[" + current + "][ray_description]").val('');
                      current1++;
                      return false;
                  }
                  });
                  $("body").on("click", "#remove_rediology", function () {
                      var current =  $(".field_group2").length;
                      if(current ==1){
                          e.prevent();
                      }else{
                          $(this).closest(".field_group2").remove();
                      }

                  });

          });
          $(function(){
              $('#btnAddtest').click(function(){
                  var max = 4;
                  var current1 =  $(".field_group1").length;
                  if(current1 < max){
                      $('.field_group1:first').clone(true).hide().insertAfter('.field_group1:last').slideDown('slow');
                      var last = $('.field_group1:last');
                      var current =  $(".field_group1").length;
                      //last.append(new_button.clone(true));
                      last.find('select').val([]);
                      last.find('select.select_custom').attr("name", "testName[" + current + "][test_name]");
                      last.find('input.item_type').attr("name", "testName[" + current + "][test_description]").val('');
                  }
                  });
                  $("body").on("click", "#remove_Test", function () {
                      var current =  $(".field_group1").length;
                      if(current ==1){
                          e.prevent();
                      }else{
                          $(this).closest(".field_group1").remove();
                      }

                  });
          });
      @include('includes.temperture')
        /* hosptail add prescreption */
      $("#recata_submit").on('click',function(e){
          e.preventDefault();
          var formData = new FormData($("#hosptail_add_prescription")[0]);
          $.ajax({
              type:"post",
              url: "{{route('store_hosptail_Raoucata')}}",
              data:formData,
              processData: false,
              contentType: false,
              cache: false,
              success:function(data){
                  if(data.status == true){
                      $("#success_msg").show().delay(800).fadeOut();
                      $( '#hosptail_add_prescription' ).each(function(){
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
      /* hosptail add prescreption */
        /* hosptail add rideology */
        $("#redeology_submit").on('click',function(e){
            e.preventDefault();
            var formData = new FormData($("#hosptail_add_rideology")[0]);
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
                        $( '#hosptail_add_rideology' ).each(function(){
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
        /* hosptail add rideology */
        /* hosptail add test */
        $("#test_submit").on('click',function(e){
            e.preventDefault();
            var formData = new FormData($("#hosptail_add_test")[0]);
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
                        $( '#hosptail_add_test' ).each(function(){
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
        /* hosptail add test */

    </script>
  @stop
