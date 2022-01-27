
<!-- Topnav -->
<nav class="navbarp navbar-top navbar-expand navbar-dark border-bottom">
    <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar links -->
        <button class=" d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
        <!-- Search form -->
        {{-- <h6 class="h5 text-white">{{$patient->online == 1 ? 'online' : 'Ofline'}}</h6> --}}
        <form id="patient_update_online" action="{{route('patient_update_online',$patient->id)}}" method="POST">
            {{-- {{ csrf_field() }}
            <div class="col-lg-6">

                <div class="switch-button">
                    <div class="button" id="button-1">
                        <input type="checkbox" class="privacy-box" name="online" class="onoffswitch-checkbox" id="myonoffswitchH" value="{{$patient->online == 1 ? 1 : 0}}" {{$patient->online == 1 ? 'checked' : ''}}>
                        <div class="knobs">
                          <span>Private</span>
                        </div>
                        <div class="layer"></div>
                        <script>
                            $('#myonoffswitchH').on('change', function() {
                                this.value =
                                this.checked ? 1 : 0;
                                $("#patient_update_online").submit();
                            });
                        </script>
                    </div>
                </div> --}}

                <!--<div class="onoffswitch">-->
                <!--<input type="checkbox" name="online" class="onoffswitch-checkbox" id="myonoffswitchH" value="{{$patient->online == 1 ? 1 : 0}}" {{$patient->online == 1 ? 'checked' : ''}}>-->
                <!--<label class="onoffswitch-label" for="myonoffswitchH">-->
                <!--    <script>-->
                <!--        $('#myonoffswitchH').on('change', function() {-->
                <!--            this.value =-->
                <!--            this.checked ? 1 : 0;-->
                <!--            $("#patient_update_online").submit();-->
                <!--        });-->
                <!--    </script>-->
                <!--    <div class="onoffswitch-inner"></div>-->
                <!--    <div class="onoffswitch-switch"></div>-->
                <!--</label>-->
                <!--</div>-->

            {{-- </div> --}}
        </form>
        <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{url('imgs/noti-active.svg')}}" alt="" width="30px">
                    <p class="h6 text-white font-weight-bold" style="position:relative;top:-31px;left:18px"> {{ auth()->guard('patien')->user()->unreadNotifications->count() }}</p>
                </a>
                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0" style="max-height:500px;overflow-y:scroll">
                <!-- Dropdown header -->
                <div class="px-3 py-3">
                    <p class="text-muted m-0">You have <strong class="text-primary">{{ auth()->guard('patien')->user()->unreadNotifications->count() }}</strong> notifications.</p>
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
                        @if(!$patient->image)
                            <img alt="Image placeholder" src="{{ asset('uploads/default.png') }}">
                        @else
                            <img alt="Image placeholder" src="{{ $patient->image }}">
                        @endif
                    </span>
                    <div class="col-12 media-body ml-3 mr-3 d-lg-block">
                    <h6 class="mb-1 font-weight-bold text-white text-capitalize">{{$patient->firstName . ' ' . $patient->middleName}}</h6>
                    <h6 class="mb-1 font-weight-bold text-white">Classic Level</h6>
                    <h6 class="mb-0 font-weight-bold text-white">{{ $patient->poients }} point</h6>
                    </div>
                </div>
                </a>
            </li>
        </ul>
    </div>
    </div>
</nav>



{{-- <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header align-items-center">
        <a class="navbar-brand" href="#">
          <img src="{{url('imgs/logoww.svg')}}" width="200" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav ">
            <li class="nav-item">
              <a class="nav-link text-primary active" href="PatientProfile.html">
                <i class="ni ni-single-02 text-primary"></i>
                <span class="nav-link-text">Profile</span>
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="examples/icons.html">
                <i class="fas fa-clock text-green"></i>
                <span class="nav-link-text">Pills Time</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="examples/EditProfile.html">
                <i class="fas fa-user-edit text-red "></i>
                <span class="nav-link-text">Edit Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="examples/logout.html">
                <i class="ni ni-key-25 text-info"></i>
                <span class="nav-link-text">Logout</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <li class="nav-item list-unstyled">
            <a class="nav-link text-primary active" href="index.html">
              <span class="nav-link-text">About</span>
            </a>
          </li>
          <li class="nav-item list-unstyled">
            <a class="nav-link text-primary active" href="index.html">
              <span class="nav-link-text">Contact</span>
            </a>
          </li>
        </div>
      </div>
    </div>
  </nav> --}}
