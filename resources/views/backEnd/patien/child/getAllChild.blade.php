@extends('backEnd.layoutes.mastar')
@section('title','get All Child')
@section('content')
@include('backEnd.patien.slidenav')
<div class="img-pop d-flex" id="wrapper">
    <div id="page-content-wrapper">
        <!-- Topnav -->
        @include('includes.patientNav')
        {{-- <img src="{{url('imgs/kidscoveer.jpg')}}" class="text-center" width="1670"> --}}
        <div class="container-fluid mb-3">
            <div class="col-lg-12 ml-auto mr-auto">

                <div class="row pt-5 col-lg-10 ml-auto mr-auto">
                    @if($patient->childern->count() >= 1 )
                        @foreach($patient->childern as $child)
                            <a href="{{route('patient.child.profile',[$patient->id,$child->id])}}" style="text-decoration:none;" class="kidsLabel col-lg-10 col-md-6 ml-auto mr-auto mt-4 mb-3">
                                <div class="row container">
                                    <div class="col-lg-3 ml-5">
                                        <div class="text-center">
                                            <img class="mb-auto mt-auto rounded-circle" src="{{$child->image}}" width="140" height="140" alt="...">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h4 class="text-capitalize h4 font-weight-bold mt-2 text-white">{{$child->child_name}} <span>{{$child->patient->gender == 'male' ? $child->patient->lastName : ''}}</span></h4>
                                        <h5 class="font-weight-bold card-title text-uppercase text-white mt-2">{{date('d/m/Y',$child->birthDay)}}</h5>
                                        <div class="row mt-3">
                                            <div class="h5 col-lg-2 text-center text-white font-weight-bold">Year</div>
                                            <div class="h5 col-lg-2 text-center text-white font-weight-bold">Month</div>
                                            <div class="h5 col-lg-2 text-center text-white font-weight-bold">Day</div>
                                        </div>
                                        <div class="row">
                                            <div class="h4 col-lg-2 text-center text-white">{{$child->CalcAgeYear}}</div>
                                            <div class="h4 col-lg-2 text-center text-white">{{$child->CalcAgeMonth}}</div>
                                            <div class="h4 col-lg-2 text-center text-white">{{$child->CalcAgeDay}}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                    <img class="no-data-img animate__animated animate__flash" src="{{url('imgs/no-children.png')}}" alt="">
                    @endif

                    <div class="col-lg-12 mt-5 text-center">
                        <a href="{{route('patients.kids',$patient->id)}}" class="col-lg-3 btn btn-warning text-white h5"><i class="fa fa-plus mr-3"></i>Add Child</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- footer -->
        <footer class="footer">
            <div class="container-fluid text-center">
                <div class="row copy-right p-2">
                  <div class="col-md-6">
                    <h6 class="mt-3">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | by <a href="index.html" target="">PHistory</a></h6>
                  </div>
                  <div class="social-icon col-md-6">
                      <a href="https://m.facebook.com/Patient-history-102419981434494/" target="_blank"><i class="m-2 hvr-grow fab fa-facebook-f fa-1x"></i></a>
                      <a href="https://twitter.com/phistory3" target="_blank"><i class="m-2 hvr-grow fab fa-twitter fa-1x"></i></a>
                      <a href="https://www.instagram.com/patient_history_/" target="_blank"><i class="m-2 hvr-grow fab fa-instagram fa-1x"></i></a>
                      <a href="patienthistory1@gmail.com" target="_blank" ><i class="m-2 hvr-grow fab fa-google-plus-g fa-1x"></i></a>
                  </div>
                </div>
            </div>
        </footer>
        <!-- footer -->
    </div>
</div>


@endsection
