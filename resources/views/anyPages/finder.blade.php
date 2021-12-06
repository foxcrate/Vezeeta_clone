@extends('backEnd.layoutes.mastar')
@section('title','Finder')
@section('content')
<div class="d-flex bg-as" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            <div class="container-fluid mt-5">
                <div class="col-lg-12 ml-auto mr-auto text-center mb-5" style="margin-top:250px;">
                    <img src="{{url('imgs/finder/finder.png')}}" class="text-center" width="350">
                </div>
                <div class="row col-lg-12 ml-auto mr-auto" style="margin-bottom:110; margin-top:70px;">
                    <div class="col ml-auto mr-auto">
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.doctor',$patient->id)}}"><img src="{{url('imgs/finder/DOCTORF.png')}}" width="90"></a>
                            <a href="{{route('finder.doctor',$patient->id)}}" class="h4 text-dark font-weight-bold mt-3 text-decoration">Doctor</a>
                        </div>
                    </div>
                    <div class="col ml-auto mr-auto">
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.nurse',$patient->id)}}"><img src="{{url('imgs/finder/nurse.png')}}" width="90"></a>
                            <a href="{{route('finder.nurse',$patient->id)}}" class="h5 text-dark font-weight-bold mt-3 text-decoration col">Nurse</a>
                        </div>
                    </div>
                    <div class="col ml-auto mr-auto">
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.pharmacy',$patient->id)}}"><img src="{{url('imgs/finder/PHARM.png')}}" width="90"></a>
                            <a href="{{route('finder.pharmacy',$patient->id)}}" class="h5 text-dark font-weight-bold mt-3 text-decoration">Pharmacy</a>
                        </div>
                    </div>
                    <div class="col ml-auto mr-auto">
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.xray',$patient->id)}}"><img src="{{url('imgs/finder/XRAYS.png')}}" width="90"></a>
                            <a href="{{route('finder.xray',$patient->id)}}" class="h4 text-dark font-weight-bold mt-3 text-decoration col">X-Ray</a>
                        </div>
                    </div>
                    <div class="col ml-auto mr-auto">
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.lab',$patient->id)}}"><img src="{{url('imgs/finder/LABS.png')}}" width="90"></a>
                            <a href="{{route('finder.lab',$patient->id)}}" class="h4 text-dark font-weight-bold mt-3 text-decoration col">Labs</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection



</div>
