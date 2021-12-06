@extends('backEnd.layoutes.mastar')
@section('title','Doctor Appoiments')
@section('content')
@include('backEnd.hosptail.sidenav')

<div class="d-flex bg-page" id="wrapper">
    <!-- Sidebar -->
    <div id="page-content-wrapper">
        <nav class="navbarp navbar-top navbar-expand navbar-dark border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                    <ul class="navbar-nav align-items-center ml-md-auto">

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
        <div>
            @if($doctorAppoiment)
                @foreach($doctorAppoiment as $doctor)
                    <div class="container col-md-6 ml-auto mr-auto mb-4  mt-5 pharmacy_item">
                        <div class="card-finder">
                            <div class="row mr-auto ml-auto">
                                <div class="col-lg-12 mr-auto ml-auto">
                                    <div class="row h5 text-dark text-capitalize mb-2">
                                        <div class="col-1"><img src="{{url('imgs/doctor.svg')}}" width="30" class="mr-3"></div>
                                        <div class="col-10 ml-3 mt-1 mb-2">{{$doctor->doctor_name}}</div>
                                    </div>
                                    <div class="row h5 text-dark text-capitalize mb-2">
                                        <div class="col-1"><img src="{{url('imgs/infodoctor.svg')}}" width="30" class="mr-3"></div>
                                        <div class="col-10 ml-3 mb-2">{{$doctor->special}}</div>
                                    </div>
                                    <div class="row h5 text-dark text-capitalize">
                                        <div class="col-1"><img src="{{url('imgs/phone.svg')}}" width="25" class="mr-3"></div>
                                        <div class="col-10 ml-3 mb-3">{{$doctor->phoneNumber}}</div>
                                    </div>
                                    <form action="{{ route('bookDocApp',$hosptail->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="row col-lg-12 get_work mb-3 ml-auto mr-auto">
                                            <input type="hidden" name="doctor_id" value="{{ $doctor->doctor_id }}">
                                            <select name="appointments[0][time]" id="" class="get_day col-5 mr-2 form-control">
                                                @if($days)
                                                    @foreach($days as $day)
                                                        <option value="{{ $day->name }}">{{ $day->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <input type="time" name="from" class="get_from col-3 mr-2  form-control">
                                            <input type="time" name="to" class="get_to col-3 mr-2 form-control">
                                        </div>
                                        <div class="row col-lg-12 mb-3 ml-auto mr-auto">
                                            <label>Fees</label>
                                            <input type="number" name="fees" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="row col-lg-2 mr-auto ml-auto mb-3 text-center">
                                                <button id="add_work" type="button" class="btn btn-info mt-3 h2">Add Time</button>
                                            </div>
                                            <div class="row col-lg-8 mr-auto ml-auto mb-3 text-center">
                                                <input type="submit" value="Add Appoiement" class="col-12 mt-3 h2 btn btn-success">
                                            </div>
                                        </div>
                                    </form>

                                    @if($doctor->appointments)
                                        @foreach($doctor->appointments as $a)
                                            <div>
                                                {{ $a['time'] }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="form-group col-lg-3">
                    <button id="add_work" type="button" class="btn btn-success">Add</button>
                </div> --}}
            @endif
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $('#add_work').click(function(){
                $('.get_work:first').clone(true).hide().insertAfter('.get_work:last').slideDown('slow');
                    var last = $('.get_work:last');
                    var current =  $(".get_work").length-1;
                    //last.append(new_button.clone(true));
                    last.find('select').val([]);
                    last.find('select.get_day').attr("name", "appointments[" + current + "][time]");
                    last.find('input.get_from').attr("name", "from");
                    last.find('input.get_to').attr("name", "to");
                });
                {{--  $("body").on("click", "#remove_more_fields", function () {
                    $(this).closest(".field_group").hide();
                });  --}}
        });

    </script>

@stop
