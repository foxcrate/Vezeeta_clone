@extends('backEnd.layoutes.mastar')
@section('title','Search Donate')
@section('content')
    @include('backEnd.patien.slidenav')
    <div class="d-flex" id="wrapper">
        <div id="page-content-wrapper">
            <!-- Topnav -->
            @include('includes.patientNav')
            @php
                $x='false';
            @endphp
            <div class="tab-content mb-5" id="myTabContent">
                @if(session('searchDonor'))
                    @foreach(session()->get('searchDonor') as $donor)
                        @if($donor->patient_id != auth()->guard('patien')->user()->id)
                            <div class="row col-lg-10 ml-auto mr-auto p-4 label-donate m-4">
                                {{-- <div class="row col-lg-12">
                                    <img src=" {{session()->get('searchDonor')->medicalDevicesName}} " class="col-lg-3 ml-auto mr-auto d-block mt-2 mb-2" alt="...">
                                </div> --}}
                                <div class="col-lg-3 pb-3">
                                    <img src="{{ $donor->patient->image }}" width="120" />
                                </div>
                                <div class="col-lg-8 mt-5">
                                <h5 class="col-lg-8 ">{{$donor->patient->name}}</h5>
                                <h5 class="col-lg-8">{{$donor->patient->idCode}}</h5>
                                <h6 class="col-lg-10 mb-3">{{$donor->patient->phoneNumber }}</h6>
                                <div class="col-lg-8">
                                    <form id="requestDonor" action="" method="">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="patientIdSender" value="{{ $donor->patient->id }}">
                                        <input type="hidden" name="patientIdRequest" value="{{ auth()->guard('patien')->user()->id }}">
                                        <input type="hidden" name="donor_id" value="{{ $donor->id }}">
                                        <input type="submit" id="requestDonorSubmit" value="Add Request" class="btn btn-success">
                                        <p style="display:none" id="donorAlert" class="alert alert-success">Request Added</p>
                                    </form>
                                </div>
                                </div>
                            </div>
                            @php
                                $x='true';
                            @endphp
                        @else
                        <div class="container">
                            <p class="alert alert-danger">Patient Not Found</p>
                        </div>
                        @endif
                    @endforeach
                @endif
                @if ($x==='false')
                    <div class="no-data-img">
                        <img class="no-data-img animate__animated animate__flash" src="{{url('imgs/no-blood.png')}}" alt="" style="margin-left: 25%;">
                    </div>
                @endif


            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
            <!-- footer -->
            @include('backEnd.layoutes.footer')
        </div>
        <script>
            $("#requestDonor").on('submit',function(e){
                e.preventDefault();
                //Get form
                var form = $("#requestDonor")[0];
                // create form data
                var data = new FormData(form);
                $.ajax({
                    url : '{{ route("addRequestDonor") }}',
                    method : 'POST',
                    data: data,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    success:function(data){
                        $("#requestDonorSubmit").fadeOut(500);
                        $("#donorAlert").fadeIn(600).delay(500).fadeOut(500);
                    }
                });
            });
        </script>
    </div>
@stop
