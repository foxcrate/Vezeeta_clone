@extends('backEnd.layoutes.mastar')
@section('title','patient Appoinments')
@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/styleRate.css') }}">
@stop
@include('backEnd.patien.slidenav')
<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
         <!-- main content -->
        <div class="main-content" id="panel">
            <!-- Topnav -->
            @include('includes.patientNav')
            <div class="container mt-5 mb-5">
                @if($patient->doctor_scudule)
                    @foreach ($patient->doctor_scudule as $scudule)
                        <div class="col-md-11 ml-auto mr-auto mb-2 pharmacy_item">
                            <div class="card-appo">
                                <div class="">
                                    <div class="row col mr-auto ml-auto pt-3 pl-3 pr-3">
                                        <div class="row alert alert-secondary col-lg-12 ml-auto mr-auto" role="alert">
                                            <h4 class="col-10 mt-auto mb-auto">{{$scudule->is_accept == '1' ? 'Booking is  Accepted !'  : 'Pending ..'}} </h4>
                                            <div class="col-2 rating-img">
                                                {{--  <a href="#" data-toggle="modal" data-target="#exampleModal">  --}}
                                                    <img data-toggle="modal" data-target="#exampleModal" class="col-8" src="{{ asset('imgs/rate.svg') }}" width="140" alt="">
                                                {{--  <a>  --}}
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog modal-lg">
                                                        <div class="modal-content text-center">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Reveiw Doctor </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body mb-5">
                                                                <div class="col-lg-2 mr-auto ml-auto p-3">
                                                                    @if(!$scudule->appoiment->doctor->image)
                                                                        <img width="120" height="120" class="rounded-circle" alt="Image placeholder" src="{{asset('uploads/default.png')}}">
                                                                    @else
                                                                        <img width="120" height="120" class="rounded-circle" alt="Image placeholder" src="{{$scudule->appoiment->doctor->image}}">
                                                                    @endif
                                                                </div>
                                                                <div class="h4 text-dark text-capitalize mt-3"> {{ $scudule->appoiment->doctor_name}}</div>
                                                                <div>
                                                                    <form action="{{ route('addRateDoctor') }}" method="POST">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="patient_id" value=" {{ $patient->id }}">
                                                                        <input type="hidden" name="doctor_id" value="{{ $scudule->appoiment->doctor_id }}">
                                                                        <fieldset class="rate">
                                                                            <input type="radio" id="rating10"name="rating" value="10" /><label for="rating10" title="5 stars"></label>
                                                                            <input type="radio" id="rating9" name="rating" value="9" /><label class="half" for="rating9" title="4 1/2 stars"></label>
                                                                            <input type="radio" id="rating8" name="rating" value="8" /><label for="rating8" title="4 stars"></label>
                                                                            <input type="radio" id="rating7" name="rating" value="7" /><label class="half" for="rating7" title="3 1/2 stars"></label>
                                                                            <input type="radio" id="rating6" name="rating" value="6" /><label for="rating6" title="3 stars"></label>
                                                                            <input type="radio" id="rating5" name="rating" value="5" /><label class="half" for="rating5" title="2 1/2 stars"></label>
                                                                            <input type="radio" id="rating4" name="rating" value="4" /><label for="rating4" title="2 stars"></label>
                                                                            <input type="radio" id="rating3" name="rating" value="3" /><label class="half" for="rating3" title="1 1/2 stars"></label>
                                                                            <input type="radio" id="rating2" name="rating" value="2" /><label for="rating2" title="1 star"></label>
                                                                            <input type="radio" id="rating1" name="rating" value="1" /><label class="half" for="rating1" title="1/2 star"></label>
                                                                        </fieldset>
                                                                        <div class="row ml-auto mr-auto">
                                                                            <div class="row col-lg-8 ml-auto mr-auto">
                                                                                <h4 class="col-3 font-weight-bold text-left">Receiption</h4>
                                                                                <div class="col-8">
                                                                                    <input type="radio" id="item1yes" name="receiption" value="1" class="is-hidden" />
                                                                                    <label for="item1yes" class="btnx btn--yes">
                                                                                        <i class="fas fa-thumbs-up icons"></i>
                                                                                    </label>
                                                                                    <input type="radio" id="item1no" name="receiption" value="0" class="is-hidden" />
                                                                                    <label for="item1no" class="btnx btn--no">
                                                                                        <i class="fas fa-thumbs-down icons"></i>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row col-lg-8 ml-auto mr-auto">
                                                                                <h4 class="col-3 font-weight-bold text-left">Price</h4>
                                                                                <div class="col-8">
                                                                                    <input type="radio" id="item2yes" name="price" value="1" class="is-hidden" />
                                                                                    <label for="item2yes" class="btnx btn--yes">
                                                                                        <i class="fas fa-thumbs-up icons"></i>
                                                                                    </label>
                                                                                    <input type="radio" id="item2no" name="price" value="0" class="is-hidden" />
                                                                                    <label for="item2no" class="btnx btn--no">
                                                                                        <i class="fas fa-thumbs-down icons"></i>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row col-lg-8 ml-auto mr-auto">
                                                                                <h4 class="col-3 font-weight-bold text-left">Cleanliness</h4>
                                                                                <div class="col-8">
                                                                                    <input type="radio" id="item3yes" name="cleanliness" value="1" class="is-hidden" />
                                                                                    <label for="item3yes" class="btnx btn--yes">
                                                                                        <i class="fas fa-thumbs-up icons"></i>
                                                                                    </label>
                                                                                    <input type="radio" id="item3no" name="cleanliness" value="0" class="is-hidden" />
                                                                                    <label for="item3no" class="btnx btn--no">
                                                                                        <i class="fas fa-thumbs-down icons"></i>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row col-lg-8 ml-auto mr-auto">
                                                                                <h4 class="col-3 font-weight-bold text-left">Nursing</h4>
                                                                                <div class="col-8">
                                                                                    <input type="radio" id="item4yes" name="nursing" value="1" class="is-hidden" />
                                                                                    <label for="item4yes" class="btnx btn--yes">
                                                                                        <i class="fas fa-thumbs-up icons"></i>
                                                                                    </label>
                                                                                    <input type="radio" id="item4no" name="nursing" value="0" class="is-hidden" />
                                                                                    <label for="item4no" class="btnx btn--no">
                                                                                        <i class="fas fa-thumbs-down icons"></i>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row col-lg-8 ml-auto mr-auto">
                                                                                <h4 class="col-3 font-weight-bold text-left">Servicing</h4>
                                                                                <div class="col-8">
                                                                                    <input type="radio" id="item5yes" name="servicing" value="1" class="is-hidden" />
                                                                                    <label for="item5yes" class="btnx btn--yes">
                                                                                        <i class="fas fa-thumbs-up icons"></i>
                                                                                    </label>
                                                                                    <input type="radio" id="item5no" name="servicing" value="0" class="is-hidden" />
                                                                                    <label for="item5no" class="btnx btn--no">
                                                                                        <i class="fas fa-thumbs-down icons"></i>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <button type="submit" class="btn btn-success h5 col-lg-6 mt-5">Add Rate</button>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 mr-auto ml-auto p-3">
                                            @if(!$scudule->appoiment->doctor->image)
                                                <img width="140" height="140" class="rounded-circle" alt="Image placeholder" src="{{asset('uploads/default.png')}}">
                                            @else
                                                <img width="140" height="140" class="rounded-circle" alt="Image placeholder" src="{{$scudule->appoiment->doctor->image}}">
                                            @endif
                                        </div>
                                        <div class="col-lg-10 pl-5">
                                            <div class="h3 font-weight-bold text-capitalize mb-4">
                                            {{ $scudule->patient_name}}
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <img src="{{url('imgs/doctor.svg')}}" width="35" class="col-1" >
                                                <div class="col-8 mr-3">{{ $scudule->appoiment->doctor_name}}</div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <img src="{{url('imgs/infodoctor.svg')}}" width="30" class="col-1" >
                                                <div class="col-8 mr-3">{{ $scudule->appoiment->special}}</div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <img src="{{url('imgs/location.svg')}}" width="25" class="col-1">
                                                <div class="col-8 mr-3"> {{$scudule->appoiment->address}}</div>
                                            </div>
                                            {{-- <div><i class="fa fa-location-arrow text-primary"></i>
                                                Distance:<span class="distance_{{$doctor->id}}"></span>
                                            </div> --}}
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <img src="{{url('imgs/money.svg')}}" width="25" class="col-1"  >
                                                <div class="col-8 mr-3">Fees: {{$scudule->appoiment->fees}} EGP </div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <img src="{{url('imgs/wiating.svg')}}" width="20" class="col-1"  >
                                                <div class="col-8 mr-3">Waiting Time: {{$scudule->appoiment->wating}} </div>
                                            </div>
                                            <div class="row h5 text-dark text-capitalize mb-2">
                                                <img src="{{url('imgs/phone.svg')}}" width="25" class="col-1" >
                                                <div class="col-8 mr-3">{{$scudule->appoiment->phoneNumber}}</div>
                                            </div>

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
<!-- footer -->
@include('backEnd.layoutes.footer')
<!-- footer -->

@stop
