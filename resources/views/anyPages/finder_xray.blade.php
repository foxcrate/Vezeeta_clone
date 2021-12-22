@extends('backEnd.layoutes.mastar')
@section('title','Finder Xray')
@section('content')
@include('backEnd.patien.slidenav')
<div class="d-flex bg-as" id="wrapper">
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            @include('includes.patientNav')
            <div class="container mb-5">
                <div class="row justify-content-start">
                    @if(count($xray) >= 1)
                    <input type="hidden" name="longitude" class="longitude" value="">
                    <input type="hidden" name="latitude" class="latitude" value="">
                        @foreach($xray as $xray)
                            <div class="col-md-8 ml-auto mr-auto mb-2 pharmacy_item" data-lat="{{$xray->latitude}}" data-lng="{{$xray->longitude}}" data-distance=".distance_{{$xray->xray_id}}">
                                <div class="card finder-card">
                                    <div class="card-header">
                                        <div class="text-primary row h3 font-weight-bold mt-2 mb-2">
                                            <div class="col-lg-1 ml-3">
                                                @if(!$xray->image)
                                                    <img src="{{ asset('uploads/default.png') }}" width="60" height="60" alt="">
                                                @else
                                                    <img src="{{ $xray->image }}" alt="">
                                                @endif
                                            </div>
                                            <div class="col-lg-8 ml-3 mt-auto mb-auto">{{$xray->doctor_name}}</div> @if($xray->xray->is_faviorate == 1)<i class="fa fa-star mt-auto mb-auto" style="color:orange"></i>@endif <br>
                                            <div class="col-lg-1 mt-auto mb-auto">
                                                @if($xray->xray->is_faviorate == 0)
                                                    <form  action="{{route('add_to_faviorate_xray')}}" method="POST" class="col-2">
                                                        {{ csrf_field() }}
                                                        <input type ="hidden" name="patient_id" value="{{$patient->id}}">
                                                        <input type="hidden" name="xray_id" value="{{$xray->xray_id}}">
                                                        <input type="hidden" name="idCode" value="{{$xray->idCode}}">
                                                        <input type="hidden" name="name"   value="{{ $xray->doctor_name }}">
                                                        <input type="hidden" name="type"   value="xray">
                                                        <button type="submit" class="btn btn-outline-primary" id="add_to_faviorate_nurse">
                                                            <i class="fa fa-star "></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mt-2 mb-2"><i class="fa fa-location-arrow"></i> <b>Distance: </b><span class="distance_{{$xray->xray_id}}"></span></div>
                                        <div class="mb-3"><b>Address: </b> {{$xray->address}}.</div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @else
                        <img class="no-data-img animate__animated animate__flash" src="{{url('imgs/no-labs.png')}}" alt="">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{url('js/address.js')}}"></script>
@stop
