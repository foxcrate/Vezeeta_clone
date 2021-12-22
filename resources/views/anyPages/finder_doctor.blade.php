@extends('backEnd.layoutes.mastar')
@section('title','Finder Dcctor')
@section('content')
<div class="d-flex bg-as" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        @include('includes.patientNav')
        <div class="container mt-5">
            <div class="text-center mb-5">
                <span><img src="{{url('imgs/finder/DOCTORF.png')}}" width="200"></span>
                <span class="text-white font-weight-bold mt-3 text-decoration" style="font-size:52pt;">Doctor</span>
            </div>
            <ul class="nav nav-pills col-10 ml-auto mr-auto mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link search-doc active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Name</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link search-doc" id="pills-special-tab" data-toggle="pill" href="#pills-special" role="tab" aria-controls="pills-special" aria-selected="true">Speciality</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link search-doc" id="pills-Hospital-tab" data-toggle="pill" href="#pills-Hospital" role="tab" aria-controls="pills-profile" aria-selected="false">Hospital</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link search-doc" id="pills-clinic-tab" data-toggle="pill" href="#pills-clinic" role="tab" aria-controls="pills-profile" aria-selected="false">Clinic</a>
                  </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form class="col-8 ml-auto mr-auto" action="{{route('finder_search_doctor',$patient->id)}}" method="GET">
                        {{-- <input type="hidden" name="patient_id" value="{{$patient->id}}"> --}}
                        <div class="row col-lg-12 ml-auto mr-auto" style="margin-bottom:100px; margin-top:88px;">
                            <div class="col-12">
                                <span class="text-white font-weight-bold text-decoration" style="font-size:25pt;">Search By Doctor Name</span>
                                <div class="form-group">
                                    <input required = "required" type="text" name="search" class="form-control" placeholder="Search By Doctor Name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="submit" value="Search" class="form-control btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="pills-special" role="tabpanel" aria-labelledby="pills-special-tab">
                    <form class="col-8 ml-auto mr-auto" action="{{route('finder_search_doctor',$patient->id)}}" method="GET">
                        {{-- <input type="hidden" name="patient_id" value="{{$patient->id}}"> --}}
                        <div class="row col-lg-12 ml-auto mr-auto" style="margin-bottom:100px; margin-top:88px;">
                            <div class="col-12">
                                <span class="text-white font-weight-bold text-decoration" style="font-size:25pt;">Search By Doctor Speciality</span>
                                <div class="form-group">
                                    <input required = "required" type="text" name="search" class="form-control" placeholder="Search By Doctor Speciality">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="submit" value="Search" class="form-control btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="pills-Hospital" role="tabpanel" aria-labelledby="pills-Hospital-tab">
                    <form class="col-8 ml-auto mr-auto" action="{{route('searchDoctorInHosptail',$patient->id)}}" method="GET">
                        {{-- <input type="hidden" name="patient_id" value="{{$patient->id}}"> --}}
                        <div class="row col-lg-12 ml-auto mr-auto" style="margin-bottom:100px; margin-top:88px;">
                            <div class="col-12">
                                <span class="text-white font-weight-bold text-decoration" style="font-size:25pt;">Search By Hospital</span>
                                <div class="form-group">
                                    <input required = "required" type="text" name="hosptailName" class="form-control" placeholder="Search By Hosptail Name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="submit" value="Search" class="form-control btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-clinic" role="tabpanel" aria-labelledby="pills-clinic-tab">
                    <form class="col-8 ml-auto mr-auto" action="{{route('searchDoctorInClinic',$patient->id)}}" method="GET">
                        {{-- <input type="hidden" name="patient_id" value="{{$patient->id}}"> --}}
                        <div class="row col-lg-12 ml-auto mr-auto" style="margin-bottom:100px; margin-top:88px;">
                            <div class="col-12">
                                <span class="text-white font-weight-bold text-decoration" style="font-size:25pt;">Search By Clinic</span>
                                <div class="form-group">
                                    <input required = "required" type="text" name="clinicName" class="form-control" placeholder="Search By Clinic Name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="submit" value="Search" class="form-control btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- footer -->
        <footer class="footer" style="position: fixed; bottom:0; width:100%">
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




