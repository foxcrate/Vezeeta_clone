@extends('backEnd.layoutes.mastar')
@section("content")
@section('title','show Profile patient')
<div class="d-flex bg-page" id="wrapper">
@include("backEnd.patien.slidenav")
    <div id="page-content-wrapper">
      <div id="app" class="col-lg-12 mt-5">
          <Message :patient="{{$patient}}" :doctor="{{$online_doctor}}" :userauth="{{$patient}}" :chat="{{$chat}}"></Message>
      </div>
    </div>
  </div>
</div>

  <script src="{{url('js/app.js')}}"></script>




@endsection
