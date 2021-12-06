@extends('backEnd.layoutes.mastar')
@section('title','Finder Dcctor')
@section('content')
<div class="d-flex" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            @include('includes.patientNav')
            <div class="container mt-5">
                <div class="row">
                    @if($nurses)
                        @foreach($nurses as $nurse)
                            <div class="col-md-6 ml-auto mr-auto mb-4 pharmacy_item" data-lat="{{$nurse->latitude}}" data-lng="{{$nurse->longitude}}" data-distance=".distance_{{$nurse->id}}">
                                <div class="card-finder">
                                    <div class="row mr-auto ml-auto">
                                        <div class="mb-3 pb-2 mr-auto ml-auto">
                                            @if(!$nurse->image)
                                                <img width="75" height="75" class="rounded-circle" alt="Image placeholder" src="{{ asset('uploads/default.png') }}">
                                            @else
                                                <img width="75" height="75" class="rounded-circle" alt="Image placeholder" src="{{ $nurse->image }}">
                                            @endif
                                        </div>
                                        <div class="col-lg-10 mr-auto ml-auto">
                                            <div class="h4 mt-3 font-weight-bold text-capitalize mb-3">
                                                {{$nurse->name}}
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            {{-- <div class="row h5 text-dark text-capitalize mb-2">
                                                <div class="col-1"><img src="{{url('imgs/doctor.svg')}}" width="30" class="mr-3"></div>
                                                <div class="col-10 ml-3">{{$doctor->special}}</div>
                                            </div> --}}
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <div class="col-1"><img src="{{url('imgs/infodoctor.svg')}}" width="30" class="mr-3"></div>
                                                <div class="col-10 ml-3">{{$nurse->information}}</div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize">
                                                <div class="col-1"><img src="{{url('imgs/phone.svg')}}" width="25" class="mr-3"></div>
                                                <div class="col-10 ml-3">{{$nurse->phoneNumber}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>






@stop
