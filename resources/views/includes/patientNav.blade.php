<nav class="navbarp navbar-top navbar-expand navbar-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar links -->
            <button class=" d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>

            <!-- Online Form -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            {{-- <form id="patient_update_online" action="{{route('patient_update_online',$patient->id)}}" method="POST">
                {{ csrf_field() }}
                <div class="col-lg-6">

                    <div class="switch-button">
                        <div class="button" id="button-1">
                            <input type="checkbox" class="privacy-box" name="online" class="onoffswitch-checkbox" id="myonoffswitchH1" value="{{$patient->online == 1 ? 1 : 0}}" {{$patient->online == 1 ? 'checked' : ''}}>
                            <div class="knobs">
                              <span>Private</span>
                            </div>
                            <div class="layer"></div>
                            <script>
                                $('#myonoffswitchH1').on('change', function() {
                                    console.log("Sumbit Start");
                                    this.value =
                                    this.checked ? 1 : 0;
                                    $("#patient_update_online").submit();
                                    console.log("Sumbit Done");
                                });
                            </script>
                        </div>
                    </div>

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

                </div>
            </form> --}}

            <!-- Online Form -->

            <!-- Search form -->
            {{-- <h6 class="h5 text-white"> @if($patient->online == 1)<img class="ml-5" src="{{url('imgs/online.png')}}" width="30">@else <img class="ml-5" src="{{url('imgs/offline.svg')}}" width="30"> @endif</h6> --}}
            <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{-- <img src="{{url('imgs/done.gif')}}" alt="" width="25px"> --}}
                    <img src="{{url('imgs/noti-active.svg')}}" alt="" width="30px">
                    <p class="h6 text-white font-weight-bold" style="position:relative;top:-31px;left:18px"> {{ auth()->guard('patien')->user()->unreadNotifications->count() }}</p>

                    {{-- <i class="fa fa-bell fa-fw mr-lg-3 mt-lg-1" style="font-size: 15pt;"></i> --}}
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
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if(!$patient->image)
                                    <img alt="Image placeholder" src="{{ asset('uploads/default.png') }}"  width="200" height="40">
                                    @else
                                    <img alt="Image placeholder" src="{{ $patient->image }}"  width="200" height="40">
                                @endif
                            </span>
                            <div class="media-body ml-3 mr-3 d-lg-block">
                                <h6 class="mb-0 font-weight-bold text-white text-capitalize">{{auth('patien')->user()->firstName . ' ' . auth('patien')->user()->lastName}}</h6>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
