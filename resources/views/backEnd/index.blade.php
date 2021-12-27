@extends('backEnd.layoutes.mastar')
@section('title','Home page')
@section('content')
    <!-- navbar file -->
    @include('backEnd.layoutes.navbar')
    <!-- navbarfile -->
    <!--Start-Content-->

      <div id="carouselExampleControls" class="carousel mt-5" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="{{url('imgs/c1.jpg')}}" class="w-100 img-fluid animated fadeIn" alt="...">
            <div class="hero-wrap" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
                    <div class="ml-2 col-md-12 pl-xl-0">
                        <h2 class="h2 animated fadeIn"> Welcome Doctor</h2>
                        <h3 class="h3 mb-4">Everywhere, Anytime, Healthy Life <i class="fa fa-heartbeat text-primary" aria-hidden="true"></i>.</h3>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="carousel-item">
            <img src="{{url('imgs/c1.jpg')}}" class="w-100 img-fluid " alt="...">
            <div class="hero-wrap" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
                    <div class="ml-2 col-md-12 pl-xl-0">
                        <h2 class="h2 animated fadeIn"> Welcome Hospital and Clinic</h2>
                        <h3 class="h3 mb-4">Everywhere, Anytime, Healthy Life <i class="fa fa-heartbeat text-primary" aria-hidden="true"></i>.</h3>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="carousel-item">
            <img src="{{url('imgs/c2.jpg')}}" class="w-100 img-fluid animated fadeIn" alt="...">
            <div class="hero-wrap" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
                    <div class="ml-2 col-md-12 pl-xl-0">
                        <h2 class="h2 animated fadeIn"> Welcome Patient</h2>
                        <h3 class="h3 mb-4">Everywhere, Anytime, Healthy Life <i class="fa fa-heartbeat text-primary" aria-hidden="true"></i>.</h3>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="carousel-item">
            <img src="{{url('imgs/c4.jpg')}}" class="w-100 img-fluid animated fadeIn" alt="...">
            <div class="hero-wrap" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
                    <div class="ml-2 col-md-12 pl-xl-0">
                        <h2 class="h2 animated fadeIn"> Welcome Labs and X-rays</h2>
                        <h3 class="h3 mb-4">Everywhere, Anytime, Healthy Life <i class="fa fa-heartbeat text-primary" aria-hidden="true"></i>.</h3>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="carousel-item">
            <img src="{{url('imgs/c5.jpg')}}" class="w-100 img-fluid animated fadeIn" alt="...">
            <div class="hero-wrap" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
                    <div class="ml-2 col-md-12 pl-xl-0">
                        <h2 class="h2 animated fadeIn"> Welcome Pharmacy</h2>
                        <h3 class="h3 mb-4">Everywhere, Anytime, Healthy Life <i class="fa fa-heartbeat text-primary" aria-hidden="true"></i>.</h3>
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
      <!--End-content-->
      <!--Start-Login-->
    <section class="bg-login text-center col-md-10" Style="margin-bottom:50px;">
        @if(session('error'))
            <div class="alert alert-danger m-2">{{session('error')}}</div>
        @endif
         <!-- form login -->
         @if(session('msg'))
            <div class="alert alert-danger">{{session('msg')}}</div>
        @elseif(session('activeMsg'))
            <div class="alert alert-success">{{session('activeMsg')}}</div>
         @endif
        <form action="{{route('loginRoute')}}" method="POST">
            {{ csrf_field() }}
            <!-- radio button -->
            <section class="radio-toolbar">
                <div class="row middle">
                    <div class="col-lg-12 patein-radio">
                        <label class="m-2" onclick="displaySong()">
                        <input id = "patien" type="radio" name="guard" value="patien"/><div class="box patein-radio" checked >
                                <script>function displaySong() {
                                        var textField = $('#name');
                                        textField.val('P')
                                    }
                                </script>
                            <img class="mt-2" src="{{url('imgs/icon_png/patient.svg')}}" height="60" alt="...">
                            <span class="">Patient</span>
                        </div>
                        </label>
                        <label class="m-2" onclick="displaySong1()">
                        <input id="clinic" type="radio" name="guard" value="clinic"/><div class="box">
                                <script>function displaySong1() {
                                        var textField = $('#name');
                                        textField.val('C')
                                    }
                                </script>
                            <img class="mt-2" src="{{url('imgs/icon_png/clinic.svg')}}" height="60" alt="...">
                            <span>Clinic</span>
                        </div>
                        </label>
                        <label class="m-2" onclick="displaySong2()">
                        <input id="hosptail" type="radio" name="guard" value="hosptail"/><div class="box">
                                <script>function displaySong2() {
                                        var textField = $('#name');
                                        textField.val('H')
                                    }
                                </script>
                            <img class="mt-2" src="{{url('imgs/Hospital.svg')}}" height="60" alt="...">
                            <span>Hospital</span>
                        </div>
                        </label>
                        <label class="m-2" onclick="displaySong3()">
                        <input id="xray" type="radio" name="guard" value="xray"/><div class="box">
                                <script>function displaySong3() {
                                        var textField = $('#name');
                                        textField.val('X')
                                    }

                                </script>
                            <img class="mt-2" src="{{url('imgs/x-ray.svg')}}" height="60" alt="...">
                            <span>X-ray</span>
                        </div>
                        </label>
                        <label class="m-2" onclick="displaySong4()">
                        <input id="labs" type="radio" name="guard" value="labs"/><div class="box">
                                <script>function displaySong4() {
                                        var textField = $('#name');
                                        textField.val('L')
                                    }

                                </script>
                            <img class="mt-2" src="{{url('imgs/labs.svg')}}" height="60" alt="...">
                            <span>Labs</span>
                        </div>
                        </label>
                        <label class="m-2" onclick="displaySong5()">
                        <input id="pharmacy" type="radio" name="guard" value="pharmacy"/><div class="box">
                                <script>function displaySong5() {
                                        var textField = $('#name');
                                        textField.val('Y')
                                    }

                                </script>
                            <img class="mt-2" src="{{url('imgs/pharmacy.svg')}}" height="60" alt="...">
                            <span>Pharmacy</span>
                        </div>
                        </label>
                        <label class="m-2" onclick="displaySong6()">
                        <input id="online_doctor" type="radio" name="guard" value="online_doctor"/><div class="box">
                                <script>function displaySong6() {
                                        var textField = $('#name');
                                        textField.val('D')
                                    }

                                </script>
                            <img class="mt-2" src="{{url('imgs/icon_png/onlineDoctor.svg')}}" height="60" alt="...">
                            <span>Doctor</span>
                        </div>
                        </label>
                        <label class="m-2" onclick="displaySong7()">
                            <input id="nurse" type="radio" name="guard" value="nurse"/><div class="box">
                                    <script>function displaySong7() {
                                            var textField = $('#name');
                                            textField.val('N')
                                        }

                                    </script>
                                <img class="mt-2" src="{{url('imgs/nurse.svg')}}" height="60" alt="...">
                                <span>Nurse</span>
                            </div>
                        </label>
                    </div>
                </div>
            </section>
            <!-- radio button -->
            <div class="container row ml-auto mr-auto mb-5">
                <p id="config_app" class="d-none">{{ config('app.url') }}</p>
                <div class="col-md-6 form">
                    <p class="group">
                        <input  id="name" type="text" required name="IdCode" class="idCode" style="text-transform:capitalize" placeholder="ID" />
                    <label for="name">ID</label>
                    </p>
                    <p class="group" id="show_hide_password">
                    <input id="Password" type="password" required name="password" placeholder="Password">
                    <a id="show_hide_password" href=""class="field-icon"><i class="fa fa-eye-slash field-icon" aria-hidden="true"></i></a>
                    <label for="name">Password</label>
                    </p><br/>
                    <a class="text-forget" href="{{route('forgot_password')}}">Forget Password?</a>
                    <input type="submit" value="Sign In">
        </form>
            <!-- form login -->
            {{-- @include('backEnd.formLogin') --}}
        </div>
        </div>
        <div class="text-account">
        <!--<a href="{{ url('/auth/redirect/facebook') }}"><img class="mt-2 mb-2 p-1" src="{{url('imgs/facebook.png')}}" width="260" alt="..."></a>-->
        <a href="#"><img class="mt-2 mb-2 p-1" src="{{url('imgs/facebook.png')}}" width="260" alt="..."></a>
        <a href="{{url('/auth/redirect/google')}}"><img class="mt-2 mb-2 p-1" src="{{url('imgs/google.png')}}" width="260" alt="..."></a>
        <br>
        OR
        <br>
        <a id = "new_account" href = "{{route('indexRegister')}}" class="" >Dont have an Account ?</a>
        </div>
    </section>
    <!--End-Login-->

    <!-- footer -->
    @include('backEnd.layoutes.footer')
    <script>
        var newAccount = document.getElementById('new_account'),
            patientRadio = document.getElementById('patien'),
            clinicRadio = document.getElementById('clinic'),
            hosptailRadio = document.getElementById('hosptail'),
            xrayRadio = document.getElementById('xray'),
            labsRadio = document.getElementById('labs'),
            pharmacyRadio = document.getElementById('pharmacy'),
            online_doctorRadio = document.getElementById('online_doctor'),
            nurceRadio = document.getElementById('nurse');
            patientRadio.onclick = function(){
                newAccount.setAttribute('href',$("#config_app").text()+'/en/dashbord/patien/register');
            };
            hosptailRadio.onclick = function(){
                newAccount.setAttribute('href',$("#config_app").text()+'/en/dashbord/hosptail/register');
            };
            clinicRadio.onclick = function(){
                newAccount.setAttribute('href',$("#config_app").text()+'/en/dashbord/clinic/register');
            };
            xrayRadio.onclick = function(){
                newAccount.setAttribute('href',$("#config_app").text()+'/en/dashbord/xray/register');
            };
            labsRadio.onclick = function(){
                newAccount.setAttribute('href',$("#config_app").text()+'/en/dashbord/labs/register');
            };
            pharmacyRadio.onclick = function(){
                newAccount.setAttribute('href',$("#config_app").text()+'/en/dashbord/pharmacy/register');
            };
            online_doctorRadio.onclick = function(){
                newAccount.setAttribute('href',$("#config_app").text()+'/en/dashbord/online_doctor/register');
            };
            nurceRadio.onclick = function(){
                newAccount.setAttribute('href',$("#config_app").text()+'/en/dashbord/nurse/register');
            };
            var idCodee = document.getElementById('name'),
                    myGuard = document.getElementById("guard");
                    idCodee.onkeyup = function(){
                        if(idCodee.value.includes("P")){
                            document.getElementById("patien").setAttribute("checked","checked");
                        }if(idCodee.value.includes("C")){
                            document.getElementById("clinic").setAttribute("checked","checked");
                        }
                        if(idCodee.value.includes("H")){
                            document.getElementById("hosptail").setAttribute("checked","checked");
                        }
                        if(idCodee.value.includes("L")){
                            document.getElementById("labs").setAttribute("checked","checked");
                        }
                        if(idCodee.value.includes("Y")){
                            document.getElementById("pharmacy").setAttribute("checked","checked");
                        }
                        if(idCodee.value.includes("X")){
                            document.getElementById("xray").setAttribute("checked","checked");
                        }
                        if(idCodee.value.includes("D")){
                            document.getElementById("online_doctor").setAttribute("checked","checked");
                        }
                        if(idCodee.value.includes("N")){
                            document.getElementById("nurse").setAttribute("checked","checked");
                        }
                    }

    </script>
@stop

@section('scripts')
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script>
      @include('includes.showPassword')
  </script>
  <script>
    /* write one char and numper only && write special char [P-C-L-Y-N-D-H-C] */
    var btn = document.getElementById("name");
    btn.addEventListener("keypress", function (evt) {
        console.log(btn.value.length);
        if(btn.value.length===0 && (evt.keyCode <= 57||evt.keyCode < 48 || (evt.keyCode != 80 && evt.keyCode != 68 && evt.keyCode != 72 && evt.keyCode != 67 && evt.keyCode != 88 && evt.keyCode != 76 && evt.keyCode !=89 && evt.keyCode != 78) )){
                console.log('no');
                evt.preventDefault();
        }else if(btn.value.length>0 && (evt.keyCode < 48 || evt.keyCode > 57)) {
                console.log('ddd');
                evt.preventDefault();
        }
    });
    /* write one char and numper only && write special char [P-C-L-Y-N-D-H-C] */
  </script>
    @stop

