@extends('backEnd.layoutes.mastar')
@section('title',$patient->firstName . ' ' . $patient->middleName)
@section('content')

<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.hosptail.sidenav')
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
                  <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                          <img alt="Image placeholder" src="{{url('imgs/team-1.jpg')}}">
                        </span>
                        <div class="media-body ml-3 mr-3 d-lg-block">
                          <h6 class="mb-0 font-weight-bold text-white">Mohamed Ahmed</h6>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>

    <!-- informationContent -->
    <div class="container-fluid mb-5">
      <div class="row pt-5">
          <div class="col-md-10 slide-img mb-3 mr-auto ml-auto ">
              <img class="d-xs-none" id="about-img" src="{{url('imgs/s1.jpg')}}" height="300" width="895" alt="Responsive image">
          </div>
          <div class="col-xl-4 col-md-4 mb-5  mr-auto ml-auto">
              <!-- Button trigger modal -->
              <div class="text-center">
                  <button type="button" class="btn btn-primary text-white col-6" data-toggle="modal" data-target="#Testing">
                      <i class="fas fa-eye mr-2"></i> Show
                  </button>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="Testing" tabindex="-1" role="dialog" aria-pharmacyelledby="exampleModalpharmacyel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalpharmacyel">Raoucheh </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-pharmacyel="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <div class="col-md-12">
                                  @if($patient->Raoucheh)
                                  @foreach($patient->Raoucheh as $ro)
                                  <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                      <div class="col-12">

                                          <h5 class="mt-4 float-right">{{$ro->created_at}}</h5>
                                      </div>
                                      <div class="row col-12 mb-3">
                                          <div class="col-4">
                                              {{-- <h5 class="font-weight-bold">Pharmacy</h5> --}}
                                              <h5 class="font-weight-bold">State</h5>
                                          </div>
                                          <div class="col-6">
                                              <h5 class="">{{$ro->prescription}}</h5>
                                          </div>
                                      </div>
                                      <div class="row col-12 mb-3">
                                          <div class="col-10 ml-auto mr-auto">
                                              <h5 class="font-weight-bold">Medication</h5>
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
                                                  @foreach(json_decode($ro->medication) as $medication)
                                                  <tr>
                                                    <td class="text-center border-0">{{$medication->medication_name}}</td>
                                                    <td class="text-center border-0">{{$medication->times_day}}</td>
                                                    <td class="text-center border-0">{{$medication->time}}</td>
                                                  </tr>
                                                  @endforeach
                                                </tbody>
                                              </table>
                                            </div>
                                          @endif
                                      </div>
                                      <div class="row col-12 mb-3">
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


                                    
          <div class="col-xl-4 col-md-4 mb-5  mr-auto ml-auto">
              <!-- Button trigger modal -->
              <div class="text-center">
                  <button type="button" class="btn btn-primary text-white col-6" data-toggle="modal" data-target="#TestingChild">
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
                                      <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                          <div class="col-12">
                                              <h5 class="mt-4 float-right">{{$ro->created_at}}</h5>
                                          </div>
                                          <div class="row col-12 mb-3">
                                              <div class="col-4">
                                                  {{-- <h5 class="font-weight-bold">Pharmacy</h5> --}}
                                                  <h5 class="font-weight-bold">State</h5>
                                              </div>
                                              <div class="col-6">
                                                  <h5 class="">{{$ro->prescription}}</h5>
                                              </div>
                                          </div>
                                          <div class="row col-12 mb-3">
                                              <div class="col-10 ml-auto mr-auto">
                                                  <h5 class="font-weight-bold">Medication</h5>
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
                                                      @foreach(json_decode($ro->medication) as $medication)
                                                      <tr>
                                                        <td class="text-center border-0">{{$medication->name}}</td>
                                                        <td class="text-center border-0">{{$medication->times_day}}</td>
                                                        <td class="text-center border-0">{{$medication->time}}</td>
                                                      </tr>
                                                      @endforeach
                                                    </tbody>
                                                  </table>
                                                </div>
                                              @endif
                                          </div>
                                          <div class="row col-12 mb-3">
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