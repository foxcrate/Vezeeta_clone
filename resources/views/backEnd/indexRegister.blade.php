@extends('backEnd.layoutes.mastar')
@section('title','paitenHistory')
@section('content')
    <!-- navbar file -->
    @include('backEnd.layoutes.navbar')

    <!-- navbar file -->
    <!--Start-cards-->
    <div class="bg-About">
        <section class="container row mr-auto ml-auto" style="padding-bottom:100px; padding-top:150px">
            <div class="row col-12 mt-5 mr-auto ml-auto">
                <div class="col-xl-3 mt-3 text-center hvr-hang">
                    <a href="{{route('patienRegister')}}">
                        <div class="card">
                            <img src="{{url('imgs/icon_png/patient.svg')}}" height="90" class="card-img-top mt-3 pt-3" alt="...">
                            <div class="card-body">
                                <a href="{{route('patienRegister')}}" class="h4  font-weight-bold text-decoration-none mb-0">Patient</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 mt-3 text-center hvr-hang">
                    <a href="{{route('clinicRegister')}}">
                        <div class="card">
                            <img src="{{url('imgs/icon_png/clinic.svg')}}" height="90" class="card-img-top mt-3 pt-3" alt="...">
                            <div class="card-body">
                                <a href="{{route('clinicRegister')}}" class="h4 font-weight-bold text-decoration-none mb-0">Clinic</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 mt-3 text-center hvr-hang">
                    <a href="{{route('hosptailRegister')}}">
                        <div class="card">
                            <img src="{{url('imgs/Hospital.svg')}}" height="90" class="card-img-top mt-3 pt-3" alt="...">
                            <div class="card-body mt-1">
                                <a href="{{route('hosptailRegister')}}" class="h4 font-weight-bold text-decoration-none mb-0">Hospital</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 mt-3 text-center hvr-hang">
                    <a  href="{{route('xrayRegister')}}">
                        <div class="card">
                            <img src="{{url('imgs/x-ray.svg')}}" height="80" class="card-img-top mt-4 pt-2" alt="...">
                            <div class="card-body mt-1">
                                <a href="{{route('xrayRegister')}}" class="h4 mt--3 font-weight-bold text-decoration-none mb-0">X-ray</a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row col-12 mt-5 mr-auto ml-auto">
                <div class="col-xl-3 mt-3 text-center hvr-hang">
                    <a href="{{route('nurce.register')}}">
                        <div class="card">
                            <img src="{{url('imgs/nurse.svg')}}" height="80" class="card-img-top mt-4 pt-2" alt="...">
                            <div class="card-body mt-1">
                                <a href="{{route('nurce.register')}}" class="h4 mt--3 font-weight-bold text-decoration-none mb-0">Nurse</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 mt-3 text-center hvr-hang">
                    <a href="{{route('labsRegister')}}">
                        <div class="card">
                            <img src="{{url('imgs/labs.svg')}}" height="80" class="card-img-top mt-4 pt-2" alt="...">
                            <div class="card-body mt-1">
                                <a href="{{route('labsRegister')}}" class="h4 mt--3 font-weight-bold text-decoration-none mb-0">Labs</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 mt-3 text-center hvr-hang">
                    <a href="{{route('pharmacyRegister')}}">
                        <div class="card pt-2">
                            <img src="{{url('imgs/pharmacy.svg')}}" height="80" class="card-img-top mt-4 pt-2" alt="...">
                            <div class="card-body mt-1">
                                <a href="{{route('pharmacyRegister')}}" class="h4 mt--3 font-weight-bold text-decoration-none mb-0">Pharmacy</a>
                            </div>
                        </div>
                    <a>
                </div>
                <div class="col-xl-3 mt-3 text-center hvr-hang">
                    <a href="{{route("onlineDoctorRegister")}}">
                        <div class="card pt-2">
                            <img src="{{url('imgs/icon_png/onlineDoctor.svg')}}" height="80" class="card-img-top mt-4 pt-2" alt="...">
                            <div class="card-body mt-1">
                                <a href="#" class="h4 mt--3 font-weight-bold text-decoration-none mb-0"></a>
                                <a href="{{route("onlineDoctorRegister")}}" class="h4 mt--3 font-weight-bold text-decoration-none mb-0">Doctor</a>
                            </div>
                        </div>
                    <a>
                </div>
            </div>
        </section>
    </div>
    <!--End-cards-->
    <!-- footer -->
    @include('backEnd.layoutes.footer')
    <!-- footer -->


@stop
