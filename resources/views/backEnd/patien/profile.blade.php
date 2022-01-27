@extends('backEnd.layoutes.mastar')
@section('title','Profile')
@section('content')
@include('backEnd.patien.slidenav')
<!-- profile patient -->
  <!-- Main content -->
  @php
  $count = auth()->guard('patien')->user()->patinets_data;
  @endphp
  @if($count)
    <div class="d-flex bg-page" id="wrapper">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <div id="page-content-wrapper">

            @include('backEnd.patien.nav')

            <div class="container-fluid">
                <div class="header pb-6">
                    <div class="container-fluid">
                        <div class="header-body">
                            <div class="row pt-3 col-11 ml-auto mr-auto">
                                <div class="col-lg-12 col-md-4">
                                    <img src="{{url('imgs/header.jpg')}}" class="img-header">
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="pills-main-green card card-stats mt-3">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-3">Height</h5>
                                                <span class="h3 font-weight-bold mb-0">@if($patient->patinets_data->height) {{$patient->patinets_data->height}} Cm @else Null @endif</span>
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
                                <div class="col-lg-3 col-md-4">
                                    <div class="pills-main-yellow card card-stats mt-3">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-3">Weight</h5>
                                                <span class="h3 font-weight-bold mb-0">@if($patient->patinets_data->width){{$patient->patinets_data->width . ' ' . $patient->patinets_data->width_type }} @else Null @endif</span>
                                            </div>
                                            <div class="col-auto">
                                                <div>
                                                <img src="{{url('imgs/Wight.png')}}" width="50" alt="...">
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="pills-main-orange card card-stats mt-3">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-3">Blood</h5>
                                                <span class="h3 font-weight-bold mb-0">@if($patient->patinets_data->blood){{$patient->patinets_data->blood}} @else Null  @endif</span>
                                            </div>
                                            <div class="col-auto">
                                                <div>
                                                <img src="{{url('imgs/blood.png')}}" width="50" alt="...">
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="pills-main-yellow card card-stats mt-3">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-3">Body mass</h5>
                                                    <span class="h3 font-weight-bold mb-0">
                                                    @php
                                                        if($patient->patinets_data->width_type == 'St'){
                                                            $weight = ($patient->patinets_data->width * 6.35);
                                                            $heightT = ($patient->patinets_data->height * $patient->patinets_data->height / 10000);
                                                            if($heightT == 0){
                                                            $bodyMass = 0;
                                                            }else{
                                                            $bodyMass = ($weight / $heightT);
                                                            }
                                                        }elseif($patient->patinets_data->width_type == 'Lbs'){
                                                            $weight = ($patient->patinets_data->width * 0.4536);
                                                            $heightT = ($patient->patinets_data->height * $patient->patinets_data->height / 10000);
                                                            if($heightT == 0){
                                                            $bodyMass = 0;
                                                            }else{
                                                            $bodyMass = ($weight / $heightT);
                                                            }
                                                        }else{
                                                            $weight = $patient->patinets_data->width;
                                                            $heightT = ($patient->patinets_data->height * $patient->patinets_data->height / 10000);
                                                            if($heightT == 0){
                                                            $bodyMass = 0;
                                                            }else{
                                                            $bodyMass = ($weight / $heightT);
                                                            }
                                                        }
                                                    @endphp
                                                    {{ floor($bodyMass)}} Kg
                                                    </span>
                                                </div>
                                                <div class="col-auto">
                                                    <div>
                                                    <img src="{{url('imgs/Wight.png')}}" width="50" alt="...">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <!-- female div -->
                                    @if($patient->gender == 'female' && ($patient->state == 'single' || $patient->state == 'married'))
                                    <div class="pills-main-pink card card-stats female-bg mt-3">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-auto">
                                            <div>
                                            <img src="{{url('imgs/clender.png')}}" width="40" alt="...">
                                            </div>
                                        </div>

                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted ">Female</h5>
                                            @if($patient->patinets_data->single_Period_Cycle == 'Yes' || $patient->patinets_data->Period_Cycle == 'Yes')
                                            <span class="h5 font-weight-bold mb-0">Have Normal Period Cycle </span>
                                            @else
                                            <span class="h5 font-weight-bold mb-0">Have Not Normal Period Cycle </span>
                                            @endif
                                        </div>

                                        </div>
                                    </div>
                                    </div>
                                    @endif
                                    <!-- female div -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Information -->
                <div class="nav row testimonial-group nav-pills menu-info col-10 ml-auto mr-auto mb-4" d="v-pills-tab" role="tablist" aria-orientation="horizontal">
                    <a class="nav-link P-1 ml-3 active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">
                        <div class="font-weight-600 text-center mt-1"><img src="{{url('imgs/01.png')}}" class="mr-2" width="30" alt="...">Diseases</div>
                    </a>
                    <a class="nav-link p-1 " id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">
                        <div class="font-weight-600 text-center mt-2"><img src="{{url('imgs/medication.svg')}}" class="mr-2" width="30" alt="...">Medication</div>
                    </a>
                    <a  class="nav-link p-1" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">
                        <div class="font-weight-600 text-center mt-2"><img src="{{url('imgs/03.png')}}" class="mr-2" width="30" alt="...">Allergies</div>
                    </a>
                    <a  class="nav-link p-1" id="v-pills-4-tab" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-4" aria-selected="false">
                        <div class="font-weight-600 text-center mt-2"><img src="{{url('imgs/dissection.png')}}" class="mr-2" width="30" alt="...">Surgeries</div>
                    </a>
                    <a class="nav-link p-1" id="v-pills-5-tab" data-toggle="pill" href="#v-pills-5" role="tab" aria-controls="v-pills-5" aria-selected="false">
                        <div class="font-weight-600 text-center mt-2"><img src="{{url('imgs/06.png')}}" class="mr-2" width="30" alt="...">Habits</div>
                    </a>
                    <a class="nav-link  p-1" id="v-pills-6-tab" data-toggle="pill" href="#v-pills-6" role="tab" aria-controls="v-pills-6" aria-selected="false">
                        <div class="font-weight-600 text-center mt-2"><img src="{{url('imgs/05.png')}}" class="mr-2" width="30" alt="...">Screen</div>
                    </a>
                    <a class="nav-link p-1" id="v-pills-7-tab" data-toggle="pill" href="#v-pills-7" role="tab" aria-controls="v-pills-7" aria-selected="false">
                        <div class="font-weight-600 text-center mt-2"><img src="{{url('imgs/folder.svg')}}" class="mr-2" width="30" alt="...">Files</div>
                    </a>
                </div>
                <div class="col-md-10 p-4 mr-auto ml-auto align-items-center js-fullheight animated">
                <div class="tab-content mr-auto ml-auto" id="v-pills-tabContent">
                    <div class="tab-pane animated bounce mr-auto ml-auto active slow py-0" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
                        <h5 class="col-10 ml-xl-8 mb-4 mt-3 ml-5">Diseases</h5>
                        @php
                            $agree_name = $patient->patinets_data->agree_name;
                        @endphp
                        @if($agree_name)
                            @foreach($agree_name as $agree)
                                <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto p-2">
                                    <div class="col-2">
                                        <img   src="{{url('imgs/01.png')}}" width="40" alt="...">
                                    </div>
                                    <div class="col-8">
                                        <h5 class="mt-3">
                                            {{$agree}}
                                        </h5>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto p-2">
                                <div class="col-2">
                                    <img src="{{url('imgs/01.png')}}" width="40" alt="...">
                                </div>
                                <div class="col-8">
                                    <h5 class="mt-3">
                                        Null
                                    </h5>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane animated bounce slow py-0" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
                        <h5 class="col-12 ml-xl-8 mb-4 mt-3 ml-5">Medication</h5>
                            @php
                                $medication_name = $patient->patinets_data->medication_name;
                            @endphp
                        <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto p-2">
                            <div class="col-2">
                                <img src="{{url('imgs/02.png')}}" width="40" alt="...">
                            </div>
                            <div class="col-8">
                                <h5 class="mt-3">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th class="text-center">Medication Name</th>
                                        <th class="text-center">Times Day</th>
                                        <th class="text-center">Time</th>
                                    </tr>
                                    {{-- {{dd(json_decode($Raoucheh->medication))}} --}}
                                    @if($medication_name === null)
                                        <p></p>
                                        @else
                                            @foreach($medication_name as $medication)
                                                @if($medication)
                                                    <tr>
                                                        <td class="text-center border-0">{{$medication['name']}}</td>
                                                        <td class="text-center border-0">{{$medication['times_day']}}</td>
                                                        <td class="text-center border-0">{{$medication['time']}}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane animated bounce slow py-0" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
                        <h5 class="col-12 mb-4 mt-3 ml-5">Allergies</h5>
                        @php
                            $allergis =$patient->patinets_data->allergi_data;
                        @endphp

                        @if( $allergis == null)
                            <p></p>
                            @else
                            @foreach( $allergis as $array)
                                @if($array)
                                    <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto p-2">
                                        <div class="col-8">
                                            @if($array['allergi_name'])
                                                <h4 class="mt-3 pl-4 font-weight-blod">{{$array['allergi_name']}}</h4>
                                            @else
                                                Null
                                            @endif
                                            @if($array['severity'])
                                                <h5 class="pl-4"><img src="{{url('imgs/lavel.png')}}" width="50" alt="...">{{$array['severity']}}</h5>
                                            @endif
                                            @if($array['reaction'])
                                                <h5 class="mt--4 pl-3"><img src="{{url('imgs/save.png')}}" width="60" alt="...">{{$array['reaction']}}</h5>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                        @endforeach
                        @endif
                    </div>
                    <div class="tab-pane animated bounce slow py-0" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-4-tab">
                        <h5 class="col-12 ml-xl-8 mb-4 mt-3 ml-5">Surgeries</h5>
                        @php
                        $surgerys = $patient->patinets_data->surgery_data;
                        @endphp
                        @if($surgerys === null)
                            <p></p>
                            @else
                            @foreach ($surgerys as $array_su)
                            @if($array_su)
                            <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                                <div class="col-8">
                                    @if($array_su['surgery_name'])
                                        <h4 class="mt-3 pl-4">{{$array_su['surgery_name']}}</h4>
                                    @else
                                    <h4 class="mt-3 mb-3 pl-4 font-weight-bold">Null</h4>
                                    @endif
                                    @if($array_su['surgery_date'])
                                        <h5 class="mt--3 pl-3"><img src="{{url('imgs/date.png')}}" width="60" alt="...">{{$array_su['surgery_date']}}</h5>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach
                        @endif

                    </div>
                    <!-- smoking -->
                    <div class="tab-pane animated bounce slow py-0" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-5-tab">
                        <h5 class="col-12 ml-xl-8 mb-4 mt-3 ml-5">Habits</h5>
                            @php
                                $smoking = $patient->patinets_data->smoking;
                            @endphp
                        @if($smoking)
                            @foreach($smoking as $smoking)
                                <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                                    <div class="col-8">
                                    <h5 class="mt-3 pl-4 font-weight-bold">{{ $smoking['name'] == null ? 'None' : $smoking['name'] }}</h5>
                                    <h5 class="mt-3 pl-4"><img src="{{url('imgs/lavel.png')}}" width="50" alt="...">{{ $smoking['severity'] == null ? 'None' : $smoking['severity'] }}</h5>
                                    </div>
                                </div>
                            @endforeach
                            @else
                            <p>No Smoking</p>
                        @endif
                    </div>
                    <!-- smoking -->
                    <div class="tab-pane animated bounce slow py-0" id="v-pills-6" role="tabpanel" aria-labelledby="v-pills-6-tab">
                        <h5 class="col-12 ml-xl-8 mb-4 mt-3 ml-5">Screening</h5>
                        <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                            <div class="col-8">
                            <h5 class="mt-3 pl-4 font-weight-bold">Colonscopy</h5>
                            <h5 class="mt-3 pl-3"><img src="{{url('imgs/date.png')}}" width="60" alt="...">@if($patient->patinets_data->colonscopy == 1) {{$patient->patinets_data->colonscopy_data}} @else No Date @endif</h5>
                            </div>
                        </div>
                        <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                            <div class="col-8">
                            <h5 class="mt-3 pl-4 font-weight-bold">Mmamogram</h5>
                            <h5 class="mt-3 pl-3"><img src="{{url('imgs/date.png')}}" width="60" alt="...">@if($patient->patinets_data->mammogram == 3) {{$patient->patinets_data->mammogram_date}} @else No Date @endif</h5>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane animated bounce slow py-0" id="v-pills-7" role="tabpanel" aria-labelledby="v-pills-7-tab">
                        <h5 class="col-12 ml-xl-8 mb-4 mt-3 ml-5">Files</h5>
                        <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                            <div class="col-12 ml-auto mr-auto">
                                <table class="table">
                                    <tr>
                                        <th class="h5">Name</th>
                                        <th class="h5">Show</th>
                                        <th class="h5">Download</th>
                                        <th class="h5">Delete</th>
                                    </tr>
                                    {{--  {{ dd($patient->patinets_data->rocata_file[0]) }}  --}}
                                    @if($patient->patinets_data->rocata_file)
                                        @foreach($patient->patinets_data->rocata_file as $key => $rocata_file)
                                            <tr>
                                                <td>Prescription Files</td>
                                                <td><a class="text-decoration" target="_blank" href="{{url($rocata_file)}}">Show</a></td>
                                                <td><a class="text-decoration" href="{{ route('download_pdf', [ 'rocata' , $patient->id , $key ] ) }}">Download</a></td>
                                                <td><a href="{{ route('deleteFiles',['rocata',$patient->id]) }}" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <div class="alert alert-danger">No Files</div>
                                    @endif
                                    @if($patient->patinets_data->rays_file)
                                        @foreach($patient->patinets_data->rays_file as $key =>$rays_file)
                                            <tr>
                                                <td>Rays Files</td>
                                                <td><a class="text-decoration" target="_blank" href="{{url($rays_file)}}">Show</a></td>
                                                {{-- <h6>{{url($rays_file)}}</h6> --}}
                                                <td><a class="text-decoration" href="{{ route('download_pdf',['ray',$patient->id, $key]) }}">Download</a></td>
                                                <td><a href="{{ route('deleteFiles',['ray',$patient->id]) }}" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <div class="alert alert-danger">No Files</div>
                                    @endif
                                    @if($patient->patinets_data->analzes_file)
                                        @foreach($patient->patinets_data->analzes_file as $key =>$analzes_file)
                                            <tr>
                                                <td>Test Files</td>
                                                <td><a class="text-decoration" target="_blank" href="{{url($analzes_file)}}">Show</a></td>
                                                <td><a class="text-decoration" href="{{ route('download_pdf',['test',$patient->id, $key]) }}">Download</a></td>
                                                <td><a href="{{ route('deleteFiles',['test',$patient->id]) }}" class="btn btn-danger">Delete</a></td>
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

                <!-- HistoryFamilyContent -->
                <div class="col-lg-10 ml-auto mr-auto col-md-2 mt-4 mb-5">
                    <h4 class="text-orange font-weight-bold">Family Diseases</h4>
                <div class="pills-main-orange py-0 mb-4 mt-4" id="v-pills-01" role="tabpanel" aria-labelledby="v-pills-01-tab">
                    @php
                    $mother = $patient->patinets_data->mother;
                    $father = $patient->patinets_data->father;
                    $sister = json_decode($patient->patinets_data->sister);
                    $brother = json_decode($patient->patinets_data->brother);
                    $grandpaf = json_decode($patient->patinets_data->grnadpaF);
                    $grandpam = json_decode($patient->patinets_data->grnadpaM);
                    $grandmaf = json_decode($patient->patinets_data->grandmaF);
                    $grandmam = json_decode($patient->patinets_data->grnadmaM);
                    @endphp
                    @if($mother > 0)
                    <div class="ml-5 p-2 h5 text-orange"><img src="{{url('imgs/mother.svg')}}" width="50"> Mother Diseases</div>
                        @foreach($mother as $mother)
                            <div class="pills-main-orangeB col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto p-2">
                                <div class="col-2">
                                    <img class="mt-2" src="{{url('imgs/01.png')}}" width="40" alt="...">
                                </div>
                                <div class="col-8">
                                    <h6 class="mt-4 text-capitalize">{{$mother}}</h6>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <div class="ml-5 p-2 h5 text-orange"><img src="{{url('imgs/mother.svg')}}" width="50"> Mother Diseases</div>
                    <div class="pills-main-orangeB col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto p-2">
                        <div class="col-2">
                            <img class="mt-1" src="{{url('imgs/01.png')}}" width="40" alt="...">
                        </div>
                        <div class="col-8">
                            <h6 class="mt-3">Null</h6>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="pills-main-orange py-0 mb-4 mt-4" id="v-pills-02" role="tabpanel" aria-labelledby="v-pills-02-tab">
                    @if($father > 0)
                        <div class="ml-5 p-2 h5 text-orange"><img src="{{url('imgs/father.svg')}}" width="50"> Father Diseases</div>
                    @foreach($father as $father)
                    <div class="pills-main-orangeB col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto p-2">
                        <div class="col-2">
                        <img src="{{url('imgs/01.png')}}" width="40" alt="...">
                        </div>
                        <div class="col-8">
                        <h6 class="mt-3 text-capitalize">{{$father}}</h6>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="ml-5 p-2 h5 text-orange"><img src="{{url('imgs/father.svg')}}" width="50"> Father Diseases</div>
                    <div class="pills-main-orangeB col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto p-2">
                        <div class="col-2">
                        <img src="{{url('imgs/01.png')}}" width="40" alt="...">
                        </div>
                        <div class="col-8">
                        <h6 class="mt-3">Null</h6>
                        </div>
                    </div>
                    @endif
                </div>
                </div>

                <!-- female -->
                {{-- @if(auth())--}}
                @if($patient->gender == 'female' && $patient->state == 'married' || $patient->state =='divorce')
                <div class="container-fluid mb-5">
                    <h2 class="row mt-4 ml-5 mb-5">Female History</h2>
                    @if($patient->patinets_data->Period_Cycle != null || $patient->patinets_data->pregnency != null || $patient->patinets_data->Abotion != null)
                    <div><h5 class="card-title mt-4 ml-5 mb-5 text-uppercase text-muted mb-3">Female Mother</h5></div>
                    @else
                    <div><h5 class="card-title mt-4 ml-5 mb-5 text-capitalize text-muted mb-3">Female Wife</h5></div>
                    @endif
                    <div class="row tab-content col-md-10 p-4 mt-2 mr-auto ml-auto">
                        @if($patient->patinets_data->Period_Cycle != null || $patient->patinets_data->pregnency != null || $patient->patinets_data->Abotion != null)
                        <div class="col-xl-4 col-md-2 col-xs-12 mb-4">
                            <div class="pills-main-pink card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div>
                                                <img src="{{url('imgs/prng.png')}}" width="60" alt="...">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">Pregnency</h5>
                                            <span class="h5 font-weight-bold mb-0">{{$patient->patinets_data->pregnency}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-2 col-xs-12 mb-4">
                            <div class="pills-main-pink card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div>
                                                <img src="{{url('imgs/beby.png')}}" width="60" alt="...">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">Abortion</h5>
                                            <span class="h5 font-weight-bold mb-0">{{$patient->patinets_data->Abotion}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-2 col-xs-12 mb-4">
                            <div class="pills-main-pink card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div>
                                                <img src="{{url('imgs/noPreg.png')}}" width="60" alt="...">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">Contraceptives</h5>
                                            <span class="h5 font-weight-bold mb-0">{{$patient->patinets_data->Contraceptive}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-2 col-xs-12 mb-4">
                            <div class="pills-main-pink card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div>
                                                <img src="{{url('imgs/delivery.png')}}" width="60" alt="...">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">Types of Deliveries</h5>
                                            <span class="h5 font-weight-bold mb-0">{{$patient->patinets_data->deliveries}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-2 col-xs-12 mb-4">
                            <div class="pills-main-pink card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div>
                                                <img src="{{url('imgs/pain.png')}}" width="60" alt="...">
                                            </div>
                                        </div>
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-3">Complicetion in Deliveries</h5>
                                                <span class="h5 font-weight-bold mb-0">{{$patient->patinets_data->complicetion}}</span>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($patient->patinets_data->Period_Cycle != null || $patient->patinets_data->Abotion != null || $patient->patinets_data->Contraceptive != null)
                        <div class="col-xl-6 col-md-2 col-xs-12 mb-5">
                            <div class="pills-main-pink card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div>
                                                <img src="{{url('imgs/beby.png')}}" width="60" alt="...">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">Abortion</h5>
                                            <span class="h5 font-weight-bold mb-0">{{$patient->patinets_data->Abotion}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-2 col-xs-12 mb-5">
                            <div class="pills-main-pink card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div>
                                                <img src="{{url('imgs/noPreg.png')}}" width="60" alt="...">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">Contraceptives</h5>
                                            <span class="h5 font-weight-bold mb-0">{{$patient->patinets_data->Contraceptive}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                <!-- female -->

                <!-- Start-kids -->
                <div class="tab-kids col-lg-10 ml-auto mr-auto col-md-2 mb-4">
                    <a href="{{route('getAllChild',$patient->id)}}" class="p-4 text-primary" style="text-decoration:none;">
                        <div class="row d-flex justify-content-around">
                        <div class="text-center">
                            <img src="{{url('imgs/kids.svg')}}" width="120" alt="...">
                        </div>
                        <div class="mb-auto mt-auto">
                            <h2 class="">Kids</h2>
                            <h6 class="text-muted">Add and Edit</h6>

                        </div>
                        </div>
                    </a>
                </div>
                <!-- End-kids -->

                <!-- Start-wifehusbend -->
                <div class="tab-wife-husband col-lg-10 ml-auto mr-auto col-md-2 mb-5">
                    <div class="p-4 text-wife" style="text-decoration:none;">
                        <div class="row d-flex justify-content-around align-items-center">
                        <div class="text-center">
                            <img src="{{url('imgs/fatherandmother.png')}}" width="100" alt="...">
                        </div>
                        <div class="mb-auto mt-auto">
                            <a href="{{route('patient.searchWife',$patient->id)}}" class="h2 text-wife" style="text-decoration:none;">Wife or Husband</a>
                            <h6 class="text-muted">Add and Edit</h6>
                        </div>
                        <div class="navbar-nav align-items-center">
                            <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell fa-fw mr-lg-3 mt-lg-1" style="font-size: 23pt; color:#632fb1;"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0" style="max-height:500px;">
                                <!-- Dropdown header -->
                                <div class="px-3 py-3">
                                {{-- <p class="text-muted m-0">You have <strong class="text-primary"></strong> notifications.</p> --}}
                                </div>
                                <div class="row px-3 py-3">
                                    <div class="col-lg-7 mb-auto mt-auto">

                                        @if($patient->Requestcouples)
                                            @foreach($patient->Requestcouples as $requestCouples)
                                                @if($requestCouples->couples == false)
<<<<<<< HEAD
                                                <h5 class="font-weight-bold" >{{$requestCouples->patientAccept->firstName . ' ' . $requestCouples->patientAccept->lastName}}</h5>
                                                <h6 class="font-weight-bold" >{{$requestCouples->patientAccept->idCode}}</h6>
=======
                                                {{-- <h5 class="font-weight-bold" >{{$requestCouples->patient->firstName . ' ' . $requestCouples->patient->lastName}}</h5> --}}
                                                <h5 class="font-weight-bold" >{{$requestCouples->patientRequest->firstName . ' ' . $requestCouples->patientRequest->lastName}}</h5>
                                                {{-- <h6 class="font-weight-bold" >{{$requestCouples->patient->idCode}}</h6> --}}
                                                <h6 class="font-weight-bold" >{{$requestCouples->patientRequest->idCode}}</h6>
>>>>>>> 28926dee534d5b15c75230510de4f54b29789781
                                    </div>
                                        <div class="row">
                                            <form action="{{route('acceptRequestWife')}}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="request_id" value="{{$requestCouples->id}}">
                                                <button class="col m-2 h2 btn btn-success" >Accept</button>
                                            </form>
                                            <form action="{{route('declineRequestWife')}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="request_id" value="{{$requestCouples->id}}">
                                            <button class="col m-2 h2 btn btn-danger" >Decline</button>
                                            </form>

                                        </div>
                                        @endif
                                    @endforeach
                                    @else
                                    <p>No Requests  </p>
                                @endif
                                </div>
                            </li>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- End-wifehusbend -->
            </div>
            <!-- Footer -->
            @include('backEnd.layoutes.footer')
            <!-- footer -->
        </div>
    </div>
  @else
  <div  class="d-flex" id="wrapper">
    <div id="page-content-wrapper">
        <a class="col-lg-11 text-center" href="{{route('edit.profile',$patient->id)}}">
            <div>
                <img src="{{url('imgs/complete.svg')}}" width="950">
            </div>
            <div class="col-12 ml-auto mr-auto">
                <button class="btn btn-info text-white font-weight-bold col-4" >Complete Profile</button>
            </div>
        </a>
        <!-- Footer -->
            @include('backEnd.layoutes.footer')
        <!-- footer -->
    </div>

  </div>
  @endif
@stop

