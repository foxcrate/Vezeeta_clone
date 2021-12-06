@extends('backEnd.layoutes.mastar')
@section('title','Chat ' . $nurse->name)
@section('content')
<!-- Sidenav -->
<div class="d-flex bg-page" id="wrapper">
  @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
      <div id="app" class = "col-lg-12 mt-4">
        <Nurse :patient="{{$patient}}" :nurse="{{$nurse}}" :userauth="{{$patient}}" :chat="{{$chat}}"></Nurse>
      </div>
      <script src="{{url('js/app.js')}}"></script>
    </div>
</div>
@endsection