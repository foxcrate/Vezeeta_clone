@extends('backEnd.layoutes.mastar')
@section('title','Doctor ' . $doctor->doctor->name)
@section('content')
    @include("backEnd.patien.slidenav")
    <div class="d-flex bg-veiwdoctor" id="wrapper">
        <div id="page-content-wrapper">
            @include('includes.patientNav')
            <div class="container">
                @if($doctor)
                   <div class="row mt-5">
                    <div class="row container">
                        <div class="mb-3 pb-2 mr-auto ml-auto">
                            @if(!$doctor->doctor->image)
                                <img width="75" height="75" class="rounded-circle" alt="Image placeholder" src="{{ asset('uploads/default.jpg') }}">
                            @else
                                <img width="75" height="75" class="rounded-circle" alt="Image placeholder" src="{{ $doctor->doctor->image }}">
                            @endif
                        </div>
                        <div class="col-lg-10 mr-auto ml-auto">
                            <div class="h4 mt-3 font-weight-bold text-capitalize mb-3">
                                {{$doctor->doctor_name}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ml-auto mr-auto mb-4 pharmacy_item" data-lat="{{$doctor->latitude}}" data-lng="{{$doctor->longitude}}" data-distance=".distance_{{$doctor->id}}">
                        <div class="card-finder">
                            <div class="row mr-auto ml-auto">
                                <div class="col-lg-10">
                                    <div class="row h5 text-dark text-capitalize mb-2">
                                        <div class="col-1"><img src="{{url('imgs/doctor.svg')}}" width="30" class="mr-3"></div>
                                        <div class="col-10 ml-3 mt-1 mb-3">{{$doctor->special}}</div>
                                    </div>
                                    <div class="row h5 text-dark text-capitalize mb-2">
                                        <div class="col-1"><img src="{{url('imgs/infodoctor.svg')}}" width="30" class="mr-3"></div>
                                        <div class="col-10 ml-3 mb-3">{{$doctor->doctor->information}}</div>
                                    </div>
                                    <div class="row h5 text-dark text-capitalize">
                                        <div class="col-1"><img src="{{url('imgs/phone.svg')}}" width="25" class="mr-3"></div>
                                        <div class="col-10 ml-3 mb-2">{{$doctor->phoneNumber}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ml-auto mr-auto mb-4 pharmacy_item" data-lat="{{$doctor->latitude}}" data-lng="{{$doctor->longitude}}" data-distance=".distance_{{$doctor->id}}">
                        <div class="card-finder">
                            <div class="row mr-auto ml-auto mt-2">
                                <div class="row h5 text-dark text-capitalize mb-2">
                                    <div class="col-1"><img src="{{url('imgs/money.svg')}}" width="25" class="mr-3"></div>
                                    <div class="col-9 ml-2">Fees: {{$doctor->fees}} EGP</div>
                                </div>
                                <div class="row h5 text-dark text-capitalize mb-2">
                                    <div class="col-1"><img src="{{url('imgs/wiating.svg')}}" width="25" class="mr-3"></div>
                                    <div class="col-10 ml-2">Waiting Time: {{$doctor->wating}}</div>
                                </div>
                                <div class="row h5 text-dark text-capitalize mt-3 mb-2">
                                    <div class="col-1"><img src="{{url('imgs/location.svg')}}" width="25" class="mr-3"></div>
                                    <div class="col-10 ml-2">{{$doctor->address}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row col-lg-12 ml-auto mr-auto mt-3 d-flex">
                            @foreach($doctor->appointments as $appointments)
                                <div class="mb-3 mr-3 ">
                                    <div class="book-title col-lg-12 text-center">
                                        <div class="h5 font-weight-bold col ml-auto mr-auto mb-3">
                                            {{$appointments['day_name']}}
                                        </div>
                                        <div class="h6 font-weight-bold col ml-auto mr-auto">
                                            {{$appointments['from']}}
                                        </div>
                                        <div class="h6 font-weight-bold col ml-auto mr-auto">
                                            To
                                        </div>
                                        <div class="h6 font-weight-bold col ml-auto mr-auto">
                                            {{$appointments['to']}}
                                        </div>
                                        <form action="{{route('doctor.book',[$patient->id,$doctor->id])}}" method="POST" class="col ml-auto mr-auto">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                            <input type="hidden" name="patient_name" value="{{$patient->name}}">
                                            <input type="hidden" name="patient_phone" value="{{$patient->phoneNumber}}">
                                            <input type="hidden" name="appoiment_id" value="{{$doctor->id}}">
                                            <input type="hidden" name="appointmentsD" value="{{$appointments['day_name']}}">
                                            <input type="hidden" name="appointmentsF" value="{{$appointments['from']}}">
                                            <input type="hidden" name="appointmentsT" value="{{$appointments['to']}}">
                                            <input type="submit" class="btn btn-danger mt-3" value="Book">
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="col-md-11 ml-auto mr-auto mb-2 pharmacy_item" data-lat="{{$doctor->latitude}}" data-lng="{{$doctor->longitude}}" data-distance=".distance_{{$doctor->id}}">
                        <div class="card-finder">
                            <div class="">
                                <div class="row col mr-auto ml-auto pt-3 pl-3 pr-3">
                                    <div class="col-lg-2 mr-auto ml-auto p-3">
                                        @if(!$doctor->doctor->image)
                                            <img width="140" height="140" class="rounded-circle" alt="Image placeholder" src="{{ asset('uploads/default.jpg') }}">
                                        @else
                                            <img width="140" height="140" class="rounded-circle" alt="Image placeholder" src="{{ $doctor->doctor->image }}">
                                        @endif

                                    </div>
                                    <div class="col-lg-10 pl-5">
                                        <div class="h3 font-weight-bold text-capitalize mb-4">
                                            {{$doctor->doctor_name}} @if($doctor->doctor->is_faviorate == 1)<i class="fa fa-star" style="color:orange"></i>@endif
                                        </div>
                                        <div class="h5 text-dark text-capitalize mb-2"><img src="{{url('imgs/doctor.svg')}}" width="30" class="mr-3" > {{$doctor->special}}</div>
                                        <div class="h5 text-dark text-capitalize mb-2"><img src="{{url('imgs/infodoctor.svg')}}" width="30" class="mr-3"   > {{$doctor->doctor->information}}</div>
                                        <div class="h5 text-dark text-capitalize mb-2"><img src="{{url('imgs/location.svg')}}" width="25" class="mr-3"  > {{$doctor->address}}</div>
                                        <div class="h5 text-dark text-capitalize mb-2"><img src="{{url('imgs/money.svg')}}" width="25" class="mr-3"  > Fees: {{$doctor->fees}} EGP</div>
                                        <div class="h5 text-dark text-capitalize mb-2"><img src="{{url('imgs/wiating.svg')}}" width="25" class="mr-3"  > Waiting Time: {{$doctor->wating}} </div>
                                        <div class="h5 text-dark text-capitalize mb-2"><img src="{{url('imgs/phone.svg')}}" width="25" class="mr-3"  > {{$doctor->phoneNumber}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row col-lg-12 ml-auto mr-auto mt-3 d-flex justify-content-end ">
                                    @foreach($doctor->appointments as $appointments)
                                        <div class="mb-3 mr-3 ">
                                            <div class="book-title col-lg-12 text-center">
                                                <div class="h5 font-weight-bold col ml-auto mr-auto mb-3">
                                                    {{$appointments['day_name']}}
                                                </div>
                                                <div class="h6 font-weight-bold col ml-auto mr-auto">
                                                    {{$appointments['from']}}
                                                </div>
                                                <div class="h6 font-weight-bold col ml-auto mr-auto">
                                                    To
                                                </div>
                                                <div class="h6 font-weight-bold col ml-auto mr-auto">
                                                    {{$appointments['to']}}
                                                </div>
                                                <form action="{{route('doctor.book',[$patient->id,$doctor->id])}}" method="POST" class="col ml-auto mr-auto">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                                    <input type="hidden" name="patient_name" value="{{$patient->name}}">
                                                    <input type="hidden" name="patient_phone" value="{{$patient->phoneNumber}}">
                                                    <input type="hidden" name="appoiment_id" value="{{$doctor->id}}">
                                                    <input type="hidden" name="appointmentsD" value="{{$appointments['day_name']}}">
                                                    <input type="hidden" name="appointmentsF" value="{{$appointments['from']}}">
                                                    <input type="hidden" name="appointmentsT" value="{{$appointments['to']}}">
                                                    <input type = "submit" class="btn btn-danger mt-3" value="Book">
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div> --}}
                   </div>
                @endif
            </div>
        </div>
    </div>
@endsection

{{-- @section('scripts')
    <script src="{{url('js/address.js')}}"></script>
@stop --}}
