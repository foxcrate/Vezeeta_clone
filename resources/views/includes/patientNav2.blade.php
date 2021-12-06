<nav class="navbarp navbar-top navbar-expand navbar-dark ">
    <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar links -->
        <button class=" d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
        <!-- Search form -->
        <div class="onoffswitch"><input type="checkbox" name="online" class="onoffswitch-checkbox" id="myonoffswitch" value="0" ><label class="onoffswitch-label" for="myonoffswitch"><script>$('#myonoffswitch').on('change', function() {this.value = this.checked ? 1 : 0;}).change;</script><div class="onoffswitch-inner"></div><div class="onoffswitch-switch"></div></label></div>

        <ul class="navbar-nav align-items-center ml-md-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{url('imgs/done.gif')}}" alt="" width="25px">
            {{-- <i class="fa fa-bell fa-fw mr-lg-3 mt-lg-1" style="font-size: 15pt;"></i> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0" style="max-height:500px;overflow-y:scroll">
            <!-- Dropdown header -->
            <div class="px-3 py-3">
                <p class="text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</p>
            </div>
            <!-- List group -->
            <!-- test notifaction -->

                <!-- Notifacation page -->
                @include('backEnd.patien.notifacation')
                <!-- Notifacation page -->

        </li>
        </ul>
        <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
        <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="@if($patient->image) {{url('uploads/patien/' . $patient->image)}} @else {{url('uploads/' . $patient->image)}}@endif">
                </span>
                <div class="media-body ml-3 mr-3 d-lg-block">
                <h6 class="mb-0 font-weight-bold text-white">{{$patient->firstName . ' ' . $patient->middleName}}</h6>
                </div>
            </div>
            </a>
        </li>
        </ul>
    </div>
    </div>
</nav>