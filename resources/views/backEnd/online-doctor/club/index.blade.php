@extends('backEnd.layoutes.mastar')
@section('title','Phistroy Club')
@section('content')
@include('backEnd.online-doctor.sidenav')

<div class="d-flex bg-page" id="wrapper">
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            <!-- Topnav -->
            <nav class="navbarp navbar-top navbar-expand navbar-dark">
                <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                    <!-- Search form -->
                    <ul class="float-lg-right pr-3">
                      {{-- <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
                        <label class="onoffswitch-label" for="myonoffswitch">
                            <div class="onoffswitch-inner"></div>
                            <div class="onoffswitch-switch"></div>
                        </label>
                    </div> --}}
                    </ul>
                    {{--  <h6 class="h5 text-white">{{$online_doctor->online == 1 ? 'online' : 'ofline'}}</h6>  --}}
                    <ul class="navbar-nav align-items-center ml-md-auto">
                      <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fa fa-bell fa-fw mr-lg-3 mt-lg-1" style="font-size: 15pt;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">

                          <div class="px-3 py-3">
                            <p class="text-muted m-0">You have <strong class="text-primary">{{$online_doctor->pRequests->count()}}</strong> notifications Requests.</p>
                          </div>

                          @include("backEnd.online-doctor.notifacation_request")

                        </div>
                      </li>
                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                      <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if(!$online_doctor->image)
                                    <img alt="Image placeholder" src="{{ asset('uploads/defualt.jpg') }}" width="50" height="40">
                                @else
                                    <img alt="Image placeholder" src="{{ $online_doctor->image }}" width="50" height="40">
                                @endif
                              </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                              <h6 class="mb-0 font-weight-bold text-white">{{$online_doctor->name}}</h6>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
            </nav>
            <div class="container">
                <h3 class="mt-5" style="font-size: 40pt;">Membership</h3>
                <div class="row col-lg-12 col-sm-6 mt-5 card-imgCard">
                  <div class="id-num ml-4 col-lg-10 h3 text-white">{{$online_doctor->idCode}}</div>
                  <div class="name-user ml-4 col-lg-10 h3 text-white">DR : {{$online_doctor->name}}</div>
                  <div class="date-exp ml-4 col-lg-5 h3 text-white">EXP 22/08</div>
                  <div class="point col-lg-5 h3 text-white">25 Point</div>
                </div>
                <div class="row mt-5">
                  <div class="col-lg-6 ml-auto mr-auto text-center">
                    <div class="skills-area">
                        <div class="single-skill col-lg-12 ml-auto mr-auto">
                            <div class="circlechart" data-percentage="92"><svg class="circle-chart" viewBox="0 0 33.83098862 33.83098862" xmlns="http://www.w3.org/2000/svg"><circle class="circle-chart__background" cx="16.9" cy="16.9" r="15.9"></circle>
                                <circle class="circle-chart__circle success-stroke" stroke-dasharray="{{$online_doctor->poients/5000*100}},100" cx="16.9" cy="16.9" r="15.9"></circle><g class="circle-chart__info">
                                <text class="circle-chart__percent" x="16.9" y="14.5">{{$online_doctor->poients}}</text>
                                <text class="circle-chart__subline" x="16.91549431" y="22">Point</text>
                                </g></svg>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-6 ml-auto mr-auto">
                    <button class="button-club col-lg-12">
                      <img src="{{url('imgs/package.svg')}}" width="50">
                      <h3 class="mt-3">Package</h3>
                    </button>
                    <div class="row mt-3">
                      <div class="col-lg-6  ml-auto mr-auto">
                        <button class="button-club col-lg-12">
                          <img src="{{url('imgs/system-update.svg')}}" width="50">
                          <h3 class="mt-3">Upgrade</h3>
                        </button>
                      </div>
                      <div class="col-lg-6  ml-auto mr-auto">
                        <button class="button-club col-lg-12">
                          <img src="{{url('imgs/updated.svg')}}" width="50">
                          <h3 class="mt-3">Update</h3>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row col-lg-8 ml-auto mr-auto mt-5">
              <h2>Statement</h2>
              <table class="table">
                <thead>
                  <tr style="background-color: #0faac9;">
                    <th scope="col" style="color: #fff;">#</th>
                    <th scope="col" style="color: #fff;">Date</th>
                    <th scope="col" style="color: #fff;">Transaction</th>
                    <th scope="col" style="color: #fff;">Point</th>
                    <th scope="col" style="color: #fff;">Balance</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($online_doctor->clupTransaction as $clup)
                        <tr>
                            <th scope="row">{{ $clup->id }}</th>
                            <td>{{ $clup->created_at->format('d/m/Y') }}</td>
                            <td>{{ $clup->transaction }}</td>
                            <td>{{ $clup->point }}</td>
                            <td>{{ $clup->balance }}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="row col-lg-8 ml-auto mr-auto mt-5">
                  <button class="row col-lg-5 ml-auto mr-auto btn btn-success mb-3">
                    <img src="{{url('imgs/invitation.svg')}}" width="30" class="mr-3 mb-auto mt-auto"><span style="font-size: 20px;">Invite Friend</span>
                  </button>
                  <button class="col-lg-5 ml-auto mr-auto btn btn-danger mb-3"><span style="font-size: 20px;">Back</span></button>
            </div>
        </div>
    </div>
    <script>
        function makesvg(percentage, inner_text=""){

            var abs_percentage = Math.abs(percentage).toString();
            var percentage_str = percentage.toString();
            var classes = ""

            if(percentage < 0){
              classes = "danger-stroke circle-chart__circle--negative";
            } else if(percentage > 0 && percentage <= 30){
              classes = "warning-stroke";
            } else{
              classes = "success-stroke";
            }

           var svg = '<svg class="circle-chart" viewbox="0 0 33.83098862 33.83098862" xmlns="http://www.w3.org/2000/svg">'
               + '<circle class="circle-chart__background" cx="16.9" cy="16.9" r="15.9" />'
               + '<circle class="circle-chart__circle '+classes+'"'
               + 'stroke-dasharray="'+ abs_percentage+',100" cx="16.9" cy="16.9" r="15.9" />'
               + '<g class="circle-chart__info">'
               + '   <text class="circle-chart__percent" x="17.9" y="15.5">'+percentage_str+'%</text>';

            if(inner_text){
              svg += '<text class="circle-chart__subline" x="16.91549431" y="22">'+inner_text+'</text>'
            }

            svg += ' </g></svg>';

            return svg
          }

          (function( $ ) {

              $.fn.circlechart = function() {
                  this.each(function() {
                      var percentage = $(this).data("percentage");
                      var inner_text = $(this).text();
                      $(this).html(makesvg(percentage, inner_text));
                  });
                  return this;
              };

          }( jQuery ));

          $(function () {
               $('.circlechart').circlechart();
          });
    </script>
</div>
@stop
