@extends('backEnd.layoutes.mastar')
@section('title','Chat ' . $nurse->name)
@section('content')
<!-- Sidenav -->
<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.nurse.sidenav')
      <div id="page-content-wrapper">  
        <form action="{{route('nurse_end_delete_request',[$nurse->id,$patient_request->id])}}" method="POST" class="row col-12 text-center">
            {{{ csrf_field() }}}
            <input type="submit" value="End Call" class="btn btn-danger col-5 mr-auto ml-auto mt-3">
          </form>
            <div id="app" class="col-lg-12 mt-4">
                <Nurse :patient="{{$patient}}" :nurse="{{$nurse}}" :userauth="{{$nurse}}" :chat="{{$chat}}"></Nurse>
            </div>
    </div>
</div>

  <script src="{{url('js/app.js')}}"></script>
@endsection
