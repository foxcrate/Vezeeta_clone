@extends('backEnd.layoutes.mastar')
@section('title','Doctor ' . $doc_sucdule->appoiment->doctor_name)
@section('content')
    @include("backEnd.patien.slidenav")
    <div class="d-flex bg-veiwdoctor" id="wrapper">
        <div id="page-content-wrapper">
            @include('includes.patientNav')
            <div id="page-content-wrapper" class="mb-5">
                <div class="mb-4s mt-5">
                    @if(!$doc_sucdule->appoiment->doctor->image)
                    <img class="rounded-circle mb-3 " width="120" height="120" src="{{asset('uploads/defualt.jpg')}}" alt="">
                    @else
                    <img class="rounded-circle mb-3 " width="120" height="120" src="{{$doc_sucdule->appoiment->doctor->image}}" alt="">
                    @endif

                </div>
                <div class="mb-3">
                    <h3>{{$doc_sucdule->appoiment->doctor_name}}</h3>
                </div>
                <div class="h5 text-dark text-capitalize mb-2">
                    <img src="{{url('imgs/infodoctor.svg')}}" width="30" class="mr-2" > {{$doc_sucdule->appoiment->doctor->information}}
                </div>
                <form  class="col-lg-12 mt-4" action="{{route('finder.update.book',[$patient->id,$doctor->id,$doc_sucdule->id])}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                    <input id="Hpatient_name" type="hidden" name="Hpatient_name" value="{{$doc_sucdule->patient_name}}">
                    <input id="Hpatient_phone" type="hidden" name="Hpatient_phone" value="{{$doc_sucdule->patient_phone}}">
                    <div class="form-group">
                        <input type="checkbox"  name="check_patient" id="check_patient">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    </div>
                    <div class="form-group">
                        <label>Patient Name</label>
                        <input id="patient_name" disabled type="text" name="patient_name" value="{{$doc_sucdule->patient_name}}" class="col-lg-8 form-control">
                    </div>
                    <div class="form-group">
                        <label>Patient Phone Number</label>
                        <input id="patient_number" disabled type="text" name="patient_phone" value="{{$doc_sucdule->patient_phone}}" class="col-lg-8 form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Confirm" class="btn btn-success">
                    </div>
                </form>
                <div class="mt-5 h4 font-weight-bold">
                    <img src="{{url('imgs/calendar.svg')}}" width="30" class="mr-3" >{{$doc_sucdule->day_name}}
                </div>
                <div class="h6 font-weight-bold">
                    <img src="{{url('imgs/wall-clock.svg')}}" width="30" class="mr-3" >{{$doc_sucdule->from}} To  {{$doc_sucdule->to}}
                </div>
                <div class="h6 font-weight-bold">
                    <img src="{{url('imgs/location.svg')}}" width="30" class="mr-3" ><b>Address : </b> {{$doc_sucdule->appoiment->address}}
                </div>
                <div class="h6 font-weight-bold">
                    <img src="{{url('imgs/money.svg')}}" width="30" class="mr-3" > <b>Fees : </b> {{$doc_sucdule->appoiment->fees}} EGP
                </div>
            </div>
        </div>
    </div>
    <script>
        var check_patient = document.getElementById('check_patient'),
            patient_name = document.getElementById('patient_name'),
            patient_number = document.getElementById('patient_number'),
            Hpatient_name = document.getElementById('Hpatient_name'),
            Hpatient_number = document.getElementById('Hpatient_phone');
            check_patient.onchange = function(){
                if(patient_name.disabled  === true && patient_number.disabled === true){
                  patient_name.disabled = false;
                  patient_number.disabled = false;
                  Hpatient_name.removeAttribute('value');
                  Hpatient_number.removeAttribute('value');
                }else{
                    patient_name.disabled = true;
                    patient_number.disabled = true;
                }
            }
    </script>
@stop

