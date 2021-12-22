@extends('backEnd.layoutes.mastar')
@section('title','Finder')
@section('content')
<div class="d-flex" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div class="container-fluid">
        <div class="finder-background">
            <div class="col-lg-8 ml-auto mr-auto text-center mb-5">
                <img src="{{url('imgs/finder/finder.png')}}" width="300" style="margin-top: 15%;">
            </div>
           <div class="finder-layouts">
            <div class="find-layout">
                <a href="{{route('finder.doctor',$patient->id)}}">
                    <img src="{{url('imgs/finder/DOCTORF.png')}}" width="90">
                    <p>Doctor</p>
                </a>
            </div>
            <div class="find-layout">
                <a href="{{route('finder.nurse',$patient->id)}}">
                    <img src="{{url('imgs/finder/nurse.png')}}" width="90">
                    <p>Nurse</p>
                </a>
            </div>
            <div class="find-layout">
                <a href="{{route('finder.pharmacy',$patient->id)}}">
                    <img src="{{url('imgs/finder/PHARM.png')}}" width="90">
                    <p>Pharmacy</p>
                </a>
            </div>
            <div class="find-layout">
                <a href="{{route('finder.xray',$patient->id)}}">
                    <img src="{{url('imgs/finder/XRAYS.png')}}" width="90">
                    <p>X-Ray</p>
                </a>
            </div>
            <div class="find-layout">
                <a href="{{route('finder.lab',$patient->id)}}">
                    <img src="{{url('imgs/finder/LABS.png')}}" width="90">
                    <p>Labs</p>
                </a>
            </div>
           </div>
        </div>
    </div>
    {{-- <div id="page-content-wrapper">
        <div class="main-content bg-as" id="panel">
            <div class="container-fluid mt-5">
                <div class="col-lg-12 ml-auto mr-auto text-center mb-5">
                    <img src="{{url('imgs/finder/finder.png')}}" class="text-center" width="350" style="margin-top: 12%">
                </div>
                <div class="find-layout">
                    <div class="find-card">
                        <a class="">
                            <a href="{{route('finder.doctor',$patient->id)}}"><img src="{{url('imgs/finder/DOCTORF.png')}}" width="90"></a>
                            <a href="{{route('finder.doctor',$patient->id)}}" class="h4 text-dark font-weight-bold mt-3 text-decoration">Doctor</a>
                        </a>
                    </div>
                    <div>
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.nurse',$patient->id)}}"><img src="{{url('imgs/finder/nurse.png')}}" width="90"></a>
                            <a href="{{route('finder.nurse',$patient->id)}}" class="h5 text-dark font-weight-bold mt-3 text-decoration col">Nurse</a>
                        </div>
                    </div>
                    <div>
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.pharmacy',$patient->id)}}"><img src="{{url('imgs/finder/PHARM.png')}}" width="90"></a>
                            <a href="{{route('finder.pharmacy',$patient->id)}}" class="h5 text-dark font-weight-bold mt-3 text-decoration">Pharmacy</a>
                        </div>
                    </div>
                    <div>
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.xray',$patient->id)}}"><img src="{{url('imgs/finder/XRAYS.png')}}" width="90"></a>
                            <a href="{{route('finder.xray',$patient->id)}}" class="h4 text-dark font-weight-bold mt-3 text-decoration col">X-Ray</a>
                        </div>
                    </div>
                    <div>
                        <div class="text-center tab-finder mt-5 hvr-shadow">
                            <a href="{{route('finder.lab',$patient->id)}}"><img src="{{url('imgs/finder/LABS.png')}}" width="90"></a>
                            <a href="{{route('finder.lab',$patient->id)}}" class="h4 text-dark font-weight-bold mt-3 text-decoration col">Labs</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div> --}}
</div>
@endsection




