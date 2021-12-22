@extends('backEnd.layoutes.mastar')
@section('title','Home Care')
@section('content')
    <div class="d-flex bg-veiwdoctor" id="wrapper">
        @include('backEnd.patien.slidenav')
        <div id="page-content-wrapper">
            @include('includes.patientNav')
            <div class="container-fluid pb-5">
                <div class="row mt-5 mb-5">
                <img src="{{url('imgs/homecare.svg')}}" class="ml-auto mr-auto" width="500" style="margin-bottom: 50px;" />
                </div>
                <div class="online-layouts">
                    @foreach($doctorSp as $sp)
                        <a href="{{route("showDoctors",[$patient->id,$sp->id])}}" class="text-spcailty font-weight-bold text-decoration online-layout col-lg-3">
                            {{$sp->name}}
                        </a>
                    @endforeach
                </div>
                {{-- <div class="row containers col-10 ml-auto mr-auto">
                    @foreach($doctorSp as $sp)
                    <a class="nav-link doc-spicalite col-lg-3 font-weight-bold text-center m-2"  href="{{route("homecare.showDoctors",[$patient->id,$sp->id])}}">{{$sp->name}}</a>
                    @endforeach
                </div> --}}

            </div>
            @include('backEnd.layoutes.footer')
        </div>
    </div>
@stop
