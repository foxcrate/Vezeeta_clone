@extends('backEnd.layoutes.mastar')
@section('title','Favorite')
@section('content')
@include('backEnd.patien.slidenav')
<div class="d-flex bg-searchdoctor" id="wrapper">
    <div id="page-content-wrapper">
        <div class="container">
            <div class="row">
                @if($fav)
                    @foreach($fav as $fav)
                        <div class="col-md-8 mt-5 mb-5 ml-auto mr-auto">
                            <div class="card fevo-card ml-auto mr-auto">
                                <div class="card-headerr">
                                    <div class="row mt-3 h5 font-weight-bold">
                                        <div class="col-2 mt-3 ">
                                            @if($fav->type === 'doctor')
                                                @if(!$fav->doctor->image)
                                                <img class="rounded-circle" width="80" height="80" src="{{ asset('uploads/default.png') }}" alt="">
                                                @else
                                                <img class="rounded-circle" width="80" height="80" src="{{ $fav->doctor->image }}" alt="">
                                                @endif
                                            @elseif($fav->type === 'nurse')
                                                @if(!$fav->nurse->image)
                                                <img class="rounded-circle" width="80" height="80" src="{{ asset('uploads/default.png') }}" alt="">
                                                @else
                                                <img class="rounded-circle" width="80" height="80" src="{{ $fav->nurse->image }}" alt="">
                                                @endif
                                            @elseif($fav->type === 'pharmacy')
                                                @if(!$fav->pharmacy->image)
                                                <img class="rounded-circle" width="80" height="80" src="{{ asset('uploads/default.png') }}" alt="">
                                                @else
                                                <img class="rounded-circle" width="80" height="80" src="{{ $fav->pharmacy->image }}" alt="">
                                                @endif
                                            @elseif($fav->type === 'xray')
                                                @if(!$fav->xray->image)
                                                <img class="rounded-circle" width="80" height="80" src="{{ asset('uploads/default.png') }}" alt="">
                                                @else
                                                <img class="rounded-circle" width="80" height="80" src="{{ $fav->xray->image }}" alt="">
                                                @endif
                                            @elseif($fav->type === 'lab')
                                                @if(!$fav->lab->image)
                                                <img class="rounded-circle" width="80" height="80" src="{{ asset('uploads/default.png') }}" alt="">
                                                @else
                                                <img class="rounded-circle" width="80" height="80" src="{{ $fav->lab->image }}" alt="">
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col-8">
                                            <div class="h3 mt-4">{{$fav->name}}</div>
                                            <div class="mb-4">{{$fav->idCode}}</div>
                                            @if($fav->type === 'doctor')
                                                <div class="row h5 text-dark text-capitalize mb-2">
                                                    <div class="col-1"><img src="{{url('imgs/doctor.svg')}}" width="30" class="mr-3"></div>
                                                    <div class="col-10">{{$fav->doctor->special->name}}</div>
                                                </div>
                                                <div class="row h5 text-dark text-capitalize mb-2">
                                                    <div class="col-1"><img src="{{url('imgs/infodoctor.svg')}}" width="30" class="mr-3"></div>
                                                    <div class="col-10">{{$fav->doctor->information}}</div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
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
