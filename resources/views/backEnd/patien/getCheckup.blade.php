@extends('backEnd.layoutes.mastar')
@section('title','checkup ' . $patient->name)
@section('content')
@include('backEnd.patien.slidenav')

<div class="d-flex bg-page" id="wrapper">
  <div id="page-content-wrapper">
    @include('includes.patientNav')
    <div class="container">
        <div class="content-two ml-auto mr-auto p-4 mt-5">
            <form action="{{route('patient.Postcheckup',$patient->id)}}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="patient_id" value="{{$patient->id}}">
                <div class="row ml-auto mr-auto">
                    <div class="form-group row col-lg-5 mr-auto ml-auto mt-3">
                        <img src="{{url('imgs/Temperature.png')}}" width="30" height="30" alt="...">
                        <label class="col-lg-4 font-weight-bold">Temperature</label>
                        <div class="col-lg-7">
                            <input  type="number" name="temperature" class="form-control col-12 @error('temperature') is-invalid @enderror">
                            @error('temperature')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row col-lg-5 mr-auto ml-auto mt-3">
                        <img src="{{url('imgs/Blood-Pressure.png')}}" width="30" height="30" alt="...">

                        <label class="col-lg-4 font-weight-bold">Blood Pressure</label>
                        <div class="col-lg-7">
                            <input placeholder="ex:120/80" type="text/se" name="blood_pressure" class="form-control col-12 @error('blood_pressure') is-invalid @enderror">
                            @error('blood_pressure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row col-lg-5 mr-auto ml-auto mt-3">
                        <img src="{{url('imgs/Diabetics.png')}}" width="30" height="30" alt="...">
                        <label class="col-lg-4 font-weight-bold">Diabetics</label>
                        <div class="col-lg-7">
                            <input type="number" name="diabetics" class="form-control col-12 @error('diabetics') is-invalid @enderror">
                            @error('diabetics')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row col-lg-5 mr-auto ml-auto mt-3">
                        <img src="{{url('imgs/oxygen.svg')}}" width="30" alt="...">
                        <label class="col-lg-4 font-weight-bold">Oxygen</label>
                        <div class="col-lg-7">
                            <input placeholder="ex:100" type="number" name="oxygen" class="form-control col-12 @error('oxygen') is-invalid @enderror">
                            @error('oxygen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary h5 col-lg-5 ml-auto mr-auto mt-3">Add</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container mb-5">
        <table class="table table-borderless bg-white mt-5">
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
                @if($checkups)
                    @foreach($checkups as $checkup)
                        <tr>
                            <th class="text-center" scope="row">{{ date('d-m-Y',$checkup->date . '')}}{{ ' ' . Carbon\Carbon::parse($checkup->created_at)->format('H:i') }}</th>
                            <td class="text-center">{{$checkup->temperature}}</td>
                            <td class="text-center">{{$checkup->blood_pressure}}</td>
                            <td class="text-center">{{' ' . $checkup->diabetics}}</td>
                            <td class="text-center">{{' ' . $checkup->oxygen}}</td>
                        </tr>
                    @endforeach
                @else
                    <div class="alert alert-danger">No Checkup</div>
                @endif
            </tbody>
        </table>
    </div>
  </div>
</div>
@endsection
