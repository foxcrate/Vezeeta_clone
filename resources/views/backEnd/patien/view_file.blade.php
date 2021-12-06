@extends('backEnd.layoutes.mastar')
@section('title','View File ')
@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <iframe class="embed-responsive-item"  src="{{public_path('uploads/pdf_file/rocata/') . $patient->patinets_data->rocata_file}}" allowfullscreen="allowfullscreen" width="100%" height="600"></iframe>



@stop
