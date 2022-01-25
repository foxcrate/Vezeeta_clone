@extends('backEnd.layoutes.mastar')
@section('title','Online Doctor Register')
@section('content')
@include('backEnd.layoutes.navbar')
<div class="bg-regist pt-5 pb-5">
<section class="signup-step-container col-md-6 container bg-registr">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <form action="{{route('postonlineDoctorRegister')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="idCode">
                    <input type="hidden" id="latitude" name="latitude" value="markerCurrent.position.lat()">
                    <input type="hidden" id="longitude" name="longitude" value="markerCurrent.position.lng()">
                    <div class="avatar-wrapper mt-5">
                        <img class="profile-pic" src="" name = "image"/>
                        <div class="upload-button">
                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </div>
                        <input class="file-upload @error('image') is-invalid @enderror" type="file" accept="image/*" name="image">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label class="col-12 text-center text-dark" style="margin-top:-50px"><i class="fa fa-camera mr-2"></i>Add Profile Pictrue</label>
                    <div class="row mt-5">
                        <div class="col-lg-6 form-group">
                            <label class="h6 font-weight-bold">Doctor Name <i class="fa fa-star-of-life star"></i></label>
                            <input onkeypress="return /[a-z ]/i.test(event.key)" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Doctor Full Name"style="text-transform:capitalize">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="h6 font-weight-bold">Degree <i class="fa fa-star-of-life star"></i></label>
                            <select class="form-control @error('degree') is-invalid @enderror" placeholder="degree" name="degree">
                                <option value="">Chosse .. </option>
                                <option value="MD">MD</option>
                                <option value="BSC">BSC</option>
                                <option value="MSC">MSC</option>
                                <option value="PsyD">PsyD</option>
                                <option value="PhD">PhD</option>
                                <option value="MDCM">MDCM</option>
                                <option value="DO">DO</option>
                                <option value="MBBS">MBBS</option>
                                <option value="MBChB">MBChB</option>
                                <option value="DDS">DDS</option>
                                <option value="DPM">DPM</option>
                                <option value="EdD">EdD</option>
                                <option value="PharmD">PharmD</option>
                            </select>
                            @error('degree')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-xl-3">
                            <div class="form-group">
                                <label class="h6 font-weight-bold">Degree Photo <i class="fa fa-star-of-life star"></i></label>
                                <input type="file" name="degree_image" class="form-control @error('degree_image') is-invalid @enderror">
                                @error('degree_image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-xl-3">
                            <div class="form-group">
                                <label class="h6 font-weight-bold">license Photo <i class="fa fa-star-of-life star"></i></label>
                                <input type="file" name="license_image" class="form-control @error('license_image') is-invalid @enderror">
                                @error('license_image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-xl-3">
                            <div class="form-group">
                                <label class="h6 font-weight-bold">license Number <i class="fa fa-star-of-life star"></i></label>
                                <input type = "text" class="form-control @error('license_number') is-invalid @enderror"  name="license_number"  placeholder="license number">{{old('information')}}</textarea>
                                @error('license_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-xl-3">
                            <div class="form-group">
                                <label class="h6 font-weight-bold">Email <i class="fa fa-star-of-life star"></i></label>
                                <input id="txtEmailId" class="form-control" type="email" name="email" placeholder="E-mail">
                                <span id="span-error" style="color:red" class="d-none pl-2">Email vaild</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-xl-3">
                            <div class="form-group"id="show_hide_password">
                                <label class="h6 font-weight-bold">Password <div class="fa fa-star-of-life star"></div></label>
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
                                <div class="alert alert-danger">{{ $message }}</div>
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
                        <div class="col-md-6 mb-xl-3">
                            <div class="form-group">
                                <label class="h6 font-weight-bold">Primary Speciality <i class="fa fa-star-of-life star"></i></label>
                                <select class="form-control @error('Primary_Speciality') is-invalid @enderror" type="text" name="speciality_id" placeholder="Primary Speciality">
                                    <option value="0">Chosse ..</option>
                                    @foreach($doctorSp as $sp)
                                        <option value="{{$sp->id}}">{{$sp->name}}</option>
                                    @endforeach
                                </select>
                                @error('Primary_Speciality')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-xl-3">
                            <div class="form-group">
                                <label class="h6 font-weight-bold">Medical Description <i class="fa fa-star-of-life star"></i></label>
                                <textarea class="form-control @error('information') is-invalid @enderror" row = "4" cols="10" name="information" style="resize: none" placeholder="Medical Description">{{old('information')}}</textarea>
                                @error('information')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-xl-3">
                            <div class="form-group">
                                <label class="h6 font-weight-bold">Phone Number <i class="fa fa-star-of-life star"></i></label>
                                <input type="number" name="phoneNumber" class="form-control @error('phoneNumber') is-invalid @enderror" value="{{old('phoneNumber')}}" placeholder="Phone Number" style="padding-left: 260px">
                                    <select style="position: relative;bottom: 38px;width: 33%;" name="countryCode" id="" class="form-control">
                                        <option data-countryCode="EG" value="+20">Egypt (+20)</option>
                                        <option data-countryCode="SA" value="+966">Saudi Arabia (+966)</option>
                                        {{--  <optgroup label="Other countries">
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
                                            <!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
                                            <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                            <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                            <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                            <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
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
                                        </optgroup>  --}}
                                    </select>
                                    @error('phoneNumber')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (session()->has('phoneMsg'))
                                        <div class="invalid-feedback">
                                            {{ session()->get('phoneMsg') }}
                                        </div>
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-xl-3">
                            <div class="form-group">
                                <label for="nationality"
                                    class="title-label ml-lg-3">Nationality</label>
                                <select
                                    value="{{old('nationality')}}"
                                    class="form-control  @error('nationality') is-invalid @enderror"
                                    id="nationality"
                                    name="nationality">
                                    {{-- <optgroup label="Other countries"> --}}
                                    {{-- <option hidden > Choose ..</option> --}}
                                    <option value="">Nationality
                                    </option>
                                    <option data-countryCode="DZ"
                                        value="Algeria">
                                        Algeria</option>
                                    <option data-countryCode="AD"
                                        value="Andorra">
                                        Andorra</option>
                                    <option data-countryCode="AO"
                                        value="Angola">Angola
                                    </option>
                                    <option data-countryCode="AI"
                                        value="Anguilla">
                                        Anguilla</option>
                                    <option data-countryCode="AG"
                                        value="Antigua">
                                        Antigua &amp; Barbuda
                                    </option>
                                    <option data-countryCode="AR"
                                        value="Argentina">
                                        Argentina</option>
                                    <option data-countryCode="AM"
                                        value="Armenia">
                                        Armenia</option>
                                    <option data-countryCode="AW"
                                        value="Aruba">Aruba
                                    </option>
                                    <option data-countryCode="AU"
                                        value="Australia">
                                        Australia</option>
                                    <option data-countryCode="AT"
                                        value="Austria ">
                                        Austria </option>
                                    <option data-countryCode="AZ"
                                        value="Azerbaijan">
                                        Azerbaijan</option>
                                    <option data-countryCode="BS"
                                        value="Bahamas">
                                        Bahamas</option>
                                    <option data-countryCode="BH"
                                        value="Bahrain">
                                        Bahrain </option>
                                    <option data-countryCode="BD"
                                        value="Bangladesh">
                                        Bangladesh</option>
                                    <option data-countryCode="BB"
                                        value="Barbados">
                                        Barbados</option>
                                    <option data-countryCode="BY"
                                        value="Belarus">
                                        Belarus</option>
                                    <option data-countryCode="BE"
                                        value="Belgium">
                                        Belgium</option>
                                    <option data-countryCode="BZ"
                                        value="Belize">Belize
                                    </option>
                                    <option data-countryCode="BJ"
                                        value="Benin">Benin
                                    </option>
                                    <option data-countryCode="BM"
                                        value="Bermuda">
                                        Bermuda</option>
                                    <option data-countryCode="BT"
                                        value="Bhutan">Bhutan
                                    </option>
                                    <option data-countryCode="BO"
                                        value="Bolivia">
                                        Bolivia</option>
                                    <option data-countryCode="BA"
                                        value="Bosnia Herzegovina">
                                        Bosnia Herzegovina
                                    </option>
                                    <option data-countryCode="BW"
                                        value="267">Botswana
                                    </option>
                                    <option data-countryCode="BR"
                                        value="55">Brazil
                                    </option>
                                    <option data-countryCode="BN"
                                        value="673">Brunei
                                    </option>
                                    <option data-countryCode="BG"
                                        value="359">Bulgaria
                                    </option>
                                    <option data-countryCode="BF"
                                        value="226">Burkina
                                        Faso</option>
                                    <option data-countryCode="BI"
                                        value="257">Burundi
                                    </option>
                                    <option data-countryCode="KH"
                                        value="855">Cambodia
                                    </option>
                                    <option data-countryCode="CM"
                                        value="237">Cameroon
                                    </option>
                                    <option data-countryCode="CA"
                                        value="1">
                                        Canada
                                    </option>
                                    <option data-countryCode="CV"
                                        value="238">Cape Verde
                                        Islands </option>
                                    <option data-countryCode="KY"
                                        value="1345">Cayman
                                        Islands </option>
                                    <option data-countryCode="CF"
                                        value="236">Central
                                        African Republic
                                    </option>
                                    <option data-countryCode="CL"
                                        value="56">Chile
                                    </option>
                                    <option data-countryCode="CN"
                                        value="86">China
                                    </option>
                                    <option data-countryCode="CO"
                                        value="57">Colombia
                                    </option>
                                    <option data-countryCode="KM"
                                        value="269">Comoros
                                    </option>
                                    <option data-countryCode="CG"
                                        value="242">Congo
                                    </option>
                                    <option data-countryCode="CK"
                                        value="682">Cook
                                        Islands </option>
                                    <option data-countryCode="CR"
                                        value="506">Costa Rica
                                    </option>
                                    <option data-countryCode="HR"
                                        value="385">Croatia
                                    </option>
                                    <option data-countryCode="CU"
                                        value="53">Cuba
                                    </option>
                                    <option data-countryCode="CY"
                                        value="90392">Cyprus
                                        North </option>
                                    <option data-countryCode="CY"
                                        value="357">Cyprus
                                        South </option>
                                    <option data-countryCode="CZ"
                                        value="42">Czech
                                        Republic </option>
                                    <option data-countryCode="DK"
                                        value="45">Denmark
                                    </option>
                                    <option data-countryCode="DJ"
                                        value="253">Djibouti
                                    </option>
                                    <option data-countryCode="DM"
                                        value="1809">Dominica
                                    </option>
                                    <option data-countryCode="DO"
                                        value="1809">Dominican
                                        Republic </option>
                                    <option data-countryCode="EC"
                                        value="593">Ecuador
                                    </option>
                                    <option data-countryCode="EG"
                                        value="+20">Egypt
                                    </option>
                                    <option data-countryCode="SV"
                                        value="503">El
                                        Salvador </option>
                                    <option data-countryCode="GQ"
                                        value="240">Equatorial
                                        Guinea </option>
                                    <option data-countryCode="ER"
                                        value="291">Eritrea
                                    </option>
                                    <option data-countryCode="EE"
                                        value="372">Estonia
                                    </option>
                                    <option data-countryCode="ET"
                                        value="251">Ethiopia
                                    </option>
                                    <option data-countryCode="FK"
                                        value="500">Falkland
                                        Islands </option>
                                    <option data-countryCode="FO"
                                        value="298">Faroe
                                        Islands </option>
                                    <option data-countryCode="FJ"
                                        value="679">Fiji
                                    </option>
                                    <option data-countryCode="FI"
                                        value="358">Finland
                                    </option>
                                    <option data-countryCode="FR"
                                        value="33">France
                                    </option>
                                    <option data-countryCode="GF"
                                        value="594">French
                                        Guiana </option>
                                    <option data-countryCode="PF"
                                        value="689">French
                                        Polynesia </option>
                                    <option data-countryCode="GA"
                                        value="241">Gabon
                                    </option>
                                    <option data-countryCode="GM"
                                        value="220">Gambia
                                    </option>
                                    <option data-countryCode="GE"
                                        value="7880">Georgia
                                    </option>
                                    <option data-countryCode="DE"
                                        value="49">Germany
                                    </option>
                                    <option data-countryCode="GH"
                                        value="233">Ghana
                                    </option>
                                    <option data-countryCode="GI"
                                        value="350">Gibraltar
                                    </option>
                                    <option data-countryCode="GR"
                                        value="30">Greece
                                    </option>
                                    <option data-countryCode="GL"
                                        value="299">Greenland
                                    </option>
                                    <option data-countryCode="GD"
                                        value="1473">Grenada
                                    </option>
                                    <option data-countryCode="GP"
                                        value="590">Guadeloupe
                                    </option>
                                    <option data-countryCode="GU"
                                        value="671">Guam
                                    </option>
                                    <option data-countryCode="GT"
                                        value="502">Guatemala
                                    </option>
                                    <option data-countryCode="GN"
                                        value="224">Guinea
                                    </option>
                                    <option data-countryCode="GW"
                                        value="245">Guinea -
                                        Bissau </option>
                                    <option data-countryCode="GY"
                                        value="592">Guyana
                                    </option>
                                    <option data-countryCode="HT"
                                        value="509">Haiti
                                    </option>
                                    <option data-countryCode="HN"
                                        value="504">Honduras
                                    </option>
                                    <option data-countryCode="HK"
                                        value="852">Hong Kong
                                    </option>
                                    <option data-countryCode="HU"
                                        value="36">Hungary
                                    </option>
                                    <option data-countryCode="IS"
                                        value="354">Iceland
                                    </option>
                                    <option data-countryCode="IN"
                                        value="91">India
                                    </option>
                                    <option data-countryCode="ID"
                                        value="62">Indonesia
                                    </option>
                                    <option data-countryCode="IR"
                                        value="98">Iran
                                    </option>
                                    <option data-countryCode="IQ"
                                        value="964">Iraq
                                    </option>
                                    <option data-countryCode="IE"
                                        value="353">Ireland
                                    </option>
                                    <option data-countryCode="IL"
                                        value="972">Israel
                                    </option>
                                    <option data-countryCode="IT"
                                        value="39">Italy
                                    </option>
                                    <option data-countryCode="JM"
                                        value="1876">Jamaica
                                    </option>
                                    <option data-countryCode="JP"
                                        value="81">Japan
                                    </option>
                                    <option data-countryCode="JO"
                                        value="962">Jordan
                                    </option>
                                    <option data-countryCode="KZ"
                                        value="7">
                                        Kazakhstan
                                    </option>
                                    <option data-countryCode="KE"
                                        value="254">Kenya
                                    </option>
                                    <option data-countryCode="KI"
                                        value="686">Kiribati
                                    </option>
                                    <option data-countryCode="KP"
                                        value="850">Korea
                                        North </option>
                                    <option data-countryCode="KR"
                                        value="82">Korea South
                                    </option>
                                    <option data-countryCode="KW"
                                        value="965">Kuwait
                                    </option>
                                    <option data-countryCode="KG"
                                        value="996">Kyrgyzstan
                                    </option>
                                    <option data-countryCode="LA"
                                        value="856">Laos
                                    </option>
                                    <option data-countryCode="LV"
                                        value="371">Latvia
                                    </option>
                                    <option data-countryCode="LB"
                                        value="961">Lebanon
                                    </option>
                                    <option data-countryCode="LS"
                                        value="266">Lesotho
                                    </option>
                                    <option data-countryCode="LR"
                                        value="231">Liberia
                                    </option>
                                    <option data-countryCode="LY"
                                        value="218">Libya
                                    </option>
                                    <option data-countryCode="LI"
                                        value="417">
                                        Liechtenstein </option>
                                    <option data-countryCode="LT"
                                        value="370">Lithuania
                                    </option>
                                    <option data-countryCode="LU"
                                        value="352">Luxembourg
                                    </option>
                                    <option data-countryCode="MO"
                                        value="853">Macao
                                    </option>
                                    <option data-countryCode="MK"
                                        value="389">Macedonia
                                    </option>
                                    <option data-countryCode="MG"
                                        value="261">Madagascar
                                    </option>
                                    <option data-countryCode="MW"
                                        value="265">Malawi
                                    </option>
                                    <option data-countryCode="MY"
                                        value="60">Malaysia
                                    </option>
                                    <option data-countryCode="MV"
                                        value="960">Maldives
                                    </option>
                                    <option data-countryCode="ML"
                                        value="223">Mali
                                    </option>
                                    <option data-countryCode="MT"
                                        value="356">Malta
                                    </option>
                                    <option data-countryCode="MH"
                                        value="692">Marshall
                                        Islands </option>
                                    <option data-countryCode="MQ"
                                        value="596">Martinique
                                    </option>
                                    <option data-countryCode="MR"
                                        value="222">Mauritania
                                    </option>
                                    <option data-countryCode="YT"
                                        value="269">Mayotte
                                    </option>
                                    <option data-countryCode="MX"
                                        value="52">Mexico
                                    </option>
                                    <option data-countryCode="FM"
                                        value="691">Micronesia
                                    </option>
                                    <option data-countryCode="MD"
                                        value="373">Moldova
                                    </option>
                                    <option data-countryCode="MC"
                                        value="377">Monaco
                                    </option>
                                    <option data-countryCode="MN"
                                        value="976">Mongolia
                                    </option>
                                    <option data-countryCode="MS"
                                        value="1664">
                                        Montserrat </option>
                                    <option data-countryCode="MA"
                                        value="212">Morocco
                                    </option>
                                    <option data-countryCode="MZ"
                                        value="258">Mozambique
                                    </option>
                                    <option data-countryCode="MN"
                                        value="95">Myanmar
                                    </option>
                                    <option data-countryCode="NA"
                                        value="264">Namibia
                                    </option>
                                    <option data-countryCode="NR"
                                        value="674">Nauru
                                    </option>
                                    <option data-countryCode="NP"
                                        value="977">Nepal
                                    </option>
                                    <option data-countryCode="NL"
                                        value="31">Netherlands
                                    </option>
                                    <option data-countryCode="NC"
                                        value="687">New
                                        Caledonia </option>
                                    <option data-countryCode="NZ"
                                        value="64">New Zealand
                                    </option>
                                    <option data-countryCode="NI"
                                        value="505">Nicaragua
                                    </option>
                                    <option data-countryCode="NE"
                                        value="227">Niger
                                    </option>
                                    <option data-countryCode="NG"
                                        value="234">Nigeria
                                    </option>
                                    <option data-countryCode="NU"
                                        value="683">Niue
                                    </option>
                                    <option data-countryCode="NF"
                                        value="672">Norfolk
                                        Islands</option>
                                    <option data-countryCode="NP"
                                        value="670">Northern
                                        Marianas</option>
                                    <option data-countryCode="NO"
                                        value="47">Norway
                                    </option>
                                    <option data-countryCode="OM"
                                        value="968">Oman
                                    </option>
                                    <option data-countryCode="PW"
                                        value="680">Palau
                                    </option>
                                    <option data-countryCode="PA"
                                        value="507">Panama
                                    </option>
                                    <option data-countryCode="PG"
                                        value="Papua New Guinea">
                                        Papua
                                        New Guinea
                                    </option>
                                    <option data-countryCode="PY"
                                        value="Paraguay">
                                        Paraguay</option>
                                    <option data-countryCode="PE"
                                        value="Peru">Peru
                                    </option>
                                    <option data-countryCode="PH"
                                        value="Philippines">
                                        Philippines</option>
                                    <option data-countryCode="PL"
                                        value="Poland">Poland
                                    </option>
                                    <option data-countryCode="PT"
                                        value="Portugal">
                                        Portugal</option>
                                    <option data-countryCode="PR"
                                        value="Puerto Rico">
                                        Puerto Rico</option>
                                    <option data-countryCode="QA"
                                        value="Qatar">Qatar
                                    </option>
                                    <option data-countryCode="RE"
                                        value="Reunion">
                                        Reunion</option>
                                    <option data-countryCode="RO"
                                        value="Romania">
                                        Romania</option>
                                    <option data-countryCode="RU"
                                        value="Russia">Russia
                                    </option>
                                    <option data-countryCode="RW"
                                        value="Rwanda ">Rwanda
                                    </option>
                                    <option data-countryCode="SM"
                                        value="San Marino">San
                                        Marino</option>
                                    <option data-countryCode="ST"
                                        value="Sao Tome">Sao
                                        Tome &amp; Principe
                                    </option>
                                    <option data-countryCode="SA"
                                        value="+Saudi Arabia">
                                        Saudi Arabia</option>
                                    <option data-countryCode="SN"
                                        value="Senegal">
                                        Senegal</option>
                                    <option data-countryCode="CS"
                                        value="Serbia">Serbia
                                    </option>
                                    <option data-countryCode="SC"
                                        value="Seychelles">
                                        Seychelles</option>
                                    <option data-countryCode="SL"
                                        value="Sierra Leone">
                                        Sierra Leone</option>
                                    <option data-countryCode="SG"
                                        value="Singapore">
                                        Singapore</option>
                                    <option data-countryCode="SK"
                                        value="Slovak Republic">
                                        Slovak
                                        Republic</option>
                                    <option data-countryCode="SI"
                                        value="Slovenia">
                                        Slovenia</option>
                                    <option data-countryCode="SB"
                                        value="Solomon Islands">
                                        Solomon
                                        Islands</option>
                                    <option data-countryCode="SO"
                                        value="Somalia">
                                        Somalia</option>
                                    <option data-countryCode="ZA"
                                        value="South Africa">
                                        South Africa</option>
                                    <option data-countryCode="ES"
                                        value="Spain">Spain
                                    </option>
                                    <option data-countryCode="LK"
                                        value="Sri Lanka">Sri
                                        Lanka</option>
                                    <option data-countryCode="SH"
                                        value="St. Helena">St.
                                        Helena </option>
                                    <option data-countryCode="KN"
                                        value="St. Kitts">St.
                                        Kitts </option>
                                    <option data-countryCode="SC"
                                        value="St. Lucia">St.
                                        Lucia</option>
                                    <option data-countryCode="SD"
                                        value="Sudan">Sudan
                                    </option>
                                    <option data-countryCode="SR"
                                        value="Suriname">
                                        Suriname</option>
                                    <option data-countryCode="SZ"
                                        value="Swaziland">
                                    </option>
                                    <option data-countryCode="SE"
                                        value="46">Sweden
                                    </option>
                                    <option data-countryCode="CH"
                                        value="Switzerland">
                                        Switzerland</option>
                                    <option data-countryCode="SI"
                                        value="Syria">Syria
                                    </option>
                                    <option data-countryCode="TW"
                                        value="Taiwan">Taiwan
                                    </option>
                                    <option data-countryCode="TJ"
                                        value="Tajikstan">
                                        Tajikstan</option>
                                    <option data-countryCode="TH"
                                        value="Thailand">
                                        Thailand</option>
                                    <option data-countryCode="TG"
                                        value="Togo">Togo
                                    </option>
                                    <option data-countryCode="TO"
                                        value="Tonga">Tonga
                                    </option>
                                    <option data-countryCode="TT"
                                        value="Trinidad">
                                        Trinidad &amp; Tobago
                                    </option>
                                    <option data-countryCode="TN"
                                        value="Tunisia">
                                        Tunisia</option>
                                    <option data-countryCode="TR"
                                        value="Turkey">Turkey
                                    </option>
                                    <option data-countryCode="TM"
                                        value="Turkmenistan">
                                        Turkmenistan</option>
                                    <option data-countryCode="TM"
                                        value="Turkmenistan">
                                        Turkmenistan</option>
                                    <option data-countryCode="TC"
                                        value="Turks">Turks
                                        &amp; Caicos Islands
                                    </option>
                                    <option data-countryCode="TV"
                                        value="Tuvalu">Tuvalu
                                    </option>
                                    <option data-countryCode="UG"
                                        value="Uganda">Uganda
                                    </option>
                                    <option data-countryCode="GB"
                                        value="UK">UK</option>
                                    <option data-countryCode="UA"
                                        value="Ukraine">
                                        Ukraine</option>
                                    <option data-countryCode="AE"
                                        value="United Arab Emirates">
                                        United Arab
                                        Emirates </option>
                                    <option data-countryCode="UY"
                                        value="Uruguay">
                                        Uruguay </option>
                                    <option data-countryCode="US"
                                        value="USA">USA
                                    </option>
                                    <option data-countryCode="UZ"
                                        value="Uzbekistan">
                                        Uzbekistan</option>
                                    <option data-countryCode="VU"
                                        value="Vanuatu">
                                        Vanuatu</option>
                                    <option data-countryCode="VA"
                                        value="Vatican City">
                                        Vatican City </option>
                                    <option data-countryCode="VE"
                                        value="Venezuela">
                                        Venezuela</option>
                                    <option data-countryCode="VN"
                                        value="Vietnam">
                                        Vietnam</option>
                                    <option data-countryCode="VG"
                                        value="Virgin Islands - British">
                                        Virgin Islands
                                        - British </option>
                                    <option data-countryCode="VI"
                                        value="Virgin Islands - US">
                                        Virgin Islands - US
                                    </option>
                                    <option data-countryCode="WF"
                                        value="Wallis">Wallis
                                        &amp; Futuna </option>
                                    <option data-countryCode="YE"
                                        value="Yemen (North)">
                                        Yemen (North)</option>
                                    <option data-countryCode="YE"
                                        value="Yemen (South)">
                                        Yemen (South)</option>
                                    <option data-countryCode="ZM"
                                        value="Zambia">Zambia
                                    </option>
                                    <option data-countryCode="ZW"
                                        value="Zimbabwe">
                                        Zimbabwe</option>
                                    {{-- </optgroup> --}}
                                </select>
                                @error('nationality')
                                <div class="invalid-feedback">
                                    {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-xl-3">
                            <div class="form-group">
                                <label class="h6 font-weight-bold">National Id Front Side <i class="fa fa-star-of-life star"></i></label>
                                <input type="file" name="national_id_front_side" class="form-control @error('national_id_front_side') is-invalid @enderror">
                                @error('national_id_front_side')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-xl-3">
                            <div class="form-group">
                                <label class="h6 font-weight-bold">National Id Back Side <i class="fa fa-star-of-life star"></i></label>
                                <input type="file" name="national_id_back_side" class="form-control @error('national_id_front_side') is-invalid @enderror">
                                @error('national_id_back_side')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- address field -->
                        <div class="col-md-12 mb-xl-3">
                            <div class="form-group">
                                <label class="h6 font-weight-bold">Address <i class="fa fa-star-of-life star"></i></label>
                                <input type="text" id="pac-input"class="form-control" name="address">
                                <div id="map" style="height: 500px;width: 100%;"></div>

                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- address field -->
                        <div class="col-md-12 mb-xl-3">
                            <hr class="my-4" />
                            <div class="">
                                <input type="checkbox" name="i_agree" id="i_agree">
                                <label class="h6 font-weight-bold" style="font-size: .98rem;">I have read and I understand the  <a target="_blank" class="text-primary" href="{{route('getPrivacyRegister')}}">pHistroy privacy policy statement</a>, I agree on all terms and conditions.</a></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center mb-5 mt-5">
                        <button type="submit" disabled id = "sign-in-button" class=" col-9 btn btn-primary font-weight-400 h3 mr-auto ml-auto">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</div>

@include('backEnd.layoutes.footer')
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
    <script>
        @include('includes.emailVaild')
    </script>
@stop



