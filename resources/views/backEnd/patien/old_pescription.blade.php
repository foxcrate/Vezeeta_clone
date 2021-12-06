@extends('backEnd.layoutes.mastar')
@section('title','old pescription')
@section('content')
{{--@include('backEnd.patien.slidenav')--}}
    @php
        // $doctor_rocata = auth()->guard('doctor')->rocatas;
  		$Raoucheh 		  = $patient->Raoucheh;
  		$patientAnalzazes = $patient->patient_analzes;
        $patient_rays 	  = $patient->patient_rays;
  @endphp

  <div class="d-flex bg-page" id="wrapper">
  	@include('backEnd.patien.slidenav')
  	<!-- Page Content -->
    <div id="page-content-wrapper">
      @include('includes.patientNav')
        <!-- informationContent -->
        <!-- informationContent -->
        <div class="container-fluid">
          <div class="header img-header pb-6">
            <div class="container-fluid" style="margin-top:130px; margin-bottom:130px;">
              <nav class="col-8 ml-auto mr-auto">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link font-weight-bold text-primary active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Prescription</a>
                  <a class="nav-item nav-link font-weight-bold text-primary" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tests</a>
                  <a class="nav-item nav-link font-weight-bold text-primary" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Radiology</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                  <div class="header-body">
                    <div class="row pt-5">
                      <!-- roachata -->
                      @if($Raoucheh)
                        @foreach($Raoucheh as $Raoucheh)
                          <div class="pills-main pills-main-yellow col-xl-9 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                            <div class="row col-lg-8 ml-5 mt-5">
                              <div class="row col-lg-12">
                                <div class="col-4">
                                  <h5 class="font-weight-bold text-primary">Dr.</h5>
                                </div>
                                <div class="col-5">
                                  <h5 class="">{{$Raoucheh->online_doctor->name}}</h5>
                                </div>
                              </div>
                              <div class="row col-12 ">
                                <div class="col-4">
                                  <h5 class="font-weight-bold text-primary">Speciality :</h5>
                                </div>
                                <div class="col-5">
                                  <h5 class="">{{$Raoucheh->online_doctor->special->name}}</h5>
                                </div>
                              </div>
                              <div class="row col-12 ">
                                <div class="col-4">
                                  <h5 class="font-weight-bold text-primary">Date:</h5>
                                </div>
                                <div class="col-5">
                                  <h5 class="">{{date('d/m/Y',$Raoucheh->date)}}</h5>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 mt-5">
                              {{--  <h5 class="font-weight-bold h3 text-uppercase">{{$Raoucheh}}</h5>  --}}
                            </div>
                            <div class="row col-lg-10 mb-2 ml-5">
                              <div class="col-3">
                                <h5 class="font-weight-bold text-primary">Patient State :</h5>
                              </div>
                              <div class="col-5">
                                <h5 class="">{{$Raoucheh->prescription}}</h5>
                              </div>
                            </div>
                            <hr class="col-lg-11 ml-auto mr-auto mb-5" />
                            <div class="row col-lg-12 mb-3">
                                <div class="col-10 ml-auto mr-auto">
                                    <h5 class="font-weight-bold text-primary">Medication</h5>
                                </div>
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
                          </div>
                        @endforeach
                      @else
                      <p class="col-lg-12 alert alert-danger">No Data</p>
                      @endif
                      <!-- roachata -->
                    </div>
                  </div>
                </div>
                <!-- analzes -->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="header-body">
                        <div class="row pt-5">
                            @if($patientAnalzazes)
                                  @foreach($patient->patient_analzes as $p_analzes)
                                          <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                              <div class="col-12">
                                                  <h5 class="mt-4 float-right">{{date('d/m/Y',$p_analzes->date)}}</h5>
                                              </div>
                                              @foreach($p_analzes['test_name'] as $t)
                                              <div class="row col-12 mb-3">
                                                <div class="col-4">
                                                    <h5 class="font-weight-bold">Test Name</h5>
                                                </div>
                                                <div class="col-8">
                                                    <h5 class="">{{$t['test_name']}}</h5>
                                                </div>
                                            </div>
                                            <div class="row col-12 mb-3">
                                                <div class="col-4">
                                                    <h5 class="font-weight-bold">Test Description</h5>
                                                </div>
                                                <div class="col-8">
                                                    <h5 class="">{{$t['test_description']}}</h5>
                                                    <!-- get result -->
                                                {{-- <p>{{$p_analzes->result->id}}</p> --}}
                                                <!-- get result -->
                                                </div>

                                                @if($p_analzes->result)
                                                <h5 class="font-weight-bold" id = "btn_result">Result : </h5>
                                                <a id = "link_result_show" href="{{url('uploads/pdf_file/result/analzes/' . $p_analzes->result->name)}}">{{$p_analzes->result->name}}</a>
                                                @else
                                                <div class="alert alert-danger">No Result</div>
                                                @endif
                                            </div>
                                              @endforeach
                                          </div>

                                  @endforeach


                                    @else
                                <p class="alert alert-danger">No Data</p>
                            @endif

                        </div>
                    </div>
                </div>
                <!-- analzes -->
                <!-- rays -->
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="header-body">
                        <div class="row pt-5">
                            @if($patient_rays)
                                @foreach($patient->patient_rays as $patient_rays)
                                <div class="pills-main pills-main-yellow col-xl-8 col-md-4 col-xs-12 row mb-4 mr-auto ml-auto">
                                  <div class="col-12">
                                      <h5 class="mt-4 float-right">{{date('d/m/Y',$patient_rays->date)}}</h5>
                                  </div>
                                  @foreach($patient_rays->ray_name as $r)
                                  <div class="row col-12 mb-3">
                                    <div class="col-4">
                                        <h5 class="font-weight-bold">Radiology Name</h5>
                                    </div>

                                    <div class="col-8">
                                        <h5 class="">{{$r['ray_name']}}</h5>
                                    </div>
                                </div>
                                <div class="row col-12 mb-3">
                                    <div class="col-4">
                                        <h5 class="font-weight-bold">Radiology Description</h5>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="">{{$r['ray_description']}}</h5>
                                    </div>
                                    @if($patient_rays->result)
                                    <h5 class="font-weight-bold" id = "btn_result">Result : </h5>
                                    <a id = "link_result_show" href="{{url('uploads/pdf_file/result/rays/' . $patient_rays->result->name)}}">{{$patient_rays->result->name}}</a>
                                    @else
                                    <div class="alert alert-danger">No Result</div>
                                    @endif
                                </div>
                                  @endforeach
                                </div>
                                @endforeach
                                @else
                                    <p class="alert alert-danger">No Data</p>
                                @endif
                        </div>
                    </div>
                </div>
                <!-- rays -->
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
@section('scripts')
{{-- <script>
    var btn = document.getElementById('btn_result'),
        link = document.getElementById('link_result_show');

        btn.onclick = function(){
          link.style.display = 'block';
        }

</script> --}}

@endsection
