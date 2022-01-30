@extends('backEnd.layoutes.mastar')
@section('title','Xray homepage')
@section('content')
<!--start-Navbar-->
@include('backEnd.layoutes.navbar')
<!--End-Navbar-->
<div class="bg-waves">
  <!--Start-Ada-->
  <div class="container homePage-carousel">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-top: 50px;">
        <ol class="carousel-indicators ml-auto mr-auto">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{url('imgs/3.png')}}" alt="..." style="border-radius:15px;">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{url('imgs/4.png')}}" alt="..." style="border-radius:15px;">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{url('imgs/1.png')}}" alt="..." style="border-radius:15px;">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{url('imgs/5.png')}}" alt="..." style="border-radius:15px;">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{url('imgs/6.png')}}" alt="..." style="border-radius:15px;">
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
    {{-- <div id="carouselExampleIndicators" class="carousel slide" style="margin-top: 120px;" data-ride="carousel">
        <ol class="carousel-indicators ml-auto mr-auto">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{url('imgs/3.png')}}" height="550" class="d-block w-100" alt="..." style="border-radius:15px;">
        </div>
        <div class="carousel-item">
            <img src="{{url('imgs/4.png')}}" height="550" class="d-block w-100" alt="..." style="border-radius:15px;">
        </div>
        <div class="carousel-item">
            <img src="{{url('imgs/1.png')}}" height="550" class="d-block w-100" alt="..." style="border-radius:15px;">
        </div>
        <div class="carousel-item">
            <img src="{{url('imgs/5.png')}}" height="550" class="d-block w-100" alt="..." style="border-radius:15px;">
        </div>
        <div class="carousel-item">
            <img src="{{url('imgs/6.png')}}" height="550" class="d-block w-100" alt="..." style="border-radius:15px;">
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
    </div> --}}
  </div>
  <!--End-Ada-->
  <div class="container">
    <div class="row content-info col-lg-12 p-4 mt-5">
      <div class="col-sm-2 mt-2">
            @if(!$xray->image)
                <img src="{{asset('uploads/default.png')}}" width="120" height="120" class="rounded-circle">
            @else
                <img src="{{$xray->image}}" class="rounded-circle" width="120" height="120">
            @endif
      </div>
      <div class="col-8">
       <h4 class="mt-3 mb-3 font-weight-bold">{{$xray->xrayName . ' xray'}}</h4>
       <h5 class="">{{$xray->idCode}}</h5>
       <div class="row mt-3">
         <h5 class="col-lg-4">Classic Level</h5>
         <h5 class="col-lg-4">{{ $xray->poients }} Point</h5>
       </div>
      </div>
      <div class="col-2">
        <a href="{{route('xray.edit.profile',$xray->id)}}"><img src="{{url('imgs/edit.svg')}}" height="40" class="d-block w-100 mb-5" alt="..."></a>
        <a href="#"><img src="{{url('imgs/share.svg')}}" height="40" class="d-block w-100 mt-5" alt="..."></a>
      </div>
    </div>
  </div>
  <!--Start-Serv-->
  <div class="container row col-lg-6 ml-auto mr-auto text-center mt-5 mb-3">
    <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{ route('xray.profile',$xray->id) }}"><img src="{{url('imgs/icon_png/patient.svg')}}" height="80" class="d-block w-100 mt-2" alt="..."></a>
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">Patient</h5>
    </div>
    <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="#"><img src="{{url('imgs/calendar.png')}}" height="70" class="w-80 mt-3" alt="..."></a>
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">Appointment</h5>
      </div>
      <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{ route('xray.club',$xray->id) }}"><img src="{{url('imgs/logo.svg')}}" height="90" class="d-block w-100 mt-2" alt="..."></a>
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">Club</h5>
      </div>
      <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{ route('xray.qr.index',$xray->id) }}"><img src="{{url('imgs/qrCode.svg')}}" height="80" class="d-block w-100 mt-2" alt="..."></a>
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">QR Code</h5>
      </div>
  </div>
  <div class="container row col-lg-6 ml-auto mr-auto text-center mb-5">
    <div class="col-lg-3 ml-auto mr-auto">
      <div class="content-item ml-auto mr-auto">
        <a href="{{route('xray.mywork',$xray->id)}}"><img src="{{url('imgs/stethoscope.svg')}}" height="70" class="w-80 mt-3" alt="..."></a>
      </div>
      <h5 class="text-dark font-weight-bold ml-auto mr-auto">My Work</h5>
    </div>
    <div class="col-lg-3 ml-auto mr-auto">
      <div class="content-item ml-auto mr-auto">
        <a href="#"><img src="{{url('imgs/insurance.png')}}" height="70" class="w-80 mt-3" alt="..."></a>
      </div>
      <h5 class="text-dark font-weight-bold ml-auto mr-auto">Insurance</h5>
    </div>
    <div class="col-lg-3 ml-auto mr-auto">
        <div class="content-item ml-auto mr-auto">
          <a href="{{ route('xray.orders',$xray->id) }}"><img src="{{url('imgs/checklist.svg')}}" height="70" class="w-80 mt-3" alt="..."></a>
        </div>
        <h5 class="text-dark font-weight-bold ml-auto mr-auto">Orders</h5>
    </div>
    <div class="col-lg-3 ml-auto mr-auto">
      <div class="content-item ml-auto mr-auto">
        <a href="{{route('xray.logout')}}"><img src="{{url('imgs/logout.png')}}" height="70" class="w-80 mt-3" alt="..."></a>
      </div>
      <h5 class="text-dark font-weight-bold ml-auto mr-auto">Logout</h5>
    </div>

  </div>
  <!--End-Serv-->
    <!--Start-Footer-->
    @include('backEnd.layoutes.footer')
</div>

@endsection
