@extends('backEnd.layoutes.mastar')
@section('title','Edit profile Clinic')
@section('css')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        function initMap() {
            var latitude = document.getElementById('latitude').getAttribute('value'),
                longitude = document.getElementById('longitude').getAttribute('value');
            const uluru = { lat: parseInt(latitude), lng: parseInt(longitude) };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8,
                center: uluru,
                mapTypeId: "roadmap",
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
            // search
            var input = document.getElementById('pac-input');
            {{-- $("#pac-input").val("أبحث هنا "); --}}
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });
            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(100, 100),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));
                    $('#latitude').val(place.geometry.location.lat());
                    $('#longitude').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
    </script>
@endsection
@section('content')
<!-- edit profile clinic -->
<!-- Sidenav -->

<!-- Sidenav -->
<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.clinic.slidenav')
    <div id="page-content-wrapper">
        <div class="main-content" id="panel">
          <!-- Topnav -->
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
                                    @if(!$clinic->image)
                                        <img src="{{asset('uploads/default.png')}}" class="rounded-circle">
                                    @else
                                        <img src="{{$clinic->image}}" class="rounded-circle">
                                    @endif
                                </span>
                                <div class="media-body ml-3 mr-3 d-lg-block">
                                <h6 class="mb-0 font-weight-bold text-white">{{$clinic->clinicName}}</h6>
                                </div>
                            </div>
                            </a>
                        </li>
                    </ul>
                </div>
                </div>
            </nav>
            <!-- Header -->
            <!-- Header -->
            <div class="col-11 ml-auto mr-auto mt-5 mb-5 align-items-center coveredit">
              <!-- Mask -->
              <span class="mask bg-gradient-white opacity-1"></span>
            </div>
            <!-- Page content -->
            <div class="container-fluid mb-5">
              <div class="row">
                <div class="col-xl-4 order-xl-2">
                  <div class="card card-profile">
                    <img src="{{url('imgs/BgLogin.jpg')}}" height="150" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                      <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                          <a href="#">
                              @if(!$clinic->image)
                                <img src="{{asset('uploads/default.png')}}" class="rounded-circle">
                              @else
                                <img src="{{$clinic->image}}" class="rounded-circle">
                              @endif
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                      {{-- <div class="d-flex justify-content-between">
                        <a href="#" class="float-lg-left"><i class="fas fa-edit mr-1"></i>Edit</a>
                      </div> --}}
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col">
                          <div class="card-profile-stats d-flex justify-content-center">
                            <div class="text-center mt-3">
                              <h2 class="h3 text-gray"></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                      <h5 class="h5 font-weight-700 mb-5 text-center mt-3">{{$clinic->clinicName}}</h5>
                      <div class="pr-5 pl-5">
                        <h5 class="h5 mt-3"><i class="fas fa-hospital-alt mr-4 text-primary"></i>{{$clinic->Primary_Speciality}}</h5>
                        <h5 class="h5 mt-3"><i class="fas fa-location-arrow mr-4 text-primary"></i>{{$clinic->address}}</h5>
                        <h5 class="h5 mt-3"><i class="fas fa-notes-medical mr-4 text-primary"></i>{{$clinic->Medical_License_Number}}</h5>
                        <h5 class="h5 mt-3"><i class="fas fa-mail-bulk mr-4 text-primary"></i>{{$clinic->email}}</h5>
                        <h5 class="h5 mt-3 "><i class="fa fa-phone mr-4 text-primary" aria-hidden="true"></i> {{str_replace('C','+',$clinic->phoneNumber )}}</h5>
                        <h5 class="h5 mt-3"><i class="fas fa-tty mr-4 text-primary"></i> {{$clinic->telephone}}</h5>
                        <h5 class="h5 mt-3 mb-5"><i class="fas fa-hospital-alt mr-4 text-primary"></i>{{$clinic->Hotline}}</h5>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="col-xl-8 order-xl-1">
                  <div class="card" style="padding-left:100px; padding-right:100px;">
                    <div class="card-header">
                      <div class="row align-items-center">
                        <div class="col-8">
                          <h3 class="mb-0">Edit Profile</h3>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                        @if(session('msgUpdate'))
                        <div id="div_success" class="alert alert-success">
                            data updated successfuly
                        </div>
                        @endif

                      <form action="{{route('clinic.update.profile',$clinic->id)}}" id = "edit-clinic" data-id = "{{$clinic->id}}" enctype="multipart/form-data" role="form" action="" class="login-box" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" id="latitude" name="latitude" value="{{ $clinic->latitude }}">
                        <input type="hidden" id="longitude" name="longitude" value="{{ $clinic->longitude }}">
                        <input type="hidden" name = "old_password" value="{{$clinic->password}}">
                        <input type="hidden" name="id" value="{{$clinic->id}}">
                        <input type="hidden" name="idCode" value="{{$clinic->idCode}}">
                        <input type="hidden" name="countryCode" value="{{$clinic->countryCode}}">
                        <input type="hidden" name="oldPhoneNumber" value="{{ $clinic->phoneNumber }}">
                        <div class="row">
                            <div class="container col-md-12">
                                <div class="avatar-wrapper">
                                    <img class="profile-pic" src="{{$clinic->image}}" />
                                    <div class="upload-button">
                                        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                    </div>
                                    <input name = "image" class="file-upload" type="file" accept="image/*"/>
                                </div>
                            </div>
                            {{--  <div class="col-md-6 mb-xl-3">
                                <div class="form-group">
                                    <label class="h5">Clinic Name</label>
                                    <input onkeypress="return /[a-z]/i.test(event.key)" value = "{{$clinic->clinicName}}" class="form-control" type="text" name="clinicName" placeholder="Hospital Name">
                                </div>
                            </div>  --}}
                            <div class="col-md-6 mb-xl-3">
                                <div class="form-group">
                                    <label class="h5">Primary Speciality</label>
                                    <select class="form-control @error('Primary_Speciality') is-invalid @enderror" type="text" name="Primary_Speciality">
                                        <option {{$clinic->Primary_Speciality == 'General' ? 'selected' : ''}} value="General">General ..</option>
                                        <option {{$clinic->Primary_Speciality == 'Audiologist' ? 'selected' : ''}} value="Audiologist">Audiologist</option>
                                        <option {{$clinic->Primary_Speciality == 'Allergist' ? 'selected' : ''}} value="Allergist">Allergist</option>
                                        <option {{$clinic->Primary_Speciality == 'Anesthesiologist' ? 'selected' : ''}} value="Anesthesiologist">Anesthesiologist </option>
                                        <option {{$clinic->Primary_Speciality == 'Andrologists' ? 'selected' : ''}} value="Andrologists">Andrologists </option>
                                        <option {{$clinic->Primary_Speciality == 'Cardiologist' ? 'selected' : ''}} value="Cardiologist">Cardiologist </option>
                                        <option {{$clinic->Primary_Speciality == 'Cardiovascular' ? 'selected' : ''}} value="Cardiovascular">Cardiovascular </option>
                                        <option {{$clinic->Primary_Speciality == 'Cardiovascular' ? 'selected' : ''}} value="Cardiovascular">Cardiovascular Surgery</option>
                                        <option {{$clinic->Primary_Speciality == 'Neurologist' ? 'selected' : ''}} value="Neurologist">Neurologist </option>
                                        <option {{$clinic->Primary_Speciality == 'Dentist' ? 'selected' : ''}} value="Dentist">Dentist </option>
                                        <option {{$clinic->Primary_Speciality == 'dermatologist' ? 'selected' : ''}} value="dermatologist">dermatologist </option>
                                        <option {{$clinic->Primary_Speciality == 'Emergency Doctors' ? 'selected' : ''}} value="Audiologist">Emergency Doctors</option>
                                        <option {{$clinic->Primary_Speciality == 'Endocrinologist' ? 'selected' : ''}} value="Endocrinologist">Endocrinologist  </option>
                                        <option {{$clinic->Primary_Speciality == 'gynecologist' ? 'selected' : ''}} value="gynecologist">gynecologist  </option>
                                        <option {{$clinic->Primary_Speciality == 'Psychiatrist' ? 'selected' : ''}} value="Psychiatrist">Psychiatrist  </option>
                                        <option {{$clinic->Primary_Speciality == 'hematology' ? 'selected' : ''}} value="hematology">hematology  </option>
                                        <option {{$clinic->Primary_Speciality == 'Hepatologists' ? 'selected' : ''}} value="Hepatologists">Hepatologists   </option>
                                        <option {{$clinic->Primary_Speciality == 'Immunologist' ? 'selected' : ''}} value="Immunologist">Immunologist   </option>
                                        <option {{$clinic->Primary_Speciality == 'Internists Gastroenterology Neonatologist' ? 'selected' : ''}}value="Internists Gastroenterology Neonatologist">Internists Gastroenterology Neonatologist </option>
                                        <option {{$clinic->Primary_Speciality == 'Orthopdist' ? 'selected' : ''}}value="Orthopdist">Orthopdist   </option>
                                        <option {{$clinic->Primary_Speciality == 'Pediatrician' ? 'selected' : ''}}value="Pediatrician">Pediatrician   </option>
                                        <option {{$clinic->Primary_Speciality == 'Plastic Surgeon' ? 'selected' : ''}}value="Plastic Surgeon">Plastic Surgeon </option>
                                        <option {{$clinic->Primary_Speciality == 'Surgeon' ? 'selected' : ''}}value="Surgeon">Surgeon   </option>
                                        <option {{$clinic->Primary_Speciality == 'Urologist' ? 'selected' : ''}}value="Urologist">Urologist     </option>
                                        <option {{$clinic->Primary_Speciality == 'Rheumatologist' ? 'selected' : ''}}value="Rheumatologist">Rheumatologist    </option>
                                        <option {{$clinic->Primary_Speciality == 'Ophthalmologist' ? 'selected' : ''}}value="Ophthalmologist">Ophthalmologist    </option>
                                        <option {{$clinic->Primary_Speciality == 'General Practitioner' ? 'selected' : ''}}value="General Practitioner">General Practitioner </option>
                                        <option {{$clinic->Primary_Speciality == 'Ear , Nose and Throat' ? 'selected' : ''}}value="Ear , Nose and Throat">Ear , Nose and Throat </option>
                                        <option {{$clinic->Primary_Speciality == 'Endoscopic Surgeon' ? 'selected' : ''}}value="Endoscopic Surgeon">Endoscopic Surgeon </option>
                                        <option {{$clinic->Primary_Speciality == 'Radiologist' ? 'selected' : ''}}value="Radiologist">Radiologist     </option>
                                        <option {{$clinic->Primary_Speciality == 'Laboratory & Analytical' ? 'selected' : ''}}value="Laboratory & Analytical">Laboratory & Analytical </option>
                                        <option {{$clinic->Primary_Speciality == 'Pharmacist' ? 'selected' : ''}}value="Pharmacist">Pharmacist      </option>
                                        <option {{$clinic->Primary_Speciality == 'Oncologist' ? 'selected' : ''}}value="Oncologist">Oncologist     </option>
                                        @error('Primary_Speciality')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-xl-3">
                                <div class="form-group">
                                    <label class="h6 font-weight-bold">Clinic License <i class="fa fa-star-of-life star"></i></label>
                                    <input class="form-control @error('Clinic_License') is-invalid @enderror" type="file" placeholder="Clinic License" name="Clinic_License">
                                    @error('Clinic_License')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-xl-3">
                                <div class="form-group">
                                    <label class="h6 font-weight-bold">Medical License Number<i class="fa fa-star-of-life star"></i></label>
                                    <input name="Medical_License_Number" type="text" value="{{ $clinic->Medical_License_Number }}" class="@error('Medical_License_Number') is-invalid @enderror form-control">
                                    @error('Medical_License_Number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 xl-3">
                                <div class="form-group">
                                    <label class="h6 font-weight-bold">Phone Number <i class="fa fa-star-of-life star"></i></label>
                                    <input value = "{{ str_replace($clinic->countryCode,'',$clinic->phoneNumber) }}" name="phoneNumber" type="text" placeholder="Phone Number" class="@error('phoneNumber') is-invalid @enderror form-control" style="padding-left: 280px">
                                    <select style="position:relative; bottom:38px; width: 30%;" name="countryCode" id="" class="form-control">
                                        <option data-countryCode="EG" value="+20">Egypt (+20)</option>
                                        <option data-countryCode="SA" value="+966">Saudi Arabia (+966)</option>
                                        <optgroup label="Other countries">
                                            <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                            <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                            <option data-countryCode="AO" value="244">Angola (+244)</option>
                                            <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                            <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                            <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                            <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                            <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                            <option data-countryCode="AU" value="61">Australia (+61)</option>
                                            <option data-countryCode="AT" value="43">Austria (+43)</option>
                                            <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                            <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                            <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                            <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                            <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                            <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                            <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                            <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                            <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                            <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                            <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                            <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                            <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                            <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                            <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                            <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                            <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                            <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                            <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                            <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                            <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                            <option data-countryCode="CA" value="1">Canada (+1)</option>
                                            <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                            <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                            <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                                            <option data-countryCode="CL" value="56">Chile (+56)</option>
                                            <option data-countryCode="CN" value="86">China (+86)</option>
                                            <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                            <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                            <option data-countryCode="CG" value="242">Congo (+242)</option>
                                            <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                            <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                            <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                            <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                            <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                            <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                            <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                            <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                            <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                            <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                            <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                            <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                            <option data-countryCode="EG" value="+20">Egypt (+20)</option>
                                            <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                            <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                            <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                            <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                            <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                            <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                            <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                            <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                            <option data-countryCode="FI" value="358">Finland (+358)</option>
                                            <option data-countryCode="FR" value="33">France (+33)</option>
                                            <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                            <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                            <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                            <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                            <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                            <option data-countryCode="DE" value="49">Germany (+49)</option>
                                            <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                            <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                            <option data-countryCode="GR" value="30">Greece (+30)</option>
                                            <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                            <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                            <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                            <option data-countryCode="GU" value="671">Guam (+671)</option>
                                            <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                            <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                            <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                            <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                            <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                            <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                            <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                            <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                            <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                            <option data-countryCode="IN" value="91">India (+91)</option>
                                            <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                            <option data-countryCode="IR" value="98">Iran (+98)</option>
                                            <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                            <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                            <option data-countryCode="IL" value="972">Israel (+972)</option>
                                            <option data-countryCode="IT" value="39">Italy (+39)</option>
                                            <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                            <option data-countryCode="JP" value="81">Japan (+81)</option>
                                            <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                            <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                            <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                            <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                            <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                            <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                            <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                            <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                            <option data-countryCode="LA" value="856">Laos (+856)</option>
                                            <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                            <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                            <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                            <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                            <option data-countryCode="LY" value="218">Libya (+218)</option>
                                            <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                            <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                            <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                            <option data-countryCode="MO" value="853">Macao (+853)</option>
                                            <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                            <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                            <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                            <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                            <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                            <option data-countryCode="ML" value="223">Mali (+223)</option>
                                            <option data-countryCode="MT" value="356">Malta (+356)</option>
                                            <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                            <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                            <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                            <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                            <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                            <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                            <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                            <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                            <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                            <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                            <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                            <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                            <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                            <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                            <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                            <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                            <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                            <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                            <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                            <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                            <option data-countryCode="NE" value="227">Niger (+227)</option>
                                            <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                                            <option data-countryCode="NU" value="683">Niue (+683)</option>
                                            <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                            <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                            <option data-countryCode="NO" value="47">Norway (+47)</option>
                                            <option data-countryCode="OM" value="968">Oman (+968)</option>
                                            <option data-countryCode="PW" value="680">Palau (+680)</option>
                                            <option data-countryCode="PA" value="507">Panama (+507)</option>
                                            <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                            <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                            <option data-countryCode="PE" value="51">Peru (+51)</option>
                                            <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                            <option data-countryCode="PL" value="48">Poland (+48)</option>
                                            <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                            <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                            <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                            <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                            <option data-countryCode="RO" value="40">Romania (+40)</option>
                                            <option data-countryCode="RU" value="7">Russia (+7)</option>
                                            <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                            <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                            <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                            <option data-countryCode="SA" value="+966">Saudi Arabia (+966)</option>
                                            <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                            <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                            <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                            <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                            <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                            <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                            <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                            <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                            <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                            <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                            <option data-countryCode="ES" value="34">Spain (+34)</option>
                                            <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                            <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                            <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                            <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                            <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                            <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                            <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                            <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                            <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                            <option data-countryCode="SI" value="963">Syria (+963)</option>
                                            <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                            <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                            <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                            <option data-countryCode="TG" value="228">Togo (+228)</option>
                                            <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                            <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                            <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                            <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                            <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                            <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                            <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                            <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                            <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                            <option data-countryCode="GB" value="44">UK (+44)</option>
                                            <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                            <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                            <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                            <option data-countryCode="US" value="1">USA (+1)</option>
                                            <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                            <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                            <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                            <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                            <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                            <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                                            <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                            <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                            <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                            <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                            <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                            <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                        </optgroup>
                                    </select>
                                    @error('phoneNumber')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if (session()->has('phoneMsg'))
                                        <div class="invalid-feedback">
                                            {{ session()->get('phoneMsg') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-xl-3">
                                <div class="form-group">
                                    <label class="h5">Email</label>
                                    <input value = "{{$clinic->email}}" class="form-control" type="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="h5 font-weight-bold">Address</label>
                                    <input value="{{ $clinic->address }}" type="text" id="pac-input"class="form-control" name="address">
                                    <div id="map" style="width:100%;height:400px"></div>
                                </div>
                            </div>
                            <div class="col-12 text-center mb-5 mt-5">
                                <button type="submit" class="col-9 btn btn-primary h5 font-weight-400 mr-auto ml-auto">Submit</button>
                            </div>
                        </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        @include('backEnd.layoutes.footer')
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&callback=initMap&libraries=places"
            async
        ></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script>

            @include("includes.maxDate")
        </script>
    </div>
</div>
  <!-- Main content -->

@stop



@section('scripts')
    {{-- <script>
        $(function(){
            $('#edit-clinic').on('submit',function(e){
                e.preventDefault();
                var formData = new FormData($("#edit-clinic")[0]),
                    path = "{{route('clinic.update.profile',':id')}}",
                    clinicID = $(this).attr('data-id'),
                    path = path.replace(':id',clinicID);
                    $.ajax({
                        url:path,
                        method:'put',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data:formData,
                        processData:false,
                        contentType:'"application/x-www-form-urlencoded',
                        cache:false,
                        success:function(data){
                            if(data.stauts == true){
                                $('#div_success').show();
                            }
                        },
                        error:function(data){
                            if(data.stauts == false){
                                $('#div_success').val(data.msg).show();
                            }
                        }
                    })

            });


        });

    </script> --}}

@stop

