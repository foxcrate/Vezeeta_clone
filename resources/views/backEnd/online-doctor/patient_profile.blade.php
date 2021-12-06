@extends('backEnd.layoutes.mastar')
@section('title',$patient->firstName . ' ' . $patient->middleName)
@section('css')
    {{--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />@stop
@section('content')
    @include('backEnd.online-doctor.sidenav')
    <!-- Main content -->
    {{--  @php
      $count = $patient->patinets_data;
    @endphp  --}}
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
                            <h4 class="card-title text-uppercase font-weight-bold text-white mb-2">
                                Dr {{$online_doctor->name}}</h4>
                            <h5 class="card-title text-uppercase text-white mb-0">{{$online_doctor->IdCode}}</h5>
                            <h5 class="card-title text-white mb-0">{{$online_doctor->Primary_Speciality}}</h5>
                            <span class="h4 font-weight-bold mb-0"></span>
                        </div>
                        {{--  <div class="col-6 name-hos">
                            <h4 class="card-title text-uppercase text-white mb-0">{{$hosptail->hosptailName}}</h4>
                            <h5 class="card-title text-uppercase text-white mb-0">{{$hosptail->address}}</h5>
                        </div>  --}}
                    </div>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="header">
                    <div class="container-fluid col-lg-9 col-md-12">
                        <div class="row pt-5">
                            <div class="col-lg-12 ml-auto mr-auto">
                                <div class="pills-main card p-3 card-stats">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="info col-6">
                                                    @if(!$patient->image)
                                                        <img alt="Image placeholder" src="{{ asset('uploads/default.png') }}" width="120" height="120" class="rounded-circle d-block mt-2">
                                                    @else
                                                        <img alt="Image placeholder" src="{{ $patient->image }}" width="120" height="120" class="rounded-circle d-block mt-2">
                                                    @endif
                                                    <a href="{{route("reportPatien",[$online_doctor->id,$patient->id])}}"><h4 class="text-dark card-title text-uppercase mb-3">{{$patient->firstName . ' ' . $patient->lastName}}</h4></a>
                                                    <h5 class="card-title text-uppercase mb-0">{{$patient->idCode}}</h5>
                                                    <h5 class="card-title text-uppercase text-muted mb-0">{{ $patient->age }} Age</h5>
                                                    <span class="h4 font-weight-bold mb-0"></span>
                                                </div>
                                            </div>
                                            <div class="col-6 buttons">
                                                <div class="col-6">
                                                    <button class="btn btn-success h4 mt-sm-2"><a class = "text-white text-decoration" href="{{ route('doctor_getOldPrescription',[$online_doctor->id,$patient->id]) }}">Doctor Prescription </a></button>
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn btn-primary h4 mt-sm-2"><a class = "text-white text-decoration" href="{{ route('doctor_getAllPrescription',[$online_doctor->id,$patient->id]) }}">All Prescription </a></button>
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                                        Edit Patient Profile
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Patient profile</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('doctorUpdatePatientProfile',[$online_doctor->id,$patient->id]) }}" method="POST">
                                                                        {{csrf_field()}}
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
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" value="Heart disease" {{is_array($agrees) && in_array('Heart disease',$agrees) ? 'checked' : ''}}>
                                                                                                    <label class="h4">Heart disease</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input  name="agree_name[]" type="checkbox" tabindex="0" class="hidden" value="High blood pressure" {{is_array($agrees) && in_array('High blood pressure',$agrees) ? 'checked' : ''}}>
                                                                                                    <label class="label-input">High blood pressure </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input  name="agree_name[]" type="checkbox" tabindex="0" class="hidden" value="High cholesterol" {{is_array($agrees) && in_array('High cholesterol',$agrees) ? 'checked' : ''}}>
                                                                                                    <label class="label-input">High cholesterol </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Lung disease',$agrees) ? 'checked' : ''}} value="Lung disease">
                                                                                                    <label class="label-input">Lung disease</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Diabetes',$agrees) ? 'checked' : ''}} value="Diabetes">
                                                                                                    <label class="label-input"> Diabetes</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Neck pain',$agrees) ? 'checked' : ''}} value="Neck pain">
                                                                                                    <label class="label-input">Neck pain</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Severe headaches',$agrees) ? 'checked' : ''}} value="Severe headaches">
                                                                                                    <label class="label-input">Severe headaches </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Back pain',$agrees) ? 'checked' : ''}} value="Back pain">
                                                                                                    <label class="label-input">Back pain</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Seizures',$agrees) ? 'checked' : ''}} value="Seizures ">
                                                                                                    <label class="label-input">Seizures </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Thyroid disease',$agrees) ? 'checked' : ''}}  value="Thyroid disease">
                                                                                                    <label class="label-input">Thyroid disease </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Stroke Sleep apnea',$agrees) ? 'checked' : ''}} value="Stroke Sleep apnea">
                                                                                                    <label class="label-input">Stroke Sleep apnea </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Stomach disease',$agrees) ? 'checked' : ''}} value="Stomach disease">
                                                                                                    <label class="label-input">Stomach disease </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Kidney , bladder or prostate disease',$agrees) ? 'checked' : ''}} value="Kidney , bladder or prostate disease">
                                                                                                    <label class="label-input">Kidney , bladder or prostate disease </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Blood clots',$agrees) ? 'checked' : ''}} value="Blood clots">
                                                                                                    <label class="label-input">Blood clots </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Depression',$agrees) ? 'checked' : ''}} value="Depression">
                                                                                                    <label class="label-input">Depression </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->

                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
                                                                                            <div class="field">
                                                                                                <div class="ui checkbox">
                                                                                                    <input name="agree_name[]" type="checkbox" tabindex="0" class="hidden" {{is_array($agrees) && in_array('Anemia or other blood disease',$agrees) ? 'checked' : ''}} value="Anemia or other blood disease">
                                                                                                    <label class="label-input">Anemia or other blood disease</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- col -->
                                                                                        <!-- col -->
                                                                                        <div class="col-sm-4">
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
                                                                        <!-- medication -->
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <img src="{{url('imgs/02.png')}}" class="mr-3 mb-3" width="50">
                                                                                <label class="title-info">Current Medication</label>
                                                                                @foreach($patient->patinets_data->medication_name as $key =>$med)
                                                                                    <ul class=" list-unstyled read-more-wrap field_medication">
                                                                                            <div class="row">
                                                                                                <div class="col-md-3 mb-3">
                                                                                                    <input list="brow" class="form-control input_field_medication" name="medication_name[{{$key}}][name]" placeholder="Medication" value="{{$med['name']}}">
                                                                                                    <datalist id="brow">
                                                                                                        <option hidden>Choose</option>
                                                                                                        @foreach(\App\models\Medication2::get() as $m)
                                                                                                            <option value="{{ $m->name }}">{{ $m->name }}</option>
                                                                                                        @endforeach
                                                                                                    </datalist>
                                                                                                </div>
                                                                                                <div class="col-md-3 mb-3">
                                                                                                    <select name="medication_name[{{$key}}][times_day]" class="col-12 required select_field_medication" id="inputGroupSelect01" value="{{$med['times_day']}}">
                                                                                                        <option value="" hidden >Times Day</option>
                                                                                                        <option value="1" {{$med['times_day'] == '1' ? 'selected' : ''}}>1</option>
                                                                                                        <option value="2" {{$med['times_day'] == '2' ? 'selected' : ''}}>2</option>
                                                                                                        <option value="3" {{$med['times_day'] == '3' ? 'selected' : ''}}>3</option>
                                                                                                        <option value="If necessity" {{$med['times_day'] == 'If necessity' ? 'selected' : ''}}>If necessity</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="col-md-3 mb-3">
                                                                                                    <select name="medication_name[{{$key}}][time]" class="col-12 custom-select required select_field_medication2" id="inputGroupSelect01">
                                                                                                        <option value="" hidden >Time</option>
                                                                                                        <option value="Before Eating" {{$med['time'] == 'Before Eating' ? 'selected' : ''}}>Before Eating</option>
                                                                                                        <option value="After Eating" {{$med['time'] == 'After Eating' ? 'selected' : ''}}>After Eating</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="col-md-3">
                                                                                                    <button  class = "btn btn-danger h5" type="button" id="remove_filed_medication">Delete</button>
                                                                                                </div>

                                                                                            </div>
                                                                                    </ul>
                                                                                @endforeach
                                                                                <button class="btn btn-success col-2 h5" type="button" id="add_filed_medication">Add</button>
                                                                            </div>
                                                                            <hr class="my-4" />
                                                                            <!-- Surgery -->
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <img src="{{url('imgs/dissection.png')}}" class="mr-3 mb-3" width="50">
                                                                                    <label class="title-info">Surgeries</label>
                                                                                    @foreach($patient->patinets_data->surgery_data as $key => $array_su)
                                                                                    <ul class="list-unstyled read-more-wrap ml-auto mr-auto Surgery_field_group">
                                                                                        <li>
                                                                                            <div class="row mb-3">
                                                                                                <div class="col-md-4">
                                                                                                    <label class="title-label">Surgery</label>
                                                                                                    <select name="surgery_data[{{$key}}][surgery_name]" class="form-control SurgeryItemSelect">
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
                                                                                                    <input value = "{{$array_su['surgery_date']}}" class="form-control SurgeryItemInput" type="date" name="surgery_data[{{$key}}][surgery_date]" placeholder="">
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <button  class = "btn btn-danger h5" style="margin-top:37px" type="button" id="remove_more_surgeries">Delete</button>
                                                                                                </div>

                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                    @endforeach
                                                                                    <button class="btn btn-success col-2 h5" type="button" id="more_surgeriesAdd">Add</button>
                                                                                </div>
                                                                                <hr />
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn btn-info h4 "><a href="{{route('reportPatien',[$online_doctor->id,$patient->id])}}" class = "text-white text-decoration">patient Report </a></button>
                                                </div>

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
                <form action="{{route('post_add_prescription_patient',[$online_doctor->id,$patient->id])}}" id="hosptail_add_prescription" method="POST">
                    {{csrf_field()}}
                    {{--  <input type="text" name="hosptail_id" value="{{$hosptail->id}}" style="display: none">  --}}
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                    <input type = "hidden" name = "online_doctor_id" value = "{{$online_doctor->id}}">
                    <div class="container-fluid">
                        <div class="pills-main-green col-md-9 ml-auto mr-auto card mt-5 p-3">
                            <div class="col-md-12 mt-4">
                                <img src="{{url('imgs/prescription.svg')}}" class="col-1 ml-3 mb-3" width="50">
                                <label class="title-label">Medical Report</label>
                                <div class="ui input col-9">
                                    <textarea class="col-lg-12 ml-2 form-control" name="prescription" id="" cols="30" rows="5" placeholder="Doctors Report" style="resize:none"></textarea>
                                    {{-- <input required="required" class="col-lg-12 ml-2" type="text" name="prescription" placeholder="prescription" style="max-width:98.4%;"> --}}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 mt-4">
                                    <img src="{{url('imgs/Temperature.png')}}" class="col-2 ml-3 mb-3" width="50">
                                    <label class="title-label">Temperature</label>
                                    <div class="ui input col-6">
                                        <input required="required" id = "idcrd" onchange="addZeroes(this)" oninput="restrictAlphas(event)" maxlength="4" oninput="restrictAlphasDis(event)" class="ml-3" type="text" name="temperature" placeholder="Temperature">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <img src="{{url('imgs/Diabetics.png')}}" class="col-2 ml-3 mb-3" width="50">
                                    <label class="title-label">Diabetes</label>
                                    <div class="ui input col-6">
                                        <input required="required"  maxlength="3" class="ml-1" type="number" name="diabetics" placeholder="Diabetics">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <img src="{{url('imgs/Blood-Pressure.png')}}" class="col-2 ml-3 mb-3" width="50">
                                    <label class="title-label">Blood Pressure</label>
                                    <div class="ui input col-6">
                                        <input oninput="" maxlength="6" class="" type="text" name="blood_pressure" placeholder="Ex : 120/80" required = "required">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4 widtht">
                                    <img src="{{url('imgs/weghit.png')}}" class="col-2 ml-3 mb-3" width="50">
                                    <label class="title-label" style="margin-right: 130px;">Weight</label>
                                    <select name="width_type" class=" col-1 ui selection dropdown zindex">
                                        <option value="pound">Lbs</option>
                                        <option value="kg">KG</option>
                                        <option value="St">St</option>
                                    </select>
                                    <div class="ui input col-6 margin-select">
                                        <input required="required" name="weight" type="number" class="pl-20" placeholder="Weight" />
                                    </div>
                                </div>
                                <div class="col-md-6 ml-5 mt-4">
                                    <img lass="col-2 ml-3 mb-3" src="{{url('imgs/oxygen.svg')}}" width="30" alt="...">
                                    <label class="title-label">Oxygen</label>
                                    <div class="ui input col-6">
                                        <input style="margin-left:73px !important"placeholder="ex:100" type="number" name="oxygen" class="form-control col-12 @error('oxygen') is-invalid @enderror">
                                        @error('oxygen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4 text-center mt-5">
                                @if($online_doctor->special->name == 'Dentist')
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
                                @if($online_doctor->special->name == 'Ophthalmologist')
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

                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="pills-main-teal col-md-9 ml-auto mr-auto card mt-5 p-3">
                            <label class="row container mb-5 mt-2 h6 font-weight-bold" style="font-size: 20pt; line-height: 5rem;"><img src="{{url('imgs/02.png')}}" class="mr-5" width="70">Medication</label>
                            <div class="form-group mt-5">
                                <div class="row mb-3">
                                    <table class="ml-auto mr-auto table field_group">
                                        <td style="border-top: none;">
                                            <input required list="brow" class="select_custom1 form-control" name="medication[0][name]">
                                            <datalist id="brow">
                                                <option hidden>Choose</option>
                                                @foreach(\App\models\Medication2::get() as $m)
                                                    <option value="{{ $m->name }}">{{ $m->name }}</option>
                                                @endforeach
                                            </datalist>
                                        </td>
                                        <td style="border-top: none;" >
                                            <select required id="medts" name="medication[0][times_day]" class=" item_type col-lg-8 custom-select required" id="inputGroupSelect01">
                                                <option hidden>Times Day</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="If necessity">If necessity</option>
                                            </select>
                                        </td>
                                        <td style="border-top: none;">
                                            <select required id="medt" name="medication[0][time]" class="col-lg-8 custom-select time required" id="inputGroupSelect01">
                                                <option hidden>Time</option>
                                                <option value="Before Eating">Before Eating</option>
                                                <option value="After Eating">After Eating</option>
                                            </select>
                                        </td>
                                        <td style="border-top: none;"><button type="button" class="btn btn-danger" id="remove"><i class="fa fa-times"></i></button></td>
                                    </table>
                                    <div class="form-group col-11 ml-5">
                                        <button id="more_fields" type="button" class="btn btn-success col-2 mt-3 float-right h5" data-toggle="tooltip" data-original-title="Add more controls"><i class="fa fa-plus"></i>&nbsp; Add&nbsp;</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row mb-5">
                            <div class="pills-main-orange card mt-5 p-3 col-lg-9 col-md-5 ml-auto mr-auto">
                                <div class="container ml-auto mr-auto">
                                    <label class="row container mb-5 mt-2 h6 font-weight-bold" style="font-size: 20pt; line-height: 5rem;"><img src="{{url('imgs/x-ray.svg')}}" class="mr-5" width="70">Radiology</label>
                                    <div class="col-md-12">
                                        <div class="row col-12 form-group field_group2">
                                            <div class="col-lg-5 mr-auto ml-auto">
                                                <div class="col-12">
                                                    <div class="inline field">
                                                        <select required name="rayName[0][ray_name]" class="col-12 custom-select select_custom" id="inputGroupSelect01">
                                                            @foreach($analyzes as $ana)
                                                                <option hidden>Choose</option>
                                                                <option value="{{$ana->name}}">{{$ana->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-4 mr-auto ml-auto redolgy">
                                                <div class="ui input col-12">
                                                    <input required name="rayName[0][ray_description]" class="form-control item_type" type="text" placeholder="Prescription">
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
                                    <label class="row container mb-5 mt-2 h6 font-weight-bold" style="font-size: 20pt; line-height: 5rem;"><img src="{{url('imgs/labs.svg')}}" class="mr-5" width="70">Analysis Test</label>
                                    <div class="col-md-12">
                                        <div class="row col-12 form-group field_group1">
                                            <div class="col-lg-5 mr-auto ml-auto">
                                                <div class="col-12">
                                                    <div class="inline field">
                                                        <select required name="testName[0][test_name]" class="col-12 custom-select select_custom" id="inputGroupSelect01">
                                                            @foreach($rays as $ray)
                                                                <option hidden>Choose</option>
                                                                <option value="{{$ray->name}}">{{$ray->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 mr-auto ml-auto">
                                                <div class="ui input col-12">
                                                    <input required name="testName[0][test_description]" type="text" class="form-control item_type" placeholder="Prescription">
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
            <!-- Footer -->
            @include('backEnd.layoutes.footer')
        <!-- footer -->
        </div>
    </div>


@stop
@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        // doctor update patient profile
        $(function(){
            $('#add_filed_medication').click(function(){
                var max = 4;
                var current1 =  $(".field_medication").length;
                if(current1 < max){
                    $('.field_medication:first').clone(true).hide().insertAfter('.field_medication:last').slideDown('slow');
                    var last = $('.field_medication:last');
                    var current =  $(".field_medication").length - 1;
                    //last.append(new_button.clone(true));
                    last.find('select').val([]);
                    last.find('input.input_field_medication').attr("name", "medication[" + current + "][name]").val('');
                    last.find('select.select_field_medication').attr("name", "medication[" + current + "][times_day]");
                    last.find('select.select_field_medication2').attr("name", "medication[" + current + "][time]");
                    current1++;
                    return false;
                }
            });
            $("body").on("click", "#remove_filed_medication", function (e) {
                var last = $('.field_medication:last');
                var current =  $(".field_medication").length;
                if(current == 1){
                    last.find('input.input_field_medication').prop('value','');
                    last.find('select.select_field_medication option:first').prop('selected',true);
                    last.find('select.select_field_medication2 option:first').prop('selected',true);
                    e.preventDefault();
                }else{
                    $(this).closest(".field_medication").remove();
                }
            });
        });
        // ================================= //
        $(function(){
            $('#more_surgeriesAdd').click(function(){
                var max = 4;
                var current1 =  $(".field_medication").length;
                if(current1 < max){
                    $('.Surgery_field_group:first').clone(true).hide().insertAfter('.Surgery_field_group:last').slideDown('slow');
                    var last = $('.Surgery_field_group:last');
                    var current =  $(".Surgery_field_group").length - 1;
                    //last.append(new_button.clone(true));
                    last.find('select').val([]);
                    last.find('select.SurgeryItemSelect').attr("name", "surgery_data[" + current + "][surgery_name]");
                    last.find('input.SurgeryItemInput').attr("name", "surgery_data[" + current + "][surgery_date]").val('');
                    current1++;
                    return false;
                }
            });
            $("body").on("click", "#remove_more_surgeries", function (e) {
                var last = $('.Surgery_field_group:last');
                var current =  $(".Surgery_field_group").length;
                if(current == 1){
                    last.find('input.SurgeryItemInput').prop('value','');
                    last.find('select.SurgeryItemSelect option:first').prop('selected',true);
                    e.preventDefault();
                }else{
                    $(this).closest(".Surgery_field_group").remove();
                }
            });
        });
        /* clinic add rediology */
        $(function(){
            $('#more_fields').click(function(){
                var max = 4;
                var current1 =  $(".field_group").length;
                if(current1 < max){
                    $('.field_group:first').clone(true).hide().insertAfter('.field_group:last').slideDown('slow');
                    var last = $('.field_group:last');
                    var current =  $(".field_group").length - 1;
                    //last.append(new_button.clone(true));
                    last.find('select').val([]);
                    last.find('input.select_custom1').attr("name", "medication[" + current + "][name]").val('');
                    last.find('select.item_type').attr("name", "medication[" + current + "][times_day]");
                    last.find('select.time').attr("name", "medication[" + current + "][time]");
                    current1++;
                    return false;
                }
            });
            $("body").on("click", "#remove", function (e) {
                var last = $('.field_group:last');
                var current =  $(".field_group").length;
                if(current == 1){
                    last.find('input.select_custom1').prop('value','');
                    last.find('select.item_type option:first').prop('selected',true);
                    last.find('select.time option:first').prop('selected',true);
                    e.preventDefault();
                }else{
                    $(this).closest(".field_group").remove();
                }
            });
        })
        $(function(){
            $('#btnAddrediology').click(function(){
                var max = 4;
                var current1 =  $(".field_group2").length;
                if(current1 < max){
                    $('.field_group2:first').clone(true).hide().insertAfter('.field_group2:last').slideDown('slow');
                    var last = $('.field_group2:last');
                    var current =  $(".field_group2").length - 1;
                    //last.append(new_button.clone(true));
                    last.find('select').val([]);
                    last.find('select.select_custom').attr("name", "rayName[" + current + "][ray_name]");
                    last.find('input.item_type').attr("name", "rayName[" + current + "][ray_description]").val('');
                    current1++;
                    return false;
                }
            });
            $("body").on("click", "#remove_rediology", function (e) {
                var last = $('.field_group2:last');
                var current =  $(".field_group2").length;
                if(current ==1){
                    last.find('select.select_custom option:first').prop('selected',true);
                    last.find('input.item_type').val('');
                    e.preventDefault();
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
                    var current =  $(".field_group1").length - 1;
                    //last.append(new_button.clone(true));
                    last.find('select').val([]);
                    last.find('select.select_custom').attr("name", "testName[" + current + "][test_name]");
                    last.find('input.item_type').attr("name", "testName[" + current + "][test_description]").val('');
                }
            });
            $("body").on("click", "#remove_Test", function (e) {
                var last = $('.field_group1:last');
                var current =  $(".field_group1").length;
                if(current ==1){
                    last.find('select.select_custom option:first').prop('selected',true);
                    last.find('input.item_type').val('');
                    e.preventDefault();
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
