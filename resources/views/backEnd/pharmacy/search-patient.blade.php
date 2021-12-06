@extends('backEnd.layoutes.mastar')
@section('title',$patient->firstName . ' ' . $patient->middleName)
@section('content')

    <div class="d-flex bg-page" id="wrapper">
    @include('backEnd.pharmacy.slidenav')
    <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Navbar links -->
                        <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                        <ul class="navbar-nav align-items-center ml-md-auto">

                        </ul>
                        <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">

                        </ul>
                    </div>
                </div>
            </nav>
            <!-- informationContent -->
            <div class="container-fluid mb-5">
                <div class="row pt-5">
                    <div class="col-lg-9 mb-3 mr-auto ml-auto ">
                        <img class="d-xs-none" id="about-img" src="{{url('imgs/xrayandlabs.svg')}}" alt="Responsive image">
                    </div>
                    <div class="col-lg-6 mb-5 mr-auto ml-auto">
                        <!-- Button trigger modal -->
                        <div class="text-center">
                            <button type="button" class="btn btn-primary text-white col-6 h5" data-toggle="modal" data-target="#Testing">
                                <i class="fas fa-eye mr-2"></i> Show Patient Prescrption
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="Testing" tabindex="-1" role="dialog" aria-pharmacyelledby="exampleModalpharmacyel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalpharmacyel">Prescrption </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-pharmacyel="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            @if($patient->Raoucheh)
                                                @foreach($patient->Raoucheh as $ro)
                                                    <div class="pills-main pills-main-yellow col-xl-11 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                                    <div class="row col-lg-10 ml-5 mt-5">
                                                      <div class="row col-lg-12">
                                                        <div class="col-5">
                                                          <h5 class="font-weight-bold text-primary">Dr.</h5>
                                                        </div>
                                                        <div class="col-5">
                                                          <h5 class="">{{$ro->online_doctor->name}}</h5>
                                                        </div>
                                                      </div>
                                                      <div class="row col-lg-12">
                                                        <div class="col-5">
                                                          <h5 class="font-weight-bold text-primary">Speciality :</h5>
                                                        </div>
                                                        <div class="col-5">
                                                          <h5 class="">{{$ro->online_doctor->special->name}}</h5>
                                                        </div>
                                                      </div>
                                                      <div class="row col-lg-12">
                                                        <div class="col-5">
                                                          <h5 class="font-weight-bold text-primary">Date:</h5>
                                                        </div>
                                                        <div class="col-5">
                                                          <h5 class="">{{$ro->created_at}}</h5>
                                                        </div>
                                                      </div>
                                                      <div class="row col-lg-12">
                                                        <div class="col-5">
                                                          <h5 class="font-weight-bold text-primary">Patient State :</h5>
                                                        </div>
                                                        <div class="col-5">
                                                          <h5 class="">{{$ro->prescription}}</h5>
                                                        </div>
                                                      </div>
                                                    </div>

                                                    <hr class="col-lg-11 ml-auto mr-auto mb-5" />
                                                    <div class="row col-lg-12 mb-3">
                                                        <div class="col-10 ml-auto mr-auto">
                                                            <h5 class="font-weight-bold text-primary">Medication</h5>
                                                        </div>
                                                        @if($ro->medication)
                                                          <div class="col-10 ml-auto mr-auto">
                                                            <table class="table">
                                                              <tbody>
                                                                <tr>
                                                                  <th class="text-center">Medication Name</th>
                                                                  <th class="text-center">Times Day</th>
                                                                  <th class="text-center">Time</th>
                                                                </tr>
                                                                @foreach($ro->medication as $medication)
                                                                <tr>
                                                                  <td class="text-center border-0 h5">{{$medication['name']}}</td>
                                                                  <td class="text-center border-0 h5">{{$medication['times_day']}}</td>
                                                                  <td class="text-center border-0 h5">{{$medication['time']}}</td>
                                                                </tr>
                                                                @endforeach
                                                              </tbody>
                                                            </table>
                                                          </div>
                                                        @endif
                                                    </div>
                                                  </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5 mr-auto ml-auto">
                        <!-- Button trigger modal -->
                        <div class="text-center">
                            <button type="button" class="btn btn-primary text-white col-6 h6" data-toggle="modal" data-target="#TestingChild">
                                <i class="fas fa-eye mr-2"></i> Child Prescription
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="TestingChild" tabindex="-1" role="dialog" aria-pharmacyelledby="exampleModalpharmacyelChild" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalpharmacyelChild">Child Prescription </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-pharmacyel="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            @if($patient->childern)
                                                @foreach($patient->childern as $child)
                                                    @foreach ($child->rocatas as $ro )
                                                        <div class="pills-main pills-main-yellow col-xl-11 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                                            <div class="row col-lg-10 ml-5 mt-5">
                                                                <h5 class="text-capitalize font-weight-bold mb-3">{{ $child->child_name}}</h5>
                                                                <div class="row col-lg-12">
                                                                    <div class="col-3">
                                                                      <h5 class="font-weight-bold text-primary">Dr.</h5>
                                                                    </div>
                                                                    <div class="col-5">
                                                                      <h5 class="">{{$ro->online_doctor->name}}</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row col-lg-12">
                                                                    <div class="col-3">
                                                                    <h5 class="font-weight-bold text-primary">Date:</h5>
                                                                    </div>
                                                                    <div class="col-5">
                                                                    <h5 class="">{{$ro->created_at}}</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row col-lg-12">
                                                                    <div class="col-3">
                                                                        <h5 class="font-weight-bold text-primary">State</h5>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <h5 class="">{{$ro->prescription}}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr class="col-lg-11 ml-auto mr-auto mb-5" />
                                                            <div class="row col-lg-12">
                                                                <div class="col-10 ml-auto mr-auto">
                                                                    <h5 class="font-weight-bold text-primary">Medication</h5>
                                                                </div>
                                                                @if($ro->medication)
                                                                <div class="col-10 ml-auto mr-auto">
                                                                    <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                        <th class="text-center">Medication Name</th>
                                                                        <th class="text-center">Times Day</th>
                                                                        <th class="text-center">Time</th>
                                                                        </tr>
                                                                        @foreach($ro->medication as $medication)
                                                                            <tr>
                                                                                <td class="text-center border-0">{{$medication['name']}}</td>
                                                                                <td class="text-center border-0">{{$medication['times_day']}}</td>
                                                                                <td class="text-center border-0">{{$medication['time']}}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                    </table>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('backEnd.layoutes.footer')
        </div>


@stop
