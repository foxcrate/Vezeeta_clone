@extends('backEnd.layoutes.mastar')
@section('title','Patient Search Nurse')
@section('content')
<div class="d-flex bg-veiwdoctor" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        @include('includes.patientNav')
        <div class="container-fluid pb-5">
            <div class="row mt-5 mb-5">
                <div class="row ml-auto mr-auto">
                    <form action="{{ route('searchNurse',$patient->id) }}" method="POST">
                        {{ csrf_field() }}
                        <h3 class="text-center font-weight-bold text-primary mb-3">Search Nurse</h3>
                        <input type="hidden" id="latitude" name="latitude" value="markerCurrent.position.lat()">
                        <input type="hidden" id="longitude" name="longitude" value="markerCurrent.position.lng()">
                        <div class="form-group ml-auto mr-auto">
                            <label class="h6 font-weight-bold">Address</label>
                            <input type="text" id="pac-input"class="form-control" name="address">
                            <div id="map" style="height: 500px;width: 500px;"></div>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row ml-auto mr-auto ">
                            <input type="submit" value="Search" class="btn btn-primary col-9 ml-auto mr-auto">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row containers col-10 ml-auto mr-auto">

            </div>
        </div>
        @include('backEnd.layoutes.footer')
        <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&callback=initAutocomplete&libraries=places&v=weekly"
    defer
></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        @include("includes.GoogleMap")
    </script>
    </div>
</div>



@stop
