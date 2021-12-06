@extends('backEnd.layoutes.mastar')
@section('title','Finder Lab')
@section('content')
@include('backEnd.patien.slidenav')

<div class="d-flex bg-as" id="wrapper">
    <div id="page-content-wrapper">
        @include('includes.patientNav')
        <div class="container mt-5 mb-5">
            <div class="row justify-content-start">
                @if($labs)
                <input type="hidden" name="longitude" class="longitude" value="">
                <input type="hidden" name="latitude" class="latitude" value="">
                    @foreach($labs as $lab)
                        <div class="col-md-8 ml-auto mr-auto mb-2 pharmacy_item" data-lat="{{$lab->latitude}}" data-lng="{{$lab->longitude}}" data-distance=".distance_{{$lab->lab_id}}">
                            <div class="card finder-card">
                                <div class="card-header">
                                    <div class="text-primary row h3 font-weight-bold mt-2 mb-2">
                                        <div class="col-lg-1 ml-3">
                                            @if(!$lab->image)
                                                <img src="{{ asset('uploads/default.png') }}" width="60" height="60" alt="">
                                            @else
                                                <img src="{{ $lab->image }}" alt="">
                                            @endif
                                        </div>
                                        <div class="col-lg-8 ml-3 mt-auto mb-auto">{{$lab->doctor_name}}</div> @if($lab->lab->is_faviorate == 1)<i class="fa fa-star mt-auto mb-auto" style="color:orange"></i>@endif <br>
                                        <div class="col-lg-1 mt-auto mb-auto">
                                            @if($lab->lab->is_faviorate == 0)
                                                <form  action="{{route('add_to_faviorate_lab')}}" method="POST" class="col-2">
                                                    {{ csrf_field() }}
                                                    <input type ="hidden" name="patient_id" value="{{$patient->id}}">
                                                    <input type="hidden" name="lab_id" value="{{$lab->lab_id}}">
                                                    <input type="hidden" name="idCode" value="{{$lab->idCode}}">
                                                    <input type="hidden" name="name"   value="{{ $lab->doctor_name }}">
                                                    <input type="hidden" name="type"   value="lab">
                                                    <button type="submit" class="btn btn-outline-primary" id="add_to_faviorate_nurse">
                                                        <i class="fa fa-star "></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mt-2 mb-2"><i class="fa fa-location-arrow"></i> <b>Distance: </b><span class="distance_{{$lab->lab_id}}"></span></div>
                                    <div class="mb-3"><b>Address: </b> {{$lab->address}}.</div>

                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{url('js/address.js')}}"></script>
@stop
