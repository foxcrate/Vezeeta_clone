@extends('backEnd.layoutes.mastar')
@section('title','Home Care')
@section('content')
<div class="d-flex" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        @include('includes.patientNav')
        <div class="container-fluid mt-5 mb-5">
            <div class="col-lg-12 ml-auto mr-auto text-center mb-5" style="margin-top:120;">
                <img src="{{url('imgs/homeware.svg')}}" class="text-center" width="250">
                <h1 style="font-size:50pt; font-weight:bold; color:#d6454c;">HomeCare</h1>
            </div>
            <div class="row col-lg-12 ml-auto mr-auto" style="margin-bottom:70;">
                <div class="col-3 ml-auto mr-auto">
                    <div class="text-center col-12 tab-finder mt-5 hvr-shadow">
                        <a href="{{route('patient.homecare',$patient->id)}}"><img src="{{url('imgs/Doctors.svg')}}" width="90"></a>
                        <a href="{{route('patient.homecare',$patient->id)}}" class="h5 text-dark font-weight-bold mt-3 text-decoration">Doctors</a>
                    </div>
                </div>
                <div class="col-3 ml-auto mr-auto">
                    <div class="text-center col-12 tab-finder mt-5 hvr-shadow">
                        <a href="{{route('homecare.patientSearchNurse',$patient->id)}}"><img src="{{url('imgs/nurse.svg')}}" width="90"></a>
                        <a href="{{route('homecare.patientSearchNurse',$patient->id)}}" class="h5 text-dark font-weight-bold mt-3 text-decoration col">Nurses</a>
                    </div>
                </div>
                <div class="col-3 ml-auto mr-auto">
                    <div class="text-center col-12 tab-finder mt-5 hvr-shadow">
                        <a href="{{route('homecare.patientCars',$patient->id)}}"><img src="{{url('imgs/ambulance.svg')}}" width="90"></a>
                        <a href="{{route('homecare.patientCars',$patient->id)}}" class="h5 text-dark font-weight-bold mt-3 text-decoration col">Patient Cars</a>
                    </div>
                </div>
            </div>
        </div>
      @include('backEnd.layoutes.footer')
    </div>
</div>


@stop
