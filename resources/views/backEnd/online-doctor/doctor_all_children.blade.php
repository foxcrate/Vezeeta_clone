@extends('backEnd.layoutes.mastar')
@section('title','Doctor Show All Children')
@section('content')
@include('backEnd.online-doctor.sidenav')
<div class="d-flex img-pop" id="wrapper">
    <div id="page-content-wrapper">
        <!-- Topnav -->
        <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
            <div class="container-fluid p-3">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar links -->
                <button class="btn btn-outline-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars text-white" aria-hidden="true"></i></button>
                <!-- Search form -->
                <div class="col-6 ml-lg-5">
                        <h4 class="card-title text-uppercase text-white mb-2">
                            Dr {{$online_doctor->name}}</h4>
                        <h5 class="card-title text-uppercase text-white mb-0">{{$online_doctor->idCode}}</h5>
                        <h5 class="card-title text-white mb-0">{{$online_doctor->Primary_Speciality}}</h5>
                        <span class="h4 font-weight-bold mb-0"></span>
                </div>
              </div>
            </div>
        </nav>
        <div class="container-fluid mb-5">
            <div class="col-lg-12 ml-auto mr-auto">
                <div class="header img-header pb-6">
                    <div class="container-fluid">
                      <div class="header-body">
                        <div class="row pt-5 col-lg-12 ml-auto mr-auto">
                        @if($patient->childern)
                          @foreach($patient->childern as $child)
                          <a href="{{route('doctor_show_profile_child',[$online_doctor->id,$patient->id,$child->id])}}" style="text-decoration:none;" class="kidsLabel col-lg-12 col-md-6 mt-4">
                            <div class="row container">
                                <div class="col-lg-3 ml-5">
                                    <div class="text-center">
                                        <img class="mb-auto mt-auto" src="{{url('uploads/patien/child/' . $child->image)}}" width="90" alt="...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="h4 font-weight-bold mt-2 text-dark">{{$child->child_name}}</h4>
                                    <h5 class="card-title text-uppercase text-muted mt-2">{{$child->birthDay}}</h5>
                                    <div class="row mt-3">
                                        <div class="h5 col-lg-2 text-center">Year</div>
                                        <div class="h5 col-lg-2 text-center">Month</div>
                                        <div class="h5 col-lg-2 text-center">Day</div>
                                    </div>
                                    <div class="row">
                                        <div class="h4 col-lg-2 text-center">{{$child->AgeYear}}</div>
                                        <div class="h4 col-lg-2 text-center">{{$child->AgeMonth}}</div>
                                        <div class="h4 col-lg-2 text-center">{{$child->AgeDay}}</div>
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
