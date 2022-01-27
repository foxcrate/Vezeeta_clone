@extends('backEnd.layoutes.mastar')
@section('title','profile ' . $child->child_name)
@section('content')
@include('backEnd.patien.slidenav')
<div class="d-flex img-pop" id="wrapper">
    <div id="page-content-wrapper">
        <!-- Topnav -->
        @include('includes.patientNav')
        <div class="container">
            <div class="ml-auto mr-auto">
                <div class="header img-header pb-6">
                      <div class="mb-5">
                        <div class="row pt-5 col-lg-12 ml-auto mr-auto">
                          <div class="kidsLabel col-lg-12 col-md-6 ml-auto mr-auto">
                            <div class="row container">
                                <div class="col-lg-3 ml-5">
                                    <div class="text-center">
                                        <img class="mb-auto mt-auto rounded-circle" src="{{url($child->image)}}" width="140" height="140" alt="...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="h4 font-weight-bold text-capitalize text-white">{{$child->child_name}} <span>{{$child->patient->gender == 'male' ? $child->patient->lastName : ''}}</span></h4>
                                    <h5 class=" font-weight-bold text-white mt-2">Bith Date: {{date('d/m/Y',$child->birthDay)}}</h5>
                                    <div class="row mt-2">
                                        <div class="h5 col-lg-2 text-center font-weight-bold text-white">Year</div>
                                        <div class="h5 col-lg-2 text-center font-weight-bold text-white">Month</div>
                                        <div class="h5 col-lg-2 text-center font-weight-bold text-white">Day</div>
                                    </div>
                                    <div class="row">
                                        <div class="h4 col-lg-2 font-weight-bold text-center text-white">{{$child->CalcAgeYear}}</div>
                                        <div class="h4 col-lg-2 font-weight-bold text-center text-white">{{$child->CalcAgeMonth}}</div>
                                        <div class="h4 col-lg-2 font-weight-bold text-center text-white">{{$child->CalcAgeDay}}</div>
                                    </div>
                                    <a class="col-lg-6 btn btn-primary text-capitalize mt-3" href="{{route('patient.child.editProfile',[$patient->id,$child->id])}}}"><i class="fa fa-edit mr-3"></i>Edit</a>
                                    <a class="col-lg-6 btn btn-danger text-capitalize mt-3" href="#">Remove</a>
                                </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 ml-auto mr-auto">
                            <div class="pills-main-green-kids card card-stats mt-5">
                              <!-- Card body -->
                              <div class="mt-2">
                                <div class="row col-lg-10 ml-auto mr-auto mt-5 mb-5">
                                  <div class="col">
                                    <h5 class="card-title text-uppercase text-dark mb-3">Height</h5>
                                    <span class="h4 font-weight-bold text-dark mb-0">{{$child->height}} Cm</span>
                                  </div>
                                  <div class="col-auto">
                                    <div>
                                      <img src="{{url('imgs/height.png')}}" width="60" alt="...">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 ml-auto mr-auto">
                            <div class="pills-main-green-kids card card-stats mt-5">
                              <!-- Card body -->
                              <div class="mt-2">
                                <div class="row col-lg-10 ml-auto mr-auto mt-5 mb-5">
                                  <div class="col">
                                    <h5 class="card-title text-uppercase text-dark mb-3">Weight</h5>
                                    <span class="h3 font-weight-bold text-dark mb-0">{{$child->weight . $child->weight_type}}</span>
                                  </div>
                                  <div class="col-auto">
                                    <div>
                                      <img src="{{url('imgs/Wight.png')}}" width="60" alt="...">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 ml-auto mr-auto">
                            <div class="pills-main-green-kids card card-stats mt-5">
                              <!-- Card body -->
                              <div class="mt-2">
                                <div class="row col-lg-10 ml-auto mr-auto mt-5 mb-5">
                                  <div class="col">
                                    <h5 class="card-title text-uppercase text-dark mb-3">Blood</h5>
                                    <span class="h3 font-weight-bold mb-0 text-dark">{{$child->blood}}</span>
                                  </div>
                                  <div class="col-auto">
                                    <div>
                                      <img src="{{url('imgs/blood.png')}}" width="60" alt="...">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 ml-auto mr-auto">
                <div class="pills-main-yellow-kids card card-stats mt-3">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <h5 class="card-title text-uppercase text-dark mb-3">Diseases</h5>
                            </div>
                            @php
                                //$disease = json_decode($child->disease);
                                $disease = $child->disease ;
                            @endphp
                            @if($disease)
                                @foreach($disease as $disease)
                                    <div class="col-lg-8 ml-auto mr-auto row">
                                        <div class="col-2">
                                            <img src="{{url('imgs/01.png')}}" width="40" alt="...">
                                        </div>
                                        <div class="col-8">
                                            <h5 class="mt-3">
                                                {{$disease}}
                                            </h5>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 ml-auto mr-auto">
                <div class="pills-main-yellow-kids card card-stats mt-3">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="card-title text-uppercase text-dark mb-3">Medication</h5>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-10 ml-auto mr-auto">
                                    <h5 class="mt-3">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th style="border-top:none;" class="text-center">Medication Name</th>
                                                <th style="border-top:none;" class="text-center">Times Day</th>
                                                <th style="border-top:none;" class="text-center">Time</th>
                                            </tr>
                                            @php
                                                $medications = $child->medication;
                                            @endphp
                                            @if($medications)
                                                @foreach($medications as $medication)
                                                <tr>
                                                    <td class="text-center border-0">{{$medication['medication_name']}}</td>
                                                    <td class="text-center border-0">{{$medication['times_day']}}</td>
                                                    <td class="text-center border-0">{{$medication['time']}}</td>
                                                </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>

                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 ml-auto mr-auto">
                <div class="pills-main-yellow-kids card card-stats mt-3">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="card-title text-uppercase text-dark mb-3">Allergies</h5>
                            </div>
                            <div class="col-lg-12">
                                <div class="row col-lg-8 ml-auto mr-auto">
                                    @php
                                        $Allergies = $child->allergy
                                    @endphp
                                    @if($Allergies)
                                        @foreach($Allergies as $Allergies)
                                            @if($Allergies['allergi_name'])

                                                <div class="col-lg-4">
                                                    <h4 class="mt-3 pl-4 font-weight-blod">{{$Allergies['allergi_name']}}</h4>
                                                </div>
                                            @endif
                                            @if($Allergies['severity'])
                                                <div class="col-lg-4">
                                                    <h5 class="pl-4"><img src="{{url('imgs/lavel.png')}}" width="50" alt="...">{{$Allergies['severity']}}</h5>
                                                </div>
                                            @endif
                                            @if($Allergies['reaction'])
                                                <div class="col-lg-4">
                                                    <h5 class="pl-3"><img src="{{url('imgs/save.png')}}" width="60" alt="...">{{$Allergies['reaction']}}</h5>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 ml-auto mr-auto">
                <div class="pills-main-yellow-kids card card-stats mt-3">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="card-title text-uppercase text-dark mb-3">Surgeries</h5>
                            </div>
                            <div class="col-lg-12">
                                @php
                                    $Surgeries = $child->Surgeries
                                @endphp
                                @if($Surgeries)
                                    @foreach($Surgeries as $Surgeries)
                                        <div class="row col-lg-8 ml-auto mr-auto">
                                            @if($Surgeries['surgery_name'])
                                            <div class="col-lg-4">
                                                <h4 class="mt-3 pl-4">{{$Surgeries['surgery_name']}}</h4>
                                            </div>

                                            @endif
                                            @if($Surgeries['surgery_date'])
                                            <div class="col-lg-4">
                                                <h5 class="pl-3"><img src="{{url('imgs/date.png')}}" width="60" alt="...">{{$Surgeries['surgery_date']}}</h5>
                                            </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row kidsfam container mr-auto ml-auto mb-5 mt-5" >
                <div class="col-lg-6 ml-auto mr-auto">
                    <div class=" card card-stats mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mother">
                                    <h2 class="card-title text-uppercase font-weight-bold text-white p-5">Mother Diseases</h2>
                                </div>
                            </div>
                            <div class="row">
                                @php
                                    $motherdiseases = $child->motherdisease
                                @endphp

                                @if($motherdiseases)
                                    @foreach($motherdiseases as $motherdisease)
                                        <div class="col-lg-11 ml-auto mr-auto mt-3 row">
                                            <div class="col-2">
                                                <img src="{{url('imgs/01.png')}}" width="40" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <h5 class="mt-3">
                                                    {{$motherdisease}}
                                                </h5>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <div class="col-8">
                                  <h5 class="mt-3">
                                      None
                                  </h5>
                                </div>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ml-auto mr-auto">
                  <div class=" card card-stats mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 father">
                                    <h2 class="card-title text-uppercase font-weight-bold text-white p-5">Father Diseases</h2>
                                </div>
                            </div>
                            <div class="row">
                                @php
                                    $Fatherdiseases = $child->fatherdisease
                                @endphp
                                @if($Fatherdiseases)
                                    @foreach($Fatherdiseases as $Fatherdisease)
                                        <div class="col-lg-11 ml-auto mr-auto mt-3 row">
                                            <div class="col-2">
                                                <img src="{{url('imgs/01.png')}}" width="40" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <h5 class="mt-3">
                                                    {{$Fatherdisease}}
                                                </h5>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <div class="col-8">
                                    <h5 class="mt-3">
                                        None
                                    </h5>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start-Vaccinations -->
            <div class="tab-kids col-lg-12 ml-auto mr-auto col-md-2 mb-4">
              <a href="@if(!$child->Vaccination) {{route('child.Vaccinations',[$patient->id,$child->id])}} @else {{route('child.edit.Vaccinations',[$patient->id,$child->id,$child->Vaccination->id])}} @endif" class="p-4 text-primary" style="text-decoration:none;">
                <div class="row">
                  <div class="col-3 text-center">
                      <img src="{{url('imgs/vaccination.svg')}}" width="120" alt="...">
                  </div>
                  <div class="col-6 mb-auto mt-auto">
                    <h2 class="">Vaccinations</h2>
                    <h6 class="text-muted">Add and Edit</h6>

                  </div>
                </div>
              </a>
            </div>
            <!-- End-Vaccinations -->
        </div>


        <!-- footer -->
        @include('backEnd.layoutes.footer')
        <!-- footer -->
    </div>
</div>
@endsection
