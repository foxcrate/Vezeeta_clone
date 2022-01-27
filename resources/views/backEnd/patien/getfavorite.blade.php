@extends('backEnd.layoutes.mastar')
@section('title','Favorite')
@section('content')
@include('backEnd.patien.slidenav')
<div class="d-flex favouritePage" id="wrapper">
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="col-lg-8 ml-auto mr-auto text-center mb-5 mt-5">
                <img src="{{url('imgs/favoriteplace.svg')}}" width="300" style="margin-top: 5%;">
            </div>
           <div class="favourite-layouts">
            <div class="find-layout">
                <a href="{{route('patient.favorite.type',[$patient->id,'doctor'])}}">
                    <img src="{{url('imgs/favoriteplaceicon.svg')}}" width="90">
                    <p>Doctor</p>
                </a>
            </div>
            <div class="find-layout">
                <a href="{{route('patient.favorite.type',[$patient->id,'nurse'])}}">
                    <img src="{{url('imgs/favoriteplaceicon.svg')}}" width="90">
                    <p>Nurse</p>
                </a>
            </div>
            <div class="find-layout">
                <a href="{{route('patient.favorite.type',[$patient->id,'pharmacy'])}}">
                    <img src="{{url('imgs/favoriteplaceicon.svg')}}" width="90">
                    <p>Pharmacy</p>
                </a>
            </div>
            <div class="find-layout">
                <a href="{{route('patient.favorite.type',[$patient->id,'xray'])}}">
                    <img src="{{url('imgs/favoriteplaceicon.svg')}}" width="90">
                    <p>X-Ray</p>
                </a>
            </div>
            <div class="find-layout">
                <a href="{{route('patient.favorite.type',[$patient->id,'lab'])}}">
                    <img src="{{url('imgs/favoriteplaceicon.svg')}}" width="90">
                    <p>Labs</p>
                </a>
            </div>
           </div>
        </div>
        <!-- footer -->

        <!-- footer -->
    </div>
@endsection



</div>
