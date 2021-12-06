@extends('backEnd.layoutes.mastar')
@section('title','Finder Nurse')
@section('content')
<div class="d-flex bg-as" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        <div class="main-content " id="panel">
            @include('includes.patientNav')
            <div class="container mt-5">
                @if($nurses)
                    <input type="hidden" name="longitude" class="longitude" value="">
                    <input type="hidden" name="latitude" class="latitude" value="">
                    <div class="row">
                        @foreach($nurses as $nurse)
                            <div class="col-md-4 mb-2 pharmacy_item" data-lat="{{$nurse->latitude}}" data-lng="{{$nurse->longitude}}" data-distance=".distance_{{$nurse->id}}">
                                <div class="card card-finder">
                                    <div class="card-header">
                                        <div class="card-title h5 font-weight-bold">
                                            {{$nurse->name}} @if($nurse->is_faviorate == 1)<i class="fa fa-star" style="color:orange"></i>@endif <br>
                                        </div>
                                        <span><i class="fa fa-location-arrow text-primary"></i> <b>Distance: </b><span class="distance_{{$nurse->id}}"></span></span>
                                    </div>
                                    <div class="card-body">
                                        <b>Address: </b> {{$nurse->address}} </br>
                                        <div class="row mt-3">
                                            @if($nurse->is_faviorate == 0)
                                            <form id = "form_add_to_faviorate_nurse" action="{{route('add_to_faviorate_nurse')}}" method="POST" class="col-2">
                                                {{ csrf_field() }}
                                                <input type ="hidden" name="patient_id" value="{{$patient->id}}">
                                                <input type="hidden" name="nurse_id" value="{{$nurse->id}}">
                                                <input type="hidden" name="IdCode" value="{{$nurse->IdCode}}">
                                                <input type="hidden" name="name" value="{{$nurse->name}}">
                                                <input type="hidden" name="type" value="nurse">
                                                <button type="submit" class="btn btn-outline-primary" id="add_to_faviorate_nurse">
                                                    <i class="fa fa-star "></i>
                                                </button>
                                            </form>
                                            @endif
                                            <div class="col-10">
                                                <a href="{{route('show_profile_nurse',[$patient->id,$nurse->id])}}" class="btn btn-outline-primary col-12">Show Profile Nurse</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{url('js/address.js')}}"></script>
    <script>

    </script>

@stop
