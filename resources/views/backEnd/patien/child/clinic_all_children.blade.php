@extends('backEnd.layoutes.mastar')
@section('title','get All Child')
@section('content')
@include('backEnd.clinic.slidenav')
<div class="d-flex img-pop" id="wrapper">
    <div id="page-content-wrapper">
        <!-- Topnav -->
        @include('includes.patientNav')

        <div class="container-fluid mb-5">
            <div class="col-lg-12 ml-auto mr-auto">
                <div class="header img-header pb-6">
                    <div class="container-fluid">
                      <div class="header-body">
                        <div class="row pt-5 col-lg-12 ml-auto mr-auto">
                        @if($patient->childern)
                          @foreach($patient->childern as $child)
                          <a href="{{route('clinic_child_profile',[$clinic->id,$patient->id,$child->id])}}" style="text-decoration:none;" class="kidsLabel col-lg-12 col-md-6 mt-4">
                            <div class="row container">
                                <div class="col-lg-3 ml-5">
                                    <div class="text-center">
                                        <img class="mb-auto mt-auto rounded-circle" src="{{url('uploads/patien/child/' . $child->image)}}" width="90" height="90" alt="...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="h4 font-weight-bold mt-2 text-dark">{{$child->child_name}}</h4>
                                    <h5 class="card-title text-uppercase text-muted mt-2">{{$child->birthDay}}</h5>
                                    <div class="row mt-3">
                                        <div class="h5 text-dark col-lg-2 text-center">Year</div>
                                        <div class="h5 text-dark col-lg-2 text-center">Month</div>
                                        <div class="h5 text-dark col-lg-2 text-center">Day</div>
                                    </div>
                                    <div class="row">
                                        <div class="h4 text-dark col-lg-2 text-center">{{$child->AgeYear}}</div>
                                        <div class="h4 text-dark col-lg-2 text-center">{{$child->AgeMonth}}</div>
                                        <div class="h4 text-dark col-lg-2 text-center">{{$child->AgeDay}}</div>
                                    </div>
                                </div>
                            </div>
                          </a>
                          @endforeach
                          @endif
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        @include('backEnd.layoutes.footer')
        <!-- footer -->
    </div>


@endsection
