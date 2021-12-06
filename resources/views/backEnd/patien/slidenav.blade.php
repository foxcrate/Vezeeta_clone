<!-- Sidebar -->
<div class="left-menu bg-white border-right" id="sidebar-wrapper">
    <a id="menuin-toggle"><i class="fa fa-times fa-2x text-primary cursor float-right mr-2 d-xl-none" aria-hidden="true" style="font-size: 16pt"></i></a>
    <div class="sidebar-heading mt-3 text-center"><img src="{{url('imgs/logo4.png')}}" width="120" height=""></div>
    <div class="list-group list-group-flush mt-5">
        <a href="{{route('patien.homepage',$patient->id)}}" class="list-group-item list-group-item-action h5"><i class="fa fa-home mr-2" aria-hidden="true"></i> Home</a>
        @if($patient->patinets_data != null)
        <a href="{{route('patien-profile',$patient->id)}}" class="list-group-item list-group-item-action h5"><i class="fa fa-user mr-2" aria-hidden="true"></i> Profile</a>
        @endif
        @if($patient->patinets_data == null)
            <a href="{{route('edit.profile',$patient->id)}}" class="list-group-item list-group-item-action h5"><i class="fas fa-user-edit mr-2"></i> Complete Profile</a>
        @endif
        @if($patient->patinets_data)
        <a href="{{route('edit_data_profile',[$patient->id])}}" class="list-group-item list-group-item-action h5"><i class="fas fa-user-edit mr-1"></i> Edit Profile</a>
        @endif
        {{-- @if(auth()->guard('patien'))
        <a href="{{route('get_old_pescription',$patient->idCode)}}" class="list-group-item list-group-item-action h5"><i class="fas fa-file-prescription mr-3"></i>Old Pescrption</a>
        @endif --}}
        <div class="dropdown">
            <a class="list-group-item list-group-item-action h5 dropdown-toggle" type="button" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-users mr-2"></i> Future <i class="fas fa-tools text-dark float-right mr-3"></i></a>
                <div class="collapse" id="collapseExample">
                    <a href="#" class="list-group-item border-3 h6 ml-4"><i class="fas fa-user-shield mr-2"></i> Insurance </a>
                    <a href="#" class="list-group-item border-3 h6 ml-4"><i class="fas fa-share mr-2"></i> Share</a>
                </div>
        </div>

        <a href="{{route('patien.logout')}}" class="list-group-item list-group-item-action h5 mb-5"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
        <div class="ml-auto mr-auto mt-4">
            {!! QrCode::size(120)->generate($patient->idCode); !!}
        </div>






    </div>
</div>
<!-- /#sidebar-wrapper -->
@section('scripts')
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        $("#menuin-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
@stop
