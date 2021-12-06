@extends('backEnd.layoutes.mastar')
@section('title','Finder Dcctors In Clinic')
@section('content')
<div class="d-flex" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            @include('includes.patientNav')
            <div class="container mt-5">
                <div class="row">
                    @if($hosptail)
                        @foreach($hosptail->hosptailDoctorAppoiemnts as $hosptail)
                            <div class="col-md-6 ml-auto mr-auto mb-4 pharmacy_item" data-lat="{{$hosptail->latitude}}" data-lng="{{$hosptail->longitude}}" data-distance=".distance_{{$hosptail->id}}">
                                <div class="card-finder">
                                    <div class="row mr-auto ml-auto">
                                        <div class="mb-3 pb-2 mr-auto ml-auto">
                                            @if(!$hosptail->image)
                                                <img width="75" height="75" class="rounded-circle" alt="Image placeholder" src="{{ asset('uploads/default.jpg') }}">
                                            @else
                                                <img width="75" height="75" class="rounded-circle" alt="Image placeholder" src="{{ $hosptail->image }}">
                                            @endif
                                        </div>
                                        <div class="col-lg-10 mr-auto ml-auto">
                                            <div class="h4 mt-3 font-weight-bold text-capitalize mb-3">
                                                {{$hosptail->doctor_name}}
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <div class="col-1"><img src="{{url('imgs/doctor.svg')}}" width="30" class="mr-3"></div>
                                                <div class="col-10 ml-3">{{$hosptail->special}}</div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <div class="col-1"><img src="{{url('imgs/infodoctor.svg')}}" width="30" class="mr-3"></div>
                                                <div class="col-10 ml-3">{{$hosptail->doctor->information}}</div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize">
                                                <div class="col-1"><img src="{{url('imgs/phone.svg')}}" width="25" class="mr-3"></div>
                                                <div class="col-10 ml-3">{{$hosptail->phoneNumber}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 ml-auto mr-auto mb-4 pharmacy_item" data-lat="{{$hosptail->latitude}}" data-lng="{{$hosptail->longitude}}" data-distance=".distance_{{$hosptail->id}}">
                                <div class="card-finder">
                                    <div class="row mr-auto ml-auto mt-2">
                                        <div class="row h5 text-dark text-capitalize mb-2">
                                            <div class="col-1"><img src="{{url('imgs/money.svg')}}" width="25" class="mr-3"></div>
                                            <div class="col-9 ml-2">Fees: {{$hosptail->fees}} EGP</div>
                                        </div>
                                        {{-- <div class="row h5 text-dark text-capitalize mb-2">
                                            <div class="col-1"><img src="{{url('imgs/wiating.svg')}}" width="25" class="mr-3"></div>
                                            <div class="col-10 ml-2">Waiting Time: {{$doctor->wating}}</div>
                                        </div> --}}
                                        <div class="row h5 text-dark text-capitalize mt-3 mb-2">
                                            <div class="col-1"><img src="{{url('imgs/location.svg')}}" width="25" class="mr-3"></div>
                                            <div class="col-10 ml-2">{{$hosptail->address}}</div>
                                        </div>
                                        {{-- <div class="row">
                                            @php
                                                $favDoc = \App\Models\Faviorate::where('doctor_id',$doctor->id)->first();
                                                $favPatient=\App\Models\Faviorate::where('patient_id',$patient->id)->first();
                                            @endphp
                                            @if(!$favDoc || !$favPatient)
                                                <form action="{{route('add_to_faviorate_doctor')}}" method="POST" class="col">
                                                    {{ csrf_field() }}
                                                    <input type ="hidden" name="patient_id" value="{{$patient->id}}">
                                                    <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
                                                    <input type="hidden" name="IdCode" value="{{$doctor->idCode}}">
                                                    <input type="hidden" name="name" value="{{$doctor->name}}">
                                                    <input type="hidden" name="type" value="doctor">
                                                    <input type="submit" value="Add To Faviorate" class="btn btn-outline-primary mt-3" id="add_to_faviorate_nurse">
                                                </form>
                                            @endif
                                        </div> --}}
                                    </div>

                                </div>
                                {{-- <div class="col-12 ml-auto mr-auto">
                                    <a class="col-12 btn btn-primary mt-4" style="border-radius: 30px;" href="{{route('finder.get_appointments',[$patient->id,$doctor->id])}}">Booking</a>
                                </div> --}}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@stop
