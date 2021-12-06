<!-- Sidebar -->
<div class="left-menu bg-white border-right" id="sidebar-wrapper">
    <a id="menuin-toggle"><i class="fa fa-bars fa-2x text-blue float-right mr-2 d-xl-none" aria-hidden="true"></i></a>
    <div class="sidebar-heading mt-3 text-center"><img src="{{url('imgs/logo4.png')}}" width="120" height=""></div>
    <div class="list-group list-group-flush mt-5">
        <a href="{{route('online_doctor.homepage',$online_doctor->id)}}" class="list-group-item list-group-item-action h5"><i class="fa fa-home mr-2" aria-hidden="true"></i> Home</a>
        <a href="{{route('online_doctor.profile',$online_doctor->id)}}" class="list-group-item list-group-item-action h5"><i class="fa fa-user mr-2" aria-hidden="true"></i> Profile</a>
        {{--  <a href="{{route('online_doctor.edit',$online_doctor->id)}}" class="list-group-item list-group-item-action h5"><i class="fas fa-user-edit mr-2"></i> Edit Profile</a>  --}}
        <a href="#" class="list-group-item list-group-item-action h5"><i class="fas fa-user-edit mr-2"></i> Edit Profile</a>
        <a href="{{route('online_doctor.logout')}}" class="list-group-item list-group-item-action mb-5 h5"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
    </div>

    </div>
</div>
<!-- /#sidebar-wrapper -->

