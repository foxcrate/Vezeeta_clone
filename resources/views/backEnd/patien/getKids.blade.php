@extends('backEnd.layoutes.mastar')
@section('title','get Kids')
@section('content')
@include('backEnd.patien.slidenav')

<div class="d-flex img-pop" id="wrapper">
    <div id="page-content-wrapper">
        <!-- Topnav -->
        @include('includes.patientNav')
        <div  class="container-fluid">
            <div class="col-lg-10 ml-auto mr-auto">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <form action="{{route('patient.child.create',$patient->id)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                    <div class="col-lg-10 ml-auto mr-auto kidsClass">
                        <div class="row">
                            <div class="col-lg-6 mt-auto mb-auto">
                                <h4 class="text-primary ml-5 font-weight-bold ">Add Child</h4>
                            </div>

                            <div class="col-lg-6">
                                <div class="avatar-wrapper">
                                    <img class="profile-pic" src="" />
                                    <div class="upload-button">
                                        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                    </div>
                                    <input id="compress_image" required name = "image" class="file-upload @error('image') is-invalid @enderror" type="file" accept="image/*">
                                </div>
                                <label class="col-12 text-center text-dark" style="margin-top:-50px"><i class="fa fa-camera mr-2"></i>Add Child pictrue</label>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label  class="h5 font-weight-bold mt-3 text-primary font-weight-bolder">Child Name</label>
                                <div class="input-group mb-3">
                                    <input required onkeypress="return /[a-z ]/i.test(event.key)" type="text" class="form-control select_custom @error('child_name') is-invalid @enderror"  placeholder="Child Name" name="child_name" value="{{old('child_name')}}">
                                    @error('child_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="birth" class="h5 font-weight-bold mt-3 text-primary">Birth Date</label>
                                <div class="input-group mb-3">
                                    <input type="date" required class="form-control item_type @error('birthDay') is-invalid @enderror" name="birthDay" value="{{old('birthDay')}}">
                                    @error('birthDay')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-3 mt-4">
                                <label for="gender" class="h5 font-weight-bold text-primary">Gender</label>
                            </div>
                            <div class="col-lg-6">
                                <div class="cc-selector gender">
                                    <input id="boy" type="radio" required name="gender" value="boy"/>
                                    <label class="drinkcard-cc boy" for="boy"></label>
                                    <input id="girl" type="radio" name="gender" value="girl" />
                                    <label class="drinkcard-cc girl" for="girl"></label>
                                </div>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <img src="{{url('imgs/height.png')}}" class="mr-3 mb-3" width="50">
                                            <label class="title-label ml-lg-3">Height</label>
                                            <input  value="{{old('height')}}" minlength="2" maxlength="3" required class="form-control" type="number" name="height" placeholder="Height">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <img src="{{url('imgs/Wight.png')}}" class="mr-3 mb-3" width="50">
                                            <label class="title-label">Weight</label>
                                            <input minlength="2" maxlength="3" required name="weight" type="number" class="form-control" placeholder="Weigth" />
                                                <select style="position:relative; bottom:38px; width:30%; left:170px;" name="weight_type" id="" class="form-control">
                                                    <optgroup>
                                                        <option value="Kg">KG</option>
                                                        <option value="lbs">Lbs</option>
                                                        <option value="St">St</option>
                                                    </optgroup>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <img src="{{url('imgs/blood.png')}}" class="mr-3 mb-3" width="50">
                                            <label for="blood" class="title-label">Blood</label>
                                            {{-- <div> --}}
                                                <select class="form-control" id="blood" name="blood" required>
                                                    <option value="">Blood</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="o+">O+</option>
                                                    <option value="o-">O-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>

                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="diseases" class="h5 font-weight-bold text-primary mb-4 mt-3">Diseases</label>
                            <div class="form-group">
                                <label class="title-info text-dark">Check any Conditions you Currently Being Treated for or have had in the past: </label>
                                <div class="form-flex">
                                    <div class="form-group row">
                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Heart disease">
                                                    <label class="h4">Heart disease</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="High blood pressure">
                                                    <label class="label-input">High blood pressure </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="High cholesterol">
                                                    <label class="label-input">High cholesterol </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Lung disease">
                                                    <label class="label-input">Lung disease</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Diabetes">
                                                    <label class="label-input"> Diabetes</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Neck pain">
                                                    <label class="label-input">Neck pain</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Severe headaches">
                                                    <label class="label-input">Severe headaches </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Back pain">
                                                    <label class="label-input">Back pain</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Seizures ">
                                                    <label class="label-input">Seizures </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Thyroid disease">
                                                    <label class="label-input">Thyroid disease </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Stroke Sleep apnea">
                                                    <label class="label-input">Stroke Sleep apnea </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Stomach disease">
                                                    <label class="label-input">Stomach disease </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Kidney , bladder or prostate disease">
                                                    <label class="label-input">Kidney , bladder or prostate disease </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Blood clots">
                                                    <label class="label-input">Blood clots </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Depression">
                                                    <label class="label-input">Depression </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Anemia or other blood disease">
                                                    <label class="label-input">Anemia or other blood disease</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->
                                        <!-- col -->
                                        <div class="col-sm-4">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Cancer ( past or present )">
                                                    <label class="label-input">Cancer ( past or present ) </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->
                                        <div class="col-md-6 mr-auto ml-auto mt-4">
                                            {{-- <div class="ui input col-12">
                                            <input class="" type="text" name="name" placeholder="Other Diseases">
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <img src="{{url('imgs/033.png')}}" class="mr-3 mb-3" width="50">
                                <label class="title-info">Allergies (incloud medication, food and environmental allergies)</label>
                                <ul class="list-unstyled read-more-wrap field_group">
                                    <li>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label class="title-label ml-xl-3">Allergy</label>
                                                <select name="allergi_data[0][allergi_name]" class=" @error('allergi_data') is-invalid @enderror form-control item_typee">
                                                    <option value="" hidden>Allergy</option>
                                                    <option value="Drug">Drug allergy</option>
                                                    <option value="Food">Food allergy</option>
                                                    <option value="Pet">Pet allergy</option>
                                                    <option value="Insect">Insect allergy</option>
                                                    <option value="Latex">Latex allergy</option>
                                                    <option value="Mold">Mold allergy</option>
                                                    <option value="Pollen">Pollen allergy</option>
                                                    <option value="Dust">Dust allergy</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                @error('allergi_data')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="title-label d-block">Severity</label>
                                                <select name="allergi_data[0][severity]" class="form-control seleect_custom">

                                                    <option  hidden>Severity</option>
                                                    <option value="Mild">Mild</option>
                                                    <option value="Moderate">Moderate</option>
                                                    <option value="Severe">Severe</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="title-label ml-lg-3">Reaction</label>
                                                <input onkeypress="return /[a-z]/i.test(event.key)" class="form-control seelect_custom" type="text" name="allergi_data[0][reaction]" placeholder="Reaction">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="title-label ml-xl-3"></label>
                                                <button  class = "btn btn-danger h5" style="margin-top:37px" type="button" id="remove_more_fields">Delete</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <button  class="btn btn-success col-2 h5" type="button" id="more_fields">Add</button>
                            </div>
                            <hr />
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <img src="{{url('imgs/dissection.png')}}" class="mr-3 mb-3" width="50">
                                <label class="title-info">Surgeries</label>
                                <ul class="list-unstyled read-more-wrap ml-auto mr-auto field_group1">
                                    <li>
                                        <div class="row mb-3">
                                            <div class="col-md-5">
                                                <label class="title-label">Surgery</label>
                                                <select name="surgery_data[0][surgery_name]" class="@error('surgery_data') is-invalid @enderror form-control item_surgeries">
                                                    <option value="" hidden>Surgery</option>
                                                    <option value="Hernia">Hernia Surgery</option>
                                                    <option value="Hemorrhoid">Hemorrhoid Surgery</option>
                                                    <option value="Eye">Eye surgery</option>
                                                    <option value="Gallbladder">Gallbladder Surgery</option>
                                                    <option value="Appendix">Appendix Surgery</option>
                                                    <option value="Cardiovascular">Cardiovascular Surgery</option>
                                                    <option value="Tonsil">Tonsil Surgery</option>
                                                    <option value="Liver">Liver Surgery</option>
                                                    <option value="Cancer">Cancer and Oncology Surgery</option>
                                                    <option value="Kidney">Kidney Surgery</option>
                                                    <option value="Brain">Brain Surgery</option>
                                                    <option value="Gastrointestinal">Gastrointestinal Surgery</option>
                                                    <option value="Reproductive">Reproductive system Surgery</option>
                                                    <option value="Nervous">Nervous system Surgery</option>
                                                    <option value="Respiratory">Respiratory Surgery</option>
                                                    <option value="Muscle">Muscle system Surgery</option>
                                                    <option value="Orthopaedic">Orthopaedic Surgery</option>
                                                    <option value="Ear">Ear, nose and throat Surgery</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                @error('surgery_data')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="title-label">Date</label>
                                                <input class="form-control seleect_surgeries" type="date" name="surgery_data[0][surgery_date]" placeholder="">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="title-label ml-xl-3"></label>
                                                <button  class = "btn btn-danger h5" style="margin-top:37px" type="button" id="remove_more_surgeries">Delete</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <button class="btn btn-success col-2 h5" type="button" id="more_surgeries">Add</button>
                            </div>
                            <hr />
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <img src="{{url('imgs/02.png')}}" class="mr-3 mb-3" width="50">
                                <label class="title-info">Current Medication</label>
                                <ul class=" list-unstyled read-more-wrap field_group2">
                                    <li class="">
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <input class="form-control item_medication" type="text" name="medication_name[0][medication_name]" placeholder="Medication">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <select name="medication_name[0][times_day]" class="@error('medication_name') is-invalid @enderror col-12 custom-select required seleect_medication" id="inputGroupSelect01">
                                                    <option value="" hidden >Times Day</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="If necessity">If necessity</option>
                                                </select>
                                                @error('medication_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <select name="medication_name[0][time]" class="col-12 custom-select required select_medication" id="inputGroupSelect01">
                                                    <option value="" hidden >Time</option>
                                                    <option value="Before Eating">Before Eating</option>
                                                    <option value="After Eating">After Eating</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="title-label ml-xl-3"></label>
                                                <button  class = "btn btn-danger h5"  type="button" id="remove_more_medication">Delete</button>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                                <button class="btn btn-success col-2 h5" type="button" id="more_medication">Add</button>
                            </div>
                            <hr />
                        </div>
                        @if($patient->gender == 'female')
                            <h4 class="text-primary ml-5 mt-3 mb-4 font-weight-bold">Mother Diseases</h4>
                            <div class="row tab-kids col-12 mr-auto ml-auto mb-2 mt-2">
                                <div class="row p-3 col-lg-12 mr-auto ml-auto">
                                    <div class="col-2">
                                        <img src="{{url('imgs/mother.png')}}" width="100">
                                    </div>
                                    <div class="col-lg-9 mb-3 mr-auto ml-auto">
                                        <div class="ui form col-12">
                                            <div class="inline field">
                                                <select name="motherdisease[]" multiple="multiple" class="label ui large selection fluid dropdown">
                                                    <option hidden >Choose</option>
                                                    <option value="high-Blood-Pressure">High Blood Pressure</option>
                                                    <option value="diabetes">Diabetes</option>
                                                    <option value="cancer">Cancer (Past or Present)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($patient->gender == 'male')
                            <h4 class="text-primary ml-5 mt-3 mb-4 font-weight-bold">Father Diseases</h4>
                            <div class="row tab-kids col-12 mr-auto ml-auto mb-3 mt-3">
                                <div class="row p-3 col-lg-12 mr-auto ml-auto">
                                    <div class="col-2">
                                        <img src="{{url('imgs/father.png')}}" width="100">
                                    </div>
                                    <div class="col-lg-9 mb-3 mr-auto ml-auto">
                                        <div class="ui form col-12">
                                            <div class="inline field">
                                                <select name="fatherdisease[]" multiple="multiple" class="label ui large selection fluid dropdown">
                                                    <option hidden >Choose</option>
                                                    <option value="high-Blood-Pressure">High Blood Pressure</option>
                                                    <option value="diabetes">Diabetes</option>
                                                    <option value="cancer">Cancer (Past or Present)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row col-lg-12 mt-5 mb-4">
                        <input type="submit" value="submit" class="btn btn-success col-6 ml-auto mr-auto">
                    </div>

                </form>
            </div>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous">
        </script>
                <script>
                    $('#more_fields').click(function(e){
                        var max = 9;
                        var current1 =  $(".field_group").length;
                            if (current1 < max) {
                                $('.field_group:first').clone(true).hide().insertAfter('.field_group:last').slideDown('slow');
                                var last = $('.field_group:last');
                                var current =  $(".field_group").length;
                                //last.append(new_button.clone(true));
                                last.find('select').val([]);
                                last.find('select.item_typee').attr("name", "allergi_data[" + current + "][allergi_name]");
                                last.find('select.seleect_custom').attr("name", "allergi_data[" + current + "][severity]");
                                last.find('input.seelect_custom').attr("name", "allergi_data[" + current + "][reaction]").val('');
                                current1++;
                                return false;
                            }
                        });
                        $("body").on("click", "#remove_more_fields", function (e) {
                            var current =  $(".field_group").length;
                            if(current == 1){
                               e.prevent();
                               // document.getElementById('remove_more_fields').style.visibility = 'hidden';
                               // $(this).closest("#remove_more_fields").hide();
                            }
                            else{
                                $(this).closest(".field_group").remove();
                            }
                        });


                    $('#more_surgeries').click(function(){
                        var max = 18;
                        var current1 =  $(".field_group1").length;
                        if (current1 < max) {
                    $('.field_group1:first').clone(true).hide().insertAfter('.field_group1:last').slideDown('slow');
                        var last = $('.field_group1:last');
                        var current =  $(".field_group1").length - 1;
                        //last.append(new_button.clone(true));
                        last.find('select').val([]);
                        last.find('select.item_surgeries').attr("name", "surgery_data[" + current + "][surgery_name]");
                        last.find('input.seleect_surgeries').attr("name", "surgery_data[" + current + "][surgery_date]").val('');
                        current1++;
                        return false;
                    }});
                    $("body").on("click", "#remove_more_surgeries", function () {
                        var current =  $(".field_group1").length;
                            if(current == 1){
                               e.prevent();
                            }
                        $(this).closest(".field_group1").remove();
                    });
                    $('#more_medication').click(function(){
                        var max = 10;
                        var current1 =  $(".field_group2").length;
                        if (current1 < max) {
                    $('.field_group2:first').clone(true).hide().insertAfter('.field_group2:last').slideDown('slow');
                        var last = $('.field_group2:last');
                        var current =  $(".field_group2").length - 1;
                        //last.append(new_button.clone(true));
                        last.find('select').val([]);
                        last.find('input.item_medication').attr("name", "medication_name[" + current + "][name]").val('');
                        last.find('select.seleect_medication').attr("name", "medication_name[" + current + "][times_day]");
                        last.find('select.select_medication').attr("name", "medication_name[" + current + "][time]");
                        current1++;
                        return false;
                    } });
                    $("body").on("click", "#remove_more_medication", function () {
                        var current =  $(".field_group2").length;
                        if(current == 1){
                           e.prevent();
                        }
                        $(this).closest(".field_group2").remove();
                    });
                </script>
                <!-- footer -->
                @include('backEnd.layoutes.footer')
                <!-- footer -->
    </div>
</div>


@endsection
