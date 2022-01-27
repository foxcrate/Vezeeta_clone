{{-- ///////////////////// solving conflict//////////////////// --}}

@extends('backEnd.layoutes.mastar')
@section('title','Complete profile')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.patien.slidenav')
    <div id="page-content-wrapper">
        <!-- main content -->
        @include('includes.patientNav')
        <div class="main-content" id="panel">
            <!-- Topnav -->
            <form action="{{route('update.profile',$patient->id)}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="patient_id" value="{{$patient->id}}">

                <!-- Header -->
                <div class="col-11 ml-auto mr-auto mt-5 mb-5 align-items-center coveredit">
                    <!-- Mask -->
                    <span class="mask bg-gradient-white opacity-1"></span>
                </div>
                <!-- Page content -->
                <div class="completeData container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"
                                data-interval="false">
                                <div class="carousel-indicators">
                                    <button data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                                        Personal Information
                                    </button>
                                    <button data-target="#carouselExampleIndicators" data-slide-to="1">
                                        Medical History
                                    </button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div id="personalData">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col-8">
                                                            <h3 class="mb-0">Complete Profile</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body d-flex flex-column">
                                                    <h3 class="title-sub text-uppercase text-muted mb-4">User
                                                        information
                                                    </h3>
                                                    <div class="pl-lg-4 mb-2 mt-5">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        @if( $patient->email == null &&
                                                                        $patient->job ==
                                                                        null &&
                                                                        $patient->race == null && $patient->state ==
                                                                        null &&
                                                                        $patient->address == null )
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    {{-- <img src="{{url('imgs/height.png')}}"
                                                                                    class="mr-3
                                                                                    mb-3" width="50"> --}}
                                                                                    <label
                                                                                        class="title-label ml-lg-3">Email</label>
                                                                                    <input
                                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                                        type="email" name="email"
                                                                                        placeholder="Enter Your Email">
                                                                                    @error('email')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
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
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label for="job"
                                                                                        class="title-label ml-lg-3">Job
                                                                                        Title</label>
                                                                                    <select id="job" name="job"
                                                                                        class="form-control">
                                                                                        {{-- <option hidden > Choose ..</option> --}}
                                                                                        <option value="">Job Title
                                                                                        </option>
                                                                                        <option value="Unemployed">
                                                                                            Unemployed</option>
                                                                                        <option value="Accountant">
                                                                                            Accountant</option>
                                                                                        <option value="Teacher">
                                                                                            Teacher
                                                                                        </option>
                                                                                        <option value="Student">
                                                                                            Student
                                                                                        </option>
                                                                                        <option value="Attorney">
                                                                                            Attorney
                                                                                        </option>
                                                                                        <option value="Engineer">
                                                                                            Engineer
                                                                                        </option>
                                                                                        <option
                                                                                            value="Industrial Engineer">
                                                                                            Industrial
                                                                                            Engineer</option>
                                                                                        <option
                                                                                            value="software engineer">
                                                                                            Software Engineer
                                                                                        </option>
                                                                                        <option
                                                                                            value="Structural Engineer">
                                                                                            Structural
                                                                                            Engineer</option>
                                                                                        <option value="Architect">
                                                                                            Architect
                                                                                        </option>
                                                                                        <option
                                                                                            value="computer engineer">
                                                                                            Computer Engineer
                                                                                        </option>
                                                                                        <option
                                                                                            value="Electrical Engineer">
                                                                                            Electrical
                                                                                            Engineer</option>
                                                                                        <option value="flight engineer">
                                                                                            Flight Engineer
                                                                                        </option>
                                                                                        <option
                                                                                            value="Decoration designer">
                                                                                            Decoration
                                                                                            Designer</option>
                                                                                        <option value="Doctor">
                                                                                            Doctor
                                                                                        </option>
                                                                                        <option value="nurse">Nurse
                                                                                        </option>
                                                                                        <option value="pharmacist">
                                                                                            Pharmacist</option>
                                                                                        <option
                                                                                            value="Marketing Specialist">
                                                                                            Marketing
                                                                                            Specialist</option>
                                                                                        <option value="Salesman">
                                                                                            Salesman
                                                                                        </option>
                                                                                        <option value="Secretary">
                                                                                            Secretary
                                                                                        </option>
                                                                                        <option value="Work man">
                                                                                            Work Man
                                                                                        </option>
                                                                                        <option value="Electrician">
                                                                                            Electrician</option>
                                                                                        <option value="Smith">Smith
                                                                                        </option>
                                                                                        <option value="Carpenter">
                                                                                            Carpenter
                                                                                        </option>
                                                                                        <option value="Barber">
                                                                                            Barber
                                                                                        </option>
                                                                                        <option value="Dressmaker">
                                                                                            Dressmaker</option>
                                                                                        <option value="Painter">
                                                                                            Painter
                                                                                        </option>
                                                                                        <option value="Herdsman">
                                                                                            Herdsman
                                                                                        </option>
                                                                                        <option value="Driver">
                                                                                            Driver
                                                                                        </option>
                                                                                        <option value="Barber">
                                                                                            Barber
                                                                                        </option>
                                                                                        <option value="Office boy">
                                                                                            Office
                                                                                            Boy</option>
                                                                                        <option value="Postman">
                                                                                            Postman
                                                                                        </option>
                                                                                        <option value="plumber">
                                                                                            Plumber
                                                                                        </option>
                                                                                        <option value="broker">
                                                                                            Broker
                                                                                        </option>
                                                                                        <option value="Chef">Chef
                                                                                        </option>
                                                                                        <option value="Fisher man">
                                                                                            Fisher
                                                                                            Man</option>
                                                                                        <option value="Clean Worker">
                                                                                            Clean
                                                                                            Worker</option>
                                                                                        <option value="Hairdresser">
                                                                                            Hairdresser</option>
                                                                                        <option value="Stylist">
                                                                                            Stylist
                                                                                        </option>
                                                                                        <option value="Mechanical">
                                                                                            Mechanical</option>
                                                                                        <option value="Waiter">
                                                                                            Waiter
                                                                                        </option>
                                                                                        <option
                                                                                            value="Construction Worker">
                                                                                            Construction
                                                                                            Worker</option>
                                                                                        <option value="Builder">
                                                                                            Builder
                                                                                        </option>
                                                                                        <option value="porter">
                                                                                            Porter
                                                                                        </option>
                                                                                        <option value="Servant">
                                                                                            Servant
                                                                                        </option>
                                                                                        <option value="Baker">Baker
                                                                                        </option>
                                                                                        <option value="Receptionist">
                                                                                            Receptionist</option>
                                                                                        <option
                                                                                            value="Customer service">
                                                                                            Customer service
                                                                                        </option>
                                                                                        <option value="businessman">
                                                                                            Businessman</option>
                                                                                        <option value="Other">Other
                                                                                        </option>


                                                                                    </select>
                                                                                    @error('job')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label for="race"
                                                                                        class="title-label ml-lg-3">Race</label>
                                                                                    <select class="form-control"
                                                                                        id="race" name="race"
                                                                                        @error('race') is-invalid
                                                                                        @enderror>
                                                                                        {{-- <option hidden>Choose ..</option> --}}
                                                                                        <option value="">Race
                                                                                        </option>
                                                                                        <option value="Arabian Gulf">
                                                                                            Arabian
                                                                                            Gulf</option>
                                                                                        <option value="African">
                                                                                            African
                                                                                        </option>
                                                                                        <option value="Middle East">
                                                                                            Middle
                                                                                            East</option>
                                                                                        <option value="Black American">
                                                                                            Black
                                                                                            American
                                                                                        </option>
                                                                                        <option value="Asian">Asian
                                                                                        </option>
                                                                                        <option value="White">White
                                                                                        </option>
                                                                                        <option
                                                                                            value="Hawalian Or other Pacific Islander">
                                                                                            Hawalian Or other
                                                                                            Pacific
                                                                                            Islander</option>
                                                                                        <option
                                                                                            value="American India/Alaska Native">
                                                                                            American India/Alaska
                                                                                            Native
                                                                                        </option>
                                                                                    </select>
                                                                                    @error('race')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label class="title-label ml-lg-3"
                                                                                    for="state">State</label>
                                                                                <div class="form-flex row">
                                                                                    <div class="col-3 mr-4">
                                                                                        <input type="radio" name="state"
                                                                                            value="single" id="single"
                                                                                            checked="checked" />
                                                                                        <label for="single"
                                                                                            class="ml-2">Single</label>
                                                                                    </div>
                                                                                    <div class="col-3 mr-4">
                                                                                        <input type="radio" name="state"
                                                                                            value="married"
                                                                                            id="married" />
                                                                                        <label for="married"
                                                                                            class="ml-2">Married</label>
                                                                                    </div>
                                                                                    <div class="col-3 mr-4">
                                                                                        <input type="radio" name="state"
                                                                                            value="divorce"
                                                                                            id="divorce" />
                                                                                        <label for="divorce"
                                                                                            class="ml-2">Divorced</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="h6 font-weight-bold">Address</label>
                                                                                <input type="text" id="pac-input"
                                                                                    class="form-control" name="address">
                                                                                <div id="map"
                                                                                    style="height: 300px; width: 700px;">
                                                                                </div>

                                                                                @error('address')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        @endif

                                                                        <div class="row mb-3">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <img src="{{url('imgs/height.png')}}"
                                                                                        class="mr-3 mb-3" width="50">
                                                                                    <label
                                                                                        class="title-label ml-lg-3">Height</label>
                                                                                    <input minlength="2" maxlength="3"
                                                                                        class="form-control @error('height') is-invalid @enderror"
                                                                                        type="number" name="height"
                                                                                        placeholder="Height">
                                                                                    @error('height')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <img src="{{url('imgs/Wight.png')}}"
                                                                                        class="mr-3 mb-3" width="50">
                                                                                    <label
                                                                                        class="title-label">Weight</label>
                                                                                    <input minlength="2" maxlength="3"
                                                                                        name="width" type="number"
                                                                                        class="form-control @error('width') is-invalid @enderror"
                                                                                        placeholder="Weigth" />
                                                                                    @error('width')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                    @enderror
                                                                                    <select
                                                                                        style="position:relative; bottom:38px; width:40%; left:177px;"
                                                                                        name="width_type" id=""
                                                                                        class="form-control">
                                                                                        <optgroup>
                                                                                            <option value="KG">KG
                                                                                            </option>
                                                                                            <option value="Lbs">Lbs
                                                                                            </option>
                                                                                            <option value="St">St
                                                                                            </option>
                                                                                        </optgroup>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <img src="{{url('imgs/blood.png')}}"
                                                                                        class="mr-3 mb-3" width="50">
                                                                                    <label
                                                                                        class="title-label">Blood</label>
                                                                                    <div>
                                                                                        <select
                                                                                            class="form-control  @error('blood') is-invalid @enderror"
                                                                                            name="blood">
                                                                                            <option hidden value="">
                                                                                                Blood
                                                                                            </option>
                                                                                            <option value="A+">A+
                                                                                            </option>
                                                                                            <option value="A-">A-
                                                                                            </option>
                                                                                            <option value="B+">B+
                                                                                            </option>
                                                                                            <option value="B-">B-
                                                                                            </option>
                                                                                            <option value="o+">O+
                                                                                            </option>
                                                                                            <option value="o-">O-
                                                                                            </option>
                                                                                            <option value="AB+">AB+
                                                                                            </option>
                                                                                            <option value="AB-">AB-
                                                                                            </option>
                                                                                        </select>
                                                                                        @error('blood')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="next-button">
                                                        <a data-target="#carouselExampleIndicators" data-slide-to="1" class="col-4 btn btn-success"
                                                        style="color: #fff;
                                                        text-decoration: none;
                                                        margin-left: 30%;
                                                        margin-bottom: 10px;">Next</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div id="medicalData">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h3 class="title-sub text-uppercase text-muted mb-4">Patient
                                                        History
                                                    </h3>
                                                    <div class="pl-lg-4">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <img src="{{url('imgs/01.png')}}" class="mr-3 mb-3"
                                                                        width="50">
                                                                    <label class="title-info">Check any Conditions
                                                                        you
                                                                        Currently Being Treated
                                                                        for or have had in the past: </label>
                                                                    <div class="form-flex">
                                                                        <div class="form-group row">
                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Heart disease">
                                                                                        <label class="h4">Heart
                                                                                            disease</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="High blood pressure">
                                                                                        <label class="label-input">High
                                                                                            blood pressure </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="High cholesterol">
                                                                                        <label class="label-input">High
                                                                                            cholesterol </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Lung disease">
                                                                                        <label class="label-input">Lung
                                                                                            disease</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Diabetes">
                                                                                        <label class="label-input">
                                                                                            Diabetes</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Neck pain">
                                                                                        <label class="label-input">Neck
                                                                                            pain</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Severe headaches">
                                                                                        <label
                                                                                            class="label-input">Severe
                                                                                            headaches </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Back pain">
                                                                                        <label class="label-input">Back
                                                                                            pain</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Seizures ">
                                                                                        <label
                                                                                            class="label-input">Seizures
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Thyroid disease">
                                                                                        <label
                                                                                            class="label-input">Thyroid
                                                                                            disease </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Stroke Sleep apnea">
                                                                                        <label
                                                                                            class="label-input">Stroke
                                                                                            Sleep apnea </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Stomach disease">
                                                                                        <label
                                                                                            class="label-input">Stomach
                                                                                            disease </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Kidney , bladder or prostate disease">
                                                                                        <label
                                                                                            class="label-input">Kidney
                                                                                            ,
                                                                                            bladder or prostate
                                                                                            disease </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Blood clots">
                                                                                        <label class="label-input">Blood
                                                                                            clots </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Depression">
                                                                                        <label
                                                                                            class="label-input">Depression
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->

                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Anemia or other blood disease">
                                                                                        <label
                                                                                            class="label-input">Anemia
                                                                                            or
                                                                                            other blood
                                                                                            disease</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->
                                                                            <!-- col -->
                                                                            <div class="col-sm-3">
                                                                                <div class="field">
                                                                                    <div class="ui checkbox">
                                                                                        <input name="agree_name[]"
                                                                                            type="checkbox" tabindex="0"
                                                                                            class="hidden"
                                                                                            value="Cancer ( past or present )">
                                                                                        <label
                                                                                            class="label-input">Cancer
                                                                                            (
                                                                                            past or present )
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- col -->
                                                                            <div class="col-md-6 mr-auto ml-auto mt-4">
                                                                                {{-- <div class="ui input col-12">
                                                                                                    <input class="" type="text" name="name" placeholder="Other Diseases">
                                                                                                    </div> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr />
                                                            </div>
                                                            <hr class="my-4" />
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <img src="{{url('imgs/033.png')}}" class="mr-3 mb-3"
                                                                        width="50">
                                                                    <label class="title-info">Allergies (incloud
                                                                        medication,
                                                                        food and
                                                                        environmental allergies)</label>
                                                                    <ul
                                                                        class="list-unstyled read-more-wrap field_group">
                                                                        <li>
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-3">
                                                                                    <label
                                                                                        class="title-label ml-xl-3">Allergy</label>
                                                                                    <select
                                                                                        name="allergi_data[0][allergi_name]"
                                                                                        class=" @error('allergi_data') is-invalid @enderror add-allergy form-control item_typee">
                                                                                        <option value="" hidden>
                                                                                            Allergy
                                                                                        </option>
                                                                                        <option value="Drug">Drug
                                                                                            allergy
                                                                                        </option>
                                                                                        <option value="Food">Food
                                                                                            allergy
                                                                                        </option>
                                                                                        <option value="Pet">Pet
                                                                                            allergy
                                                                                        </option>
                                                                                        <option value="Insect">
                                                                                            Insect
                                                                                            allergy</option>
                                                                                        <option value="Latex">Latex
                                                                                            allergy
                                                                                        </option>
                                                                                        <option value="Mold">Mold
                                                                                            allergy
                                                                                        </option>
                                                                                        <option value="Pollen">
                                                                                            Pollen
                                                                                            allergy</option>
                                                                                        <option value="Dust">Dust
                                                                                            allergy
                                                                                        </option>
                                                                                        <option value="Other">Other
                                                                                        </option>
                                                                                    </select>
                                                                                    @error('allergi_data')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label
                                                                                        class="title-label d-block">Severity</label>
                                                                                    <select
                                                                                        name="allergi_data[0][severity]"
                                                                                        class="add-allergy-severity form-control seleect_custom">

                                                                                        <option hidden value="">
                                                                                            Severity
                                                                                        </option>
                                                                                        <option value="High">High
                                                                                        </option>
                                                                                        <option value="Middle">
                                                                                            Middle
                                                                                        </option>
                                                                                        <option value="Low">Low
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label
                                                                                        class="title-label ml-lg-3">Reaction</label>
                                                                                    <input
                                                                                        onkeypress="return /[a-z]/i.test(event.key)"
                                                                                        class="add-reaction form-control seelect_custom"
                                                                                        type="text"
                                                                                        name="allergi_data[0][reaction]"
                                                                                        placeholder="Reaction">
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label
                                                                                        class="title-label ml-xl-3"></label>
                                                                                    <button class="btn btn-danger h5"
                                                                                        style="margin-top:37px"
                                                                                        type="button"
                                                                                        id="remove_more_fields">Delete</button>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    <button class="btn btn-success col-sm-3 h5"
                                                                        type="button" id="more_fields">Add
                                                                        Another Allergy</button>
                                                                </div>
                                                                <hr />
                                                            </div>
                                                            <hr class="my-4" />
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <img src="{{url('imgs/dissection.png')}}"
                                                                        class="mr-3 mb-3" width="50">
                                                                    <label class="title-info">Surgeries</label>
                                                                    <ul
                                                                        class="list-unstyled read-more-wrap ml-auto mr-auto field_group1">
                                                                        <li>
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-5">
                                                                                    <label
                                                                                        class="title-label">Surgery</label>
                                                                                    <select
                                                                                        name="surgery_data[0][surgery_name]"
                                                                                        class="@error('surgery_data') is-invalid @enderror add-surgery form-control item_surgeries">
                                                                                        <option value="" hidden>
                                                                                            Surgery
                                                                                        </option>
                                                                                        <option value="Hernia">
                                                                                            Hernia
                                                                                            Surgery</option>
                                                                                        <option value="Hemorrhoid">
                                                                                            Hemorrhoid Surgery
                                                                                        </option>
                                                                                        <option value="Eye">Eye
                                                                                            surgery
                                                                                        </option>
                                                                                        <option value="Gallbladder">
                                                                                            Gallbladder Surgery
                                                                                        </option>
                                                                                        <option value="Appendix">
                                                                                            Appendix
                                                                                            Surgery</option>
                                                                                        <option value="Cardiovascular">
                                                                                            Cardiovascular Surgery
                                                                                        </option>
                                                                                        <option value="Tonsil">
                                                                                            Tonsil
                                                                                            Surgery</option>
                                                                                        <option value="Liver">Liver
                                                                                            Surgery
                                                                                        </option>
                                                                                        <option value="Cancer">
                                                                                            Cancer and
                                                                                            Oncology Surgery
                                                                                        </option>
                                                                                        <option value="Kidney">
                                                                                            Kidney
                                                                                            Surgery</option>
                                                                                        <option value="Brain">Brain
                                                                                            Surgery
                                                                                        </option>
                                                                                        <option
                                                                                            value="Gastrointestinal">
                                                                                            Gastrointestinal
                                                                                            Surgery</option>
                                                                                        <option value="Reproductive">
                                                                                            Reproductive system
                                                                                            Surgery
                                                                                        </option>
                                                                                        <option value="Nervous">
                                                                                            Nervous
                                                                                            system Surgery</option>
                                                                                        <option value="Respiratory">
                                                                                            Respiratory Surgery
                                                                                        </option>
                                                                                        <option value="Muscle">
                                                                                            Muscle system
                                                                                            Surgery</option>
                                                                                        <option value="Orthopaedic">
                                                                                            Orthopaedic Surgery
                                                                                        </option>
                                                                                        <option value="Ear">Ear,
                                                                                            nose and
                                                                                            throat Surgery
                                                                                        </option>
                                                                                        <option value="Other">Other
                                                                                        </option>
                                                                                    </select>
                                                                                    @error('surgery_data')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label
                                                                                        class="title-label">Date</label>
                                                                                    <input
                                                                                        class="add-surgery-date form-control seleect_surgeries"
                                                                                        type="date"
                                                                                        name="surgery_data[0][surgery_date]"
                                                                                        placeholder="">

                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <label
                                                                                        class="title-label ml-xl-3"></label>
                                                                                    <button class="btn btn-danger h5"
                                                                                        style="margin-top:40px"
                                                                                        type="button"
                                                                                        id="remove_more_surgeries">Delete</button>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    <button class="btn btn-success col-sm-3 h5"
                                                                        type="button" id="more_surgeries">Add Another
                                                                        Surgery</button>
                                                                </div>
                                                                <hr />
                                                            </div>
                                                            <hr class="my-4" />
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <img src="{{url('imgs/02.png')}}" class="mr-3 mb-3"
                                                                        width="50">
                                                                    <label class="title-info">Current
                                                                        Medication</label>
                                                                    <ul
                                                                        class=" list-unstyled read-more-wrap field_group2">
                                                                        <li>
                                                                            <div class="row">
                                                                                <div class="col-md-3 mb-3">
                                                                                    <input list="brow"
                                                                                        class="add-medication form-control item_medication"
                                                                                        name="medication_name[0][name]"
                                                                                        placeholder="Medication">
                                                                                    <datalist id="brow">
                                                                                        <option hidden>Choose
                                                                                        </option>
                                                                                        @foreach(\App\models\Medication2::get()
                                                                                        as $m)
                                                                                        <option value="{{ $m->name }}">
                                                                                            {{ $m->name }}</option>
                                                                                        @endforeach
                                                                                    </datalist>
                                                                                </div>

                                                                                <div class="col-md-3 mb-3">
                                                                                    <select
                                                                                        name="medication_name[0][times_day]"
                                                                                        class="@error('medication_name') is-invalid @enderror col-12 medication-day custom-select required seleect_medication"
                                                                                        id="inputGroupSelect01">
                                                                                        <option value="" hidden>
                                                                                            Times Day
                                                                                        </option>
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                        <option value="If necessity">If
                                                                                            necessity</option>
                                                                                    </select>
                                                                                    @error('medication_name')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="col-md-3 mb-3">
                                                                                    <select
                                                                                        name="medication_name[0][time]"
                                                                                        class="medication-time col-12 custom-select required select_medication"
                                                                                        id="inputGroupSelect01">
                                                                                        <option value="" hidden>Time
                                                                                        </option>
                                                                                        <option value="Before Eating">
                                                                                            Before
                                                                                            Eating</option>
                                                                                        <option value="After Eating">
                                                                                            After
                                                                                            Eating</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label
                                                                                        class="title-label ml-xl-3"></label>
                                                                                    <button class="btn btn-danger h5"
                                                                                        type="button"
                                                                                        id="remove_more_medication">Delete</button>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    <button class="btn btn-success col-sm-3 h5"
                                                                        type="button" id="more_medication">Add Another
                                                                        Medication</button>
                                                                </div>
                                                                <hr />
                                                            </div>
                                                            <div class="row col-md-12 mt-lg-3 mb-2">
                                                                <div class="col-lg-12">
                                                                    <img src="{{url('imgs/prescription.svg')}}"
                                                                        class="mr-3 mb-3" width="50">
                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="col-lg-12 title-info mb-auto">Adding
                                                                            Prescription</label>
                                                                        <input type="file" name="rocata_file[]"
                                                                            id="file"
                                                                            class="input-file @error('medication_name') is-invalid @enderror"
                                                                            multiple>
                                                                        <label for="file"
                                                                            class="btn btn-tertiary js-labelFile">
                                                                            <i class="icon fa fa-check"></i>
                                                                            <span class="js-fileName">Choose a
                                                                                File</span>
                                                                        </label>
                                                                        @error('rocata_file')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="col-lg-12 title-info mb-auto">Adding
                                                                            Rays</label>
                                                                        <input type="file" name="rays_file[]" id="fileE"
                                                                            class="input-file @error('rays_file') is-invalid @enderror"
                                                                            multiple>
                                                                        <label for="fileE"
                                                                            class="btn btn-tertiary js-labelFile">
                                                                            <i class="icon fa fa-check"></i>
                                                                            <span class="js-fileName">Choose a
                                                                                File</span>
                                                                        </label>
                                                                        @error('rays_file')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="col-lg-12 title-info mb-auto">Adding
                                                                            Test</label>
                                                                        <input type="file" name="analzes_file[]"
                                                                            id="fileS"
                                                                            class="input-file @error('analzes_file') is-invalid @enderror"
                                                                            multiple>
                                                                        <label for="fileS"
                                                                            class="btn btn-tertiary js-labelFile">
                                                                            <i class="icon fa fa-check"></i>
                                                                            <span class="js-fileName">Choose a
                                                                                File</span>
                                                                        </label>
                                                                        @error('analzes_file')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mt-2">
                                                                <hr class="my-4 mt-2" />
                                                                <img src="{{url('imgs/055.png')}}" class="mr-3 mb-3"
                                                                    width="50">
                                                                <label class="title-info">Preventative
                                                                    Screening</label>
                                                                <div id="myRadioGroup">
                                                                    <div class="row">
                                                                        <label class="col-5 ml-4 mb-3 title-label">Have
                                                                            you had a
                                                                            colonscopy</label>
                                                                        <div class="col-4">
                                                                            <input class="ui radio checkbox"
                                                                                type="radio" name="colonscopy"
                                                                                value="1" />&nbsp; <label
                                                                                class="font-weight-600">Yes</label>
                                                                            &nbsp;&nbsp;
                                                                            <input class="ui radio checkbox"
                                                                                type="radio" name="colonscopy"
                                                                                value="2" /> &nbsp; <label
                                                                                class="font-weight-600">No</label>
                                                                        </div>
                                                                        <div id="types1" class="desc col-lg-8 ml-3 mb-3"
                                                                            style="display: none;">
                                                                            <input class="form-control" type="date"
                                                                                name="colonscopy_data">
                                                                        </div>
                                                                        <div id="types2" class="desc"
                                                                            style="display: none;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="myRadioGroup">
                                                                    <div class="row">
                                                                        <label
                                                                            class="h5 col-5 ml-4 mb-3 title-label">Have
                                                                            you had a
                                                                            Mammogram</label>
                                                                        <div class="col-4">
                                                                            <input class="ui radio checkbox"
                                                                                type="radio" name="mammogram"
                                                                                value="3" />&nbsp; <label
                                                                                class="font-weight-600">Yes</label>
                                                                            &nbsp;&nbsp;
                                                                            <input class="ui radio checkbox"
                                                                                type="radio" name="mammogram"
                                                                                value="4" />&nbsp;&nbsp; <label
                                                                                class="font-weight-600">No</label>
                                                                        </div>
                                                                        <div id="type3" class="des col-lg-8 ml-3 mb-3"
                                                                            style="display: none;">
                                                                            <input class="form-control" type="date"
                                                                                name="mammogram_data">
                                                                        </div>
                                                                        <div id="type4" class="des"
                                                                            style="display: none;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr class="my-4 mt-5 mb-5" />
                                                            </div>
                                                            <!-- unhealty -->
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <img src="{{url('imgs/06.png')}}" class="mr-3 mb-3"
                                                                        width="50">
                                                                    <label class="title-info">Unhealthy
                                                                        Habits</label>
                                                                    <ul
                                                                        class="list-unstyled read-more-wrap ml-auto mr-auto field_groupUn">
                                                                        <li>
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-5">
                                                                                    <label class="title-label">Unhealthy
                                                                                        Habits</label>
                                                                                    <select name="smoking[0][name]"
                                                                                        class="add-habit item_smoking form-control">
                                                                                        <option value="" hidden>Name
                                                                                        </option>
                                                                                        <option value="alcohol">
                                                                                            Alcohol
                                                                                        </option>
                                                                                        <option value="cigarette">
                                                                                            Cigarette
                                                                                        </option>
                                                                                        <option value="drug">Drug
                                                                                        </option>
                                                                                    </select>
                                                                                    @error('smoking')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label
                                                                                        class="title-label">Severity</label>
                                                                                    <select name="smoking[0][severity]"
                                                                                        class="add-habit-severity item_smoking_severity form-control">
                                                                                        <option value="" hidden>
                                                                                            Severity
                                                                                        </option>
                                                                                        <option value="high">High
                                                                                        </option>
                                                                                        <option value="middle">
                                                                                            Middle
                                                                                        </option>
                                                                                        <option value="low">Low
                                                                                        </option>
                                                                                    </select>
                                                                                    @error('smoking')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <label
                                                                                        class="title-label ml-xl-3"></label>
                                                                                    <button class="btn btn-danger h5"
                                                                                        style="margin-top:40px"
                                                                                        type="button"
                                                                                        id="remove_more_smoking">Delete</button>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    <button class="btn btn-success col-sm-3 h5"
                                                                        type="button" id="more_smoking">Add
                                                                        Another Habit</button>
                                                                </div>
                                                                <hr />
                                                            </div>
                                                            <!-- unhealty -->

                                                            <div class="col-12 mt-5">
                                                                <!-- Family History -->
                                                                <h3 class="title-sub text-uppercase text-muted mb-4">
                                                                    Family
                                                                    History</h3>
                                                                <div class="pl-lg-4">
                                                                    <h4
                                                                        class="text-primary ml-5 mt-3 mb-5 font-weight-bold">
                                                                        Family Diseases
                                                                    </h4>
                                                                    <div class="col-12">
                                                                        <div class="nav flex-row family-one nav-pills row ml-auto mr-auto decor-none"
                                                                            id="v-pills-tab" role="tablist"
                                                                            aria-orientation="horizontal">
                                                                            <a class="col-lg-3 col-md-2 col-4 nav-item nav-links active"
                                                                                id="v-pills-5-tab" data-toggle="pill"
                                                                                href="#v-pills-5" role="tab"
                                                                                aria-controls="v-pills-5"
                                                                                aria-selected="true">
                                                                                <div class="text-center">
                                                                                    <img src="{{url('imgs/mother.png')}}"
                                                                                        width="100">
                                                                                    <h4 class="text-pills m-auto"
                                                                                        style="font-size:12pt;padding-top:15px;">
                                                                                        Mother</h4>
                                                                                </div>
                                                                            </a>
                                                                            <a class="col-lg-3 col-md-2 col-4 nav-item nav-links"
                                                                                id="v-pills-6-tab" data-toggle="pill"
                                                                                href="#v-pills-6" role="tab"
                                                                                aria-controls="v-pills-6"
                                                                                aria-selected="true">
                                                                                <div class="text-center">
                                                                                    <img src="{{url('imgs/father.png')}}"
                                                                                        width="100">
                                                                                    <h4 class="text-pills m-auto"
                                                                                        style="font-size: 12pt;padding-top:15px;">
                                                                                        Father</h4>
                                                                                </div>
                                                                            </a>

                                                                        </div>
                                                                        <div
                                                                            class="col-md-12 p-4 align-items-center js-fullheight animated">
                                                                            <div class="tab-content tab-family-1 mr-auto ml-auto"
                                                                                id="v-pills-tabContent">
                                                                                <div class="tab-pane animated bounce slow py-0 show active"
                                                                                    id="v-pills-5" role="tabpanel"
                                                                                    aria-labelledby="v-pills-5-tab">
                                                                                    <div class="row mb-5 mt-3 ">
                                                                                        <div
                                                                                            class="col-lg-9 mb-3 mr-auto ml-auto">
                                                                                            <div class="ui form col-12">
                                                                                                <div
                                                                                                    class="inline field">
                                                                                                    <label
                                                                                                        class="h6 font-weight-bold"
                                                                                                        style="font-size: 14pt; margin-bottom:20px;">Mother
                                                                                                        Diseases</label>
                                                                                                    <select
                                                                                                        name="mother[]"
                                                                                                        multiple="multiple"
                                                                                                        class="label ui large selection fluid dropdown">
                                                                                                        <option
                                                                                                            value="high-Blood-Pressure">
                                                                                                            High
                                                                                                            Blood
                                                                                                            Pressure
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="diabetes">
                                                                                                            Diabetes
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="cancer">
                                                                                                            Cancer
                                                                                                            (Past or
                                                                                                            Present)
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        {{-- <div class="col-lg-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                                                <div class="ui input col-12">
                                                                                                                    <input name="other_mother" type="text" placeholder="Other Diseases">
                                                                                                                </div>
                                                                                                            </div> --}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="tab-pane animated bounce slow py-0 show"
                                                                                    id="v-pills-6" role="tabpanel"
                                                                                    aria-labelledby="v-pills-6-tab">
                                                                                    <div class="row mb-5 mt-3">
                                                                                        <div
                                                                                            class="col-lg-9 mb-3 mr-auto ml-auto">
                                                                                            <div class="ui form col-12">
                                                                                                <div
                                                                                                    class="inline field">
                                                                                                    <label
                                                                                                        class="h6 font-weight-bold"
                                                                                                        style="font-size: 14pt; margin-bottom:20px;">Father
                                                                                                        Diseases</label>
                                                                                                    <select
                                                                                                        name="father[]"
                                                                                                        multiple="multiple"
                                                                                                        class="label ui large selection fluid dropdown">
                                                                                                        <option
                                                                                                            value="high-Blood-Pressure">
                                                                                                            High
                                                                                                            Blood
                                                                                                            Pressure
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="diabetes">
                                                                                                            Diabetes
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="cancer">
                                                                                                            Cancer
                                                                                                            (Past or
                                                                                                            Present)
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <!-- female -->
                                                                @if(auth()->guard('patien')->user()->gender ==
                                                                'female' &&
                                                                auth()->guard('patien')->user()->state == 'single')
                                                                <h4 class="text-pink ml-5 mt-3 mb-4 font-weight-bold">
                                                                    Female
                                                                    Single</h4>
                                                                <div
                                                                    class="row tab-Female col-10 mr-auto ml-auto mb-3 mt-3">
                                                                    <div class="p-3 col-lg-9 mb-2 mt-3 mr-auto ml-auto">
                                                                        <label class="mr-7 col-lg-6 title-label">Have
                                                                            you a
                                                                            Normal Period Cycle
                                                                        </label>
                                                                        <input class="ui radio checkbox col-1"
                                                                            type="radio" name="single_Period_Cycle"
                                                                            value="Yes" /><label
                                                                            class="font-weight-600">Yes</label>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input class="ui radio checkbox col-1 ml-4"
                                                                            type="radio" name="single_Period_Cycle"
                                                                            value="No" /> <label
                                                                            class="font-weight-600">No</label>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(auth()->guard('patien')->user()->gender ==
                                                                'female' &&
                                                                auth()->guard('patien')->user()->state == 'married'
                                                                ||
                                                                auth()->guard('patien')->user()->state == 'divorce')
                                                                <div class="col-12 ml-auto mr-auto">
                                                                    <div class="nav flex-row nav-pills female row offset-lg-1 col-12"
                                                                        id="v-pills-tab" role="tablist"
                                                                        aria-orientation="horizontal">
                                                                        <a class="col-md-4 p-2 mr-1 active"
                                                                            id="v-pills-01-tab" data-toggle="pill"
                                                                            href="#v-pills-01" role="tab"
                                                                            aria-controls="v-pills-01"
                                                                            aria-selected="true">
                                                                            <div class="text-center">
                                                                                <div><img
                                                                                        src="{{url('imgs/mother.png')}}"
                                                                                        width="120"></div>
                                                                                <div>
                                                                                    <h4 class="text-pills mt-3">Wife
                                                                                    </h4>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <a class="col-md-4 p-2 mr-1" id="v-pills-02-tab"
                                                                            data-toggle="pill" href="#v-pills-02"
                                                                            role="tab" aria-controls="v-pills-02"
                                                                            aria-selected="true">
                                                                            <div class="text-center">
                                                                                <div><img
                                                                                        src="{{url('imgs/femalmother.png')}}"
                                                                                        width="120">
                                                                                </div>
                                                                                <div>
                                                                                    <h4 class="text-pills mt-3">
                                                                                        Mother</h4>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <div
                                                                        class="col-md-12 p-4 align-items-center js-fullheight animated">
                                                                        <div class="tab-content mr-auto ml-auto"
                                                                            id="v-pills-tabContent">
                                                                            <div class="tab-pane animated bounce slow py-0 show active"
                                                                                id="v-pills-01" role="tabpanel"
                                                                                aria-labelledby="v-pills-01-tab">
                                                                                <h5 class="text-pink ml-5 mt-3">
                                                                                    Female Wife
                                                                                </h5>
                                                                                <div class="row mb-3 mt-3">
                                                                                    <div
                                                                                        class="col-lg-9 mb-3 mr-auto ml-auto">
                                                                                        <label
                                                                                            class="mr-7 col-6 title-label">Have
                                                                                            you a Normal
                                                                                            Period Cycle </label>
                                                                                        <input
                                                                                            class="ui radio checkbox col-1"
                                                                                            type="radio"
                                                                                            name="Period_Cycle"
                                                                                            value="Yes" /><label
                                                                                            class="font-weight-600">Yes</label>
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        <input
                                                                                            class="ui radio checkbox col-1 ml-4"
                                                                                            type="radio"
                                                                                            name="Period_Cycle"
                                                                                            value="No" /> <label
                                                                                            class="font-weight-600">No</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-lg-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                        <label
                                                                                            class="mr-7 col-6 title-label">Abotion</label>
                                                                                        <input
                                                                                            class="ui radio checkbox col-1"
                                                                                            type="radio" name="Abotion"
                                                                                            value="yes" /><label
                                                                                            class="font-weight-600">Yes</label>
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        <input
                                                                                            class="ui radio checkbox col-1 ml-4"
                                                                                            type="radio" name="Abotion"
                                                                                            value="no" /><label
                                                                                            class="font-weight-600">No</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-lg-9 col-md-4 mb-3 mr-auto ml-auto ">
                                                                                        <label
                                                                                            class="title-label col-6">Contraceptive</label>
                                                                                        <select name="Contraceptive"
                                                                                            class="ui selection dropdown col-4">
                                                                                            <option hidden value="">
                                                                                                Severity
                                                                                            </option>
                                                                                            <option value="Pill">
                                                                                                Pill
                                                                                            </option>
                                                                                            <option value="Implant">
                                                                                                Implant
                                                                                            </option>
                                                                                            <option
                                                                                                value="Intrauterine">
                                                                                                Intrauterine Device
                                                                                            </option>
                                                                                            <option value="Injection">
                                                                                                Injection</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- female mother -->
                                                                            <div class="tab-pane animated bounce slow py-0 show"
                                                                                id="v-pills-02" role="tabpanel"
                                                                                aria-labelledby="v-pills-02-tab">
                                                                                <h5 class="text-pink ml-5 mt-3">
                                                                                    Female
                                                                                    Mother</h5>
                                                                                <div class="row mb-3 mt-3">
                                                                                    <div
                                                                                        class="col-lg-9 mb-3 mr-auto ml-auto">
                                                                                        <label
                                                                                            class="mr-7 col-6 title-label">Have
                                                                                            you a Normal
                                                                                            Period Cycle </label>
                                                                                        <input
                                                                                            class="ui radio checkbox col-1"
                                                                                            type="radio"
                                                                                            name="Period_Cycle"
                                                                                            value="yes" /><label
                                                                                            class="font-weight-600">Yes</label>
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        <input
                                                                                            class="ui radio checkbox col-1 ml-4"
                                                                                            type="radio"
                                                                                            name="Period_Cycle"
                                                                                            value="no" /> <label
                                                                                            class="font-weight-600">No</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-lg-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                        <label
                                                                                            class="mr-7 col-6 title-label">Pregnency</label>
                                                                                        <input
                                                                                            class="ui radio checkbox col-1"
                                                                                            type="radio"
                                                                                            name="pregnency"
                                                                                            value="yes" /><label
                                                                                            class="font-weight-600">Yes</label>
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        <input
                                                                                            class="ui radio checkbox col-1 ml-4"
                                                                                            type="radio"
                                                                                            name="pregnency"
                                                                                            value="no" /><label
                                                                                            class="font-weight-600">No</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-lg-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                        <label
                                                                                            class="mr-7 col-6 title-label">Abotion</label>
                                                                                        <input
                                                                                            class="ui radio checkbox col-1"
                                                                                            type="radio" name="abotion"
                                                                                            value="yes" /><label
                                                                                            class="font-weight-600">Yes</label>
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        <input
                                                                                            class="ui radio checkbox col-1 ml-4"
                                                                                            type="radio" name="abotion"
                                                                                            value="no" /><label
                                                                                            class="font-weight-600">No</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-lg-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                        <label
                                                                                            class="mr-7 col-6 title-label">Types
                                                                                            of
                                                                                            Deliveries </label>
                                                                                        <input
                                                                                            class="ui radio checkbox col-1"
                                                                                            type="radio"
                                                                                            name="deliveries"
                                                                                            value="normal" /><label
                                                                                            class="font-weight-600">Normal</label>
                                                                                        <input
                                                                                            class="ui radio checkbox col-1 ml-3"
                                                                                            type="radio"
                                                                                            name="deliveries"
                                                                                            value="c.s" /><label
                                                                                            class="font-weight-600">C.S</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-lg-9 col-md-4 mb-3 mr-auto ml-auto">
                                                                                        <label
                                                                                            class="mr-7 col-6 title-label">Complicetion
                                                                                            in
                                                                                            Deliveries </label>
                                                                                        <input
                                                                                            class="ui radio checkbox col-1"
                                                                                            type="radio"
                                                                                            name="complicetion"
                                                                                            value="yes" /><label
                                                                                            class="font-weight-600">Yes</label>
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        <input
                                                                                            class="ui radio checkbox col-1 ml-4"
                                                                                            type="radio"
                                                                                            name="complicetion"
                                                                                            value="no" /><label
                                                                                            class="font-weight-600">No</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-lg-9 col-md-4 mb-3 mr-auto ml-auto ">
                                                                                        <label
                                                                                            class="title-label col-6">Contraceptive</label>
                                                                                        <select name="Contraceptive"
                                                                                            class="ui selection dropdown col-4">
                                                                                            <option hidden> Severity
                                                                                            </option>
                                                                                            <option value="Pill">
                                                                                                Pill
                                                                                            </option>
                                                                                            <option value="Implant">
                                                                                                Implant
                                                                                            </option>
                                                                                            <option
                                                                                                value="Intrauterine">
                                                                                                Intrauterine Device
                                                                                            </option>
                                                                                            <option value="Injection">
                                                                                                Injection</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- female -->
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-12 text-center mb-3 mt-5 d-flex justify-content-between">
                                                                <input type="button" value="Previous" data-target="#carouselExampleIndicators" data-slide-to="0" class="col-5 btn btn-primary">
                                                                <input type="submit" value="Submit"
                                                                    class="col-5 btn btn-success">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-4 card-container">
                            <div class="card card-profile">
                                <img src="{{url('/imgs/BgLogin.jpg')}}" height="150" alt="Image placeholder"
                                    class="card-img-top">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 order-lg-2">
                                        <div class="card-profile-image">
                                            <a href="#">
                                                @if(!$patient->image)
                                                <img src="{{ asset('uploads/default.png') }}" class="rounded-circle">
                                                @else
                                                <img src="{{$patient->image}}" class="rounded-circle">
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                                    <div class="d-flex justify-content-between">
                                        {{--  <a href="{{route('edit.data.profile',$patient->id)}}"
                                        class="float-lg-left"><i class="fas fa-edit mr-1"></i>Edit</a> --}}
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <P class="h5 font-weight-700 text-center mt-4 text-capitalize">
                                        {{$patient->firstName . ' ' . $patient->middleName}}</P>
                                    <h5 class="h5 font-weight-700 mb-5 text-center">{{$patient->idCode}}
                                    </h5>
                                    <div class="pl-3 pr-3 mt-3">
                                        <div class="row h5 mt-3 text-capitalize">
                                            <i class="fas fa-male mr-4 ml-1 text-primary"></i>
                                            <div class="col-10">{{$patient->gender}}</div>
                                        </div>
                                        <div class="row h5 mt-3">
                                            <i class="fa fa-calendar-check mr-3 text-primary" aria-hidden="true"></i>
                                            <div class="col-10"> {{$patient->age}} Age</div>
                                        </div>
                                        <div class="row h5 mt-3">
                                            <i class="fas fa-location-arrow mr-3 text-primary"></i>
                                            <div class="col-10">{{$patient->address}}</div>
                                        </div>
                                        <div class="row h5 mt-3 text-capitalize">
                                            <i class="fas fa-mail-bulk mr-3 text-primary"></i>
                                            <div class="col-10">{{$patient->email}}</div>
                                        </div>
                                        <div class="row h5 mt-3 mb-5">
                                            <i class="fa fa-phone mr-3 text-primary" aria-hidden="true"></i>
                                            <div class="col-10">{{$patient->phoneNumber}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
        <!-- footer -->
        @include('backEnd.layoutes.footer')
    </div>

    <script>
        @include("includes.GoogleMap")
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&callback=initAutocomplete&libraries=places&v=weekly"
        defer></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        (function () {
            'use strict';
            $('.input-file').each(function () {
                var $input = $(this),
                    $label = $input.next('.js-labelFile'),
                    labelVal = $label.html();

                $input.on('change', function (element) {
                    var fileName = '';
                    if (element.target.value) fileName = element.target.value.split('\\')
                        .pop();
                    fileName ? $label.addClass('has-file').find('.js-fileName').html(
                        fileName) : $label.removeClass('has-file').html(labelVal);
                });
            });

        })();
    </script>
    <script>
        $(document).ready(function () {
            //Disabled Allergy Button

            $('#more_fields').attr('disabled', 'disabled');
            $(".add-reaction, .add-allergy-severity, .add-allergy").change(function () {
                var isAllergyFormValid =
                    $(".add-allergy").val().length > 0 &&
                    $(".add-allergy-severity").val().length > 0 &&
                    $(".add-reaction").val().length > 0;

                if (isAllergyFormValid) {
                    $('#more_fields').removeAttr("disabled");
                } else {
                    $('#more_fields').attr('disabled', 'disabled');
                }
            });

            //Clone Allergy Field

            $('#more_fields').click(function (e) {
                var max = 9;
                var current1 = $(".field_group").length;
                if (current1 < max) {
                    $('.field_group:first').clone(true).hide().insertAfter('.field_group:last')
                        .slideDown('slow');
                    var last = $('.field_group:last');
                    var current = $(".field_group").length -1;
                    last.find('select').val([]);
                    last.find('select.item_typee').attr("name", "allergi_data[" + current +
                        "][allergi_name]").val('');
                    last.find('select.seleect_custom').attr("name", "allergi_data[" + current +
                        "][severity]").val('');
                    last.find('input.seelect_custom').attr("name", "allergi_data[" + current +
                        "][reaction]").val('');
                    current1++;
                    return false;
                }

            });

            //Remove Allergy Field

            $("body").on("click", "#remove_more_fields", function (e) {
                var current = $(".field_group").length;
                if (current == 1) {
                    e.prevent();
                }
                $(this).closest(".field_group").remove();
            });

            //Disabled Surgery Button

            $('#more_surgeries').attr('disabled', 'disabled');
            $(".add-surgery, .add-surgery-date").change(function () {
                var isSurgeryFormValid =
                    $(".add-surgery").val().length > 0 &&
                    $(".add-surgery-date").val().length > 0;

                if (isSurgeryFormValid) {
                    $('#more_surgeries').removeAttr("disabled");
                } else {
                    $('#more_surgeries').attr('disabled', 'disabled');
                }
            });

            //Clone Surgery Field

            $('#more_surgeries').click(function () {
                var max = 18;
                var current1 = $(".field_group1").length;
                if (current1 < max) {
                    $('.field_group1:first').clone(true).hide().insertAfter(
                        '.field_group1:last').slideDown('slow');
                    var last = $('.field_group1:last');
                    var current = $(".field_group1").length - 1;
                    last.find('select').val([]);
                    last.find('select.item_surgeries').attr("name", "surgery_data[" + current +
                        "][surgery_name]").val('');
                    last.find('input.seleect_surgeries').attr("name", "surgery_data[" +
                        current + "][surgery_date]").val('');
                    current1++;
                    return false;
                }
            });

            //Remove Surgery Field

            $("body").on("click", "#remove_more_surgeries", function () {
                var current = $(".field_group1").length;
                if (current == 1) {
                    e.prevent();
                }
                $(this).closest(".field_group1").remove();
            });

            //Disabled Medication Button

            $('#more_medication').attr('disabled', 'disabled');
            $(".add-medication, .medication-day, .medication-time").change(function () {
                var isMedicationFormValid =
                    $(".add-medication").val().length > 0 &&
                    $(".medication-day").val().length > 0 &&
                    $(".medication-time").val().length > 0;

                if (isMedicationFormValid) {
                    $('#more_medication').removeAttr("disabled");
                } else {
                    $('#more_medication').attr('disabled', 'disabled');
                }
            });

            //Clone Medication Field

            $('#more_medication').click(function () {
                var max = 10;
                var current1 = $(".field_group2").length;
                if (current1 < max) {
                    $('.field_group2:first').clone(true).hide().insertAfter(
                        '.field_group2:last').slideDown('slow');
                    var last = $('.field_group2:last');
                    var current = $(".field_group2").length - 1;
                    last.find('select').val([]);
                    last.find('input.item_medication').attr("name", "medication_name[" +
                        current + "][name]").val('');
                    last.find('select.seleect_medication').attr("name", "medication_name[" +
                        current + "][times_day]").val('');
                    last.find('select.select_medication').attr("name", "medication_name[" +
                        current + "][time]").val('');
                    current1++;
                    return false;
                }
            });

            //Remove Medication Field
            $("body").on("click", "#remove_more_medication", function () {
                var current = $(".field_group2").length;
                if (current == 1) {
                    e.prevent();
                }
                $(this).closest(".field_group2").remove();
            });

            //Disabled Unhealthy Habits Button

            $('#more_smoking').attr('disabled', 'disabled');
            $(".add-habit, .add-habit-severity").change(function () {
                var isHabitFormValid =
                    $(".add-habit").val().length > 0 &&
                    $(".add-habit-severity").val().length > 0;

                if (isHabitFormValid) {
                    $('#more_smoking').removeAttr("disabled");
                } else {
                    $('#more_smoking').attr('disabled', 'disabled');
                }
            });

            //Clone Unhealthy Habits Field

            $('#more_smoking').click(function () {
                var max = 3;
                var current1 = $(".field_groupUn").length;
                if (current1 < max) {
                    $('.field_groupUn:first').clone(true).hide().insertAfter(
                        '.field_groupUn:last').slideDown('slow');
                    var last = $('.field_groupUn:last');
                    var current = $(".field_groupUn").length - 1;
                    last.find('select').val([]);
                    last.find('select.item_smoking').attr("name", "smoking[" + current +
                        "][name]").val('');
                    last.find('select.item_smoking_severity').attr("name", "smoking[" +
                        current + "][severity]").val('');
                    current1++;
                    return false;
                }
            });

            //Remove Unhealthy Habits Field

            $("body").on("click", "#remove_more_smoking", function () {
                var current = $(".field_groupUn").length;
                if (current == 1) {
                    e.prevent();
                }
                $(this).closest(".field_groupUn").remove();
            });
        });
    </script>
    <script>
        $('.carousel').carousel({
            interval: false,
        });
    </script>

</div>



@stop
