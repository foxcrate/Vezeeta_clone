@extends('backEnd.layoutes.mastar')
@section('title','Prescription')
@section('content')
@php
    $Raoucheh = $patient->Raoucheh;
@endphp
<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.patien.slidenav')
    <!-- Page Content -->
    <div id="page-content-wrapper">
        @include('includes.patientNav')
      <!-- informationContent -->
        <div class="container-fluid">
            <div class="header img-header pb-6">
                <ul class="nav nav-pills col-7 ml-auto mr-auto mt-5 mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link test_pres font-weight-bold active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Prescription</a>
                    </li>
                </ul>
                <div class="tab-content mb-5" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="header-body">
                            <div class="row pt-5">
                                <!-- roachata -->
                                @if($Raoucheh)
                                    @foreach($Raoucheh as $Raoucheh)
                                        <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                            <div class="row col-lg-12 mt-4">
                                                <div class="col-3">
                                                    <h5 class="font-weight-bold text-primary">Dr.</h5>
                                                </div>
                                                <div class="col-5">
                                                    <h5 class="">{{$Raoucheh->online_doctor->name}}</h5>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12">
                                                <div class="col-3">
                                                    <h5 class="font-weight-bold text-primary">Speciality :</h5>
                                                </div>
                                                <div class="col-5">
                                                    <h5 class="">{{$Raoucheh->online_doctor->special->name}}</h5>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12">
                                                <div class="col-3">
                                                    <h5 class="font-weight-bold text-primary">Date:</h5>
                                                </div>
                                                <div class="col-5">
                                                <h5 class="">{{$Raoucheh->created_at}}</h5>
                                                </div>
                                            </div>
                                            <div class="row col-12 mb-4">
                                                <div class="col-3">
                                                    <h5 class="font-weight-bold text-primary">State</h5>
                                                </div>
                                                <div class="col-5">
                                                    <h5 class="">{{$Raoucheh->prescription}}</h5>
                                                </div>
                                            </div>
                                            <div class="row col-12 mb-3">
                                                <div class="col-4">
                                                    <h5 class="font-weight-bold text-primary">Medication</h5>
                                                </div>
                                                @if($Raoucheh->medication)
                                                    <table class ="table">
                                                        <div class="row col-lg-12 mb-3">
                                                            @if($Raoucheh->medication)
                                                            <div class="col-10 ml-auto mr-auto">
                                                                <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                    <th class="text-center">Medication Name</th>
                                                                    <th class="text-center">Times Day</th>
                                                                    <th class="text-center">Time</th>
                                                                    </tr>
                                                                    @foreach($Raoucheh->medication as $medication)
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
                                                    </table>
                                                @endif

                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="alert alert-danger">No Data</p>
                                @endif
                                <!-- roachata -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Start-Footer-->
        @include('backEnd.layoutes.footer')
        <!--End-Footer-->
    </div>
</div>

@stop
