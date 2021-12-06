@extends('backEnd.dashbord.layout2')
@section('title','Home page')
@section('content')
@include('backEnd.dashbord.nav')
<!-- panels -->
<div class="panels">
    <div class="container">
        <div class="row mt-3">
            <div class="col-sm-3 mb-3">
                <h5>Paitnes</h5>
            </div>
            <div class="col-sm-3 mb-3">
                <h5>Hosptails</h5>
            </div>
            <div class="col-sm-3 mb-3">
                <h5>Clincs</h5>
            </div>
            <div class="col-sm-3">
                <h5>Doctors</h5>
            </div>
            <div class="col-sm-3">
                <h5>Xrays</h5>
            </div>
            <div class="col-sm-3">
                <h5>Labs</h5>
            </div>
            <div class="col-sm-3">
                <h5>Pharmacy</h5>
            </div>
            <div class="col-sm-3">
                <h5>Nurses</h5>
            </div>
        </div>
    </div>
</div>
<!-- panels -->
@stop
