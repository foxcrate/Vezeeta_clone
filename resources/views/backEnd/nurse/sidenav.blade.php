<!-- Sidebar -->
<div class="left-menu bg-white border-right" id="sidebar-wrapper">
    <a id="menuin-toggle"><i class="fa fa-times fa-2x text-primary cursor float-right mr-2 d-xl-none" aria-hidden="true" style="font-size: 16pt"></i></a>
    <div class="sidebar-heading mt-3 text-center"><img src="{{url('imgs/logo4.png')}}" width="120" height=""></div>
    <div class="list-group list-group-flush mt-5">
        <a href="{{route('nurse.homepage',$nurse->id)}}" class="list-group-item list-group-item-action h5"><i class="fa fa-home mr-2" aria-hidden="true"></i> Home</a>
        <a href="{{route('nurse.profile',$nurse->id)}}" class="list-group-item list-group-item-action h5"><i class="fa fa-home mr-2" aria-hidden="true"></i> Profile</a>
        {{--  <a href="{{route('nurse.edit.profile',[$nurse->id])}}" class="list-group-item list-group-item-action h5"><i class="fas fa-user-edit mr-1"></i> Edit Profile</a>  --}}
        <a href="{{ route('nurse.edit.profile',$nurse->id) }}" class="list-group-item list-group-item-action h5"><i class="fas fa-user-edit mr-1"></i> Edit Profile</a>
        <a href="{{route('nurse.logout')}}" class="list-group-item list-group-item-action h5 mb-5"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>




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
