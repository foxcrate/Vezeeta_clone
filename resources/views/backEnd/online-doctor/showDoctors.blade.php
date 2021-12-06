@extends('backEnd.layoutes.mastar')
@section('title','Show Doctors')
@section('content')
@include('backEnd.patien.slidenav')

<div class="d-flex bg-searchdoctor" id="wrapper">
    <div id="page-content-wrapper">
        <div class="container">
            <div class="row col-12 ml-auto mr-auto">
                <div id="tab-content" class="col-lg-12 tab-content bg-doctor mt-5 mb-5">
                    <div id="tab-01" class="tab-pane fade show active" role="tabpanel" aria-labelledby="pill-01">
                        @foreach($spdoctors->onlineDoctor as $doctor)
                            @if($doctor->online == 1)
                                <div class="row col-lg-10 ml-auto mr-auto p-5 label-doctor m-4">
                                    <div class="col-lg-3 pb-3">
                                        <img src="{{url('imgs/dProfilePic.png')}}" width="120" />
                                    </div>
                                    <div class="col-lg-8 mt-3">
                                        <h4 class="col-lg-8 font-weight-bold">Dr {{$doctor->name}}</h4>
                                        <h5 class="col-lg-8 mb-3">{{$doctor->special->name}}</h5>
                                        <h6 class="col-lg-12 text-muted">{{$doctor->information}}</h5>
                                    </div>
                                    <div class="col-12 text-center mt-5">
                                        <a href = "{{route('show_profile_doctor',[$patient->id,$doctor->id])}}" class="btn btn-primary col-8 ml-auto mr-auto h4">Show Profile</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backEnd.layoutes.footer')

@stop
