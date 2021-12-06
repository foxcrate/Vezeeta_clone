@extends('backEnd.layoutes.mastar')
@section('title','Favorite')
@section('content')
@include('backEnd.patien.slidenav')
<div class="d-flex" id="wrapper" style="background-color:#535353;">
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="col-lg-12 ml-auto mr-auto text-center mb-5" style="margin-top:180;">
                <img src="{{url('imgs/favoriteplace.svg')}}" class="text-center" width="350">
            </div>
            <div class="row col-lg-12 ml-auto mr-auto" style="margin-bottom:150;">
                <div class="col ml-auto mr-auto">
                    <div class="text-center tab-finder mt-5 hvr-shadow">
                        <a href="{{route('patient.favorite.type',[$patient->id,'doctor'])}}"><img src="{{url('imgs/favoriteplaceicon.svg')}}" width="70"></a>
                        <a href="{{route('patient.favorite.type',[$patient->id,'doctor'])}}" class="h4 text-dark font-weight-bold mt-3 text-decoration">Doctor</a>
                    </div>
                </div>
                <div class="col ml-auto mr-auto">
                    <div class="text-center tab-finder mt-5 hvr-shadow">
                        <a href="{{route('patient.favorite.type',[$patient->id,'nurse'])}}"><img src="{{url('imgs/favoriteplaceicon.svg')}}" width="70"></a>
                        <a href="{{route('patient.favorite.type',[$patient->id,'nurse'])}}" class="h4 text-dark font-weight-bold mt-3 text-decoration col">Nurse</a>
                    </div>
                </div>
                <div class="col ml-auto mr-auto">
                    <div class="text-center tab-finder mt-5 hvr-shadow">
                        <a href="{{route('patient.favorite.type',[$patient->id,'pharmacy'])}}"><img src="{{url('imgs/favoriteplaceicon.svg')}}" width="70"></a>
                        <a href="{{route('patient.favorite.type',[$patient->id,'pharmacy'])}}" class="h5 text-dark font-weight-bold mt-3 text-decoration">Pharmacy</a>
                    </div>
                </div>
                <div class="col ml-auto mr-auto">
                    <div class="text-center tab-finder mt-5 hvr-shadow">
                        <a href="{{route('patient.favorite.type',[$patient->id,'xray'])}}"><img src="{{url('imgs/favoriteplaceicon.svg')}}" width="70"></a>
                        <a href="{{route('patient.favorite.type',[$patient->id,'xray'])}}" class="h4 text-dark font-weight-bold mt-3 text-decoration col">X-Ray</a>
                    </div>
                </div>
                <div class="col ml-auto mr-auto">
                    <div class="text-center tab-finder mt-5 hvr-shadow">
                        <a href="{{route('patient.favorite.type',[$patient->id,'lab'])}}"><img src="{{url('imgs/favoriteplaceicon.svg')}}" width="70"></a>
                        <a href="{{route('patient.favorite.type',[$patient->id,'lab'])}}" class="h4 text-dark font-weight-bold mt-3 text-decoration col">Labs</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        @include('backEnd.layoutes.footer')
        <!-- footer -->
    </div>
@endsection



</div>
