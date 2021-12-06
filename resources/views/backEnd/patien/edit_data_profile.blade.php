@extends('backEnd.layoutes.mastar')
@section('title','Edit profile ')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="d-flex bg-page" id="wrapper">
        @include('backEnd.patien.slidenav')
        <div id="page-content-wrapper">
            <!-- main content -->
            <div class="main-content" id="panel">
                <form action="{{route('updata_data_profile',[$patient->id,$patient->patinets_data->id])}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                    <!-- Topnav -->
                    @include('includes.patientNav')
                    <!-- Header -->
                    <div class="col-11 ml-auto mr-auto mt-5 mb-5 align-items-center coveredit">
                        <!-- Mask -->
                        <span class="mask bg-gradient-white opacity-1"></span>
                    </div>
                    <!-- Page content -->
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-xl-4 order-xl-2">
                                <div class="card card-profile">
                                    <img src="{{url('/imgs/BgLogin.jpg')}}" height="150" alt="Image placeholder" class="card-img-top">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 order-lg-2">
                                            <div class="card-profile-image">
                                                <a href="#" class="">
                                                    @if(!$patient->image)
                                                        <a href="{{route('edit.data.profile',$patient->id)}}"><img src="{{ asset('uploads/default.png') }}" class="rounded-circle"></a>
                                                    @else
                                                        <img src="{{$patient->image}}" class="rounded-circle">
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                                        <div class="d-flex justify-content-between">
                                            {{--  <a href="{{route('edit.data.profile',$patient->id)}}" class="float-lg-left"><i class="fas fa-edit mr-1"></i>Edit</a>  --}}
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <P class="h5 font-weight-bold text-center mt-5">{{$patient->firstName . ' ' . $patient->middleName}}</P>
                                        <h5 class="h5 font-weight-700 mb-5 text-center">{{$patient->idCode}}</h5>
                                        <div class="pl-3 pr-3 mt-3">
                                            {{--  <h5 class="h5 mt-3 text-capitalize"><i class="fas fa-male mr-4 ml-1 text-primary"></i><span class="ml-3">{{$patient->gender}}</span></h5>  --}}
                                            {{--  <h5 class="h5 mt-3 text-capitalize"><i class="fa fa-calendar-check mr-3 text-primary" aria-hidden="true"></i><span class="ml-3">{{$patient->age}} Age</span></h5>  --}}
                                            <div class="row h5 mt-3 text-capitalize">
                                                <i class="col-lg-1 fas fa-location-arrow mr-3 text-primary"></i>
                                                <div class="col-lg-10">
                                                    {{$patient->address}}
                                                </div>
                                            </div>
                                            <div class="row h5 mt-3 text-capitalize">
                                                <i class="col-lg-1 fas fa-mail-bulk mr-3 text-primary"></i>
                                                <div class="col-lg-10">
                                                    {{$patient->email}}
                                                </div>
                                            </div>
                                            <h5 class="h5 mt-3 text-capitalize mb-5"><i class="fa fa-phone mr-3 text-primary" aria-hidden="true"></i><span class="ml-2">{{$patient->phoneNumber}}</span></h5>
                                        </div>
                                        <div class="text-center">
                                            <a href="{{route('edit.data.profile',$patient->id)}}"class="btn btn-primary col-5 h4">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 order-xl-1 mb-5">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h3 class="mb-0">Edit Medical Profile</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="title-sub text-uppercase text-muted mb-4">User information</h3>
                                        <div class="pl-lg-4 mb-2 mt-5">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <img src="{{url('imgs/height.png')}}" class="mr-3 mb-3" width="50">
                                                                        <label class="title-label ml-lg-3">Height</label>
                                                                        <input maxlength="3" class="form-control" type="number" name="height" placeholder="Height" value="{{$patient->patinets_data->height}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <img src="{{url('imgs/Wight.png')}}" class="mr-3 mb-3" width="50">
                                                                        <label class="title-label">Weight</label>
                                                                        <input minlength="2" maxlength="3" name="width" type="number" class="form-control" placeholder="Weight"value="{{$patient->patinets_data->width}}" />
                                                                            <select style="position:relative; bottom:38px; width:30%; left:170px;" name="width_type" id="" class="form-control">
                                                                                <optgroup>
                                                                                    <option {{$patient->patinets_data->width_type == 'KG' ? 'selected' : ''}} value="Kg">KG</option>
                                                                                    <option {{$patient->patinets_data->width_type == 'Lbs' ? 'selected' : ''}} value="Lbs">Lbs</option>
                                                                                    <option {{$patient->patinets_data->width_type == 'St' ? 'selected' : ''}} value="St">ST</option>
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <img src="{{url('imgs/blood.png')}}" class="mr-3 mb-3" width="50">
                                                                        <label class="title-label">Blood</label>
                                                                        <div>
                                                                            <select class="form-control" name="blood">
                                                                                <option hidden>Choose</option>
                                                                                <option {{$patient->patinets_data->blood == 'A+' ? 'selected' : ''}} value="A+">A+</option>
                                                                                <option {{$patient->patinets_data->blood == 'A-' ? 'selected' : ''}} value="A-">A-</option>
                                                                                <option {{$patient->patinets_data->blood == 'B+' ? 'selected' : ''}} value="B+">B+</option>
                                                                                <option {{$patient->patinets_data->blood == 'B-' ? 'selected' : ''}} value="B-">B-</option>
                                                                                <option {{$patient->patinets_data->blood == 'o+' ? 'selected' : ''}} value="o+">O+</option>
                                                                                <option {{$patient->patinets_data->blood == 'o-' ? 'selected' : ''}} value="o-">O-</option>
                                                                                <option {{$patient->patinets_data->blood == 'AB+' ? 'selected' : ''}} value="AB+">AB+</option>
                                                                                <option {{$patient->patinets_data->blood == 'AB-' ? 'selected' : ''}} value="AB-">AB-</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-4" />
                                        <!-- Patient History -->
                                        <h3 class="title-sub text-uppercase text-muted mb-4">Patient History</h3>
                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <img src="{{url('imgs/01.png')}}" class="mr-3 mb-3" width="50">
                                                        <label class="title-info">Check any Conditions you Currently Being Treated for or have had in the past: </label>
                                                        <div class="form-flex">
                                                            <div class="form-group row">
                                                                @php
                                                                    $agrees = $patient->patinets_data->agree_name;
                                                                @endphp
                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" value="Heart disease" {{is_array($agrees) && in_array('Heart disease',$agrees) ? 'checked' : ''}}>
                                                                            <label class="h4">Heart disease</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input  name="agree_name[]" type="checkbox" tabindex="0" class="hidden" value="High blood pressure" {{is_array($agrees) && in_array('High blood pressure',$agrees) ? 'checked' : ''}}>
                                                                            <label class="label-input">High blood pressure </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input  name="agree_name[]" type="checkbox" tabindex="0" class="hidden" value="High cholesterol" {{is_array($agrees) && in_array('High cholesterol',$agrees) ? 'checked' : ''}}>
                                                                            <label class="label-input">High cholesterol </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Lung disease',$agrees) ? 'checked' : ''}} value="Lung disease">
                                                                            <label class="label-input">Lung disease</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Diabetes',$agrees) ? 'checked' : ''}} value="Diabetes">
                                                                            <label class="label-input"> Diabetes</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Neck pain',$agrees) ? 'checked' : ''}} value="Neck pain">
                                                                            <label class="label-input">Neck pain</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Severe headaches',$agrees) ? 'checked' : ''}} value="Severe headaches">
                                                                            <label class="label-input">Severe headaches </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Back pain',$agrees) ? 'checked' : ''}} value="Back pain">
                                                                            <label class="label-input">Back pain</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Seizures',$agrees) ? 'checked' : ''}} value="Seizures ">
                                                                            <label class="label-input">Seizures </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Thyroid disease',$agrees) ? 'checked' : ''}}  value="Thyroid disease">
                                                                            <label class="label-input">Thyroid disease </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Stroke Sleep apnea',$agrees) ? 'checked' : ''}} value="Stroke Sleep apnea">
                                                                            <label class="label-input">Stroke Sleep apnea </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Stomach disease',$agrees) ? 'checked' : ''}} value="Stomach disease">
                                                                            <label class="label-input">Stomach disease </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Kidney , bladder or prostate disease',$agrees) ? 'checked' : ''}} value="Kidney , bladder or prostate disease">
                                                                            <label class="label-input">Kidney , bladder or prostate disease </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Blood clots',$agrees) ? 'checked' : ''}} value="Blood clots">
                                                                            <label class="label-input">Blood clots </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Depression',$agrees) ? 'checked' : ''}} value="Depression">
                                                                            <label class="label-input">Depression </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->

                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Anemia or other blood disease',$agrees) ? 'checked' : ''}} value="Anemia or other blood disease">
                                                                            <label class="label-input">Anemia or other blood disease</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- col -->
                                                                <!-- col -->
                                                                <div class="col-sm-3">
                                                                    <div class="field">
                                                                        <div class="ui checkbox">
                                                                            <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Cancer ( past or present )',$agrees) ? 'checked' : ''}} value="Cancer ( past or present )">
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
                                                <hr class="my-4" />
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <img src="{{url('imgs/033.png')}}" class="mr-3 mb-3" width="50">
                                                        <label class="title-info">Allergies (incloud medication, food and environmental allergies)</label>
                                                        @foreach($patient->patinets_data->allergi_data as $key => $array)
                                                        <ul class="list-unstyled read-more-wrap field_group">
                                                            <li>
                                                                <div class="row mb-3">

                                                                    <div class="col-md-3">
                                                                        <label class="title-label ml-xl-3">Allergy</label>
                                                                        <select name="allergi_data[{{$key}}][allergi_name]" class="form-control item_typee">
                                                                            <option value="" hidden>Allergy</option>
                                                                            <option {{$array['allergi_name'] == "Drug" ? "selected" : ''}}   value="Drug">Drug allergy</option>
                                                                            <option {{$array['allergi_name'] == "Food" ? "selected" : ''}} value="Food">Food allergy</option>
                                                                            <option {{$array['allergi_name'] == "Pet" ? "selected" : '' }} value="Pet">Pet allergy</option>
                                                                            <option {{$array['allergi_name'] == "Insect" ? "selected" : '' }} value="Insect">Insect allergy</option>
                                                                            <option {{$array['allergi_name'] == "Latex" ? "selected" : '' }} value="Latex">Latex allergy</option>
                                                                            <option {{$array['allergi_name'] == "Mold" ? "selected" : '' }} value="Mold">Mold allergy</option>
                                                                            <option {{$array['allergi_name'] == "Pollen" ? "selected" : ''}} value="Pollen">Pollen allergy</option>
                                                                            <option {{$array['allergi_name'] == "Dust" ? "selected" : '' }} value="Dust">Dust allergy</option>
                                                                            <option {{$array['allergi_name'] == "Other" ? "selected" : '' }} value="Other">Other</option>
                                                                        </select>

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="title-label d-block">Severity</label>
                                                                        <select name="allergi_data[{{$key}}][severity]" class="form-control seleect_custom">
                                                                            <option value="" hidden>Severity</option>
                                                                            <option {{$array['severity'] == 'High' ? 'selected' : ''}} value="High">High</option>
                                                                            <option {{$array['severity'] == 'Middle' ? 'selected' : ''}} value="Middle">Middle</option>
                                                                            <option {{$array['severity'] == 'Low' ? 'selected' : ''}} value="Low">Low</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="title-label ml-xl-3">Reaction</label>
                                                                        <input value = "{{$array['reaction']}}" class="form-control seelect_custom" type="text" name="allergi_data[{{$key}}][reaction]" placeholder="Reaction">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="title-label ml-xl-3"></label>
                                                                        <button  class = "btn btn-danger h5" style="margin-top:37px" type="button" id="remove_more_fields">Delete</button>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                        </ul>
                                                        @endforeach
                                                        <button  class="btn btn-success col-2 h5" type="button" id="more_fields">Add</button>

                                                    </div>
                                                    <hr />
                                                </div>
                                                <hr class="my-4" />
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <img src="{{url('imgs/dissection.png')}}" class="mr-3 mb-3" width="50">
                                                        <label class="title-info">Surgeries</label>
                                                        @foreach($patient->patinets_data->surgery_data as $key => $array_su)
                                                        <ul class="list-unstyled read-more-wrap ml-auto mr-auto field_group1">
                                                            <li>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-4">
                                                                        <label class="title-label">Surgery</label>
                                                                        <select name="surgery_data[{{$key}}][surgery_name]" class="form-control item_surgeries">
                                                                            <option value="" hidden>Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Hernia" ? "selected" : ''}} value="Hernia">Hernia Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Hemorrhoid" ? "selected" : ''}} value="Hemorrhoid">Hemorrhoid Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Eye" ? "selected" : ''}} value="Eye">Eye surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Gallbladder" ? "selected" : ''}} value="Gallbladder">Gallbladder Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Appendix" ? "selected" : ''  }} value="Appendix">Appendix Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Cardiovascular" ? "selected" : ''}} value="Cardiovascular">Cardiovascular Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Tonsil" ? "selected" : ''}} value="Tonsil">Tonsil Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Liver" ? "selected" : ''}} value="Liver">Liver Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Cancer" ? "selected" : ''}} value="Cancer">Cancer and Oncology Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Kidney" ? "selected" : ''}} value="Kidney">Kidney Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Brain" ? "selected" : ''}} value="Brain">Brain Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Gastrointestinal" ? "selected" : ''}} value="Gastrointestinal">Gastrointestinal Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Reproductive" ? "selected" : ''}} value="Reproductive">Reproductive system Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Nervous" ? "selected" : ''}} value="Nervous">Nervous system Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Respiratory" ? "selected" : ''}} value="Respiratory">Respiratory Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Orthopaedic" ? "selected" : ''}} value="Orthopaedic">Orthopaedic Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Ear" ? "selected" : ''}} value="Ear">Ear, nose and throat Surgery</option>
                                                                            <option {{$array_su['surgery_name'] == "Other" ? "selected" : ''}} value="Other">Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <label class="title-label">Date</label>
                                                                        <input value = "{{$array_su['surgery_date']}}" class="form-control seleect_surgeries" type="date" name="surgery_data[{{$key}}][surgery_date]" placeholder="">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="title-label ml-xl-3"></label>
                                                                        <button  class = "btn btn-danger h5" style="margin-top:37px" type="button" id="remove_more_surgeries">Delete</button>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                        </ul>
                                                        @endforeach
                                                        <button class="btn btn-success col-2 h5" type="button" id="more_surgeries">Add</button>
                                                    </div>
                                                    <hr />
                                                </div>
                                                <hr class="my-4" />
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <img src="{{url('imgs/02.png')}}" class="mr-3 mb-3" width="50">
                                                        <label class="title-info">Current Medication</label>
                                                        @foreach($patient->patinets_data->medication_name as $key =>$med)
                                                        <ul class=" list-unstyled read-more-wrap field_group2">
                                                            <li class="">
                                                                <div class="row">
                                                                    <div class="col-md-3 mb-3">
                                                                        <input list="brow" class="form-control item_medication" name="medication_name[{{$key}}][name]" placeholder="Medication" value="{{$med['name']}}">
                                                                        <datalist id="brow">
                                                                            <option hidden>Choose</option>
                                                                            @foreach(\App\models\Medication2::get() as $m)
                                                                                <option value="{{ $m->name }}">{{ $m->name }}</option>
                                                                            @endforeach
                                                                        </datalist>
                                                                    </div>

                                                                    <div class="col-md-3 mb-3">
                                                                        <select name="medication_name[{{$key}}][times_day]" class="col-12 custom-select required seleect_medication" id="inputGroupSelect01" value="{{$med['times_day']}}">
                                                                            <option value="" hidden >Times Day</option>
                                                                            <option value="1" {{$med['times_day'] == '1' ? 'selected' : ''}}>1</option>
                                                                            <option value="2" {{$med['times_day'] == '2' ? 'selected' : ''}}>2</option>
                                                                            <option value="3" {{$med['times_day'] == '3' ? 'selected' : ''}}>3</option>
                                                                            <option value="If necessity" {{$med['times_day'] == 'If necessity' ? 'selected' : ''}}>If necessity</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-3 mb-3">
                                                                        <select name="medication_name[{{$key}}][time]" class="col-12 custom-select required select_medication" id="inputGroupSelect01">
                                                                            <option value="" hidden >Time</option>
                                                                            <option value="Before Eating" {{$med['time'] == 'Before Eating' ? 'selected' : ''}}>Before Eating</option>
                                                                            <option value="After Eating" {{$med['time'] == 'After Eating' ? 'selected' : ''}}>After Eating</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="title-label ml-xl-3"></label>
                                                                        <button  class = "btn btn-danger h5" type="button" id="remove_more_medication">Delete</button>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                        </ul>
                                                        @endforeach
                                                        <button class="btn btn-success col-2 h5" type="button" id="more_medication">Add</button>

                                                    </div>
                                                    <hr />
                                                </div>
                                                <div class="row col-md-12 mt-lg-3 mb-2">
                                                    <div class="col-lg-12">
                                                        <img src="{{url('imgs/prescription.svg')}}" class="mr-3 mb-3" width="50">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="col-lg-12 title-info mb-auto">Adding Prescription</label>
                                                            <input type="file" name="rocata_file[]" id="file" class="input-file @error('medication_name') is-invalid @enderror" multiple>
                                                            <label for="file" class="btn btn-tertiary js-labelFile">
                                                              <i class="icon fa fa-check"></i>
                                                              <span class="js-fileName">Choose a File</span>
                                                            </label>
                                                            @error('rocata_file')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="col-lg-12 title-info mb-auto">Adding Rays</label>
                                                            <input type="file" name="rays_file[]" id="fileE" class="input-file @error('rays_file') is-invalid @enderror" multiple>
                                                            <label for="fileE" class="btn btn-tertiary js-labelFile">
                                                              <i class="icon fa fa-check"></i>
                                                              <span class="js-fileName">Choose a File</span>
                                                            </label>
                                                            @error('rays_file')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="col-lg-12 title-info mb-auto">Adding Test</label>
                                                            <input type="file" name="analzes_file[]" id="fileS" class="input-file @error('analzes_file') is-invalid @enderror" multiple>
                                                            <label for="fileS" class="btn btn-tertiary js-labelFile">
                                                              <i class="icon fa fa-check"></i>
                                                              <span class="js-fileName">Choose a File</span>
                                                            </label>
                                                            @error('analzes_file')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                          </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-5">
                                                    <img src="{{url('imgs/055.png')}}" class="mr-3 mb-3" width="50">
                                                    <label class="title-info">Preventative Screening</label>
                                                    <div class="">
                                                        <div id="myRadioGroup">
                                                            <div class="row">
                                                                <label class="col-5 ml-4 mb-3 title-label">Have you had a colonscopy</label>
                                                                <div class="col-3">
                                                                    <input class="ui radio checkbox" type="radio" name="colonscopy" {{$patient->patinets_data->colonscopy == 1 ? 'checked' : ''}} value="1" />&nbsp; <label class="font-weight-600">Yes</label> &nbsp;&nbsp;
                                                                    <input class="ui radio checkbox" type="radio" name="colonscopy" value="2" {{$patient->patinets_data->colonscopy == 2 ? 'checked' : ''}} /> &nbsp; <label class="font-weight-600">No</label>
                                                                </div>
                                                                <div id="types1" class="desc col-8 ml-3 mb-3" style="display: none;">
                                                                    <input class="form-control" type="date" name="colonscopy_data" value="{{$patient->patinets_data->colonscopy_data}}">
                                                                </div>
                                                                <div id="types2" class="desc" style="display: none;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div id="myRadioGroup">
                                                            <div class="row">
                                                                <label class="h5 col-5 ml-4 mb-3 title-label">Have you had a Mammogram</label>
                                                                <div class="col-3">
                                                                    <input class="ui radio checkbox" type="radio" name="mammogram" {{$patient->patinets_data->mammogram == 3 ? 'checked' : ''}} value="3" />&nbsp; <label class="font-weight-600">Yes</label> &nbsp;&nbsp;
                                                                    <input class="ui radio checkbox" type="radio" name="mammogram" {{$patient->patinets_data->mammogram == 4 ? 'checked' : ''}} value="4" />&nbsp;&nbsp; <label class="font-weight-600">No</label>
                                                                </div>
                                                                <div id="type3" class="des col-8 ml-3 mb-3" style="display: none;">
                                                                    <input class="form-control" type="date" name="mammogram_data">
                                                                </div>
                                                                <div id="type4" class="des" style="display: none;"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 mt-5 mb-5" />
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <img src="{{url('imgs/06.png')}}" class="mr-3 mb-3" width="50">
                                                        <label class="title-info">Unhealthy Habits</label>
                                                        @foreach($patient->patinets_data->smoking as $key =>$smoking_array)
                                                            <ul class="list-unstyled read-more-wrap field_groupUn">
                                                                <li class="">
                                                                    <div class="row">
                                                                        <div class="col-md-5 mb-3">
                                                                            <label class="title-label">Unhealthy Habits</label>
                                                                            <select name="smoking[{{ $key }}][name]" class="item_smoking form-control">
                                                                                <option value="" hidden>Name</option>
                                                                                <option {{$smoking_array['name'] == "alcohol" ? "selected" : ''}} value="alcohol">Alcohol</option>
                                                                                <option {{$smoking_array['name'] == "cigarette" ? "selected" : ''}} value="cigarette">Cigarette</option>
                                                                                <option {{$smoking_array['name'] == "drug" ? "selected" : ''}} value="drug">Drug</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-4 mb-3">
                                                                            <label class="title-label">Severity</label>
                                                                            <select name="smoking[{{ $key }}][severity]" class="item_smoking_severity form-control">
                                                                                <option value="" hidden>Severity</option>
                                                                                <option {{$smoking_array['severity'] == "high" ? "selected" : ''}} value="high">High</option>
                                                                                <option {{$smoking_array['severity'] == "middle" ? "selected" : ''}} value="middle">Middle</option>
                                                                                <option {{$smoking_array['severity'] == "low" ? "selected" : ''}} value="low">Low</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <label class="title-label ml-xl-3"></label>
                                                                            <button style="margin-top:37px" class = "btn btn-danger h5" type="button" id="remove_more_smoking">Delete</button>
                                                                        </div>

                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        @endforeach
                                                        <button class="btn btn-success col-2 h5" type="button" id="more_smoking">Add</button>
                                                    </div>
                                                    <hr />
                                                </div>
                                                <div class="col-12 mt-5">
                                                    <!-- Family History -->
                                                    <h3 class="title-sub text-uppercase text-muted mb-4">Family History</h3>
                                                    <div class="pl-lg-4">
                                                        <h4 class="text-primary ml-5 mt-3 mb-5 font-weight-bold">Family Diseases</h4>
                                                        <div class="col-12">
                                                            <div class="nav flex-row family-one nav-pills row ml-auto mr-auto decor-none" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                                                                <a class="col-xl-3 col-md-2 col-4 nav-item nav-links active" id="v-pills-5-tab" data-toggle="pill" href="#v-pills-5" role="tab" aria-controls="v-pills-5" aria-selected="true">
                                                                    <div class="text-center">
                                                                        <img src="{{url('imgs/mother.png')}}" width="100">
                                                                        <h4 class="text-pills m-auto" style="font-size:12pt;padding-top:15px;">Mother</h4>
                                                                    </div>
                                                                </a>
                                                                <a class="col-xl-3 col-md-2 col-4 nav-item nav-links" id="v-pills-6-tab" data-toggle="pill" href="#v-pills-6" role="tab" aria-controls="v-pills-6" aria-selected="true">
                                                                    <div class="text-center">
                                                                        <img src="{{url('imgs/father.png')}}" width="100">
                                                                        <h4 class="text-pills m-auto" style="font-size: 12pt;padding-top:15px;">Father</h4>
                                                                    </div>
                                                                </a>

                                                            </div>
                                                            <div class="col-md-12 p-4 align-items-center js-fullheight animated">
                                                                <div class="tab-content tab-family-1 mr-auto ml-auto" id="v-pills-tabContent">
                                                                    <div class="tab-pane animated bounce slow py-0 show active" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-5-tab">
                                                                        <div class="row mb-5 mt-3 ">
                                                                            <div class="col-xl-9 mb-3 mr-auto ml-auto">
                                                                                <div class="ui form col-12">

                                                                                    <div class="inline field">
                                                                                        <label class="h6 font-weight-bold" style="font-size: 14pt; margin-bottom:20px;">Mother Diseases</label>
                                                                                        <select name="mother[]" multiple="multiple" class="label ui large selection fluid dropdown">
                                                                                            <option value="">Choose Diseases </option>
                                                                                            <option value="high-Blood-Pressure">High Blood Pressure</option>
                                                                                            <option value="diabetes">Diabetes</option>
                                                                                            <option value="cancer">Cancer (Past or Present)</option>
                                                                                            <option value="None">None</option>
                                                                                            @if($patient->patinets_data->mother)
                                                                                            @foreach($patient->patinets_data->mother as $mother)
                                                                                            <option value="{{$mother}}" selected>
                                                                                                {{$mother}}
                                                                                            </option>
                                                                                            @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            {{-- <div class="col-xl-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                <div class="ui input col-12">
                                                                                    <input name="other_mother" type="text" placeholder="Other Diseases">
                                                                                </div>
                                                                            </div> --}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane animated bounce slow py-0 show" id="v-pills-6" role="tabpanel" aria-labelledby="v-pills-6-tab">
                                                                        <div class="row mb-5 mt-3">
                                                                            <div class="col-xl-9 mb-3 mr-auto ml-auto">
                                                                                <div class="ui form col-12">
                                                                                    <div class="inline field">
                                                                                        <label class="h6 font-weight-bold" style="font-size: 14pt; margin-bottom:20px;">Father Diseases</label>
                                                                                        <select name="father[]" multiple="multiple" class="label ui large selection fluid dropdown">
                                                                                            <option value="">Choose Diseases</option>
                                                                                            <option value="high-Blood-Pressure">High Blood Pressure</option>
                                                                                            <option value="diabetes">Diabetes</option>
                                                                                            <option value="cancer">Cancer (Past or Present)</option>
                                                                                            <option value="None">None</option>
                                                                                            @if($patient->patinets_data->father)
                                                                                                @foreach($patient->patinets_data->father as $father)
                                                                                                <option value="{{$father}}" selected>
                                                                                                    {{$father}}
                                                                                                </option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            {{-- <div class="col-xl-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                <div class="ui input col-12">
                                                                                    <input name="other_father" type="text" placeholder="Other Diseases">
                                                                                </div>
                                                                            </div> --}}
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <!-- female -->
                                                    @if(auth()->guard('patien')->user()->gender == 'female' && auth()->guard('patien')->user()->state == 'single')
                                                        <h4 class="text-pink ml-5 mt-3 mb-4 font-weight-bold">Female Single</h4>
                                                        <div class="row tab-Female col-10 mr-auto ml-auto mb-3 mt-3">
                                                            <div class="p-3 col-xl-9 mb-2 mt-3 mr-auto ml-auto">
                                                                <label class="mr-7 col-6 title-label">Have you a Normal Period Cycle </label>
                                                                <input class="ui radio checkbox col-1" type="radio" name="single_Period_Cycle" value="Yes" /><label class="font-weight-600">Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input class="ui radio checkbox col-1 ml-4" type="radio" name="single_Period_Cycle" value="No" /> <label class="font-weight-600">No</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(auth()->guard('patien')->user()->gender == 'female' && auth()->guard('patien')->user()->state == 'married' || auth()->guard('patien')->user()->state == 'divorce')
                                                        <div class="col-12 ml-auto mr-auto">
                                                            <div class="nav flex-row nav-pills female row offset-xl-1 col-12" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                                                                <a class="col-md-4 p-2 mr-1 active" id="v-pills-01-tab" data-toggle="pill" href="#v-pills-01" role="tab" aria-controls="v-pills-01" aria-selected="true">
                                                                    <div class="text-center">
                                                                        <div><img src="{{url('imgs/mother.png')}}" width="120"></div>
                                                                        <div>
                                                                            <h4 class="text-pills mt-3">Wife</h4>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a class="col-md-4 p-2 mr-1" id="v-pills-02-tab" data-toggle="pill" href="#v-pills-02" role="tab" aria-controls="v-pills-02" aria-selected="true">
                                                                    <div class="text-center">
                                                                        <div><img src="{{url('imgs/femalmother.png')}}" width="120"></div>
                                                                        <div>
                                                                            <h4 class="text-pills mt-3">Mother</h4>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="col-md-12 p-4 align-items-center js-fullheight animated">
                                                                <div class="tab-content mr-auto ml-auto" id="v-pills-tabContent">
                                                                    <div class="tab-pane animated bounce slow py-0 show active" id="v-pills-01" role="tabpanel" aria-labelledby="v-pills-01-tab">
                                                                        <h5 class="text-pink ml-5 mt-3">Female Wife</h5>
                                                                        <div class="row mb-3 mt-3">
                                                                            <div class="col-xl-9 mb-3 mr-auto ml-auto">
                                                                                <label class="mr-7 col-6 title-label">Have you a Normal Period Cycle </label>
                                                                                <input class="ui radio checkbox col-1" type="radio" name="wife_Period_Cycle" {{$patient->patinets_data->wife_Period_Cycle == 'Yes' ? 'checked' : ''}} value="Yes" /><label class="font-weight-600">Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <input class="ui radio checkbox col-1 ml-4" type="radio" name="wife_Period_Cycle" {{$patient->patinets_data->wife_Period_Cycle == 'No' ? 'checked' : ''}} value="No" /> <label class="font-weight-600">No</label>
                                                                            </div>
                                                                            <div class="col-xl-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                <label class="mr-7 col-6 title-label">Abotion</label>
                                                                                <input class="ui radio checkbox col-1" type="radio" name="wife_Abotion" {{$patient->patinets_data->wife_Abotion == 'yes' ? 'checked' : ''}} value="yes" /><label class="font-weight-600">Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <input class="ui radio checkbox col-1 ml-4" type="radio" name="wife_Abotion" {{$patient->patinets_data->wife_Abotion == 'no' ? 'checked' : ''}} value="no" /><label class="font-weight-600">No</label>
                                                                            </div>
                                                                            <div class="col-xl-9 col-md-4 mb-3 mr-auto ml-auto ">
                                                                                <label class="title-label col-6">Contraceptive</label>
                                                                                <select name="wife_Contraceptive" class="ui selection dropdown col-4">
                                                                                    <option hidden value="">Severity</option>
                                                                                    <option {{$patient->patinets_data->wife_Contraceptive == 'Pill' ? 'selected' : ''}} value="Pill">Pill</option>
                                                                                    <option {{$patient->patinets_data->wife_Contraceptive == 'Implant' ? 'selected' : ''}} value="Implant">Implant</option>
                                                                                    <option {{$patient->patinets_data->wife_Contraceptive == 'Intrauterine' ? 'selected' : ''}} value="Intrauterine">Intrauterine Device</option>
                                                                                    <option {{$patient->patinets_data->wife_Contraceptive == 'Injection' ? 'selected' : ''}} value="Injection">Injection</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- female mother -->
                                                                    <div class="tab-pane animated bounce slow py-0 show" id="v-pills-02" role="tabpanel" aria-labelledby="v-pills-02-tab">
                                                                        <h5 class="text-pink ml-5 mt-3">Female Mother</h5>
                                                                        <div class="row mb-3 mt-3">
                                                                            <div class="col-xl-9 mb-3 mr-auto ml-auto">
                                                                                <label class="mr-7 col-6 title-label">Have you a Normal Period Cycle </label>
                                                                                <input class="ui radio checkbox col-1" type="radio" name="mother_Period_Cycle" {{$patient->patinets_data->mother_Period_Cycle == 'yes' ? 'checked' : ''}} value="yes" /><label class="font-weight-600">Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <input class="ui radio checkbox col-1 ml-4" type="radio" name="mother_Period_Cycle" {{$patient->patinets_data->mother_Period_Cycle == 'no' ? 'checked' : ''}} value="no" /> <label class="font-weight-600">No</label>
                                                                            </div>
                                                                            <div class="col-xl-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                <label class="mr-7 col-6 title-label">Pregnency</label>
                                                                                <input class="ui radio checkbox col-1" type="radio" name="mother_pregnency" {{$patient->patinets_data->mother_pregnency == 'yes' ? 'checked' : ''}} value="yes" /><label class="font-weight-600">Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <input class="ui radio checkbox col-1 ml-4" type="radio" name="mother_pregnency" {{$patient->patinets_data->mother_pregnency == 'no' ? 'checked' : ''}} value="no" /><label class="font-weight-600">No</label>
                                                                            </div>
                                                                            <div class="col-xl-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                <label class="mr-7 col-6 title-label">Abotion</label>
                                                                                <input class="ui radio checkbox col-1" type="radio" name="mother_abotion" {{$patient->patinets_data->mother_abotion == 'yes' ? 'checked' : ''}} value="yes" /><label class="font-weight-600">Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <input class="ui radio checkbox col-1 ml-4" type="radio" name="mother_abotion" {{$patient->patinets_data->mother_abotion == 'no' ? 'checked' : ''}} value="no" /><label class="font-weight-600">No</label>
                                                                            </div>
                                                                            <div class="col-xl-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                <label class="mr-7 col-6 title-label">Types of Deliveries </label>
                                                                                <input class="ui radio checkbox col-1" type="radio" name="mother_deliveries" {{$patient->patinets_data->mother_deliveries == 'normal' ? 'checked' : ''}} value="normal" /><label class="font-weight-600">Normal</label>
                                                                                <input class="ui radio checkbox col-1 ml-3" type="radio" name="mother_deliveries" {{$patient->patinets_data->mother_deliveries == 'c.s' ? 'checked' : ''}} value="c.s" /><label class="font-weight-600">C.S</label>
                                                                            </div>
                                                                            <div class="col-xl-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                <label class="mr-7 col-6 title-label">Complicetion in Deliveries </label>
                                                                                <input class="ui radio checkbox col-1" type="radio" name="mother_complicetion" {{$patient->patinets_data->mother_complicetion == 'yes' ? 'checked' : ''}} value="yes" /><label class="font-weight-600">Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <input class="ui radio checkbox col-1 ml-4" type="radio" name="mother_complicetion" {{$patient->patinets_data->mother_complicetion == 'no' ? 'checked' : ''}} value="no" /><label class="font-weight-600">No</label>
                                                                            </div>
                                                                            <div class="col-xl-9 col-md-4 mb-3 mr-auto ml-auto ">
                                                                                <label class="title-label col-6">Contraceptive</label>
                                                                                <select name="mother_Contraceptive" class="ui selection dropdown col-4">
                                                                                    <option hidden> Severity</option>
                                                                                    <option {{$patient->patinets_data->mother_Contraceptive == 'Pill' ? 'selected' : ''}} value="Pill">Pill</option>
                                                                                    <option {{$patient->patinets_data->mother_Contraceptive == 'Implant' ? 'selected' : ''}} value="Implant">Implant</option>
                                                                                    <option {{$patient->patinets_data->mother_Contraceptive == 'Intrauterine' ? 'selected' : ''}} value="Intrauterine">Intrauterine Device</option>
                                                                                    <option {{$patient->patinets_data->mother_Contraceptive == 'Injection' ? 'selected' : ''}} value="Injection">Injection</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- female -->
                                                            @endif
                                                        </div>
                                                        <div class="col-12 text-center mb-3 mt-5">
                                                            <input type="submit" value="Update profile" class="col-8 btn btn-success">
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- main content -->
                    </div>
                </form>
                <!-- footer -->
                @include('backEnd.layoutes.footer')
                <!-- footer -->
                <script
                    src="https://code.jquery.com/jquery-3.5.1.min.js"
                    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
                    crossorigin="anonymous"></script>
                <script>
                    $(function(){
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

                        $('#more_smoking').click(function(){
                            var max = 3;
                            var current1 =  $(".field_groupUn").length;
                            if (current1 < max) {
                            $('.field_groupUn:first').clone(true).hide().insertAfter('.field_groupUn:last').slideDown('slow');
                                var last = $('.field_groupUn:last');
                                var current =  $(".field_groupUn").length - 1;
                                //last.append(new_button.clone(true));
                                last.find('select').val([]);
                                last.find('select.item_smoking').attr("name", "smoking[" + current + "][name]");
                                last.find('select.item_smoking_severity').attr("name", "smoking[" + current + "][severity]");
                                current1++;
                                return false;
                            }  });
                            $("body").on("click", "#remove_more_smoking", function () {
                                var current =  $(".field_groupUn").length;
                                if(current == 1){
                                   e.prevent();
                                }
                                $(this).closest(".field_groupUn").remove();
                            });
                </script>
                <script>
                    (function() {
                        'use strict';
                        $('.input-file').each(function() {
                          var $input = $(this),
                              $label = $input.next('.js-labelFile'),
                              labelVal = $label.html();

                         $input.on('change', function(element) {
                            var fileName = '';
                            if (element.target.value) fileName = element.target.value.split('\\').pop();
                            fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
                         });
                        });

                      })();
                </script>
            </div>
        </div>
    </div>

@stop


