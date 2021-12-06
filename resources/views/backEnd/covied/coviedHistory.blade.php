@extends('backEnd.layoutes.mastar')
@section('title','Covied History ' . $patient->name)
@section('content')
<div class=" bg-covid d-flex" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        @if($patient)
            @foreach ($patient->coviedCountry as $country)
            <div class="card-pcr col-lg-6 mt-5 mb-5 ml-auto mr-auto">
                <h5 class="font-weight-bold pl-4 pt-4">{{ $country->created_at }}</h5>
                <h5 class="font-weight-bold pl-4 pb-2">{{ $country->from }}<i class="far fa-angle-double-right mr-4 ml-4"></i>  {{ $country->to }}</h5>
            </div>
            @endforeach
            @foreach ($patient->coviedPcr as $pcr)
                <a target="_blank" class="row card-pcr col-lg-6 mt-5 mb-3 ml-auto mr-auto col-lg-5 font-weight-bold text-decoration text-center h5 pl-5 pt-3 pb-3" href="{{ $pcr->link }}">Pcr Test</a>
            @endforeach

            @foreach ($patient->coviedVac as $linkvac)
                <a target="_blank" class="row card-pcr col-lg-6 mt-3 mb-5 ml-auto mr-auto col-lg-5 font-weight-bold text-decoration text-center h5 pl-5 pt-3 pb-3" href="{{ $linkvac->link }}">Vaccine Test</a>
            @endforeach
        @endif

    </div>

</div>
@include('backEnd.layoutes.footer')
@stop

