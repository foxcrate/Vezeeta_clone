@extends('backEnd.layoutes.mastar')
@section('title','Qr')
@section('content')
<div class="d-flex" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
            @include('includes.patientNav')
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-md-10 ml-auto mr-auto mb-4 pharmacy_item">
                        <div class="m-5 col-lg-6 mr-auto ml-auto">
                            {!! QrCode::size(400)->generate($patient->idCode); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Start-Footer-->
            @include('backEnd.layoutes.footer')
        <!--End-Footer-->
    </div>
</div>




@stop
