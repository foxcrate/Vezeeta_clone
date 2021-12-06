@extends('backEnd.layoutes.mastar')
@section('title','edit profile ' . $child->child_name)
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
                <form action="{{route('patient.child.updaeProfile',[$patient->id,$child->id])}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                    <div class="col-lg-10 ml-auto mr-auto kidsClass">
                        <div class="row">
                            <div class="col-lg-6 mt-auto mb-auto">
                                <h4 class="text-primary ml-5 font-weight-bold ">Edit Child</h4>
                            </div>

                            <div class="col-lg-6">
                                <div class="avatar-wrapper">
                                    <img class="profile-pic" src="" />
                                    <div class="upload-button">
                                        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                    </div>
                                    <input id="compress_image" name = "image" class="file-upload @error('image') is-invalid @enderror" type="file" accept="image/*">
                                </div>
                                <label class="col-12 text-center text-dark" style="margin-top:-50px"><i class="fa fa-camera mr-2"></i>Edit Child pictrue</label>
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label  class="h5 font-weight-bold mt-3 text-primary font-weight-bolder">Child Name</label>
                                <div class="input-group mb-3">
                                    <input onkeypress="return /[a-z]/i.test(event.key)" type="text" class="form-control select_custom @error('child_name') is-invalid @enderror"  placeholder="Child Name" name="child_name" value="{{$child->child_name}}">
                                    @error('child_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="birth" class="h5 font-weight-bold mt-3 text-primary">Birth Date</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control item_type @error('birthDay') is-invalid @enderror" name="birthDay" value="{{ date('d/m/Y',$child->birthDay) }}">
                                    @error('birthDay')
                                        <div class="alert alert-danger">{{ $message }}</div>
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
                                    <input {{$child->gender == 'boy' ? 'checked' : ''}} id="boy" type="radio" name="gender" value="boy"/>
                                    <label class="drinkcard-cc boy" for="boy"></label>
                                    <input {{$child->gender == 'girl' ? 'checked' : ''}} id="girl" type="radio" name="gender" value="girl" />
                                    <label class="drinkcard-cc girl" for="girl"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <img src="{{url('imgs/height.png')}}" class="mr-3 mb-3" width="50">
                                            <label class="title-label ml-lg-3">Height</label>
                                            <input minlength="2" maxlength="3" class="form-control" type="number" name="height" placeholder="Height" value="{{$child->height}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <img src="{{url('imgs/Wight.png')}}" class="mr-3 mb-3" width="50">
                                            <label class="title-label">Weight</label>
                                            <input value = "{{$child->weight}}" minlength="2" maxlength="3" name="weight" type="number" class="form-control" placeholder="Weigth" />
                                                <select style="position:relative; bottom:38px; width:30%; left:170px;" name="weight_type" id="" class="form-control">
                                                    <optgroup>
                                                        <option {{$child->weight_type == 'kg' ? 'selected' : ''}} value="Kg">KG</option>
                                                        <option {{$child->weight_type == 'lbs' ? 'selected' : ''}} value="lbs">Lbs</option>
                                                        <option {{$child->weight_type == 'St' ? 'selected' : ''}} value="St">St</option>
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
                                                    <option hidden >Blood</option>
                                                    <option {{$child->blood == 'A+' ? 'selected' : ''}} value="A+">A+</option>
                                                    <option {{$child->blood == 'A-' ? 'selected' : ''}} value="A-">A-</option>
                                                    <option {{$child->blood == 'B+' ? 'selected' : ''}} value="B+">B+</option>
                                                    <option {{$child->blood == 'B-' ? 'selected' : ''}} value="B-">B-</option>
                                                    <option {{$child->blood == 'o+' ? 'selected' : ''}} value="o+">O+</option>
                                                    <option {{$child->blood == 'o-' ? 'selected' : ''}}value="o-">O-</option>
                                                    <option {{$child->blood == 'AB+' ? 'selected' : ''}} value="AB+">AB+</option>
                                                    <option {{$child->blood == 'AB-' ? 'selected' : ''}} value="AB-">AB-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="title-info">Check any Conditions you Currently Being Treated for or have had in the past: </label>
                                <div class="form-flex">
                                    <div class="form-group row">
                                        @php
                                            $diseases = json_decode($child->disease);
                                        @endphp
                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" value="Heart disease" {{is_array($diseases) && in_array('Heart disease',$diseases) ? 'checked' : ''}}>
                                                    <label class="h4">Heart disease</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input  name="disease[]" type="checkbox" tabindex="0" class="hidden" value="High blood pressure" {{is_array($diseases) && in_array('High blood pressure',$diseases) ? 'checked' : ''}}>
                                                    <label class="label-input">High blood pressure </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input  name="disease[]" type="checkbox" tabindex="0" class="hidden" value="High cholesterol" {{is_array($diseases) && in_array('High cholesterol',$diseases) ? 'checked' : ''}}>
                                                    <label class="label-input">High cholesterol </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Lung disease',$diseases) ? 'checked' : ''}} value="Lung disease">
                                                    <label class="label-input">Lung disease</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Diabetes',$diseases) ? 'checked' : ''}} value="Diabetes">
                                                    <label class="label-input"> Diabetes</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Neck pain',$diseases) ? 'checked' : ''}} value="Neck pain">
                                                    <label class="label-input">Neck pain</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Severe headaches',$diseases) ? 'checked' : ''}} value="Severe headaches">
                                                    <label class="label-input">Severe headaches </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Back pain',$diseases) ? 'checked' : ''}} value="Back pain">
                                                    <label class="label-input">Back pain</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Seizures',$diseases) ? 'checked' : ''}} value="Seizures ">
                                                    <label class="label-input">Seizures </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Thyroid disease',$diseases) ? 'checked' : ''}}  value="Thyroid disease">
                                                    <label class="label-input">Thyroid disease </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Stroke Sleep apnea',$diseases) ? 'checked' : ''}} value="Stroke Sleep apnea">
                                                    <label class="label-input">Stroke Sleep apnea </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Stomach disease',$diseases) ? 'checked' : ''}} value="Stomach disease">
                                                    <label class="label-input">Stomach disease </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Kidney , bladder or prostate disease',$diseases) ? 'checked' : ''}} value="Kidney , bladder or prostate disease">
                                                    <label class="label-input">Kidney , bladder or prostate disease </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Blood clots',$diseases) ? 'checked' : ''}} value="Blood clots">
                                                    <label class="label-input">Blood clots </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Depression',$diseases) ? 'checked' : ''}} value="Depression">
                                                    <label class="label-input">Depression </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->

                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Anemia or other blood disease',$diseases) ? 'checked' : ''}} value="Anemia or other blood disease">
                                                    <label class="label-input">Anemia or other blood disease</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->
                                        <!-- col -->
                                        <div class="col-sm-3">
                                            <div class="field">
                                                <div class="ui checkbox">
                                                    <input name="disease[]" type="checkbox" tabindex="0" class="hidden" {{is_array($diseases) && in_array('Cancer ( past or present )',$diseases) ? 'checked' : ''}} value="Cancer ( past or present )">
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
                                <label class="title-info">Allergies (incloud medication, food and environmental allergies)</label>
                                <ul class="list-unstyled read-more-wrap">
                                    <li>
                                        <div class="row mb-3">
                                            @foreach($child->allergy as $key => $allergy)
                                                <div class="col-md-4">
                                                    <label class="title-label ml-xl-3">Allergy</label>
                                                    <select name="allergy[{{$key}}][allergi_name]" class="form-control">
                                                        <option value="" hidden>Allergy</option>
                                                        <option {{$allergy['allergi_name'] == "Drug" ? "selected" : ''}}   value="Drug">Drug allergy</option>
                                                        <option {{$allergy['allergi_name'] == "Food" ? "selected" : ''}} value="Food">Food allergy</option>
                                                        <option {{$allergy['allergi_name'] == "Pet" ? "selected" : '' }} value="Pet">Pet allergy</option>
                                                        <option {{$allergy['allergi_name'] == "Insect" ? "selected" : '' }} value="Insect">Insect allergy</option>
                                                        <option {{$allergy['allergi_name'] == "Latex" ? "selected" : '' }} value="Latex">Latex allergy</option>
                                                        <option {{$allergy['allergi_name'] == "Mold" ? "selected" : '' }} value="Mold">Mold allergy</option>
                                                        <option {{$allergy['allergi_name'] == "Pollen" ? "selected" : ''}} value="Pollen">Pollen allergy</option>
                                                        <option {{$allergy['allergi_name'] == "Dust" ? "selected" : '' }} value="Dust">Dust allergy</option>
                                                        <option {{$allergy['allergi_name'] == "Other" ? "selected" : '' }} value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="title-label d-block">Severity</label>
                                                    <select name="allergy[{{$key}}][severity]" class="form-control">
                                                        <option value="" hidden>Severity</option>
                                                        <option {{$allergy['severity'] == 'Mild' ? 'selected' : ''}} value="Mild">Mild</option>
                                                        <option {{$allergy['severity'] == 'Moderate' ? 'selected' : ''}} value="Moderate">Moderate</option>
                                                        <option {{$allergy['severity'] == 'Severe' ? 'selected' : ''}} value="Severe">Severe</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="title-label ml-xl-3">Reaction</label>
                                                    <input onkeypress="return /[a-z]/i.test(event.key)" value = "{{$allergy['reaction']}}" class="form-control" type="text" name="allergy[{{$key}}][reaction]" placeholder="Reaction">
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <hr />
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="title-info">Surgeries</label>
                                <ul class="list-unstyled read-more-wrap ml-auto mr-auto">
                                    <li>

                                        <div class="row mb-3">
                                            @foreach($child->Surgeries as $key => $Surgeries)
                                            <div class="col-md-5">
                                                <label class="title-label">Surgery</label>
                                                <select name="Surgeries[{{$key}}][surgery_name]" class="form-control">
                                                    <option value="" hidden>Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Hernia" ? "selected" : ''}} value="Hernia">Hernia Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Hemorrhoid" ? "selected" : ''}} value="Hemorrhoid">Hemorrhoid Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Eye" ? "selected" : ''}} value="Eye">Eye surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Gallbladder" ? "selected" : ''}} value="Gallbladder">Gallbladder Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Appendix" ? "selected" : ''  }} value="Appendix">Appendix Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Cardiovascular" ? "selected" : ''}} value="Cardiovascular">Cardiovascular Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Tonsil" ? "selected" : ''}} value="Tonsil">Tonsil Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Liver" ? "selected" : ''}} value="Liver">Liver Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Cancer" ? "selected" : ''}} value="Cancer">Cancer and Oncology Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Kidney" ? "selected" : ''}} value="Kidney">Kidney Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Brain" ? "selected" : ''}} value="Brain">Brain Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Gastrointestinal" ? "selected" : ''}} value="Gastrointestinal">Gastrointestinal Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Reproductive" ? "selected" : ''}} value="Reproductive">Reproductive system Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Nervous" ? "selected" : ''}} value="Nervous">Nervous system Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Respiratory" ? "selected" : ''}} value="Respiratory">Respiratory Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Orthopaedic" ? "selected" : ''}} value="Orthopaedic">Orthopaedic Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Ear" ? "selected" : ''}} value="Ear">Ear, nose and throat Surgery</option>
                                                    <option {{$Surgeries['surgery_name'] == "Other" ? "selected" : ''}} value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="title-label">Date</label>
                                                <input value = "{{$Surgeries['surgery_date']}}" class="form-control" type="date" name="Surgeries[{{$key}}][surgery_date]" placeholder="">
                                            </div>
                                            @endforeach
                                        </div>


                                    </li>
                                </ul>
                            </div>
                            <hr />
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="title-info">Current Medication</label>
                                <ul class=" list-unstyled read-more-wrap">
                                    <li class="">

                                        <div class="row">
                                            @foreach($child->medication as $key =>$med)
                                            <div class="col-md-4 mb-3">
                                                <input class="form-control" type="text" name="medication[{{$key}}][medication_name]" placeholder="Medication" value="{{$med['medication_name']}}">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <select name="medication[{{$key}}][times_day]" class="col-8 custom-select required" id="inputGroupSelect01" value="{{$med['times_day']}}">
                                                    <option value="" hidden >Times Day</option>
                                                    <option value="1" {{$med['times_day'] == '1' ? 'selected' : ''}}>1</option>
                                                    <option value="2" {{$med['times_day'] == '2' ? 'selected' : ''}}>2</option>
                                                    <option value="3" {{$med['times_day'] == '3' ? 'selected' : ''}}>3</option>
                                                    <option value="If necessity" {{$med['times_day'] == 'If necessity' ? 'selected' : ''}}>If necessity</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <select name="medication[{{$key}}][time]" class="col-8 custom-select required" id="inputGroupSelect01">
                                                    <option value="" hidden >Time</option>
                                                    <option value="Before Eating" {{$med['time'] == 'Before Eating' ? 'selected' : ''}}>Before Eating</option>
                                                    <option value="After Eating" {{$med['time'] == 'After Eating' ? 'selected' : ''}}>After Eating</option>
                                                </select>
                                            </div>
                                            @endforeach
                                        </div>


                                    </li>
                                </ul>
                            </div>
                            <hr />
                        </div>
                        <h4 class="text-primary ml-5 mt-3 mb-4 font-weight-bold">Mother Diseases</h4>
                        <div class="row tab-kids col-12 mr-auto ml-auto mb-2 mt-2">
                            <div class="p-3 col-lg-12 mr-auto ml-auto">
                                <div class="col-lg-9 mb-3 mr-auto ml-auto">
                                    <div class="ui form col-12">
                                        <div class="inline field">
                                            <select name="motherdisease[]" multiple="multiple" class="label ui large selection fluid dropdown" placeholder="hffhb">
                                                <option hidden >Choose</option>
                                                <option value="high-Blood-Pressure">High Blood Pressure</option>
                                                <option value="diabetes">Diabetes</option>
                                                <option value="cancer">Cancer (Past or Present)</option>
                                                @if(json_decode($child->motherdisease))
                                                    @foreach (json_decode($child->motherdisease) as $mother )
                                                        <option value="{{$mother}}" selected>
                                                            {{$mother}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="text-primary ml-5 mt-3 mb-4 font-weight-bold">Father Diseases</h4>
                        <div class="row tab-kids col-12 mr-auto ml-auto mb-3 mt-3">
                            <div class="p-3 col-lg-12 mr-auto ml-auto">
                                <div class="col-lg-9 mb-3 mr-auto ml-auto">
                                    <div class="ui form col-12">
                                        <div class="inline field">
                                            <select name="fatherdisease[]" multiple="multiple" class="label ui large selection fluid dropdown">
                                                <option hidden >Choose</option>
                                                <option value="high-Blood-Pressure">High Blood Pressure</option>
                                                <option value="diabetes">Diabetes</option>
                                                <option value="cancer">Cancer (Past or Present)</option>
                                                @if(json_decode($child->fatherdisease))
                                                    @foreach (json_decode($child->fatherdisease) as $father )
                                                        <option value="{{$father}}" selected>
                                                            {{$father}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-4 mt-4">
                        <input type="submit" value="Update" class="btn btn-success col-lg-6">
                    </div>

                </form>
            </div>
        </div>
        <!-- footer -->
        @include('backEnd.layoutes.footer')
        <!-- footer -->
    </div>
</div>


@endsection
