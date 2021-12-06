@extends('backEnd.layoutes.mastar')
@section('title','Family Doctor')
@section('content')
<div class="d-flex" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            @include('includes.patientNav')
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-md-10 ml-auto mr-auto mb-4 pharmacy_item">
                        <div style="display:none" id="resultRequest" class="alert alert-success">Requests Added</div>
                        @if(!$patient->doctorFamily)
                            <form action="{{route('searchDoctor')}}" method="GET">
                                {{-- <input type="hidden" name="patient_id" value="{{$patient->id}}"> --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Search</label>
                                            <input required = "required" type="text" name="search" class="form-control" placeholder="Search By Doctor Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="submit" value="Search" class="form-control btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                        <div class="content-FD text-center">
                            <img class="rounded-circle mb-5 mt-5" src="{{ $patient->doctorFamily->doctor->image }}" width="200" height="200" alt="">
                            <h3 class="font-weight-bold" >Dr : {{ $patient->doctorFamily->doctor->name }}</h3>
                            <h4 class="font-weight-bold">{{ $patient->doctorFamily->doctor->special->name }}</h4>
                            @if($patient->doctorFamily->is_accept == 0)
                                <form id="declinePatientRequest" action="" method="POST">
                                    <input type="hidden" id="patient_id" name="patient_id" value="{{$patient->id}}">
                                    <input id="declinePatientSubmit" type = "submit" value="Decline" class="col-lg-4 mt-4 mb-5 btn btn-danger">
                                </form>
                            @else
                                <div>
                                    <h4>{{ $patient->doctorFamily->doctor->idCode}}</h4>
                                </div>
                            @endif
                        </div>
                        @endif
                        @if(session('data'))
                            <div class="card-finder mt-5">
                                <div class="">
                                    <div class="row col mr-auto ml-auto pt-3 pl-3 pr-3">
                                        <div class="col-lg-2 mr-auto ml-auto p-3">
                                            @if(!session()->get('data')->image)
                                                <img width="140" height="140" class="rounded-circle" alt="Image placeholder" src="{{ asset('uploads/default.png') }}">
                                            @else
                                                <img width="140" height="140" class="rounded-circle" alt="Image placeholder" src="{{session()->get('data')->image}}">
                                            @endif

                                        </div>
                                        <div class="col-lg-10 pl-5">
                                            <div class="h3 font-weight-bold text-capitalize mb-4">
                                                {{session()->get('data')->name}}
                                            </div>
                                            <div class="h5 text-dark text-capitalize mb-2"><img src="{{url('imgs/doctor.svg')}}" width="30" class="mr-3" >{{session()->get('data')->idCode}}</div>
                                            <div class="h5 text-dark text-capitalize mb-2"><img src="{{url('imgs/infodoctor.svg')}}" width="30" class="mr-3">{{session()->get('data')->special->name}}</div>
                                        </div>
                                        <div class="col-lg-12 mt-3 d-flex justify-content-end">
                                            <form id = "formAddRequestDoctor" action="" method="">
                                                <input type="hidden" id = "doctor_id" name="doctor_id" value="{{session()->get('data')->id}}">
                                                <input type="hidden" id = "patient_id" name="patient_id" value="{{$patient->id}}">
                                                <input id = "submitRequest" type="submit" value="Add Request" class="btn btn-success">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--Start-Footer-->
            @include('backEnd.layoutes.footer')
        <!--End-Footer-->
    </div>

    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>
    <script>
        $("#formAddRequestDoctor").on('submit',function(e){
            e.preventDefault();
            // Get form
            var form = $('#formAddRequestDoctor')[0];
            // create formData object
            var data = new FormData(form);
            $.ajax({
                url : '{{route("addRequestDoctor")}}',
                method : 'POST',
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                success:function(data){
                    $("#resultRequest").fadeIn(600).delay(600).fadeOut(300);
                    $("#submitRequest").delay(600).fadeOut(300);
                    location.reload();
                }
            });
        });

        $("#declinePatientRequest").on('submit',function(e){
            e.preventDefault();
            // Get form
            var form = $('#declinePatientRequest')[0];
            // create formData object
            var data = new FormData(form);
            $.ajax({
                url : '{{route("declinePatientRequest")}}',
                method : 'POST',
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                success:function(data){
                    $("#resultRequest").fadeIn(600).delay(600).fadeOut(300);
                    $("#declinePatientSubmit").delay(600).fadeOut(300);
                    location.reload();
                }
            });
        });
    </script>
</div>
@stop
