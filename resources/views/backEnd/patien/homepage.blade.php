@extends('backEnd.layoutes.mastar')
@section('title','Patient Homepage')
@section('content')
<!--start-Navbar-->
@include('backEnd.layoutes.navbar')
<!--End-Navbar-->
<div class="bg-waves">
    {{-- @include('includes.alerts.success') --}}
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

    {{-- @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif --}}

    <div class="container link" >
        <div class="row content-info col-lg-12 mt-5 ml-auto mr-auto">
            <div class="col-md-2 col-sm-12">
                @if(!$patient->image)
                    <img alt="Image placeholder" src="{{ asset('uploads/default.png') }}" width="120" height="120" class="rounded-circle d-block mt-2">
                @else
                    <img alt="Image placeholder" src="{{ $patient->image }}" width="120" height="120" class="rounded-circle d-block mt-2">
                @endif
            </div>
            <div class="col-md-8 col-sm-12">
                <h4 class="text-dark mt-3 mb-2 font-weight-bold text-capitalize">{{$patient->firstName . ' ' . $patient->lastName}}</h4>
                <h5 class="text-dark">{{$patient->idCode}}</h5>
                <h5 class="text-dark">{{$patient->Age}} Years</h5>
                <div class="row mt-3">
                    <h5 class="col-lg-4 text-dark">Classic Level</h5>
                    <h5 class="col-lg-4 text-dark">{{ $patient->poients }} Point</h5>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                @if($patient->patinets_data)
                    <a href="{{route("edit_data_profile",$patient->id)}}"><img src="{{url('imgs/edit.svg')}}" height="45" class="d-block w-100 mt-3 mb-5" alt="..."></a>
                @else
                    <a href="{{route("edit.profile",$patient->id)}}"><img src="{{url('imgs/edit.svg')}}" height="45" class="d-block w-100 mt-3 mb-5" alt="..."></a>
                @endif

                <a href="{{ route('getReport',$patient->id) }}"><img src="{{url('imgs/report.svg')}}" height="40" class="d-block w-100 mt-5" alt="..." ></a>
            </div>
        </div>
    </div>
    <!--Start-Serv-->
    <div class="container row col-lg-6 ml-auto mr-auto text-center mt-5">
        <a href="{{route('finder.page',$patient->id)}}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
          <div class="content-item ml-auto mr-auto">
            <img src="{{url('imgs/finder.svg')}}" height="80" class="d-block w-100 mt-2" alt="...">
          </div>
          <h5 class="text-dark font-weight-bold ml-auto mr-auto">Finder</h5>
        </a>
        <a href="{{route("getOnline",['patien',$patient->id])}}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
          <div class="content-item ml-auto mr-auto">
            <img src="{{url('imgs/hello.svg')}}" height="90" class="d-block w-100 mt-2" alt="...">
          </div>
          <h5 class="text-dark font-weight-bold ml-auto mr-auto">Online</h5>
        </a>
        <a href="{{ route('patient.qr.index',$patient->id) }}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
          <div class="content-item ml-auto mr-auto">
            <img src="{{url('imgs/qrCode.svg')}}" height="80" class="d-block w-100 mt-2" alt="...">
          </div>
          <h5 class="text-dark font-weight-bold ml-auto mr-auto">QR Code</h5>
        </a>
        <a href="{{route('patient.club',$patient->id)}}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
          <div class="content-item ml-auto mr-auto">
            <img src="{{url('imgs/logo.svg')}}" height="80" class="d-block w-100 mt-2" alt="...">
          </div>
          <h5 class="text-dark font-weight-bold text-center">Club</h5>
        </a>
    </div>
    <div class="row col-lg-6 ml-auto mr-auto text-center">
        <a href="{{route('donate.index',$patient->id)}}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
          <div class="content-item ml-auto mr-auto">
            <img src="{{url('imgs/handhelp.svg')}}" height="110" class="d-block w-100" alt="...">
          </div>
          <h5 class="text-dark font-weight-bold text-center">Donate</h5>
        </a>
        <a href="{{route('homecare.index',$patient->id)}}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
          <div class="content-item ml-auto mr-auto">
            <img src="{{url('imgs/homeware.svg')}}" height="80" class="d-block w-100 mt-2" alt="...">
          </div>
          <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Home Care</h5>
        </a>
        <div class="col-lg-3 ml-auto mr-auto" data-toggle="modal" data-target="#exampleModal">
          <div class="content-item ml-auto mr-auto">
            <img src="{{url('imgs/familyicon.svg')}}" height="80" class="d-block w-100 mt-2" alt="...">
          </div>
          <h5 class="text-dark font-weight-bold text-center">Family</h5>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Family</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="tab-kids col-lg-8 ml-auto mr-auto col-md-2 mb-4">
                    <a href="{{route('getAllChild',$patient->id)}}" class="text-primary" style="text-decoration:none;">
                        <div class="row ml-auto mr-auto">
                            <div class="col-4 mb-auto mt-auto text-center">
                                <img src="{{url('imgs/kids.svg')}}" width="70" alt="...">
                            </div>
                            <div class="col-6 mb-auto mt-auto h4">Kids</div>
                        </div>
                    </a>
                </div>
                <div class="tab-wife-husband col-lg-8 ml-auto mr-auto col-md-2 mb-4">
                    <a href="{{route('patient.searchWife',$patient->id)}}" class="text-primary" style="text-decoration:none;">
                        <div class="row ml-auto mr-auto ">
                            <div class="col-3 mb-auto mt-auto text-center">
                                <img src="{{url('imgs/fatherandmother.png')}}" width="70" alt="...">
                            </div>
                            <div class="col-8 mb-auto mt-auto ml-auto mr-auto h5 text-wife">Wife or Husband</div>
                        </div>
                    </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a href="{{ route('patient.getCheckup',$patient->id) }}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
          <div class="content-item ml-auto mr-auto">
            <img src="{{url('imgs/checkup.svg')}}" height="80" class="d-block w-100 mt-2" alt="...">
          </div>
          <h5 class="text-dark font-weight-bold text-center">Check Up</h5>
        </a>
    </div>
    <div class="row col-lg-6 ml-auto mr-auto text-center">
      <a href="{{route('patient.favorite',$patient->id)}}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
        <div class="content-item ml-auto mr-auto">
          <img src="{{url('imgs/favoriteplaceicon.svg')}}" height="80" class="d-block w-100 mt-2" alt="...">
        </div>
        <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Favorite</h5>
      </a>
      <a href="{{route('patient_Appointments',$patient->id)}}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
        <div class="content-item ml-auto mr-auto">
          <img src="{{url('imgs/calendar.png')}}" height="70" class="w-80 mt-3" alt="...">
        </div>
        <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Appointments</h5>
      </a>
      <a href="#" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
        <div class="content-item ml-auto mr-auto">
          <img src="{{url('imgs/insurance.png')}}" height="70" class="w-80 mt-3" alt="...">
        </div>
        <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Insurance</h5>
      </a>
      <a href="{{route('covied.index',$patient->id)}}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
        <div class="content-item ml-auto mr-auto">
          <img src="{{url('imgs/corona.svg')}}" height="70" class="w-80 mt-3" alt="...">
        </div>
        <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Covid-19</h5>
      </a>
    </div>
    <div class="row col-lg-6 ml-auto mr-auto text-center mb-5">
      <a href="{{route('doctorfamily.index',$patient->id)}}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
          <div class="content-item ml-auto mr-auto">
            <img src="{{url('imgs/doctorfamily.svg')}}" height="80" class="d-block w-100 mt-2" alt="...">
          </div>
          <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Family Physican</h5>
      </a>
      <a href="#" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
        <div class="content-item ml-auto mr-auto">
          <img src="{{url('imgs/starrate.svg')}}" height="70" class="w-80 mt-3" alt="...">
        </div>
        <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Rate</h5>
      </a>
      <a href="{{route('patien.logout')}}" class="col-lg-3 ml-auto mr-auto" style="text-decoration:none;">
        <div class="content-item ml-auto mr-auto">
          <img src="{{url('imgs/logout.png')}}" height="70" class="w-80 mt-3" alt="...">
        </div>
        <h5 class="col text-dark font-weight-bold ml-auto mr-auto">Log Out</h5>
      </a>
      <div class="col-lg-3 ml-auto mr-auto">
      </div>
    </div>
    <div class="bts-popup" role="alert">
        <div class="bts-popup-container">
            <div class="download-container">
                <h1>Download Our Application Now</h1>
                <div class="download-imgs">
                    <a href="#"><img src="{{url('imgs/download-Android.png')}}"></a>
                    <a href="#"><img src="{{url('imgs/download-ios.png')}}"></a>
                </div>
            </div>
            <a href="#0" class="bts-popup-close img-replace"><i class="fas fa-times"></i></a>
        </div>
    </div>
    <!--End-Serv-->
    {{-- <div class="download-container">
        <h1>Download Our Application Now</h1>
        <div class="download-imgs">
            <a href="#"><img src="{{url('imgs/download-Android.png')}}"></a>
            <a href="#"><img src="{{url('imgs/download-ios.png')}}"></a>
        </div>
    </div> --}}
    <!--Start-Footer-->
    @include('backEnd.layoutes.footer')
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('.link').on('click', function () {
        window.location = "{{route('patien-profile',$patient->id)}}";
    });
</script>

<script>
    jQuery(document).ready(function($){

  window.onload = function (){
    $(".bts-popup").delay(1000).addClass('is-visible');
  }

  //open popup
  $('.bts-popup-trigger').on('click', function(event){
    event.preventDefault();
    $('.bts-popup').addClass('is-visible');
  });

  //close popup
  $('.bts-popup').on('click', function(event){
    if( $(event.target).is('.bts-popup-close') || $(event.target).is('.bts-popup') ) {
      event.preventDefault();
      $(this).removeClass('is-visible');
    }
  });
  //close popup when clicking the esc keyboard button
  $(document).keyup(function(event){
      if(event.which=='27'){
        $('.bts-popup').removeClass('is-visible');
      }
    });
});
</script>
@endsection
