@extends('backEnd.layoutes.mastar')
@section('title','profile ' . $child->child_name)
@section('content')
@include('backEnd.hosptail.sidenav')

<div class="d-flex img-pop" id="wrapper">
    <div id="page-content-wrapper">
        <!-- Topnav -->
        @include('includes.patientNav')
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
                                                <h5 class="card-title text-uppercase mb-0">{{$child->child_name}}</h5>
                                                <div class="row mt-3">
                                                    <div class="h5 col-lg-4 text-center">Year</div>
                                                    <div class="h5 col-lg-4 text-center">Month</div>
                                                    <div class="h5 col-lg-4 text-center">Day</div>
                                                </div>
                                                <div class="row">
                                                    <div class="h4 col-lg-4 text-center">{{$child->AgeYear}}</div>
                                                    <div class="h4 col-lg-4 text-center">{{$child->AgeMonth}}</div>
                                                    <div class="h4 col-lg-4 text-center">{{$child->AgeDay}}</div>
                                                </div>
                                                <span class="h4 font-weight-bold mb-0"></span>
                                                {{--<h4 class="card-title text-uppercase mb-3">{{$patient->firstName . ' ' . $patient->lastName}}</h4>--}}
                                        </div>
                                        <div class="col-3 text-center">
                                            <button class="col-10 btn btn-success h4 mt-sm-2"><a class = "text-white text-decoration" href="{{route('hosptail_child_old_prescrption',[$hosptail->id,$patient->id,$child->id])}}">Doctor Prescription </a></button>
                                        </div>
                                        <div class="col-3 text-center">
                                            <button class="col-10 btn btn-primary h4 mt-sm-2"><a class = "text-white text-decoration" href="{{route('hosptail_child_all_prescrption',[$hosptail->id,$patient->id,$child->id])}}">All Prescription </a></button>
                                        </div>
                                        <div class="col-12">
                                            <button class="col-3 float-right btn btn-danger h4 "><a class = "text-white text-decoration" href="#">Log out </a></button>
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
            <form action="{{route('hosptail_child_store_prescription')}}" id="hosptail_add_prescription" method="POST">
                {{csrf_field()}}
                <input type="text" name="child_id" value="{{$child->id}}" style="display: none">
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
                                      @foreach($tests as $test)
                                      <option hidden>Choose</option>
                                      <option value="{{$test->name}}">{{$test->name}}</option>
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


    </div>




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
                  last.find('input.select_custom').attr("name", "medication[" + current + "][name]");
                  last.find('select.item_type').attr("name", "medication[" + current + "][times_day]");
                  last.find('select.time').attr("name", "medication[" + current + "][time]");
              });
              $("body").on("click", "#remove", function () {
                  $(this).closest("tr").hide();
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
                  last.find('input.item_type').attr("name", "testName[" + current + "][test_description]");
              });
              $("body").on("click", "#removeTest", function () {
                $(this).closest(".field_group1").hide();
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