@extends('backEnd.layoutes.mastar')
@section('title','Finder pharmacy')
@section('content')
@include('backEnd.patien.slidenav')

<div class="d-flex bg-as" id="wrapper">
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            @include('includes.patientNav')
            <div class="container mt-5 mb-5">
                <div class="row justify-content-start">
                    @if($pharmacies)
                        <input type="hidden" name="longitude" class="longitude" value="">
                        <input type="hidden" name="latitude" class="latitude" value="">
                    @foreach($pharmacies as $pharmacy)
                        <div class="col-md-4 mb-4 pharmacy_item" data-lat="{{$pharmacy->latitude}}" data-lng="{{$pharmacy->longitude}}" data-distance=".distance_{{$pharmacy->id}}">
                            <div class="card card-finder">
                                <div class="card-header">
                                    <div class="card-title mt-3">
                                        <div class="h5 font-weight-bold">
                                            {{$pharmacy->pharmacyName}} @if($pharmacy->is_faviorate == 1)<i class="fa fa-star" style="color:orange"></i>@endif
                                        </div>
                                        <span><i class="fa fa-location-arrow"></i></span>
                                        <b>Distance: </b><span class="distance_{{$pharmacy->id}}"></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <b>Address:</b> {{$pharmacy->address}}
                                    @if($pharmacy->is_faviorate == 0)
                                        <form  action="{{route('add_to_faviorate_pharmacy')}}" method="POST" class="col">
                                            {{ csrf_field() }}
                                            <input type ="hidden" name="patient_id" value="{{$patient->id}}">
                                            <input type="hidden" name="pharmacy_id" value="{{$pharmacy->id}}">
                                            <input type="hidden" name="idCode" value="{{$pharmacy->idCode}}">
                                            <input type="hidden" name="name" value="{{$pharmacy->pharmacyName}}">
                                            <input type="hidden" name="type" value="pharmacy">
                                            <input type="submit" value="Add To Faviorate" class="btn btn-success" id="add_to_faviorate_nurse">
                                        </form>
                                    @endif
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


@endsection


