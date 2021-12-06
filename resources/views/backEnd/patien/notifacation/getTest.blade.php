@extends('backEnd.layoutes.mastar')
@section('title','Test')
@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/styleRate.css') }}">
@stop
@php
$patientAnalzazes = $patient->patient_analzes;
@endphp
<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.patien.slidenav')
    <!-- Page Content -->
    <div id="page-content-wrapper">
        @include('includes.patientNav')
        <!-- informationContent -->
        <div class="container-fluid">
            <div class="header img-header pb-5">
                <ul class="nav nav-pills col-7 ml-auto mr-auto mt-5 mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link test_pres font-weight-bold active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tests</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="header-body">
                            <div class="row pt-5 col-l2 ml-auto mr-auto">
                                @if($patientAnalzazes)
                                    @foreach(auth()->guard('patien')->user()->patient_analzes as $p_analzes)
                                        <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                            <div class="col-12">
                                                <h5 class="mt-4 float-right">{{$p_analzes->created_at}}</h5>
                                            </div>
                                            <div class="row col-12 mb-3">
                                                <div class="col-3">
                                                    <h5 class="font-weight-bold">Name</h5>
                                                </div>
                                                <div class="col-8">
                                                    @foreach ($p_analzes->test_name as $test_name)
                                                        <h5 class="">{{ $test_name['test_name'] }}</h5>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="row col-12 mb-3">
                                                <div class="col-3">
                                                    <h5 class="font-weight-bold">Description</h5>
                                                </div>
                                                <div class="col-8">
                                                    @foreach ($p_analzes->test_name as $test_name)
                                                        <h5 class="">{{ $test_name['test_description'] }}</h5>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="row col-12 mb-3">
                                                <div class="col-3">
                                                    <h5 class="font-weight-bold" id = "btn_result">Result : </h5>
                                                </div>
                                                <div class="col-7">
                                                    @if($p_analzes->link)
                                                        <a target="_blank" id = "link_result_show" href="{{$p_analzes->link['URLLink']}}">{{$p_analzes->link['name']}}</a>
                                                    @else
                                                    <div class="alert alert-danger">No Result</div>
                                                    @endif
                                                </div>
                                                <div class="col-2">
                                                    <a href="#" data-toggle="modal" data-target="#exampleModal">
                                                        <img class="col-12" src="{{ asset('imgs/rate.svg') }}" width="140" alt="">
                                                    <a>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog modal-lg">
                                                        <div class="modal-content text-center">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Reveiw Doctor</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body mb-5">
                                                                <div class="h4 text-dark text-capitalize mt-3"></div>
                                                                <div>
                                                                    <form action="{{ route('addRateXray') }}" method="POST">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="patient_id" value=" {{ $patient->id }}">
                                                                        <input type="hidden" name="xray_id" value="{{ $p_analzes->id }}">
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
                                    @endforeach
                                @else
                                    <p class="alert alert-danger">No Data</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Start-Footer-->
@include('backEnd.layoutes.footer')
<!--End-Footer-->
@stop
