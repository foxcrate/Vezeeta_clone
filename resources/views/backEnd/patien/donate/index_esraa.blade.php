
@extends('backEnd.layoutes.mastar')
@section('title','Donate')
@section('content')
@include('backEnd.patien.slidenav')

<div class="d-flex" id="wrapper">
    <div id="page-content-wrapper">
        <!-- Topnav -->
        @include('includes.patientNav')
        @if(session()->has('error'))
            <div class="alert alert-danger m-2">
                {{ session()->get('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger m-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container mt-5">
            <ul class="nav mb-5" id="myTab" role="tablist">
                <li class="nav-item col-lg-3 m-1 ml-auto mr-auto pill-donate text-center li-active" role="presentation">
                  <a class="nav-link text-dark h5"  id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                    <img src="{{url('imgs/blood.svg')}}" height="80" class="d-block w-100 mt-2 mb-2" alt="...">
                    <h4 class="mt-3">Blood Bank</h4>
                  </a>
                </li>

                <li class="nav-item col-lg-3 m-1 ml-auto mr-auto pill-donate text-center" role="presentation">
                  <a class="nav-link text-dark h5" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <img src="{{url('imgs/wheelchair.svg')}}" height="80" class="d-block w-100 mt-2 mb-2" alt="...">
                    <h4 class="mt-3">Medical Devices</h4>
                  </a>
                </li>
                <li class="nav-item col-lg-3 m-1 ml-auto mr-auto pill-donate text-center" role="presentation">
                  <a class="nav-link donate text-dark h5" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                    <img src="{{url('imgs/mediacationdonate.svg')}}" height="80" class="d-block w-100 mt-2 mb-2" alt="...">
                    <h4 class="mt-3">Medication</h4>
                  </a>
                </li>
            </ul>
            <div class="tab-content mb-5" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @foreach ($patient->donorSender as  $donorS)
                    @if($donorS->accept == false)
                        <p id="alertDonor" style="display:none">Requested Added</p>
                        <div class="tab-content-request col-lg-8 row ml-auto mr-auto mb-auto mt-4">
                            <div class="col-lg-2 mr-2 ml-5 mb-auto mt-auto">
                                <img src="{{url('imgs/request.svg')}}" class=" mb-3" height="40">
                            </div>
                            <div class="col-lg-5 mb-auto mt-auto">
                                <h5 class="font-weight-bold text-capitalize" height="40">{{ $donorS->patientRequest->name }}</h5>
                                <h6 class="font-weight-bold text-capitalize" height="40">{{ $donorS->patientRequest->idCode }}</h6>
                                {{--  <h5>{{ $donorS->patientRequest->name }} | <span class="font-weight-bold" style="color:#cf0a0a">Quantity: {{ $medicalS->quantity }}</span></h5>  --}}
                            </div>
                            <div class="col-lg-1 mb-auto mt-auto">
                                <form id="acceptDonorRequest" action="" method="">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="donorReqId" value="{{ $donorS->id }}">
                                    {{--  <input type="hidden" name="deviceId" value="{{ $medicalS->donorForm->id }}">  --}}
                                    <input type="submit" class="btn btn-success h3" value="Accept">
                                </form>

                            </div>
                            <div class="col-lg-1 ml-4 mb-auto mt-auto">
                                <form id="declineDonorRequest" action="" method="">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="donorReqId" value="{{ $donorS->id }}">
                                    <input type="submit"class="btn btn-danger h3" value="Decline">
                                </form>
                            </div>
                        </div>

                    @endif
                @endforeach
                <div class="tab-content-sub mt-4 mb-5 col-lg-8 ml-auto mr-auto" style="" >
                    <form class="row col-lg-12 ml-auto mr-auto" id="patient_update_is_donor" action="{{route('patient_update_is_donor',$patient->id)}}" method="POST">
                      {{ csrf_field() }}
                      <label class="col-lg-5 h5 font-weight-bold ml-5 mt-auto mb-auto" for="">Are you a blood donor?</label>
                      <div class="col-lg-6 ml-auto mr-auto">
                        <div class="onoffswitch">
                          <input type="hidden" name="latitude" value="{{ $patient->latitude }}">
                          <input type="hidden" name="longitude" value="{{ $patient->longitude }}">
                          <input type="checkbox" name="is_donor" class="onoffswitch-checkbox" id="myonoffswitchH" value="{{$patient->is_donor == 1 ? 1 : 0}}" {{$patient->is_donor == 1 ? 'checked' : ''}}>
                          <label class="onoffswitch-label" for="myonoffswitchH">
                            <script
                            src="https://code.jquery.com/jquery-3.5.1.min.js"
                            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
                            crossorigin="anonymous"></script>
                            <script>
                                  $('#myonoffswitchH').on('change', function() {
                                    console.log('aaa');
                                      // this.value =
                                      this.checked ? 1 : 0;
                                      $("#patient_update_is_donor").submit();
                                  });
                              </script>
                              <div class="onoffswitch-inner"></div>
                              <div class="onoffswitch-switch"></div>
                          </label>
                        </div>
                      </div>
                    </form>

                </div>
                <!-- Button trigger Blood modal -->
                @foreach ($patient->medicalSender as  $medicalS)
                        @if($medicalS->accept == false)
                            <div class="tab-content-request col-lg-10 row ml-auto mr-auto mb-auto mt-4">
                                <div class="col-lg-2 mr-2 ml-5 mb-auto mt-auto">
                                    <img src="{{url('imgs/request.svg')}}" class=" mb-3" height="40">
                                </div>
                                <div class="col-lg-5 mb-auto mt-auto">
                                    <h5 class="font-weight-bold text-capitalize" height="40">{{ $medicalS->patientRequest->name }}</h5>
                                    <h5>{{ $medicalS->donorForm->medicalDevicesName }} | <span class="font-weight-bold" style="color:#cf0a0a">Quantity: {{ $medicalS->quantity }}</span></h5>
                                </div>
                                <div class="col-lg-1 mb-auto mt-auto">
                                    <form id="acceptDeviceRequest" action="" method="">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="deviceReqId" value="{{ $medicalS->id }}">
                                        <input type="hidden" name="deviceId" value="{{ $medicalS->donorForm->id }}">
                                        <input type="submit" class="btn btn-success h3" value="Accept">
                                    </form>

                                </div>
                                <div class="col-lg-1 mb-auto mt-auto">
                                    <form id="declineDeviceRequest" action="" method="">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="medSId" value="{{ $medicalS->id }}">
                                        <input type="submit"class="btn btn-danger h3" value="Decline">
                                    </form>
                                </div>

                        @endif
                    @endforeach
                <div class="tab-content-sub col-lg-10 ml-auto mr-auto">
                    <div class="col-lg-6 ml-auto mr-auto" style="margin-top:40px; margin-bottom:40px;">
                        <h3 class="col-lg-12 font-weight-bold text-center mb-3"><img src="{{url('imgs/request.svg')}}" class="mr-3" height="40">Request</h3>
                        <button type="button" class="col-lg-12 btn btn-danger h5 mt-3" data-toggle="modal" data-target="#exampleModal1">
                            Request Blood
                        </button>
                    </div>
                </div>
                <div class="tab-content-sub col-lg-10 ml-auto mr-auto mt-3">
                    <div class="col-lg-8 ml-auto mr-auto" style="margin-top:40px; margin-bottom:40px;">
                        <h3 class="col-lg-12 font-weight-bold text-center mb-3"><img src="{{url('imgs/search.svg')}}" class="mr-3" height="40">Donate</h3>
                        <form action="{{route('searchDevice')}}" method="GET">
                                <div class="col-10 ml-auto mr-auto">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="font-weight-bold" for="">Blood Types</label>
                                            <select name="blood" id="" class="form-control">
                                                <option hidden>Choose ..</option>
                                                @foreach($bloods as $blood)
                                                <option value="{{$blood->name}}">{{$blood->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 ml-auto mr-auto">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="font-weight-bold" for="">Address</label>
                                            <input id="pac-input" name = "address" type="text" class="form-control">
                                            <div id="map" style="height: 550px;width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 ml-auto mr-auto">
                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="form-control btn btn-danger">
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>

                <!--Blood Modal -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Request Blood</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row col-lg-12 mb-5 mt-3">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="">Blood Types</label>
                                <select name="blood" id="" class="form-control">
                                    <option hidden>Choose ..</option>
                                    @foreach($bloods as $blood)
                                    <option value="{{$blood->name}}">{{$blood->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="font-weight-bold" for="">Address</label>
                                <input id="pac-input" name = "address" type="text" class="form-control">
                                <div id="map" style="height: 550px;width: 100%;"></div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="font-weight-bold" for="">More Details</label>
                                <textarea name = "details" type="text" class="form-control" id="More-Detils" aria-describedby="emailHelp"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="font-weight-bold" for="">Patient Name</label>
                                <input name = "patientName" type="text" class="form-control" id="Patient-Name" aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="font-weight-bold" for="">File Number</label>
                                <input name = "fileNumber" type="text" class="form-control" id="Address" aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-12 mt-5 text-center">
                                <input type="submit" value="Request" class="col-md-6 btn btn-danger">
                            </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                @if($medicalDevices)
                  @foreach ($medicalDevices as $medicalDevice )
                    @if($medicalDevice->patient_id != auth()->guard('patien')->user()->id)
                        <div class="row col-lg-10 ml-auto mr-auto p-4 label-donate m-4">
                            <div class="col-lg-12 text-center">
                                <img src="{{$medicalDevice->medicalDevicesImage}}" class="col-lg-5 ml-auto mr-auto mt-2 mb-2" alt="...">
                                <h4 class="col-lg-12 ml-auto mr-auto mt-2 mb-2 font-weight-bold">{{$medicalDevice->medicalDevicesName}}</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 pb-3">
                                    @if(!$medicalDevice->patient->image)
                                        <img class="rounded-circle" src="{{ asset('uploads/default.png') }}" width="90" height="90" />
                                    @else
                                        <img class="rounded-circle" src="{{$medicalDevice->patient->image}}" width="90" height="90" />
                                    @endif
                                </div>
                                <div class="col-lg-8 mt-2">
                                    <h5 class="col-lg-12 font-weight-bold">{{$medicalDevice->patient->name}}</h5>
                                    <h5 class="col-lg-12 font-weight-bold">{{$medicalDevice->patient->idCode}}</h5>
                                    <h6 class="col-lg-12">{{$medicalDevice->medicalDevicesInformation}}</h6>
                                    <h6 class="col-lg-12 mb-3">{{$medicalDevice->medicalCategory}}</h6>
                                </div>
                            </div>
                        </div>
                    @endif

                  @endforeach
                @endif
              </div>
                    {{-- @if($bloods)
                        <form action="{{route('donate.store')}}" method="POST" style="margin-top:20px;">
                            {{ csrf_field() }}
                            <input type="hidden" name="patient_id" value="{{$patient->id}}">
                            <input type="hidden" id="latitude" name="latitude" value="markerCurrent.position.lat()">
                            <input type="hidden" id="longitude" name="longitude" value="markerCurrent.position.lng()">
                            <div class="row col-lg-8 ml-auto mr-auto mb-5 mt-3">
                                <div class="col-md-10 ml-auto mr-auto">
                                    <label class="font-weight-bold" for="">Blood Types</label>
                                    <select name="blood" id="" class="form-control">
                                        <option hidden>Choose ..</option>
                                        @foreach($bloods as $blood)
                                        <option value="{{$blood->name}}">{{$blood->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-10 mt-3 ml-auto mr-auto">
                                    <label class="font-weight-bold" for="">Address</label>
                                    <input id="pac-input" name = "address" type="text" class="form-control">
                                    <div id="map" style="height: 550px;width: 550px;"></div>
                                </div>
                                <div class="col-md-10 mt-3 ml-auto mr-auto">
                                    <label class="font-weight-bold" for="">More Detils</label>
                                    <textarea name = "details" type="text" class="form-control" id="More-Detils" aria-describedby="emailHelp"></textarea>
                                </div>
                                <div class="col-md-10 mt-3 ml-auto mr-auto">
                                    <label class="font-weight-bold" for="">Patient Name</label>
                                    <input name = "patientName" type="text" class="form-control" id="Patient-Name" aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-10 mt-3 ml-auto mr-auto">
                                    <label class="font-weight-bold" for="">File Number</label>
                                    <input name = "fileNumber" type="text" class="form-control" id="Address" aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-12 mt-5 text-center">
                                    <input type="submit" value="Filter" class="col-md-6 btn btn-danger">
                                </div>
                            </div>
                        </form>
                    @endif
                    @if($donors)
                        @foreach ($donors as $donor)
                            @if($donor->patient->is_donor == true && $donor->patient_id != auth()->guard('patien')->user()->id)
                                <div class="row col-lg-10 ml-auto mr-auto p-4 label-donate m-4">
                                <div class="col-lg-3 pb-3">
                                    <img src="{{url('imgs/dProfilePic.png')}}" width="120" />
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <h4 class="col-lg-8 font-weight-bold">{{$donor->patient->name}}</h4>
                                    <h5 class="col-lg-8 mb-3">{{$donor->patient->idCode}}</h5>
                                    <h5 class="col-lg-8 mb-3">{{$donor->patient->phoneNumber}}</h5>
                                    <h5 class="col-lg-12 text-muted">{{$donor->patient->age}} Years</h5>
                                </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
              </div> --}}

              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- Button trigger Medical Devices modal -->
                @foreach ($patient->medicalSender as  $medicalS)
                        @if($medicalS->accept == false)
                            <div class="tab-content-request col-lg-10 row ml-auto mr-auto mb-auto mt-4">
                                <div class="col-lg-2 mr-2 ml-5 mb-auto mt-auto">
                                    <img src="{{url('imgs/request.svg')}}" class=" mb-3" height="40">
                                </div>
                                <div class="col-lg-5 mb-auto mt-auto">
                                    <h5 class="font-weight-bold text-capitalize" height="40">{{ $medicalS->patientRequest->name }}</h5>
                                    <h5>{{ $medicalS->donorForm->medicalDevicesName }} | <span class="font-weight-bold" style="color:#cf0a0a">Quantity: {{ $medicalS->quantity }}</span></h5>
                                </div>
                                <div class="col-lg-1 mb-auto mt-auto">
                                    <form id="acceptDeviceRequest" action="" method="">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="deviceReqId" value="{{ $medicalS->id }}">
                                        <input type="hidden" name="deviceId" value="{{ $medicalS->donorForm->id }}">
                                        <input type="submit" class="btn btn-success h3" value="Accept">
                                    </form>

                                </div>
                                <div class="col-lg-1 mb-auto mt-auto">
                                    <form id="declineDeviceRequest" action="" method="">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="medSId" value="{{ $medicalS->id }}">
                                        <input type="submit"class="btn btn-danger h3" value="Decline">
                                    </form>
                                </div>

                        @endif
                    @endforeach
                <div class="tab-content-sub col-lg-10 ml-auto mr-auto">
                    <div class="col-lg-6 ml-auto mr-auto" style="margin-top:40px; margin-bottom:40px;">
                        <h3 class="col-lg-12 font-weight-bold text-center mb-3"><img src="{{url('imgs/request.svg')}}" class="mr-3" height="40"> Request</h3>
                        <button type="button" class="col-lg-12 btn btn-danger h5 mt-3" data-toggle="modal" data-target="#exampleModal1">
                            Add Medical Devices
                        </button>
                    </div>
                </div>
                <div class="tab-content-sub col-lg-10 ml-auto mr-auto mt-5">
                    <div class="col-lg-8 ml-auto mr-auto" style="margin-top:40px; margin-bottom:40px;">
                        <h3 class="col-lg-12 font-weight-bold text-center mb-3"><img src="{{url('imgs/search.svg')}}" class="mr-3" height="40">Search</h3>
                        <form action="{{route('searchDevice')}}" method="GET">
                                <div class="col-10 ml-auto mr-auto">
                                    <div class="form-group">
                                        <input required="required" type="text" name="search_device" class="form-control" placeholder="Search By Medical Device Name">
                                    </div>
                                </div>
                                <div class="col-10 ml-auto mr-auto">
                                    <div class="form-group">
                                        <input type="submit" value="Search" class="form-control btn btn-danger">
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <!--Medical Devices Modal -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Add Medical Devices</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{route('donate.addMedicalDevices',$patient->id)}}" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input type="hidden" name="patient_id" value="{{$patient->id}}">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Medical Devices Name:</label>
                            <input name = "medicalDevicesName" type="text" class="form-control @error('medicalDevicesName') is-invalid @enderror" id="recipient-name">
                            @error('medicalDevicesName')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Information:</label>
                            <textarea name = "medicalDevicesInformation" class="form-control @error('medicalDevicesInformation') is-invalid @enderror" id="message-text"></textarea>
                            @error('medicalDevicesInformation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="img-name" class="col-form-label">Picture:</label>
                            <input name = "medicalDevicesImage" type="file" class="form-control @error('medicalDevicesImage') is-invalid @enderror" id="img-name">
                            @error('medicalDevicesImage')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label  class="col-form-label">Category:</label>
                            <select name="medicalCategory" class="form-control">
                              <option value="Blood pressure monitor (manual mercury)">Blood pressure monitor (manual mercury)</option>
                              <option value="Blood pressure monitor (electronic)">Blood pressure monitor (electronic)</option>
                              <option value="Glucose meter">Glucose meter</option>
                              <option value="Electronic glucose meter">Electronic glucose meter</option>
                              <option value="Temperature measuring device">Temperature measuring device</option>
                              <option value="A respirator">A respirator</option>
                              <option value="Sick bed (moving)">Sick bed (moving)</option>
                              <option value="Sick chair (fixed with toilet)">Sick chair (fixed with toilet)</option>
                              <option value="Sick chair (wheelchair)">Sick chair (wheelchair)</option>
                              <option value="Pregnant crutch">Pregnant crutch</option>
                              <option value="Inhalation device">Inhalation device</option>
                              <option value="Medical bands">Medical bands</option>
                              <option value="Medical belts">Medical belts</option>
                            </select>
                            @error('medicalCategory')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Quantity</label>
                            <input class="form-control" type="number" id="quantity" name="quantity" min="1" max="5" >
                            @error('quantity')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary h5">Add Medical</button>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>
                @if($medicalDevices)
                  @foreach ($medicalDevices as $medicalDevice )
                    @if($medicalDevice->patient_id != auth()->guard('patien')->user()->id)
                        <div class="row col-lg-10 ml-auto mr-auto p-4 label-donate m-4">
                            <div class="col-lg-12 text-center">
                                <img src="{{$medicalDevice->medicalDevicesImage}}" class="col-lg-5 ml-auto mr-auto mt-2 mb-2" alt="...">
                                <h4 class="col-lg-12 ml-auto mr-auto mt-2 mb-2 font-weight-bold">{{$medicalDevice->medicalDevicesName}}</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 pb-3">
                                    @if(!$medicalDevice->patient->image)
                                        <img class="rounded-circle" src="{{ asset('uploads/default.png') }}" width="90" height="90" />
                                    @else
                                        <img class="rounded-circle" src="{{$medicalDevice->patient->image}}" width="90" height="90" />
                                    @endif
                                </div>
                                <div class="col-lg-8 mt-2">
                                    <h5 class="col-lg-12 font-weight-bold">{{$medicalDevice->patient->name}}</h5>
                                    <h5 class="col-lg-12 font-weight-bold">{{$medicalDevice->patient->idCode}}</h5>
                                    <h6 class="col-lg-12">{{$medicalDevice->medicalDevicesInformation}}</h6>
                                    <h6 class="col-lg-12 mb-3">{{$medicalDevice->medicalCategory}}</h6>
                                </div>
                            </div>
                        </div>
                    @endif

                  @endforeach
                @endif
              </div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <!-- Button trigger Medication modal -->
                    @foreach ($patient->medactionSender as  $medS)
                        @if($medS->accept == false)
                            <div class="tab-content-request col-lg-10 row ml-auto mr-auto mb-auto mt-4">
                                <div class="col-lg-2 mr-2 ml-5 mb-auto mt-auto">
                                    <img src="{{url('imgs/request.svg')}}" class=" mb-3" height="40">
                                </div>
                                <div class="col-lg-5 mb-auto mt-auto">
                                    <h5 class="font-weight-bold text-capitalize" height="40">{{ $medS->patientRequest->name }}</h5>
                                    <h5>{{ $medS->donorForm->medicationName }} | <span class="font-weight-bold" style="color:#cf0a0a">Quantity: {{ $medS->quantity }}</span></h5>
                                </div>
                                <div class="col-lg-1 mb-auto mt-auto">
                                    <form id="acceptMedicationRequest" action="" method="">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="medSId" value="{{ $medS->id }}">
                                        <input type="hidden" name="medId" value="{{ $medS->donorForm->id }}">
                                        <input type="submit" class="btn btn-success h3" value="Accept">
                                    </form>

                                </div>
                                <div class="col-lg-1 mb-auto mt-auto">
                                    <form id="declineMedicationRequest" action="" method="">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="medSId" value="{{ $medS->id }}">

                                        <input type="submit"class="btn btn-danger h3" value="Decline">
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="tab-content-sub col-lg-10 ml-auto mr-auto mt-5">
                        <div class="col-lg-6 ml-auto mr-auto" style="margin-top:40px; margin-bottom:40px;">
                            <h3 class="col-lg-12 font-weight-bold text-center mb-3"><img src="{{url('imgs/request.svg')}}" class="mr-3" height="40">Request</h3>
                            <button type="button" class="col-lg-12 btn btn-danger h5 mt-3" data-toggle="modal" data-target="#exampleModal">
                                Add Medication
                            </button>
                        </div>
                    </div>
                    <div class="tab-content-sub col-lg-10 ml-auto mr-auto mt-5">
                        <div class="col-lg-8 ml-auto mr-auto" style="margin-top:40px; margin-bottom:40px;">
                            <h3 class="col-lg-12 font-weight-bold text-center mb-3"><img src="{{url('imgs/search.svg')}}" class="mr-3" height="40">Search</h3>
                            <form action="{{route('searchMedication',$patient->id)}}" method="GET">
                                {{-- <input type="hidden" name="patient_id" value="{{$patient->id}}"> --}}
                                    <div class="col-10 ml-auto mr-auto">
                                        <div class="form-group">
                                            <input required="required" type="text" name="search_medication" class="form-control" placeholder="Search By Medication Name">
                                        </div>
                                    </div>
                                    <div class="col-10 ml-auto mr-auto">
                                        <div class="form-group">
                                            <input type="submit" value="Search" class="form-control btn btn-danger">
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                <!-- Medication Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Medication</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{route('donate.addMedication',$patient->id)}}" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input type="hidden" name="patient_id" value="{{$patient->id}}">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Medication Name:</label>
                            <input name="medicationName" type="text" class="form-control @error('medicationName') is-invalid @enderror" id="recipient-name">
                            @error('medicationName')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Information:</label>
                            <textarea name="medicationInformation" class="form-control @error('medicationInformation') is-invalid @enderror" id="message-text"></textarea>
                            @error('medicationInformation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="img-name" class="col-form-label">Picture:</label>
                            <input name="medicationImage" type="file" class="form-control @error('medicationImage') is-invalid @enderror" id="img-name">
                            @error('medicationImage')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Quantity</label>
                            <input class="form-control" type="number" id="quantity" name="quantity" min="1" max="5" >
                            @error('quantity')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary h5">Add Medication</button>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>
                @if($medications)
                  @foreach($medications as $medication)
                    @if($medication->patient_id != auth()->guard('patien')->user()->id)
                        <div class="row col-lg-10 ml-auto mr-auto p-4 label-donate m-4">
                            <div class="col-lg-12 text-center">
                                <img src="{{url($medication->medicationImage)}}" class="col-lg-5 ml-auto mr-auto mt-2 mb-2" alt="...">
                                <h4 class="col-lg-12 ml-auto mr-auto mt-2 mb-2 font-weight-bold">{{$medication->medicationName}}</h4>
                            </div>
                            <div class="row">
                            <div class="col-lg-4 pb-3">
                                @if(!$medication->patient->image)
                                    <img class="rounded-circle" src="{{asset('uploads/default.png')}}" width="90" height="90" />
                                @else
                                    <img class="rounded-circle" src="{{$medication->patient->image}}" width="90" height="90"/>
                                @endif
                            </div>
                            <div class="col-lg-8 mt-2">
                                <h5 class="col-lg-12 font-weight-bold">{{$medication->patient->name}}</h5>
                                <h5 class="col-lg-12 font-weight-bold">{{$medication->patient->idCode}}</h5>
                                <h6 class="col-lg-12 mb-3">{{$medication->medicationInformation}}</h6>
                            </div>
                        </div>
                        </div>
                    @endif

                  @endforeach
                @endif
              </div>
            </div>
            <!-- footer -->
        </div>
        @include('backEnd.layoutes.footer')

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&callback=initAutocomplete&libraries=places&v=weekly" defer></script>
        <script>
          @include("includes.GoogleMap")
        </script>
    </div>
    <script>
        $("#acceptMedicationRequest").on('submit',function(e){
            e.preventDefault();
            // Get form
            var form = $('#acceptMedicationRequest')[0];
            // create formData object
            var data = new FormData(form);
            //console.log(data);
            $.ajax({
                url : '{{ route("AcceptRequestMedication") }}',
                method : 'POST',
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                success:function(data){
                    $("#acceptMedicationRequest").fadeOut(500);
                    $("#declineMedicationRequest").delay(500).fadeOut(500);
                    $("#acceptedAlert").fadeIn(600).delay(400).fadeOut(400);
                    {{--  location.reload();  --}}
                }

            });
        });

        $("#declineMedicationRequest").on('submit',function(e){
            e.preventDefault();
            // Get form
            var form = $('#declineMedicationRequest')[0];
            // create formData object
            var data = new FormData(form);
            //console.log(data);
            $.ajax({
                url : '{{ route("DeclineRequestMedication") }}',
                method : 'POST',
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                success:function(data){
                    $("#acceptMedicationRequest").fadeOut(500);
                    $("#declineMedicationRequest").delay(500).fadeOut(500);
                    $("#acceptedAlert").fadeIn(600).delay(400).fadeOut(400);
                    {{--  location.reload();  --}}
                }

            });
        });

        $("#acceptDeviceRequest").on('submit',function(e){
            e.preventDefault();
            // Get form
            var form = $('#acceptDeviceRequest')[0];
            // create formData object
            var data = new FormData(form);
            //console.log(data);
            $.ajax({
                url : '{{ route("AcceptRequestDevice") }}',
                method : 'POST',
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                success:function(data){
                    $("#acceptDeviceRequest").fadeOut(500);
                    $("#declineDeviceRequest").delay(500).fadeOut(500);
                    $("#acceptedAlert").fadeIn(600).delay(400).fadeOut(400);
                    {{--  location.reload();  --}}
                }

            });
        });

        $("#declineDeviceRequest").on('submit',function(e){
            e.preventDefault();
            // Get form
            var form = $('#declineDeviceRequest')[0];
            // create formData object
            var data = new FormData(form);
            //console.log(data);
            $.ajax({
                url : '{{ route("DeclineRequestMedication") }}',
                method : 'POST',
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                success:function(data){
                    $("#acceptDeviceRequest").fadeOut(500);
                    $("#declineDeviceRequest").delay(500).fadeOut(500);
                    $("#acceptedAlert").fadeIn(600).delay(400).fadeOut(400);
                    {{--  location.reload();  --}}
                }

            });
        });

        $("#acceptDonorRequest").on('submit',function(e){
            e.preventDefault;
            // Get form
            var form = $("#acceptDonorRequest")[0];
            // get form data
            var data = new FormData(form);

            $.ajax({
                url : '{{ route("acceptRequestDonor") }}',
                method : 'POST',
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                success:function(data){
                    $("#acceptDonorRequest").fadeOut(500);
                    $("#declineDonorRequest").delay(500).fadeOut(500);
                    $("#alertDonor").fadeIn(600).delay(400).fadeOut(400);
                    {{--  location.reload();  --}}
                }

            });
        });

        $("#declineDonorRequest").on('submit',function(e){
            e.preventDefault;
            //Get Form
            var form = $("#declineDonorRequest")[0];
            // get form data
            var data = new FormData(form);

            $.ajax({
                url : '{{ route("declineRequestDonor") }}',
                method : 'POST',
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                success:function(data){
                    $("#declineRequestDonor").fadeOut(500);
                    $("#declineRequestDonor").delay(500).fadeOut(500);
                    $("#alertDonor").fadeIn(600).delay(400).fadeOut(400);
                    {{--  location.reload();  --}}
                }


            });
        });

        //Active Buttons
        var header = document.getElementById("myTab");
        var btns = header.getElementsByClassName("pill-donate");
        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("li-active");
        current[0].className = current[0].className.replace(" li-active", "");
        this.className += " li-active";
        });
        }

    </script>
</div>
@stop

