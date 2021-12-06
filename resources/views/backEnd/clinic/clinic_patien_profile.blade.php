@extends('backEnd.layoutes.mastar')
@section('title','Profile')
@section('content')
    @include('backEnd.clinic.slidenav')
    <!-- profile patient -->
    <!-- Main content -->
    @php
        $count = $patien->patinets_data;
    @endphp
    @if($count)
        <div class="d-flex bg-page" id="wrapper">
            <div id="page-content-wrapper">
                <!-- Topnav -->
                <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Navbar links -->
                            <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                            <!-- Search form -->
                            <h6 class="h5 text-white">{{$patien->patinets_data->online == 1 ? 'online' : 'Ofline'}}</h6>
                            <ul class="navbar-nav align-items-center ml-md-auto">
                               
                            </ul>
                            <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                                <li class="nav-item dropdown">
                                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="media align-items-center">
                                            <span class="avatar avatar-sm rounded-circle">
                                            <img alt="Image placeholder" src="{{url('uploads/patien/' . $patien->image)}}">
                                            </span>
                                            <div class="media-body ml-3 mr-3 d-lg-block">
                                                <h6 class="mb-0 font-weight-bold text-white">{{$patien->firstName . ' ' . $patien->middleName}}</h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="header img-header pb-6">
                        <div class="container-fluid">
                            <div class="header-body">
                                <div class="row pt-5 col-11 ml-auto mr-auto">
                                    <div class="col-xl-4 col-md-4 col-xs-12">
                                        <div class="pills-main-green card card-stats">
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-3">Height</h5>
                                                        <span class="h3 font-weight-bold mb-0">{{$patien->patinets_data->height}} Cm</span>
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
                                    <div class="col-xl-4 col-md-4">
                                        <div class="pills-main-yellow card card-stats">
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-3">Weight</h5>
                                                        <span class="h3 font-weight-bold mb-0">{{$patien->patinets_data->width}}</span>
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
                                    <div class="col-xl-4 col-md-4">
                                        <div class="pills-main-orange card card-stats">
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-3">Blood</h5>
                                                        <span class="h3 font-weight-bold mb-0">{{$patien->patinets_data->blood}}</span>
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
                                    <div class="col-xl-12 col-md-6">
                                        <!-- female div -->
                                        @if($patien->gender == 'female')
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
                                                            <h5 class="card-title text-uppercase text-muted mb-0">Female</h5>
                                                            <span class="h2 font-weight-bold mb-0"></span>
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
                    <div class="nav row testimonial-group nav-pills menu-info col-10 ml-auto mr-auto mb-4" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                        <a class="nav-link col-xs-4 P-1 active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">
                            <li class="font-weight-600"><img src="{{url('imgs/01.png')}}" width="50" alt="...">Diseases</li>
                        </a>
                        <a class="nav-link col-xs-4 p-1 " id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">
                            <li class="font-weight-600"><img src="{{url('imgs/02.png')}}" width="50" alt="...">Medication</li>
                        </a>
                        <a  class="nav-link col-xs-4 p-1" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">
                            <li class="font-weight-600"><img src="{{url('imgs/03.png')}}" width="50" alt="...">Allergies</li>
                        </a>
                        <a  class="nav-link col-xs-4 p-1" id="v-pills-4-tab" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-4" aria-selected="false">
                            <li class="font-weight-600"><img src="{{url('imgs/04.png')}}" width="50" alt="...">Surgeries</li>
                        </a>
                        <a class="nav-link col-xs-4 p-1" id="v-pills-5-tab" data-toggle="pill" href="#v-pills-5" role="tab" aria-controls="v-pills-5" aria-selected="false">
                            <li class="font-weight-600"><img src="{{url('imgs/06.png')}}" width="50" alt="...">Somking</li>
                        </a>
                        <a class="nav-link col-xs-4 p-1" id="v-pills-6-tab" data-toggle="pill" href="#v-pills-6" role="tab" aria-controls="v-pills-6" aria-selected="false">
                            <li class="font-weight-600"><img src="{{url('imgs/05.png')}}" width="50" alt="...">Screening</li>
                        </a>
                        <a class="nav-link col-xs-4 p-1" id="v-pills-7-tab" data-toggle="pill" href="#v-pills-7" role="tab" aria-controls="v-pills-7" aria-selected="false">
                            <li class="font-weight-600 text-center "><img src="{{url('imgs/folder.svg')}}" class="mr-2" width="30" alt="...">Files</li>
                        </a>
                    </div>
                    <div class="col-md-10 p-4 mr-auto ml-auto align-items-center js-fullheight animated">
                        <div class="tab-content mr-auto ml-auto" id="v-pills-tabContent">
                            <div class="tab-pane animated bounce mr-auto ml-auto active slow py-0" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
                                <h5 class="col-12 ml-xl-8 mb-4 mt-3 ml-5">Diseases</h5>
                               
                                @php
                                    $agree_name = json_decode($patien->patinets_data->agree_name);
                                @endphp
                    @if($agree_name)
                    @foreach($agree_name as $agree)
                        <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto p-2">
                            <div class="col-2">
                                <img src="{{url('imgs/01.png')}}" width="40" alt="...">
                            </div>
                            <div class="col-8">
                                <h5 class="mt-3">
                                    {{$agree}}
                                </h5>
                            </div>
                        </div>
                    @endforeach
                    @endif
                            </div>
                            <div class="tab-pane animated bounce  slow py-0" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
                                <h5 class="col-12 ml-xl-8 mb-4 mt-3 ml-5">Medication</h5>
                                @php
                                    $medication_name = json_decode($patien->patinets_data->medication_name);
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
                                                  @foreach($medication_name as $medication)
                                                  @if($medication)
                                                  <tr>
                                                    <td class="text-center border-0">{{$medication->name}}</td>
                                                    <td class="text-center border-0">{{$medication->times_day}}</td>
                                                    <td class="text-center border-0">{{$medication->time}}</td>
                                                  </tr>
                                                  @endif
                                                  @endforeach
                                                </tbody>
                                              </table>
                                            </h5>
                                        </div>
                                    </div>

                                 
                            </div>
                            <div class="tab-pane animated bounce slow py-0" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
                                <h5 class="col-12 mb-4 mt-3 ml-5">Allergies</h5>
                                @foreach(json_decode($patien->patinets_data->allergi_data) as $array)
                                    <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                                        <div class="col-8">
                                            @if($array->allergi_name)
                                                <h4 class="mt-3 pl-4">{{$array->allergi_name}}</h4>
                                                @else 
                                                None
                                               
                                            @endif
                                            @if($array->severity)
                                                <h5 class="pl-4"><img src="{{url('imgs/lavel.png')}}" width="50" alt="...">{{$array->severity}}</h5>
                                            @endif
                                            @if($array->reaction)
                                                <h5 class="mt--4 pl-3"><img src="{{url('imgs/save.png')}}" width="60" alt="...">{{$array->reaction}}</h5>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="tab-pane animated bounce slow py-0" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-4-tab">
                                <h5 class="col-12 ml-xl-8 mb-4 mt-3 ml-5">Surgeries</h5>
                                @foreach(json_decode($patien->patinets_data->surgery_data) as $array_su)
                                    <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                                        <div class="col-8">
                                            @if($array_su->surgery_name)
                                                <h4 class="mt-3 pl-4">{{$array_su->surgery_name}}</h4>
                                                @else 
                                                None
                                            @endif
                                            @if($array_su->surgery_date)
                                                <h5 class="mt--3 pl-3"><img src="{{url('imgs/date.png')}}" width="60" alt="...">{{$array_su->surgery_date}}</h5>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="tab-pane animated bounce slow py-0" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-5-tab">
                                <h4 class="col-12 ml-xl-8 mb-4 mt-3 ml-5">Somking</h4>
                                <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                                    <div class="col-8">
                                        <h5 class="mt-3 pl-4 font-weight-bold">Alcohol</h5>
                                        <h5 class="pl-3 pl-6">{{$patien->patinets_data->alcohol_type}}</h5>
                                        <h5 class="mt-3 pl-4"><img src="{{url('imgs/lavel.png')}}" width="50" alt="...">{{$patien->patinets_data->alcohol_severity}}</h5>
                                    </div>
                                </div>
                                <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                                    <div class="col-8">
                                        <h5 class="mt-3 pl-4 font-weight-bold">Cigarette</h5>
                                        <h5 class="mt-3 pl-4"><img src="{{url('imgs/lavel.png')}}" width="50" alt="...">{{$patien->patinets_data->cigarettes}}</h5>
                                    </div>
                                </div>
                                <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                                    <div class="col-8">
                                        <h5 class="mt-3 pl-4 font-weight-bold">Tobacco</h5>
                                        <h5 class="mt-3 pl-4"><img src="{{url('imgs/lavel.png')}}" width="50" alt="...">{{$patien->patinets_data->tobacco}}</h5>
                                    </div>
                                </div>
                                <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                                    <div class="col-8">
                                        <h5 class="mt-3 pl-4 font-weight-bold">Drug</h5>
                                        <h5 class="mt-3 pl-4"><img src="{{url('imgs/lavel.png')}}" width="50" alt="...">{{$patien->patinets_data->drug}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane animated bounce py-0" id="v-pills-6" role="tabpanel" aria-labelledby="v-pills-6-tab">
                                <h4 class="col-12 ml-xl-8 mb-4 mt-3 ml-5">Screening</h4>
                                <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                                    <div class="col-8">
                                        <h5 class="mt-3 pl-4">Colonscopy</h5>
                                        <h5 class="mt-3 pl-3"><img src="{{url('imgs/date.png')}}" width="60" alt="...">@if($patien->patinets_data->colonscopy == 1) {{$patien->patinets_data->colonscopy_data}} @else No Date @endif</h5>
                                    </div>
                                </div>
                                <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                                    <div class="col-8">
                                        <h5 class="mt-3 pl-4">Mmamogram</h5>
                                        <h5 class="mt-3 pl-3"><img src="{{url('imgs/date.png')}}" width="60" alt="...">@if($patien->patinets_data->mammogram == 3) {{$patien->patinets_data->mammogram_date}} @else No Date @endif</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane animated bounce py-0" id="v-pills-7" role="tabpanel" aria-labelledby="v-pills-7-tab">
                                <h4 class="col-12 ml-xl-8 mb-4 mt-3 ml-5">Files</h4>
                                <div class="pills-main col-xl-8 col-md-4 col-xs-12 row row-text mb-3 mr-auto ml-auto">
                                    <div class="col-12 ml-auto mr-auto">
                                        <table class="table">
                                            <tr>
                                                <th>Name</th>
                                                <th>Show</th>
                                                <th>Download</th>
                                            </tr>
                                            @if($patien->patinets_data->rocata_file)
                                                <tr>
                                                    <td>{{$patien->patinets_data->rocata_file}}</td>
                                                    <td><a target="_blank" href = "{{url('uploads/pdf_file/rocata/' . $patien->patinets_data->rocata_file)}}">Show</a></td>
                                                    <td><a href = "{{route('download_pdf',$patien->id)}}">Download</a></td>
                                                </tr>
                                            @else
                                                <div class = "alert alert-danger">No Files</div>
                                            @endif
                                            @if($patien->patinets_data->rays_file)
                                                <tr>
                                                    <td>{{$patien->patinets_data->rays_file}}</td>
                                                    <td><a target="_blank" href = "{{url('uploads/pdf_file/rays/' . $patien->patinets_data->rays_file)}}">Show</a></td>
                                                    <td><a href = "{{route('download_pdf',$patien->id)}}">Download</a></td>
                                                </tr>
                                            @else
                                                <div class = "alert alert-danger">No Files</div>
                                            @endif
                                            @if($patien->patinets_data->analzes_file)
                                                <tr>
                                                    <td>{{$patien->patinets_data->analzes_file}}</td>
                                                    <td><a target="_blank" href = "{{url('uploads/pdf_file/analzes/' . $patien->patinets_data->analzes_file)}}">Show</a></td>
                                                    <td><a href = "{{route('download_pdf',$patien->id)}}">Download</a></td>
                                                </tr>
                                            @else
                                                <div class = "alert alert-danger">No Files</div>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- HistoryFamilyContent -->
                    <div class="nav row family-group nav-pills row col-9 ml-auto mr-auto mt-5" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                        <a class="active" id="v-pills-01-tab" data-toggle="pill" href="#v-pills-01" role="tab" aria-controls="v-pills-01" aria-selected="true">
                            <div class="text-center">
                                <img src="{{url('imgs/mother.png')}}" width="100">
                                <h4 class="text-pills m-auto" style="font-size:12pt;padding-top:15px;">Mother</h4>
                            </div>
                        </a>
                        <a class="" id="v-pills-02-tab" data-toggle="pill" href="#v-pills-02" role="tab" aria-controls="v-pills-02" aria-selected="true">
                            <div class="text-center">
                                <img src="{{url('imgs/father.png')}}" width="100">
                                <h4 class="text-pills m-auto" style="font-size: 12pt;padding-top:15px;">Father</h4>
                            </div>
                        </a>
                        
                        
                    </div>
                    <div class="col-md-10 mr-auto ml-auto pill-box-f p-4 align-items-center js-fullheight animated">
                        <div class="tab-content mr-auto ml-auto" id="v-pills-tabContent">
                            <div class="tab-pane animated bounce slow py-0 mb-4 mt-4 show active" id="v-pills-01" role="tabpanel" aria-labelledby="v-pills-01-tab">
                                @php
                                    $mother = json_decode($patien->patinets_data->mother);
                                    $father = json_decode($patien->patinets_data->father);
                                    $sister = json_decode($patien->patinets_data->sister);
                                    $brother = json_decode($patien->patinets_data->brother);
                                    $grandpaf = json_decode($patien->patinets_data->grnadpaF);
                                    $grandpam = json_decode($patien->patinets_data->grnadpaM);
                                    $grandmaf = json_decode($patien->patinets_data->grandmaF);
                                    $grandmam = json_decode($patien->patinets_data->grnadmaM);
                                @endphp
                                @if($mother > 0)
                                <div class="ml-5"><img src="{{url('imgs/mother.png')}}" width="80"></div>
                                    @foreach($mother as $mother)
                                        
                                        <div class="pills-main col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                            <div class="col-2">
                                                <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <h6 class="mt-4">{{$mother}}</h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="ml-5"><img src="{{url('imgs/mother.png')}}" width="80"></div>
                                    <div class="pills-main col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                        <div class="col-2">
                                            <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mt-4">No Data</h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane animated bounce slow py-0 mb-4 mt-4" id="v-pills-02" role="tabpanel" aria-labelledby="v-pills-02-tab">
                                @if($father > 0)
                                <div class="ml-5"><img src="{{url('imgs/father.png')}}" width="80"></div>
                                    @foreach($father as $father)
                                        
                                        <div class="pills-main pills-main-orange col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                            <div class="col-2">
                                                <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <h6 class="mt-4">{{$father}}</h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="ml-5"><img src="{{url('imgs/father.png')}}" width="80"></div>
                                    <div class="pills-main pills-main-orange col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                        <div class="col-2">
                                            <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mt-4">No Data</h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane animated bounce slow py-0 mb-4 mt-4" id="v-pills-03" role="tabpanel" aria-labelledby="v-pills-03-tab">
                                @if($sister > 0)
                                <div class="ml-5"><img src="{{url('imgs/sis.png')}}" width="80"></div>
                                    @foreach($sister as $sister)
                                        
                                        <div class="pills-main pills-main-green col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                            <div class="col-2">
                                                <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <h6 class="mt-4">{{$sister}}</h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="ml-5"><img src="{{url('imgs/sis.png')}}" width="80"></div>
                                    <div class="pills-main pills-main-green col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                        <div class="col-2">
                                            <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mt-4">No Data</h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane animated bounce slow py-0 mb-4 mt-4" id="v-pills-04" role="tabpanel" aria-labelledby="v-pills-04-tab">
                                @if($brother > 0)
                                <div class="ml-5"><img src="{{url('imgs/bro.png')}}" width="80"></div>
                                    @foreach($brother as $brother)
                                        
                                        <div class="pills-main pills-main-teal col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                            <div class="col-2">
                                                <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <h6 class="mt-4">{{$brother}}</h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="ml-5"><img src="{{url('imgs/bro.png')}}" width="80"></div>
                                    <div class="pills-main pills-main-teal col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                        <div class="col-2">
                                            <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mt-4">No Data</h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane animated bounce slow py-0 mb-4 mt-4" id="v-pills-05" role="tabpanel" aria-labelledby="v-pills-05-tab">
                                @if($grandmam >0)
                                <div class="ml-5"><img src="{{url('imgs/grandma.png')}}" width="80"></div>
                                    @foreach($grandmam as $grandmam)
                                        
                                        <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                            <div class="col-2">
                                                <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <h6 class="mt-4">{{$grandmam}}</h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="ml-5"><img src="{{url('imgs/grandma.png')}}" width="80"></div>
                                    <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                        <div class="col-2">
                                            <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mt-4">No Data</h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane animated bounce slow py-0 mb-4 mt-4" id="v-pills-06" role="tabpanel" aria-labelledby="v-pills-06-tab">
                                @if($grandmaf > 0)
                                <div class="ml-5"><img src="{{url('imgs/grandma.png')}}" width="80"></div>
                                    @foreach($grandmaf as $grandmaf)
                                        
                                        <div class="pills-main pills-main-green col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                            <div class="col-2">
                                                <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <h6 class="mt-4">{{$grandmaf}}/h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="ml-5"><img src="{{url('imgs/grandma.png')}}" width="80"></div>
                                    <div class="pills-main pills-main-green col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                        <div class="col-2">
                                            <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mt-4">No Data </h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane animated bounce slow py-0 mb-4 mt-4" id="v-pills-07" role="tabpanel" aria-labelledby="v-pills-07-tab">
                                @if($grandpam > 0)
                                <div class="ml-5"><img src="{{url('imgs/grandpa.png')}}" width="80"></div>
                                    @foreach($grandpam as $grandpam)
                                        
                                        <div class="pills-main pills-main-teal col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                            <div class="col-2">
                                                <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <h6 class="mt-4">{{$grandpam}}</h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="ml-5"><img src="{{url('imgs/grandpa.png')}}" width="80"></div>
                                    <div class="pills-main pills-main-teal col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                        <div class="col-2">
                                            <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mt-4">No Data</h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane animated bounce slow py-0 mb-4 mt-4" id="v-pills-08" role="tabpanel" aria-labelledby="v-pills-08-tab">
                                @if($grandpaf > 0)
                                <div class="ml-5"><img src="{{url('imgs/grandpa.png')}}" width="80"></div>
                                    @foreach($grandpaf as $grandpaf)
                                        
                                        <div class="pills-main pills-main-teal col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                            <div class="col-2">
                                                <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <h6 class="mt-4">{{$grandpaf}}</h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="ml-5"><img src="{{url('imgs/grandpa.png')}}" width="80"></div>
                                    <div class="pills-main pills-main-teal col-xl-8 col-md-4 col-xs-12 row mb-3 mr-auto ml-auto">
                                        <div class="col-2">
                                            <img src="{{url('imgs/01.png')}}" width="60" alt="...">
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mt-4">No Data</h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- female -->
                    {{-- @if(auth())--}}
                    @if($patien->gender == 'female')
                        <div class="">
                            <h2 class="row mt-4 ml-5 mb-5">Female History</h2>
                            <div><h5 class="card-title mt-4 ml-5 mb-5 text-uppercase text-muted mb-3">Female Mother</h5></div>
                            <div class="row mt-2 mr-auto ml-auto">
                                @if($patien->patinets_data->mother_Period_Cycle != null || $patien->patinets_data->mother_pregnency != null || $patien->patinets_data->mother_abotion != null)
                                    <div class="col-xl-6 col-md-2 col-xs-12 mb-4">
                                        <div class="pills-main pills-main-pink card card-stats">
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div>
                                                            <img src="imgs/prng.png" width="60" alt="...">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-3">Pregnency</h5>
                                                        <span class="h5 font-weight-bold mb-0">Yes</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-2 col-xs-12 mb-5">
                                        <div class="pills-main pills-main-pink card card-stats">
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div>
                                                            <img src="imgs/beby.png" width="60" alt="...">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-3">Abortion</h5>
                                                        <span class="h5 font-weight-bold mb-0">Yes</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-2 col-xs-12 mb-5">
                                        <div class="pills-main pills-main-pink  card card-stats">
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div>
                                                            <img src="imgs/noPreg.png" width="60" alt="...">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-3">Contraceptives</h5>
                                                        <span class="h5 font-weight-bold mb-0">Anjection</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($patien->patinets_data->wife_Period_Cycle != null || $patien->patinets_data->wife_Abotion != null || $patien->patinets_data->wife_Contraceptive != null)
                                    <div class="col-xl-4 col-md-2 col-xs-12 mb-5">
                                        <div class="pills-main pills-main-pink card card-stats">
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div>
                                                            <img src="imgs/delivery.png" width="60" alt="...">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-3">Types of Deliveries</h5>
                                                        <span class="h5 font-weight-bold mb-0">Normal</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-2 col-xs-12 mb-4">
                                        <div class="pills-main pills-main-pink card card-stats">
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div>
                                                            <img src="imgs/pain.png" width="60" alt="...">
                                                        </div>
                                                    </div>
                                                    @if($patien->state == 'single')
                                                        <div class="col">
                                                            <h5 class="card-title text-uppercase text-muted mb-3">Complicetion in Deliveries</h5>
                                                            <span class="h5 font-weight-bold mb-0">No</span>
                                                        </div>
                                                    @endif
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
                    <a href="{{route('clinic_all_children',[$clinic->id,$patien->id])}}" class="p-4 text-primary" style="text-decoration:none;">
                    <div class="row">
                        <div class="col-3 text-center">
                            <img src="{{url('imgs/kids.svg')}}" width="120" alt="...">
                        </div>
                        <div class="col-6 mb-auto mt-auto">
                            <h2 class=""> Kids</h2>
                            <h6 class="text-muted">Add and Edit</h6>
                        </div>
                    </div>
                    </a>
                </div>
                <!-- End-kids -->
                </div>
                <!-- Footer -->
            @include('backEnd.layoutes.footer')
            <!-- footer -->
            </div>
        </div>
    @else
        <!-- container -->
        <div class="container">
            <p class="alert alert-danger mb-4">Sorry, there is no data</p>
        </div>
        <!-- container -->
    @endif




    <!-- profiel patient -->



@stop
