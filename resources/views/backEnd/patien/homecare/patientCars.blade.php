@extends('backEnd.layoutes.mastar')
@section('title','Patient Cars')
@section('content')
@include('backEnd.patien.slidenav')
<div class="d-flex bg-veiwdoctor " id="wrapper">
    <div id="page-content-wrapper">
        <!-- Topnav -->
        @include('includes.patientNav')
        <div class="container mt-5">
          <section class="radio-toolbar">
              <div class="col-lg-8 ml-auto mr-auto mt-5">
                <form action="{{route('homecare.post.patientCars',$patient->id)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                    <div class="row middle">
                      <div class="col-lg-12 patein-radio">
                        <label class="m-2">
                          <input id = "patien" type="radio" name="ampulanceType" value="SpecialNeedsCars"/>
                          <div class="box patein-radio" style="width:170px;height:130px;" checked >
                              <img class="mt-2" src="{{url('imgs/car.svg')}}" height="60" alt="...">
                              <span class="">Special Needs Cars</spaPsn>
                          </div>
                        </label>
                        <label class="m-2">
                          <input id = "patien" type="radio" name="ampulanceType" value="PatientCars"/>
                          <div class="box patein-radio" style="width:170px;height:130px;" checked >
                              <img class="mt-2" src="{{url('imgs/ambulance.svg')}}" height="60" alt="...">
                              <span class="">Patient Cars</span>
                          </div>
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label font-weight-bold font-weight-bold">Name</label>
                      <input name = "name" type="text" class="form-control @error('name') is-invalid @enderror" id="recipient-name">
                      @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label font-weight-bold">Phone Number</label>
                        <input name = "phoneNumber" type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="recipient-name">
                        @error('phoneNumber')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label font-weight-bold">Date</label>
                        <input name = "date" type="date" class="form-control @error('date') is-invalid @enderror" id="recipient-name">
                        @error('date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label font-weight-bold">Address</label>
                        <input name = "address" type="text" class="form-control @error('address') is-invalid @enderror" id="recipient-name">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label font-weight-bold">Address</label>
                        <input name = "addressDist" type="text" class="form-control @error('addressDist') is-invalid @enderror" id="recipient-name">
                        @error('addressDist')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label  class="col-form-label font-weight-bold">Car Type</label>
                        <select name="carType" class="form-control">
                          <option hidden>Choose</option>
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
                        @error('carType')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                          <label  class="col-form-label font-weight-bold">Purpose of the tipe</label>
                          <select name="PurposeOfTheTipe" class="form-control">
                            <option hidden>Choose</option>
                            <option value="HosptailFollowingUp">Hosptail following up</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="kidenyDialysis">kideny Dialysis</option>
                            <option value="familyVisit">family visit</option>
                            <option value="other">other</option>
                          </select>
                          @error('PurposeOfTheTipe')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      <label class="col-form-label font-weight-bold">Require</label>
                      <div class="row form-group">
                        <div class="col-2 checkbox">
                          <label><input name="requireQues" type="radio" value="none"> None</label>
                        </div>
                        <div class="col-3 checkbox">
                          <label><input name = "requireQues" type="radio" value="wheelchair"> Wheelchair</label>
                        </div>
                        <div class="col-2 checkbox">
                          <label><input name = "requireQues" type="radio" value="Slrether"> Slrether</label>
                        </div>
                      </div>
                      <div class="modal-footer mt-5">
                        <button type="submit" class="btn btn-primary h5">Add Request</button>
                      </div>
                </form>
              </div>
          </section>
          <!-- footer -->
          @include('backEnd.layoutes.footer')
          <!-- footer -->
        </div>
    </div>
</div>





@stop
