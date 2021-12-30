@extends('backEnd.layoutes.mastar')
@section('title','Report ' . $patient->firstName . ' ' . $patient->lastName)
@section("content")
@include("backEnd.patien.slidenav")
<div class="d-flex bg-veiwdoctor" id="wrapper">
    @php
        $patientData = 0;
    @endphp
    <div id="page-content-wrapper">
        @include('includes.patientNav')
        <div class="card col-lg-10 ml-auto mr-auto mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="row col-8">
                        <img src="{{url('imgs/logonew.svg')}}" width="120" class="col-lg-2" alt="..." >
                        <h5 class="font-weight-bold text-capitalize col-lg-9 mt-4">Patient Medical History Report</h4>
                    </div>
                    <div class="col d-flex justify-content-end">
                        @if(!$patient->image)
                            <img class="rounded-circle" alt="Image placeholder" src="{{ asset('uploads/default.png') }}"  width="80" height="80">
                        @else
                            <img class="rounded-circle" alt="Image placeholder" src="{{ $patient->image }}"  width="80" height="80">
                        @endif
                    </div>
                </div>
                <div class="contanier p-2">
                    <div class="row bg-doctor pt-3 pb-2 ">
                        <div class="col-4">
                          <div class="row">
                              <h6 class="col-5 font-weight-bold text-primary pl-5"> Name :</h6>
                              <div class="col-7 h6 text-dark font-weight-bold">@if($patient->name) {{ $patient->name }} @else Null @endif</div>
                          </div>
                          <div class="row">
                            <h6 class="col-5 font-weight-bold text-primary pl-4"> Patient ID:</h6>
                            <div class="col-7 h6 text-dark font-weight-bold">@if($patient->idCode) {{ $patient->idCode }}   @else Null @endif </div>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="row">
                              <h6 class="col-6 font-weight-bold text-primary pl-5"> Age :</h6>
                              <div class="col-6 h6 text-dark font-weight-bold">@if($patient->BirthDate) {{$patient->getAgeAttribute()}} @else Null @endif</div>
                          </div>
                          <div class="row">
                              <div class="col-6 h6 font-weight-bold text-primary pl-4">Gender :</div>
                              <div class="col-6 h6 text-dark font-weight-bold">@if($patient->gender) {{ $patient->gender }} @else Null @endif</div>
                          </div>
                        </div>


                @if($patient->patinets_data)
                    @php
                        $patientData = 1;
                    @endphp
                        <div class="col-2">
                                <div class="row">
                                    <h6 class="col-6 font-weight-bold text-primary"> Blood :</h6>
                                    <div class="col-6 h6 text-dark font-weight-bold">@if($patient->patinets_data->blood) {{ $patient->patinets_data->blood }} @else Null @endif</div>
                                </div>
                            <div class="row">
                                <div class="col-6 h6 font-weight-bold text-primary">States:</div>
                                <div class="col-6 h6 text-dark font-weight-bold">@if($patient->state) {{ $patient->state }} @else Null @endif </div>
                            </div>
                          </div>
                        <div class="col-2 ml-5">
                            <div class="row">
                                <h6 class="col-6 h6 font-weight-bold text-primary"> Height:</h6>
                                <div class="col-6 h6 text-dark font-weight-bold">@if($patient->patinets_data->height) {{ $patient->patinets_data->height . ' CM' }} @else Null @endif </div>
                            </div>
                            <div class="row">
                                <h6 class="col-6 h6 font-weight-bold text-primary"> Weight:</h6>
                                <div class="col-6 h6 text-dark font-weight-bold"> @if($patient->patinets_data->width) {{ $patient->patinets_data->width .  $patient->patinets_data->width_type }} @else Null  @endif </div>
                            </div>
                          </div>
                    </div>
                </div>
                <!-- checkup -->
                <div class="container p-2">
                    <div class="row bg-title ml-auto mr-auto ">
                        <div class="row col-9 pt-2 pb-2">
                            <img src="{{url('imgs/report/checkup.png')}}" class="col-lg-1 mt-auto mb-auto" alt="..." >
                          <div class="h6 text-dark font-weight-bold mt-auto mb-auto"> Checkup </div>
                        </div>
                        <div class="row col-3 pt-2 pb-2 d-flex justify-content-end">
                            <a href="#" class="h6 text-primary font-weight-bold mt-auto mb-auto" data-toggle="modal" data-target="#exampleModalCheckup"> Show More </a>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCheckup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Patient Checkup</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-borderless bg-white">
                                        <thead>
                                          <tr>
                                            <th class="text-center" scope="col"><img src="{{url('imgs/date.svg')}}" width="40" class="mt-2 mb-2 mr-2" alt="...">Date</th>
                                            <th class="text-center" scope="col"><img src="{{url('imgs/Temperature.png')}}" width="40" class="mt-2 mb-2 mr-2" alt="...">
                                                Temperature</th>
                                            <th class="text-center" scope="col"><img src="{{url('imgs/Blood-Pressure.png')}}" width="40" class="mt-2 mb-2 mr-2" alt="...">
                                                Blood Pressure</th>
                                            <th class="text-center" scope="col"><img src="{{url('imgs/Diabetics.png')}}" width="40" class="mt-2 mb-2 mr-2" alt="...">
                                                Diabetics</th>
                                            <th class="text-center" scope="col"><img src="{{url('imgs/oxygen.svg')}}" width="40" class="mt-2 mb-2 mr-2" alt="...">
                                                Oxygen</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($patient->checkup as $checkup)
                                                    <tr>
                                                        <th class="text-center" scope="row">{{ date('d-m-Y',$checkup->date . '')}}{{ ' ' . Carbon\Carbon::parse($checkup->created_at)->format('H:i:s A') }}</th>
                                                        <td class="text-center">{{$checkup->temperature}}</td>
                                                        <td class="text-center">{{$checkup->blood_pressure}}</td>
                                                        <td class="text-center">{{' ' . $checkup->diabetics}}</td>
                                                        <td class="text-center">{{' ' . $checkup->oxygen}}</td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($lastCheckup)
                        <div class="contanier">
                            <div class="row pt-3">
                                <div class="col-2 col-2x">
                                <div class="bg-doctor p-2 col-12 text-center">
                                    <div class="col-12 h6 text-dark font-weight-bold mb-2"> {{ $lastCheckup->temperature }}</div>
                                    <div class="col-12 h6 font-weight-bold text-primary" style="margin-bottom:-2px"> Temp</div>
                                </div>
                                </div>
                                <div class="col-2 col-2x">
                                    <div class="bg-doctor p-2 col-12 text-center">
                                    <div class="col-12 h6 text-dark font-weight-bold mb-2"> {{ $lastCheckup->blood_pressure }}</div>
                                        <div class="col-12 h6 font-weight-bold text-primary" style="margin-bottom:-2px"> Pressure</div>
                                    </div>
                                </div>
                                <div class="col-2 col-2x">
                                    <div class="bg-doctor p-2 col-12 text-center">
                                    <div class="col-12 h6 text-dark font-weight-bold mb-2">{{ $lastCheckup->diabetics }}</div>
                                        <div class="col-12 h6 font-weight-bold text-primary" style="margin-bottom:-2px"> Diabetics</div>
                                    </div>
                                </div>
                                <div class="col-2 col-2x">
                                <div class="bg-doctor p-2 col-12 text-center">
                                    <div class="col-12 h6 text-dark font-weight-bold mb-2"> {{ $lastCheckup->oxygen }}</div>
                                    <div class="col-12 h6 font-weight-bold text-primary" style="margin-bottom:-2px"> Oxygen</div>
                                </div>
                                </div>
                                <div class="col-2 col-2x">
                                <div class="bg-doctor p-2 col-12  text-center">
                                    <div class="col-12 h6 text-dark font-weight-bold mb-2">
                                        @php
                                            $weight = $patient->patinets_data->width;
                                            $heightT = ($patient->patinets_data->height * $patient->patinets_data->height / 10000);
                                            if($heightT == 0){
                                            $bodyMass = 0;
                                            }else{
                                            $bodyMass = ($weight / $heightT);
                                            }
                                        @endphp
                                    {{ floor($bodyMass)}} Kg
                                    </div>
                                    <div class="col-12 h6 font-weight-bold text-primary" style="margin-bottom:-2px"> Mass</div>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- checkup -->
                <!-- Covied -->
                <div class="container p-2">
                    <div class="row bg-title ml-auto mr-auto ">
                        <div class="row col-9 pt-2 pb-2">
                            <img src="{{url('imgs/report/checkup.png')}}" class="col-lg-1 mt-auto mb-auto" alt="..." >
                          <div class="h6 text-dark font-weight-bold mt-auto mb-auto"> Covied </div>
                        </div>
                        <div class="row col-3 pt-2 pb-2 d-flex justify-content-end">
                            <a href="{{ route('coviedHistory',$patient->idCode) }}" class="h6 text-primary font-weight-bold mt-auto mb-auto"> Covied History </a>
                        </div>
                    </div>
                    <!-- Modal -->
                    {{-- <div class="modal fade" id="exampleModalCheckup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Patient Checkup</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-borderless bg-white">
                                        <thead>
                                          <tr>
                                            <th class="text-center" scope="col"><img src="{{url('imgs/date.svg')}}" width="40" class="mt-2 mb-2 mr-2" alt="...">Date</th>
                                            <th class="text-center" scope="col"><img src="{{url('imgs/Temperature.png')}}" width="40" class="mt-2 mb-2 mr-2" alt="...">
                                                Temperature</th>
                                            <th class="text-center" scope="col"><img src="{{url('imgs/Blood-Pressure.png')}}" width="40" class="mt-2 mb-2 mr-2" alt="...">
                                                Blood Pressure</th>
                                            <th class="text-center" scope="col"><img src="{{url('imgs/Diabetics.png')}}" width="40" class="mt-2 mb-2 mr-2" alt="...">
                                                Diabetics</th>
                                            <th class="text-center" scope="col"><img src="{{url('imgs/oxygen.svg')}}" width="40" class="mt-2 mb-2 mr-2" alt="...">
                                                Oxygen</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($patient->checkup as $checkup)
                                                    <tr>
                                                        <th class="text-center" scope="row">{{ date('d-m-Y',$checkup->date . '')}}{{ ' ' . Carbon\Carbon::parse($checkup->created_at)->format('H:i:s A') }}</th>
                                                        <td class="text-center">{{$checkup->temperature}}</td>
                                                        <td class="text-center">{{$checkup->blood_pressure}}</td>
                                                        <td class="text-center">{{' ' . $checkup->diabetics}}</td>
                                                        <td class="text-center">{{' ' . $checkup->oxygen}}</td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($lastCheckup)
                        <div class="contanier">
                            <div class="row pt-3">
                                <div class="col-2 col-2x">
                                <div class="bg-doctor p-2 col-12 text-center">
                                    <div class="col-12 h6 text-dark font-weight-bold mb-2"> {{ $lastCheckup->temperature }}</div>
                                    <div class="col-12 h6 font-weight-bold text-primary" style="margin-bottom:-2px"> Temp</div>
                                </div>
                                </div>
                                <div class="col-2 col-2x">
                                    <div class="bg-doctor p-2 col-12 text-center">
                                    <div class="col-12 h6 text-dark font-weight-bold mb-2"> {{ $lastCheckup->blood_pressure }}</div>
                                        <div class="col-12 h6 font-weight-bold text-primary" style="margin-bottom:-2px"> Pressure</div>
                                    </div>
                                </div>
                                <div class="col-2 col-2x">
                                    <div class="bg-doctor p-2 col-12 text-center">
                                    <div class="col-12 h6 text-dark font-weight-bold mb-2">{{ $lastCheckup->diabetics }}</div>
                                        <div class="col-12 h6 font-weight-bold text-primary" style="margin-bottom:-2px"> Diabetics</div>
                                    </div>
                                </div>
                                <div class="col-2 col-2x">
                                <div class="bg-doctor p-2 col-12 text-center">
                                    <div class="col-12 h6 text-dark font-weight-bold mb-2"> {{ $lastCheckup->oxygen }}</div>
                                    <div class="col-12 h6 font-weight-bold text-primary" style="margin-bottom:-2px"> Oxygen</div>
                                </div>
                                </div>
                                <div class="col-2 col-2x">
                                <div class="bg-doctor p-2 col-12  text-center">
                                    <div class="col-12 h6 text-dark font-weight-bold mb-2">
                                        @php
                                            $weight = $patient->patinets_data->width;
                                            $heightT = ($patient->patinets_data->height * $patient->patinets_data->height / 10000);
                                            if($heightT == 0){
                                            $bodyMass = 0;
                                            }else{
                                            $bodyMass = ($weight / $heightT);
                                            }
                                        @endphp
                                    {{ floor($bodyMass)}} Kg
                                    </div>
                                    <div class="col-12 h6 font-weight-bold text-primary" style="margin-bottom:-2px"> Mass</div>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif --}}
                </div>
                <!-- Covied -->
                <!-- Diseases -->
                <div class="container p-2">
                    <div class="row bg-title ml-auto mr-auto ">
                        <div class="row col-9 pt-2 pb-2">
                            <img src="{{url('imgs/report/Diseases.png')}}" class="col-lg-1 mt-auto mb-auto" alt="..." >
                          <div class="h6 text-dark font-weight-bold mt-auto mb-auto"> Diseases </div>
                        </div>
                    </div>
                    <div class="contanier">
                        <div class="row pt-3">
                            @php
                                $agree_name = $patient->patinets_data->agree_name;
                            @endphp
                            @if($agree_name && $agree_name > 0)
                                @foreach($agree_name as $agree)
                                    <div class="col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            {{-- <img src="{{url('imgs/report/No1.svg')}}" width="25" class="mb-1" alt="..." > --}}
                                            <h6 class="col-8 font-weight-bold text-dark">{{ $agree }}</h6>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <div class="col-4">
                                    <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                        {{-- <img src="{{url('imgs/report/No1.svg')}}" width="25" class="mb-1" alt="..." > --}}
                                        <h6 class="col-8 font-weight-bold text-dark">Null</h6>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Diseases -->
                <!-- medication -->
                <div class="container p-2">
                    <div class="row bg-title ml-auto mr-auto ">
                        <div class="row col-9 pt-2 pb-2">
                            <img src="{{url('imgs/report/Medication.png')}}" class="col-lg-1 mt-auto mb-auto" alt="..." >
                          <div class="h6 text-dark font-weight-bold mt-auto mb-auto"> Medication </div>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="row col-12 ml-auto mr-auto">
                            <div class="col-4">
                                <div class="row col-12 text-center">
                                    <h6 class="col-12 font-weight-bold text-primary">Name</h6>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row col-12 text-center">
                                    <h6 class="col-12 font-weight-bold text-primary"> Times Day</h6>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row col-12 text-center">
                                    <h6 class="col-12 font-weight-bold text-primary"> Time</h6>
                                </div>
                            </div>
                        </div>
                            @php
                                $medication_name = $patient->patinets_data->medication_name;
                            @endphp
                            @if($medication_name === null)
                                <p></p>
                            @else
                                @foreach ($medication_name as $medication)
                                    @if($medication)
                                        <div class="mb-2 row col-12 ml-auto mr-auto">
                                            <div class="col-4">
                                                <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                                    {{-- <img src="{{url('imgs/report/No1.svg')}}" width="25" class="mb-1" alt="..." > --}}
                                                    <h6 class="col-8 font-weight-bold text-dark"> {{ $medication['name'] ? $medication['name'] : Null }}</h6>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                                    <h6 class="col-12 font-weight-bold text-dark">{{ $medication['times_day'] ? $medication['times_day'] : Null }}</h6>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                                    <h6 class="col-12 font-weight-bold text-dark">{{ $medication['time']  ?$medication['time'] : Null }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                    </div>
                </div>
                <!-- medication -->
                <!-- Allergies -->
                <div class="container p-2">
                    <div class="row bg-title ml-auto mr-auto ">
                        <div class="row col-9 pt-2 pb-2">
                            <img src="{{url('imgs/report/allergy.png')}}" class="col-lg-1 mt-auto mb-auto" alt="..." >
                          <div class="h6 text-dark font-weight-bold mt-auto mb-auto"> Allergies </div>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="row col-12 ml-auto mr-auto">
                            <div class="col-4">
                                <div class="row col-12 text-center">
                                    <h6 class="col-12 font-weight-bold text-primary">Name</h6>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row col-12 text-center">
                                    <h6 class="col-12 font-weight-bold text-primary"> severity</h6>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row col-12 text-center">
                                    <h6 class="col-12 font-weight-bold text-primary"> Reaction</h6>
                                </div>
                            </div>
                        </div>
                        @php
                            $allergis =$patient->patinets_data->allergi_data;
                        @endphp
                        <div class="row col-12 ml-auto mr-auto">
                            @if($allergis)
                                @foreach($allergis as $allergi)
                                    <div class="mb-2 col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            {{-- <img src="{{url('imgs/report/No1.svg')}}" width="25" class="mb-1" alt="..." > --}}
                                            <h6 class="col-8 font-weight-bold text-dark"> {{ $allergi['allergi_name'] }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            <h6 class="col-12 font-weight-bold text-dark"> {{ $allergi['severity'] }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            <h6 class="col-12 font-weight-bold text-dark"> {{ $allergi['reaction'] }}</h6>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-8">
                                    <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                        <h6 class="col-12 font-weight-bold text-dark"> Null</h6>
                                    </div>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
                <!-- Allergies -->
                <!-- Surgeries -->
                <div class="container p-2">
                    <div class="row bg-title ml-auto mr-auto ">
                        <div class="row col-9 pt-2 pb-2">
                            <img src="{{url('imgs/report/Surgery.png')}}" class="col-lg-1 mt-auto mb-auto" alt="..." >
                          <div class="h6 text-dark font-weight-bold mt-auto mb-auto"> Surgeries </div>
                        </div>
                    </div>
                    <div class="row pt-2">
                        @php
                            $surgerys = $patient->patinets_data->surgery_data;
                        @endphp

                        <div class="row col-12 ml-auto mr-auto">

                            <div class="col-6">
                                <div class="row col-12 text-center">
                                    <h6 class="col-12 font-weight-bold text-primary">Name</h6>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row col-12 text-center">
                                    <h6 class="col-12 font-weight-bold text-primary"> Date</h6>
                                </div>
                            </div>

                        </div>
                        <div class="row col-12 ml-auto mr-auto">
                            @if($surgerys)
                                @foreach($surgerys as $surgery)
                                    <div class="mb-2 col-6">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            {{-- <img src="{{url('imgs/report/No1.svg')}}" width="25" class="mb-1" alt="..." > --}}
                                            <h6 class="col-8 font-weight-bold text-dark"> {{ $surgery['surgery_name'] }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            <h6 class="col-12 font-weight-bold text-dark">{{ $surgery['surgery_date'] }}</h6>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            <div class="col-8">
                                <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                    <h6 class="col-12 font-weight-bold text-dark">Null</h6>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                <!-- Surgeries -->
                <!-- Unhealthy Habits -->
                <div class="container p-2">
                    <div class="row bg-title ml-auto mr-auto ">
                        <div class="row col-9 pt-2 pb-2">
                            <img src="{{url('imgs/report/smoking.png')}}" class="col-lg-1 mt-auto mb-auto" alt="..." >
                          <div class="h6 text-dark font-weight-bold mt-auto mb-auto"> Unhealthy Habits </div>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="row col-12 ml-auto mr-auto">
                            <div class="col-6">
                                <div class="row col-12 text-center">
                                    <h6 class="col-12 font-weight-bold text-primary">Name</h6>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row col-12 text-center">
                                    <h6 class="col-12 font-weight-bold text-primary"> severity</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 ml-auto mr-auto">
                            @php
                                $smoking = $patient->patinets_data->smoking;
                            @endphp
                            @foreach($smoking as $smoke)
                                <div class="mb-2 col-6">
                                    <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                        {{-- <img src="{{url('imgs/report/No1.svg')}}" width="25" class="mb-1" alt="..." > --}}
                                        <h6 class="col-8 font-weight-bold text-dark"> {{ $smoke['name'] }}</h6>
                                    </div>
                                </div>
                                <div class="mb-2 col-4">
                                    <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                        <h6 class="col-12 font-weight-bold text-dark"> {{ $smoke['severity'] }}</h6>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- Unhealthy Habits -->
                <!-- files -->
                <div class="container p-2">
                    <div class="row bg-title ml-auto mr-auto ">
                        <div class="row col-9 pt-2 pb-2">
                            <img src="{{url('imgs/report/file.png')}}" class="col-lg-1 mt-auto mb-auto" alt="..." >
                          <div class="h6 text-dark font-weight-bold mt-auto mb-auto"> File </div>
                        </div>
                        <div class="row col-3 pt-2 pb-2 d-flex justify-content-end">
                            <a href="#" class="h6 text-primary font-weight-bold mt-auto mb-auto" data-toggle="modal" data-target="#exampleModalFile"> Show More </a>
                        </div>
                        <div class="modal fade" id="exampleModalFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Patient Files</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <tr>
                                                <th class="h5">Name</th>
                                                <th class="h5">Show</th>
                                                <th class="h5">Download</th>
                                            </tr>
                                            @if($patient->patinets_data->rocata_file)
                                                @foreach($patient->patinets_data->rocata_file as $rocata_file)
                                                    <tr>
                                                        <td>Prescription Files</td>
                                                        <td><a class="text-decoration" target="_blank" href="{{url($rocata_file)}}">Show</a></td>
                                                        <td><a class="text-decoration" href="{{ route('download_pdf',['rocata',$patient->id]) }}">Download</a></td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                <div class="alert alert-danger">No Files</div>
                                            @endif
                                            @if($patient->patinets_data->rays_file)
                                                @foreach($patient->patinets_data->rays_file as $rays_file)
                                                    <tr>
                                                        <td>Rays Files</td>
                                                        <td><a class="text-decoration" target="_blank" href="{{url($rays_file)}}">Show</a></td>
                                                        <td><a class="text-decoration" href="{{ route('download_pdf',['ray',$patient->id]) }}">Download</a></td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                <div class="alert alert-danger">No Files</div>
                                            @endif
                                            @if($patient->patinets_data->analzes_file)
                                                @foreach($patient->patinets_data->analzes_file as $analzes_file)
                                                    <tr>
                                                        <td>Test Files</td>
                                                        <td><a class="text-decoration" target="_blank" href="{{url($analzes_file)}}">Show</a></td>
                                                        <td><a class="text-decoration" href="{{ route('download_pdf',['test',$patient->id]) }}">Download</a></td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                <div class="alert alert-danger">No Files</div>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- files -->
                <!-- female -->
                <div class="container p-2">
                    <div class="row bg-title ml-auto mr-auto ">
                        <div class="row col-8 pt-2 pb-2">
                            <img src="{{url('imgs/report/family.png')}}" class="col-1 mt-auto mb-auto" alt="..." >
                          <div class="h6 text-dark font-weight-bold mt-auto mb-auto"> Family Diseases </div>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="row col-12 ml-auto mr-auto">
                            <div class="col-12">
                                <div class="row col-12">
                                    <h6 class="col-12 font-weight-bold text-primary">Mother</h6>
                                </div>
                            </div>
                            @php
                                $mother = $patient->patinets_data->mother;
                            @endphp
                            @if($mother > 0)
                                @foreach($mother as $value)
                                    <div class="mb-2 col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            {{-- <img src="{{url('imgs/report/No1.svg')}}" width="25" class="mb-1" alt="..." > --}}
                                            <h6 class="col-8 font-weight-bold text-dark">{{ $value }}</h6>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <div class="col-4">
                                    <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                        {{-- <img src="{{url('imgs/report/No1.svg')}}" width="25" class="mb-1" alt="..." > --}}
                                        <h6 class="col-8 font-weight-bold text-dark">Null</h6>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="row col-12 ml-auto mr-auto mt-2">
                            <div class="col-12">
                                <div class="row col-12">
                                    <h6 class="col-12 font-weight-bold text-primary">Father</h6>
                                </div>
                            </div>
                            @php
                                $father = $patient->patinets_data->father;
                            @endphp
                            @if($father > 0)
                                @foreach($father as $father)
                                    <div class="mb-2 col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            {{-- <img src="{{url('imgs/report/No1.svg')}}" width="25" class="mb-1" alt="..." > --}}
                                            <h6 class="col-8 font-weight-bold text-dark"> {{ $father }}</h6>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <div class="col-4">
                                    <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                        {{-- <img src="{{url('imgs/report/No1.svg')}}" width="25" class="mb-1" alt="..." > --}}
                                        <h6 class="col-8 font-weight-bold text-dark">Null</h6>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if($patient->gender == 'female' && $patient->state == 'married' || $patient->state =='divorce')
                    <div class="container p-2">
                        <div class="row bg-title ml-auto mr-auto ">
                            <div class="row col-8 pt-2 pb-2">
                                <img src="{{url('imgs/report/female.png')}}" class="col-1 mt-auto mb-auto" alt="..." >
                            <div class="h6 text-dark font-weight-bold mt-auto mb-auto"> Female </div>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="row col-12 mb-3 ml-auto mr-auto">
                                <div class="col-6">
                                    <div class="pt-2 pb-1 row col-12">
                                        <h6 class="col-8 font-weight-bold text-dark"> Mormal Period Cycly</h6>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                        <h6 class="col-12 font-weight-bold text-dark text-center">{{ $patient->patinets_data->mother_Period_Cycle }}</h6>
                                    </div>
                                </div>
                            </div>
                            @if($patient->patinets_data->mother_Period_Cycle != null || $patient->patinets_data->mother_pregnency != null || $patient->patinets_data->mother_abotion != null)
                                <div class="row col-12 mb-3 ml-auto mr-auto">
                                    <div class="col-6">
                                        <div class="pt-2 pb-1 row col-12">
                                            <h6 class="col-8 font-weight-bold text-dark"> Pregnancy</h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            <h6 class="col-12 font-weight-bold text-dark text-center"> {{$patient->patinets_data->mother_pregnency}} </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-12 mb-3 ml-auto mr-auto">
                                    <div class="col-6">
                                        <div class="pt-2 pb-1 row col-12">
                                            <h6 class="col-8 font-weight-bold text-dark"> Aboticon</h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            <h6 class="col-12 font-weight-bold text-dark text-center"> {{$patient->patinets_data->mother_abotion}} </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-12 mb-3 ml-auto mr-auto">
                                    <div class="col-6">
                                        <div class="pt-2 pb-1 row col-12">
                                            <h6 class="col-8 font-weight-bold text-dark"> Contraceptive</h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            <h6 class="col-12 font-weight-bold text-dark text-center"> {{$patient->patinets_data->mother_Contraceptive}} </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-12 mb-3 ml-auto mr-auto">
                                    <div class="col-6">
                                        <div class="pt-2 pb-1 row col-12">
                                            <h6 class="col-8 font-weight-bold text-dark">Types of Deliveries</h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            <h6 class="col-12 font-weight-bold text-dark text-center"> {{$patient->patinets_data->mother_deliveries}} </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-12 mb-3 ml-auto mr-auto">
                                    <div class="col-6">
                                        <div class="pt-2 pb-1 row col-12">
                                            <h6 class="col-8 font-weight-bold text-dark"> Complication in Deliveries</h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-doctor pt-2 pb-1 row col-12 text-center">
                                            <h6 class="col-12 font-weight-bold text-dark text-center"> {{ $patient->patinets_data->mother_complicetion }} </h6>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @endif
                <!-- female -->

                {{-- @else
                <div class="row">
                    <h1>Please Complete Your Profile</h1>
                </div> --}}

                @endif
            </div>
        </div>



    </div>



</div>

@if ( $patientData == 0 )
<div class="card col-lg-10 ml-auto mr-auto mt-4">
    <div class="card-body">
        <h1 style="font-weight: bold;">Please Complete Your Profile Data</h1>
    </div>
</div>
@endif

@stop
