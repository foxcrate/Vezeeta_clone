@extends('backEnd.layoutes.mastar')
@section('title','Search wife')
@section('content')
@include('backEnd.patien.slidenav')
<!-- profile patient -->
  <!-- Main content -->
  <div class="d-flex bg-page" id="wrapper">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <div id="page-content-wrapper">
      <!-- Topnav -->
      @include('includes.patientNav')
      {{-- <div class="col-lg-3" data-toggle="modal" data-target="#exampleModal">
        <div class="content-item ml-auto mr-auto">
          <img src="{{url('imgs/icon_png/patient.svg')}}" height="80" class="d-block w-100 mt-2" alt="...">
        </div>
        <h5 class="text-dark font-weight-bold text-center">Add Wife</h5>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Family</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="tab-kids col-lg-8 ml-auto mr-auto col-md-2 mb-4">
                  <a href="{{route('getAllChild',$patient->id)}}" class="text-primary" style="text-decoration:none;">
                      <div class="row ml-auto mr-auto">
                          <div class="col-4 mb-auto mt-auto text-center">
                              <img src="{{url('imgs/kids.svg')}}" width="70" alt="...">
                          </div>
                          <div class="col-6 mb-auto mt-auto h4">Kids</div>
                      </div>
                  </a>
              </div>
              <div class="tab-wife-husband col-lg-8 ml-auto mr-auto col-md-2 mb-4">
                  <a href="{{route('patient.searchWife',$patient->id)}}" class="text-primary" style="text-decoration:none;">
                      <div class="row ml-auto mr-auto ">
                          <div class="col-3 mb-auto mt-auto text-center">
                              <img src="{{url('imgs/fatherandmother.png')}}" width="70" alt="...">
                          </div>
                          <div class="col-8 mb-auto mt-auto ml-auto mr-auto h5 text-wife">Wife or Husband</div>
                      </div>
                  </a>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="container-fluid" style="margin-bottom:100px;">
        <!-- Button trigger modal -->

        {{-- <div class="col-lg-3 ml-auto mr-auto" data-toggle="modal" data-target="#exampleModal">
            <div class="content-item ml-auto mr-auto">
              <img src="{{url('imgs/familyicon.svg')}}" height="80" class="d-block w-100 mt-2" alt="...">
            </div>
            <h5 class="text-dark font-weight-bold text-center">Add {{ auth('patien')->user()->gender == 'male' ? 'wife' : 'Husband' }}</h5>
        </div> --}}

        @if(count($patient->couples) > 0 && $patient->couples[0]->couples == 1)
            @foreach($patient->couples as $value)
                @if($value->couples == 1)
                    <div class="row col-lg-8 ml-auto mr-auto mb-3 card-person-add">
                        <div class="col-lg-2 mb-auto mt-auto">
                            <img src="{{url('imgs/family.png')}}" width="130" alt="...">
                        </div>
                        <div class="col-lg-8 mb-auto mt-auto">
                            <h4 class="col-lg-10 font-weight-bold" ><a style="text-transform:capitalize" href="{{ route('showReportAccept',$value->patientRequest->id) }}">{{ $value->patientRequest->name }}</a></h4>
                            <h5 class="col-lg-10 font-weight-bold" >{{ $value->patientRequest->idCode }}</h5>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="row col-4 mb-3 ml-auto mr-auto">
                <button id="addWife" class="btn btn-primary col-12 h2">Add Wife</button>
            </div>
        @endif
        @if(count($patient->Requestcouples) > 0 && $patient->Requestcouples[0]->couples == 1)
            @foreach($patient->Requestcouples as $value)
                @if($value->couples == 1)
                    <div class="row col-lg-8 ml-auto mr-auto mb-3 card-person-add">
                        <div class="col-lg-2 mb-auto mt-auto">
                            <img src="{{url('imgs/family.png')}}" width="130" alt="...">
                        </div>
                        <div class="col-lg-8 mb-auto mt-auto">
                            <h4 class="col-lg-10 font-weight-bold" ><a style="text-transform:capitalize" href="{{ route('showReportAccept',$value->patient->id) }}">{{ $value->patient->name }}</a></h4>
                            <h5 class="col-lg-10 font-weight-bold" >{{ $value->patient->idCode }}</h5>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="row col-4 mb-3 ml-auto mr-auto">
                <button id="addWife" class="btn btn-primary col-6 h2">Add Wife</button>
            </div>
        @endif
        <div class="row col-4 mb-3 ml-auto mr-auto">
            <button type="button" class="btn btn-primary col-12 " data-toggle="modal" data-target="#exampleModal">
                Register {{ auth('patien')->user()->gender == 'male' ? 'wife' : 'Husband' }}
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add {{ auth('patien')->user()->gender == 'male' ? 'Wife' : 'Husband' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action = "{{route('addNew_wifeOrHusband')}}" method="POST" id = "register" enctype="multipart/form-data" class="login-box">
                            {{ csrf_field() }}
                            <input type="hidden" name="role">
                            <input type="hidden" name="is_active" value=0>
                            <input type="hidden" name="idCode">
                            <input type="hidden" id="latitude" name="latitude" value="markerCurrent.position.lat()">
                            <input type="hidden" id="longitude" name="longitude" value="markerCurrent.position.lng()">
                            <div class="row">
                                <div class="container col-md-12 mb-5">
                                    <div class="avatar-wrapper">
                                        <img class="profile-pic" src="" />
                                        <div class="upload-button">
                                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                        </div>
                                        <input id = "compress_image" name = "image" class="file-upload" type="file" accept="image/*">
                                    </div>
                                    <label class="col-12 text-center text-dark" style="margin-top:-50px"><i class="fa fa-camera mr-2"></i>Add Profile pictrue</label>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-xl-3">
                                    <div class="form-group">
                                        <label class="h6 font-weight-bold">First Name <i class="fa fa-star-of-life star"></i></label>
                                        <input  onkeypress="return /[a-z]/i.test(event.key)" style="text-transform: capitalize" value = "{{old('firstName')}}" class="form-control  @error('firstName') is-invalid @enderror" type="text" name="firstName" placeholder="First Name" >
                                    @error('firstName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-xl-3">
                                    <div class="form-group">
                                        <label class="h6 font-weight-bold">Middle Name</label>
                                        <input onkeypress="return /[a-z]/i.test(event.key)" style="text-transform: capitalize" value = "{{old('middleName')}}" class="form-control @error('middleName') is-invalid @enderror" type="text" name="middleName" placeholder="Middle Name">
                                    </div>
                                    @error('middleName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-xl-3">
                                    <div class="form-group">
                                        <label class="h6 font-weight-bold">Last Name <i class="fa fa-star-of-life star"></i></label>
                                        <input onkeypress="return /[a-z]/i.test(event.key)" style="text-transform: capitalize" value = "{{old('lastName')}}" class="form-control @error('lastName') is-invalid @enderror" type="text" name="lastName" placeholder="Last name">
                                        @error('lastName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-xl-3">
                                    <div class="form-group">
                                        <label class="h6 font-weight-bold">Birth date <i class="fa fa-star-of-life star"></i></label>
                                        <input value = "{{old('BirthDate')}}" class="form-control @error('BirthDate') is-invalid @enderror"  type="date" placeholder="BIRTHDATE" name="BirthDate" >
                                        @error('BirthDate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-xl-3">
                                    <label class="h6 font-weight-bold" for="gender">Gender <i class="fa fa-star-of-life star"></i></label>
                                    <div class="form-flex row">
                                        <div class="col-5">
                                            <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="male" id="male" checked="checked" >
                                            <label for="male" class="ml-3">Male</label>
                                        </div>
                                        <div class="col-5">
                                            <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="female" id="female" />
                                            <label for="female" class="ml-3">Female</label>
                                        </div>
                                        @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-xl-3">
                                    <div class="form-group">
                                        <label class="h6 font-weight-bold">Email</label>
                                        <input id="txtEmailId" value = "{{old('email')}}" class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="username@example.com">
                                        <span id="span-error" style="color:red" class="d-none pl-2">Email vaild</span>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-xl-3">
                                    <div class="form-group">
                                        <label class="h6 font-weight-bold">Phone Number <i class="fa fa-star-of-life star"></i></label>
                                        <input value = "{{old('phoneNumber')}}" name="phoneNumber" type="number" placeholder="Phone Number" class="@error('phoneNumber') is-invalid @enderror form-control" style="padding-left: 240px">
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
                                <div class="col-md-6 mb-xl-3">
                                    <div class="form-group"id="show_hide_password">
                                        <label class="h6 font-weight-bold">Password
                                            <div class="fa fa-star-of-life star"></div>
                                        </label>
                                        <input id = "psw" class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
                                        <a href=""class="field-icon"><i class="fa fa-eye-slash field-icon " aria-hidden="true"></i></a>
                                        <div id="message">
                                            <p id="letter" class="invalid"><span>A lowercase letter</span></p>
                                            <p id="capital" class="invalid"><span>A capital (uppercase) letter</span></p>
                                            <p id="length" class="invalid"><span>Minimum 8 characters </span></p>
                                            {{--  <p id="Char" class="invalid"><span>Special Charter </span></p>  --}}
                                            <p id="Number" class="invalid"><span>A Number </span></p>
                                        </div>
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-xl-3">
                                    <div class="form-group" id="show_hide_password1">
                                        <label class="h6 font-weight-bold">Confirm Password <i class="fa fa-star-of-life star"></i></label>
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
                                        <a href="" class="field-icon"><i class="fa fa-eye-slash field-icon " aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <!-- jop field -->
                                <div class="col-md-6 mb-xl-3">
                                    <div class="form-group">
                                        <label class="h6 font-weight-bold">Job Title</label>
                                        <select name="job" class="form-control">
                                            <option hidden > Choose ..</option>
                                            <option value="Accountant">Accountant</option>
                                            <option value="Teacher">Teacher</option>
                                            <option value="Student">Student</option>
                                            <option value="Attorney">Attorney</option>
                                            <option value="Engineer">Engineer</option>
                                            <option value="Industrial Engineer">Industrial Engineer</option>
                                            <option value="software engineer">Software Engineer</option>
                                            <option value="Structural Engineer">Structural Engineer</option>
                                            <option value="Architect">Architect</option>
                                            <option value="computer engineer">Computer Engineer</option>
                                            <option value="Electrical Engineer">Electrical Engineer</option>
                                            <option value="flight engineer">Flight Engineer</option>
                                            <option value="Decoration designer">Decoration Designer</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="nurse">Nurse</option>
                                            <option value="pharmacist">Pharmacist</option>
                                            <option value="Marketing Specialist">Marketing Specialist</option>
                                            <option value="Salesman">Salesman</option>
                                            <option value="Secretary">Secretary</option>
                                            <option value="Work man">Work Man</option>
                                            <option value="Electrician">Electrician</option>
                                            <option value="Smith">Smith</option>
                                            <option value="Carpenter">Carpenter</option>
                                            <option value="Barber">Barber</option>
                                            <option value="Dressmaker">Dressmaker</option>
                                            <option value="Painter">Painter</option>
                                            <option value="Herdsman">Herdsman</option>
                                            <option value="Driver">Driver</option>
                                            <option value="Barber">Barber</option>
                                            <option value="Office boy">Office Boy</option>
                                            <option value="Postman">Postman</option>
                                            <option value="plumber">Plumber</option>
                                            <option value="broker">Broker</option>
                                            <option value="Chef">Chef</option>
                                            <option value="Fisher man">Fisher Man</option>
                                            <option value="Clean Worker">Clean Worker</option>
                                            <option value="Hairdresser">Hairdresser</option>
                                            <option value="Stylist">Stylist</option>
                                            <option value="Mechanical">Mechanical</option>
                                            <option value="Waiter">Waiter</option>
                                            <option value="Construction Worker">Construction Worker</option>
                                            <option value="Builder">Builder</option>
                                            <option value="porter">Porter</option>
                                            <option value="Servant">Servant</option>
                                            <option value="Baker">Baker</option>
                                            <option value="Receptionist">Receptionist</option>
                                            <option value="Customer service">Customer service</option>
                                            <option value="businessman">Businessman</option>
                                            <option value="Other">Other</option>


                                        </select>
                                        @error('job')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- jop field -->
                                <!-- race field -->
                                <div class="col-md-6 mb-xl-3">
                                    <div class="form-group">
                                        <label class="h6 font-weight-bold">Race</label>
                                        <select class="form-control" name = "race" @error('race') is-invalid @enderror>
                                            <option hidden>Choose ..</option>
                                            <option value="Arabian Gulf">Arabian Gulf</option>
                                            <option value="African">African</option>
                                            <option value="Middle East">Middle East</option>
                                            <option value="Black American">Black American</option>
                                            <option value="Asian">Asian</option>
                                            <option value="White">White</option>
                                            <option value="Hawalian Or other Pacific Islander">Hawalian Or other Pacific Islander</option>
                                            <option value="American India/Alaska Native">American India/Alaska Native</option>
                                        </select>
                                        @error('race')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- race field -->
                                <!-- address field -->
                                <div class="col-md-6 mb-xl-3">
                                    <div class="form-group">
                                        <label class="h6 font-weight-bold">Address</label>
                                        <input type="text" id="pac-input"class="form-control" name="address">
                                        <div id="map" style="height: 500px;width: 500px;"></div>

                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- address field -->
                                <div class="col-md-12 mb-xl-3">
                                    <label class="h6 font-weight-bold" for="state">State
                                        <div class="fa fa-star-of-life star"></div>
                                    </label>
                                    <div class="form-flex row">
                                        <div class="col-3">
                                            <input type="radio" name="state" value="single" id="single" checked="checked" />
                                            <label for="single" class="ml-2">Single</label>
                                        </div>
                                        <div class="col-3">
                                            <input type="radio" name="state" value="married" id="married" />
                                            <label for="married" class="ml-2">Married</label>
                                        </div>
                                        <div class="col-3">
                                            <input type="radio" name="state" value="divorce" id="divorce" />
                                            <label for="divorce" class="ml-2">Divorced</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-xl-3">
                                        <hr class="my-4" />
                                        <div class="">
                                            <input type="checkbox" name="i_agree" id="i_agree">
                                            <label class="h6 font-weight-bold" style="font-size: .98rem;">I have read and I understand the  <a target="_blank" class="text-primary" href="{{route('getPrivacyRegister')}}">pHistroy privacy policy statement</a>, I agree on all terms and conditions.</a></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-center mb-5 mt-5">
                                    <button  id = "sign-in-button" type="submit"  disabled class="h4 col-9 btn btn-primary font-weight-400 mr-auto ml-auto" >Submite</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start-wifehusbend -->
        <div id="searchWife"class="tab-wife-husband col-lg-10 ml-auto mr-auto col-md-2">
            <div class="row">
                <div class="col-12 text-center mt-5">
                    <img src="{{url('imgs/family.png')}}" width="130" alt="...">
                </div>
                <div class="col-lg-8 mt-4 mb-5 ml-auto mr-auto">
                    <form action="{{route('getWife')}}" method="GET" id="formSearchWife">
                        <div class="form-group">
                        <label class="h5 font-weight-bold" for="exampleInputPassword1">Search Id Number</label>
                        <input required type="text" name ="idCodeWife" class="form-control" id="exampleInputPassword1" placeholder="Enter your Husbend or Wife id Number">
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button id="searchWife" type="submit" class="col-lg-5 btn btn-primary h5" data-toggle="modal" data-target="#staticBackdrop">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            @if(session('data'))
                <div id="addRequestWifeDiv" class="row col-lg-10 ml-auto mr-auto mb-5 card-person-add">
                    <div class="col-lg-8 mb-auto mt-auto">
                        <h4 class="col-lg-10 font-weight-bold" >{{session()->get('data')->firstName . ' ' . session()->get('data')->lastName}}</h4>
                        <h5 class="col-lg-10 font-weight-bold" >{{session()->get('data')->idCode}}</h5>
                    </div>
                    <form id="addRequestWife" class="col-lg-2 mb-auto mt-auto" action="{{route('addRequestWife',$patient->id)}}" method="POST">
                        {{ csrf_field() }}
                        <input type = "hidden" name="patientAcceptId" value="{{session()->get('data')->id}}">
                        <input type="hidden" name="patientRequestId" value="{{$patient->id}}">
                        <input type="submit" value="Add Request" class="btn btn-success">
                    </form>
                </div>
            @endif
        </div>
        <!-- End-wifehusbend -->

      </div>
    </div>
    <script>
      $("#addRequestWife").on('submit',function(){
        $("#addRequestWifeDiv").fadeOut(500);
      });
      $("#addWife").on('click',function(){
        $("#searchWife").toggleClass('d-none');
      });
    </script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&callback=initAutocomplete&libraries=places&v=weekly"
    defer
></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        @include('includes.iAgree')
        @include('includes.showPassword')
        @include("includes.GoogleMap")
        @include("includes.maxDate")
    </script>
  </div>
  <!-- Footer -->
  {{-- @include('backEnd.layoutes.footer') --}}
  <!-- footer -->

@stop
