@extends('backEnd.layoutes.mastar')
@section('title', 'Medication Request')
@section('content')
@include('backEnd.patien.slidenav')

<div class="d-flex" id="wrapper">
    <div id="page-content-wrapper">
        <!-- Topnav -->
        @include('includes.patientNav')
        <div class="container mt-5">
            <div class="tab-content mb-5" id="myTabContent">
                {{-- {{ session()->get('medication')->medicationName }}
                {{ session()->get('medication')->medicationInformation }} --}}
                @if(session('medication'))
                    <div class="row col-lg-10 ml-auto mr-auto p-4 label-donate m-4">
                        <div class="row col-lg-12">
                            <img src=" {{session()->get('medication')->medicationImage}} " class="col-lg-5 ml-auto mr-auto d-block mt-2 mb-2" alt="...">
                        </div>
                        <div class="col-lg-3 pb-3">
                            <img class="rounded-circle" src="{{ session()->get('medication')->patient->image }}" width="120" height="120" />
                        </div>
                        <div class="col-lg-8 mt-2">
                          <h4 class="col-lg-8 font-weight-bold"> {{ session()->get('medication')->medicationName }}</h4>
                          <h5 class="col-lg-8 ">{{session()->get('medication')->patient->name}}</h5>
                          <h5 class="col-lg-8">{{session()->get('medication')->patient->idCode}}</h5>
                          <h6 class="col-lg-10 mb-3">{{session()->get('medication')->medicationInformation }}</h6>
                          <div class="col-lg-8">
                            <form id="requestMedication" action="" method="">
                                {{ csrf_field() }}
                                <input type="hidden" name="medication_id" value="{{ session()->get('medication')->id }}">
                                <input type="hidden" name="patientIdSender" value="{{ session()->get('medication')->patient_id }}">
                                <input type="hidden" name="patientIdRequest" value="{{ auth()->guard('patien')->user()->id }}">
                                <input class="mb-3" type="number" name="quantity" value="{{ session()->get('medication')->quantity }}" max="{{ session()->get('medication')->quantity }}">
                                <input id="medicationRequestSubmit" type="submit" value="Add Request" class="btn btn-success col-lg-6">
                                <p style="display:none" id="medicationAlert" class="alert alert-success">Request Added</p>
                            </form>
                          </div>
                        </div>
                    </div>
                @endif
            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        </div>
        <!-- footer -->
        @include('backEnd.layoutes.footer')
    </div>
    <script>
        $("#requestMedication").on('submit',function(e){
            e.preventDefault();
            // Get form
            var form = $('#requestMedication')[0];
            // create formData object
            var data = new FormData(form);
            $.ajax({
                url : '{{ route("AddRequestMedication") }}',
                method : 'POST',
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                success:function(data){
                    $("#medicationRequestSubmit").fadeOut(500);
                    $("#medicationAlert").fadeIn(600).delay(400).fadeOut(400);
                }
            });
        });
    </script>
</div>
@stop
@section('scripts')


@endsection
