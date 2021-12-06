@extends('backEnd.layoutes.mastar')
@section('title','Find Doctor')
@section('content')
    <div class="d-flex bg-page" id="wrapper">
        <!-- Sidebar -->
    @include('backEnd.hosptail.sidenav')
    <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbarp navbar-top navbar-expand navbar-dark border-bottom">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Navbar links -->
                        <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                        <ul class="navbar-nav align-items-center ml-md-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ni ni-bell-55 mr-lg-3 mt-lg-1" style="font-size: 15pt;"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                                    <!-- Dropdown header -->
                                    <div class="px-3 py-3">
                                        <p class="text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</p>
                                    </div>
                                    <!-- List group -->
                                    <div class="list-group-noti list-group-flush">
                                    </div>
                                    <!-- View all -->
                                    <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                            <li class="nav-item dropdown">
                                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="media align-items-center">
                                        <span class="avatar avatar-sm rounded-circle">
                                            @if(!$hosptail->image)
                                            <img alt="Image placeholder" src="{{ asset('uploads/default.png') }}">
                                            @else
                                            <img alt="Image placeholder" src="{{ $hosptail->image }}">
                                            @endif

                                        </span>
                                        <div class="media-body ml-3 mr-3 d-lg-block">
                                            <h6 class="mb-0 font-weight-bold text-white">{{$hosptail->hosptailName}}</h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- informationContent -->
            <div class="container-fluid" style="margin-top: 140px; margin-bottom: 160px;">
                <div class="header">
                    <div class="container card p-5 ml-auto mr-auto">
                        <h4 class="h3 text-center">Find Doctor</h4>
                        @if(session('msg'))
                            <div class="invalid-feedback">{{session('msg')}}</div>
                        @endif

                        <form action = "{{ route('hosptailFindDoctor',$hosptail->id) }}" method="Get" class="col-8 ml-auto mr-auto">
                            <div class="form-group mt-5">
                                <label class="h5 font-weight-bold">Find By Name Doctor</label>
                                <input onkeypress="return /[a-z]/i.test(event.key)" required="required" name="doctorName" type="text" class="form-control" placeholder="Search By DoctorName and Specialty">
                            </div>
                            <input type="submit" value="Find" class="col-4 btn btn-primary mt-3 float-right">
                        </form>
                    </div>
                </div>
            </div>


            <!--Start-Footer-->
        @include('backEnd.layoutes.footer')
        <!--End-Footer-->
        </div>
    </div>




@stop
@section('scripts')


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

@stop
