@extends('backEnd.layoutes.mastar')
@section('title','Clinic Homepage')
@section('content')
<!--start-Navbar-->
@include('backEnd.layoutes.navbar')
<!--End-Navbar-->
<!--Start-Ada-->
<div id="carouselExampleIndicators" class="carousel slide" style="margin-top: 60px;" data-ride="carousel">
    <ol class="carousel-indicators ml-auto mr-auto">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{url('imgs/3.png')}}" height="550" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{url('imgs/4.png')}}" height="550" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{url('imgs/1.png')}}" height="550" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{url('imgs/5.png')}}" height="550" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{url('imgs/6.png')}}" height="550" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
<!--End-Ada-->
<div class="container">
    <div class="row content-info col-lg-12 p-4 mt-5">
      <div class="col-2">
        <img src="{{url('imgs/dProfilePic.png')}}" width="120" class="d-block mt-2" alt="...">
      </div>
      <div class="col-8">
       <h4 class="text-dark mt-3 mb-3 font-weight-bold">{{$clinic->clinicName . ' Clinic'}}</h4>
       <h5 class="text-dark">{{$clinic->idCode}}</h5>
       <div class="row mt-3">
         <h5 class="col-lg-4 text-dark">Classic Level</h5>
         <h5 class="col-lg-4 text-dark">{{ $clinic->poients }} Point</h5>
       </div>
      </div>
      <div class="col-2">
        <a href="{{route('clinic.edit.profile',$clinic->id)}}"><img src="{{url('imgs/edit.svg')}}" height="40" class="d-block w-100 mb-5" alt="..."></a>
        <a href="#"><img src="{{url('imgs/share.svg')}}" height="40" class="d-block w-100 mt-5" alt="..."></a>
      </div>
    </div>
  </div>
  <!--Start-Serv-->
  <div class="container row col-lg-6 ml-auto mr-auto text-center mt-5 mb-5">
      <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{ route('clinic_login_doctor',$clinic->id) }}"><img src="{{url('imgs/Patirnt.svg')}}" height="80" class="d-block w-100 mt-2" alt="..."></a>
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">Doctor</h5>
      </div>
      {{-- <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <img src="{{url('imgs/logo.svg')}}" height="90" class="d-block w-100 mt-2" alt="...">
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">Online</h5>
      </div> --}}
      {{-- <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <img src="{{url('imgs/qrCode.svg')}}" height="80" class="d-block w-100 mt-2" alt="...">
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">QR Code</h5>
      </div> --}}
      <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{ route('clinicdoctorAppoiement',$clinic->id) }}"><img src="{{url('imgs/calendar.png')}}" height="80" class="w-80 mt-2" alt="..."></a>
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">Appoiement</h5>
      </div>
      <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{route('clinic.logout')}}"><img src="{{url('imgs/logout.png')}}" height="70" class="w-80 mt-3" alt="..."></a>
        </div>
        <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Log Out</h5>
      </div>
  </div>
  <!--End-Serv-->
    <!--Start-Footer-->
    @include('backEnd.layoutes.footer')




@endsection
