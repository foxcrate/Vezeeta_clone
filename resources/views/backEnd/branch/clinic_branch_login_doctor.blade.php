@extends('backEnd.layoutes.mastar')
@section('title','Login Doctor')
@section('content')
<div class="d-flex bg-page" id="wrapper">
    <!-- Sidebar -->
@include('backEnd.branch.clinic_sidenav')
<!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbarp navbar-top navbar-expand navbar-dark border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                    <!-- Search form -->
                    {{-- <ul class="float-lg-right pr-5">
                      <div class="toggle toggle__wrapper">
                        <div id="toggle-example-1" role="switch" aria-checked="false" class="toggle__button">
                          <div class="toggle__switch"></div>
                        </div>
                      </div>
                    </ul> --}}
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
                                    <a href="#!" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto mb-3">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder" src="{{url('imgs/team-1.jpg')}}" class="avatar rounded-circle">
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="text-gray-d">John Snow</h6>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <small class="text-primary">2 hrs ago</small>
                                                    </div>
                                                </div>
                                                <p class="">Lets meet at Starbucks at 11:30. Wdyt?</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto mb-3">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder" src="{{url('imgs/team-1.jpg')}}" class="avatar rounded-circle">
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="text-gray-d">John Snow</h6>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <small class="text-primary">3 hrs ago</small>
                                                    </div>
                                                </div>
                                                <p class="">A new issue has been reported for Argon.</p>
                                            </div>
                                        </div>
                                    </a>
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
                          <img alt="Image placeholder" src="@if($clinic->image) {{url('uploads/clinic/' . $clinic->image)}} @else {{url('uploads/' . $clinic->image)}}@endif">
                        </span>
                                    <div class="media-body ml-3 mr-3 d-lg-block">
                                        <h6 class="mb-0 font-weight-bold text-white">Mohamed Ahmed</h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- informationContent -->
        <div class="container-fluid" style="margin-top: 140px; margin-bottom: 100px;">
            <div class="header">
                <div class="container card p-5 ml-auto mr-auto">
                    <h4 class="text-center">Login By Doctor</h4>
                    @if(session('msg'))
                        <div class="alert alert-danger">{{session('msg')}}</div>
                    @endif

                    <form action = "{{route('clinic_branch_post_login_doctor',[$clinic->id,$branch->id])}}" method="POST" class="col-8 ml-auto mr-auto">
                        {{@csrf_field()}}
                        <div class="form-group mt-5">
                            <label class="h5 font-weight-bold">Choose Your Id Doctor</label>
                            <select class="col-12 form-control" name="IdCode" id="doctor">
                                <option>Choose .. </option>
                                {{-- {{dd($hosptail->doctors)}} --}}
                                @foreach($branch->doctor as $doc)
                                        <option value="{{$doc->IdCode}}">{{$doc->IdCode}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="h5 font-weight-bold">Password</label>
                            <input type="password" name="password" class="col-12 form-control" required = "required">
                        </div>
                        <input type="submit" value="Login" class="col-4 btn btn-primary mt-3 float-right">
                    </form>
                </div>
            </div>
        </div>
        <!-- add new doctor -->
        <!-- Button trigger modal -->
        <div class="row container ml-auto mr-auto">
            <div class="col-4">
                <div class="row" style="margin-bottom:100px;">
                    <div class="col-2"><a type="button" class="cursor" data-toggle="modal" data-target="#exampleModal"><img src="{{url('imgs/1.svg')}}" width="80" /></a></div>
                    <div class="d-inline-block col-8 ml-4 mt-auto mb-auto cursor" data-toggle="modal" data-target="#exampleModal"><p class="h4 ml-3 text-primary">Add New Doctor</p></div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add new doctor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body"  style="padding-left:40px; padding-right:40px;">
                                <form action="{{route('clinic_branch_add_doctor',[$clinic->id,$branch->id])}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" name="clinic_id" value="{{$clinic->id}}">
                                    <input type="hidden" name="branch" value="{{$branch->id}}">
                                    <div class="avatar-wrapper">
                                        <img class="profile-pic" src="" name = "image"/>
                                        <div class="upload-button">
                                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                        </div>
                                        <input class="file-upload" type="file" accept="image/*" name="image">
                                    </div>
                                    <div class="form-group">
                                        <label>Doctor Name</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Degree</label>
                                        <select class="form-control" placeholder="drgree" name="degree">
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
                                    </div>
                                    <div class="form-group">
                                        <label>Medical Description</label>
                                        <textarea class="form-control" row = "4" cols="10" name="information" style="resize: none">{{old('information')}}</textarea>
                                    </div>
                                        {{--<div class="form-group">--}}
                                        {{--<label>phone Number</label>--}}
                                        {{--<input type="text" name="phoneNumber" class="form-control" value="{{old('phoneNumber')}}">--}}
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phoneNumber" class="form-control" value="{{old('phoneNumber')}}" placeholder="Phone Number" style="padding-left: 200px">
                                            <select style="position: relative;bottom: 38px;width: 25%;" name="countryCode" id="" class="form-control">
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
                                                </optgroup>
                                            </select>
                                            @error('phoneNumber')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="Password" name="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Primary Speciality</label>
                                        <select class="form-control" type="text" name="Primary_Speciality">
                                            <option value="0">Chosse ..</option>
                                            <option value="Audiologist">Audiologist</option>
                                            <option value="Audiologist">Allergist</option>
                                            <option value="Audiologist">Anesthesiologist </option>
                                            <option value="Audiologist">Andrologists </option>
                                            <option value="Audiologist">Cardiologist </option>
                                            <option value="Audiologist">Cardiovascular </option>
                                            <option value="Audiologist">Cardiovascular Surgery</option>
                                            <option value="Audiologist">Neurologist </option>
                                            <option value="Audiologist">Dentist </option>
                                            <option value="Audiologist">dermatologist </option>
                                            <option value="Audiologist">Emergency Doctors</option>
                                            <option value="Audiologist">Endocrinologist  </option>
                                            <option value="Audiologist">gynecologist  </option>
                                            <option value="Audiologist">Psychiatrist  </option>
                                            <option value="Audiologist">hematology  </option>
                                            <option value="Audiologist">Hepatologists   </option>
                                            <option value="Audiologist">Immunologist   </option>
                                            <option value="Audiologist">Internists Gastroenterology Neonatologist </option>
                                            <option value="Audiologist">Orthopdist   </option>
                                            <option value="Audiologist">Pediatrician   </option>
                                            <option value="Audiologist">Plastic Surgeon </option>
                                            <option value="Audiologist">Surgeon   </option>
                                            <option value="Audiologist">Urologist     </option>
                                            <option value="Audiologist">Rheumatologist    </option>
                                            <option value="Audiologist">Ophthalmologist    </option>
                                            <option value="Audiologist">General Practitioner </option>
                                            <option value="Audiologist">Ear , Nose and Throat </option>
                                            <option value="Audiologist">Endoscopic Surgeon </option>
                                            <option value="Audiologist">Radiologist     </option>
                                            <option value="Audiologist">Laboratory & Analytical </option>
                                            <option value="Audiologist">Pharmacist      </option>
                                            <option value="Audiologist">Oncologist     </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nationality</label>
                                        <input type="text" name="Nationality" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>National Id </label>
                                        <input type="text" name="national_id" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>National Id Front Side</label>
                                        <input type="file" name="national_id_front_side" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>National Id Back Side</label>
                                        <input type="file" name="national_id_back_side" class="form-control">
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>Branch</label>
                                        <input disabled type="text" value="{{$branch->id}}" name="branch" class="form-control">

                                    </div> --}}
                                    <input type="submit" value="Add" class="btn btn-primary">
                                </form>
                            </div>
                            {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Save changes</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- add new doctor -->

            <!-- add new Patient -->
            <!-- Button trigger modal -->
            <div class="col-4">
                <div class="row" style="margin-bottom:100px;">
                    <div class="col-2"><a type="button" class="cursor" data-toggle="modal" data-target="#exampleModal1"><img src="{{url('imgs/1.svg')}}" width="80" /></a></div>
                    <div class="d-inline-block col-8 ml-4 mt-auto mb-auto cursor" data-toggle="modal" data-target="#exampleModal1"><p class="h4 text-primary ml-3">Add New Patient</p></div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add new Patien</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding-left:40px; padding-right:40px;">
                                <!-- form -->
                                <form action = "{{route('clinic_branch_add_patient',[$clinic->id,$branch->id])}}" method="POST" id = "register" enctype="multipart/form-data" class="login-box">
                                    {{ csrf_field() }}
                                    {{-- {{dd($hosptail->id)}} --}}
                                    <input type="hidden" name = "clinic_id" value="{{$clinic->id}}">
                                    <input type="hidden" name = "branch_id" value="{{$branch->id}}">
                                    <input type="hidden" name="role">
                                    <input type="hidden" name="is_active">
                                    <input type="hidden" name="idCode">
                                    <div class="row">
                                        <div class="container col-md-12 mb-5">
                                            <div class="avatar-wrapper">
                                                <img class="profile-pic" src="" />
                                                <div class="upload-button">
                                                    <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                                </div>
                                                <input name = "image" class="file-upload" type="file" accept="image/*"/>
                                            </div>
                                            @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="col-md-4 mb-xl-3">
                                            <div class="form-group">
                                                <label class="h6 font-weight-bold">First Name <i class="fa fa-star-of-life star"></i></label>
                                                <input style="text-transform: capitalize" value = "{{old('firstName')}}" class="form-control  @error('firstName') is-invalid @enderror" type="text" name="firstName" placeholder="First Name" >

                                            </div>
                                            @error('firstName')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-xl-3">
                                            <div class="form-group">
                                                <label class="h6 font-weight-bold">Middle Name</label>
                                                <input style="text-transform: capitalize" value = "{{old('middleName')}}" class="form-control @error('middleName') is-invalid @enderror" type="text" name="middleName" placeholder="Middle Name">
                                            </div>
                                            @error('middleName')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-xl-3">
                                            <div class="form-group">
                                                <label class="h6 font-weight-bold">Last Name <i class="fa fa-star-of-life star"></i></label>
                                                <input style="text-transform: capitalize" value = "{{old('lastName')}}" class="form-control @error('lastName') is-invalid @enderror" type="text" name="lastName" placeholder="Last name">
                                                @error('lastName')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-xl-3">
                                            <div class="form-group">
                                                <label class="h6 font-weight-bold">Birth date <i class="fa fa-star-of-life star"></i></label>
                                                <input value = "{{old('BirthDate')}}" class="form-control @error('BirthDate') is-invalid @enderror" type="date" placeholder="BIRTHDATE" name="BirthDate" >
                                                @error('BirthDate')
                                                <div class="alert alert-danger">{{ $message }}</div>
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
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-xl-3">
                                            <div class="form-group">
                                                <label class="h6 font-weight-bold">Email</label>
                                                <input value = "{{old('email')}}" class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="username@example.com">
                                                @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-xl-3">
                                            <div class="form-group">
                                                <label class="h6 font-weight-bold">Phone Number <i class="fa fa-star-of-life star"></i></label>
                                                <input value = "{{old('phoneNumber')}}" name="phoneNumber" type="tel" placeholder="Phone Number" class="@error('phoneNumber') is-invalid @enderror form-control" style="padding-left: 240px">
                                                <!-- country codes (ISO 3166) and Dial codes. -->
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
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-xl-3">
                                            <div class="form-group">
                                                <label class="h6 font-weight-bold">Password <i class="fa fa-star-of-life star"></i></label>
                                                <input id = "psw"pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
                                                <div id="message">
                                                    {{-- <h3>Password must contain the following:</h3> --}}
                                                    <p id="letter" class="invalid"><span>A lowercase letter</span></p>
                                                    <p id="capital" class="invalid"><span>A capital (uppercase) letter</span></p>
                                                    {{-- <p id="number" class="invalid"><span>A number</span></p> --}}
                                                    <p id="length" class="invalid"><span>Minimum 8 characters </span></p>
                                                </div>
                                                @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-xl-3">
                                            <div class="form-group">
                                                <label class="h6 font-weight-bold">Confirm Password <i class="fa fa-star-of-life star"></i></label>
                                                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                        <!-- jop field -->
                                        <div class="col-md-6 mb-xl-3">
                                            <div class="form-group">
                                                <label class="h6 font-weight-bold">Job Title</label>
                                                <input  class="form-control @error('jop') is-invalid @enderror" type="text" name="jop" placeholder="Job Title">
                                                @error('jop')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- jop field -->
                                        <!-- race field -->
                                        <div class="col-md-6 mb-xl-3">
                                            <div class="form-group">
                                                <label class="h6 font-weight-bold">Race</label>
                                                <select class="form-control" name = "race" @error('race') is-invalid @enderror>
                                                    <option>Choose ..</option>
                                                    <option value="Arabian Gulf">Arabian Gulf</option>
                                                    <option value="Middle East">Middle East</option>
                                                    <option value="Black American">Black American</option>
                                                    <option value="Asian">Asian</option>
                                                    <option value="White">White</option>
                                                    <option value="Hawalian Or other Pacific Islander">Hawalian Or other Pacific Islander</option>
                                                    <option value="American India/Alaska Native">American India/Alaska Native</option>
                                                </select>
                                                @error('race')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- race field -->
                                        <!-- race field -->
                                        {{-- <div class="col-md-6 mb-xl-3">
                                            <div class="form-group">
                                                <label class="h6 font-weight-bold">Address</label>
                                                <input type="text" name="address" class="form-control">
                                                <span><a id = "get_location" href="#">Get Location</a></span>
                                                <div id="map" style="display: none; height: 400px; width: 500px"></div>
                                                @error('address')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> --}}
                                        <!-- race field -->
                                        <div class="col-md-12 mb-xl-3">
                                            <label class="h6 font-weight-bold" for="state">State</label>
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
                                                    <label class="h6 font-weight-bold" style="font-size: .98rem;">I have read and I understand the  <a class="text-primary" href="#">pHistroy privacy policy statement</a>, I agree on all terms and conditions.</a></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center mb-5 mt-5">
                                            <button onclick="phoneAuth();" id = "sign-in-button" type="submit"  disabled class="h4 col-9 btn btn-primary font-weight-400 mr-auto ml-auto" >Submite</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- add new Patient -->
        <!-- add new branch -->
            <!-- Button trigger modal -->
            <div class="col-4">
                <div class="row" style="margin-bottom:100px;">
                    <div class="col-2"><a type="button" class="cursor" data-toggle="modal" data-target="#exampleModal2"><img src="{{url('imgs/4.svg')}}" width="80" /></a></div>
                    <div class="d-inline-block col-8 ml-4 mt-auto mb-auto cursor" data-toggle="modal" data-target="#exampleModal2"><p class="h4 text-primary ml-3">Add Departement</p></div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabe2">Add Departement</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding-left:40px; padding-right:40px;">
                                <!-- form -->
                                <form action = "{{route('clinic_branch_doctor_departement',[$clinic->id,$branch->id])}}" method="POST" id = "register" enctype="multipart/form-data" class="login-box">
                                    {{ csrf_field() }}
                                    {{-- {{dd($hosptail->id)}} --}}
                                    {{-- <input type="hidden" name = "clinic_id" value="{{$clinic->id}}"> --}}
                                    {{-- <input type="hidden" name="role">
                                    <input type="hidden" name="is_active"> --}}
                                    <div class="row">
                                        <label class="col-12 h5 font-weight-bold mt-3 mb-4">Add Dapartment</label>
                                            <div class="col-md-4 mb-xl-3">
                                                <input type="checkbox" name="is_lab" value="1">
                                                <label class="h5 ml-3 font-weight-bold text-dark">Labs</label>
                                            </div>
                                            <div class="col-md-4 mb-xl-3">
                                                <input type="checkbox" name="is_xray" value="1">
                                                <label class="h5 ml-3 font-weight-bold text-dark">Xray</label>
                                            </div>
                                            <div class="col-md-4 mb-xl-3">
                                                <input type="checkbox" name="is_pharmacy" value="1">
                                                <label class="h5 ml-3 font-weight-bold text-dark">pharmacy</label>
                                            </div>
                                            <input type = "submit" value = "Add" class = "btn btn-primary">
                                    </div>
                                </form>
                                <!-- form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add new branch -->


        <!--Start-Footer-->
    @include('backEnd.layoutes.footer')
    <!--End-Footer-->
    </div>
</div>



@stop

@section('scripts')
    <script>
        var i_agree = document.getElementById('i_agree'),
            button_submit = document.getElementById('sign-in-button');
        i_agree.onchange = function(){
            button_submit.removeAttribute('disabled');
        }
    </script>
@stop
