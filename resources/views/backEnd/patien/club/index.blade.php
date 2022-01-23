@extends('backEnd.layoutes.mastar')
@section('title','Phistroy Club')
@section('content')
<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            <!-- Topnav -->
            @include('includes.patientNav')
            <div class="container">
                <h3 class="mt-5" style="font-size: 40pt;">Membership</h3>
                <div class="card-imgCard">
                    <div class="imgCard-info d-flex">
                        <div class="id-num h3 text-white pb-3">{{$patient->idCode}}</div>
                        <div class="name-user h3 text-white pb-3">{{$patient->name}}</div>
                        <div class="date-exp h3 text-white pb-3">EXP 22/08</div>
                    </div>
                    <div class="point h3 text-white pb-3">{{ $patient->poients }} Point</div>
                </div>
                <div class="row mt-5">
                  <div class="col-lg-6 ml-auto mr-auto text-center">
                    <div class="skills-area">
                        <div class="single-skill col-lg-12 ml-auto mr-auto">
                            <div class="circlechart" data-percentage="5000"><svg class="circle-chart" viewBox="0 0 33.83098862 33.83098862" xmlns="http://www.w3.org/2000/svg"><circle class="circle-chart__background" cx="16.9" cy="16.9" r="15.9"></circle>
                                <circle class="circle-chart__circle success-stroke" stroke-dasharray="{{$patient->poients/5000 * 100}},100" cx="16.9" cy="16.9" r="15.9"></circle><g class="circle-chart__info">
                                <text class="circle-chart__percent" x="16.9" y="14.5">{{$patient->poients}}</text>
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
            <div class="row col-sm-8 ml-auto mr-auto mt-5">
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
                    <?php $i=0 ?>
                    @foreach($patient->clupTransaction as $clup)
                        <tr>
                            <?php $i++ ?>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $clup->created_at->format('d/m/Y') }}</td>
                            <td>{{ $clup->transaction }}</td>
                            <td>{{ $clup->point }}</td>
                            <td>{{ $clup->balance }}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            {{-- <a href="{{ route('url.current') }}">url</a> --}}
            <div class="row col-lg-8 ml-auto mr-auto mt-5">
                  <button class="row col-lg-5 ml-auto mr-auto btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal">
                        <img src="{{url('imgs/invitation.svg')}}" width="30" class="mr-3 mb-auto mt-auto"><span style="font-size: 20px;">Invite Friend</span>
                  </button>
                  <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Copy Url</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input id="myInput" style="text-transform:none;"type="text" value="{{ config('app.url') }}Phistory/en/dashbord/patien_id={{ $patient->id }}/efelate" class="form-control" readonly>
                                </div>
                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                    <button onclick="copyLink()" type="button" class="btn btn-primary">Copy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                  {{-- <button class="col-lg-5 ml-auto mr-auto btn btn-danger mb-3"><span style="font-size: 20px;">Back</span></button> --}}
                  <a href="{{route('patien.homepage',$patient->id)}}" class="col-lg-5 ml-auto mr-auto btn btn-danger mb-3"> <span style="font-size: 20px;">Back</span> </a>
            </div>
        </div>
    </div>
    {{--  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script> --}}
    <script>

        function copyLink(){
            let myInput = document.getElementById('myInput');
            myInput.select();
            document.execCommand("copy");
        }
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
               + 'stroke-dasharray="'+ abs_percentage+'{{ $patient->poients/5000*100 }},5000"  cx="16.9" cy="16.9" r="15.9" />'
               + '<g class="circle-chart__info">'
               + '<text class="circle-chart__percent" x="17.9" y="15.5">'+percentage_str+'%</text>';

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


