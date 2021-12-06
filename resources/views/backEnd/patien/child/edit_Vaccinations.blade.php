@extends('backEnd.layoutes.mastar')
@section('title','profile ' . $child->child_name)
@section('content')
@include('backEnd.patien.slidenav')
<div class="d-flex img-pop" id="wrapper">
    <div id="page-content-wrapper">
        <!-- Topnav -->
        @include('includes.patientNav')
        <!--Start-Serv-->
        @include('includes.alerts.success')

        <form action="{{route('Vaccination.update',[$patient->id,$child->id,$Vaccination->id])}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="child_id" value="{{$child->id}}">
            <div class="row col-lg-8 ml-auto mr-auto mt-5">
                @php
                    $at_birth = $child->Vaccination->at_birth;
                @endphp
                <div class="col-lg-3 content-one ml-auto mr-auto">
                <h5 class="text-dark font-weight-bold mb-4">At Birth</h5>
                <div class="form-group form-check pl-5 mt-3">
                    <input {{is_array($at_birth) && in_array('BCG',$at_birth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="atBirth1" name="at_birth[]" value="BCG">
                    <label class="form-check-label font-weight-normal" for="atBirth1">BCG</label>
                </div>
                <div class="form-group form-check pl-5 mt-3">
                    <input {{is_array($at_birth) && in_array('Hepatitis B',$at_birth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="atBirth2" name="at_birth[]" value="Hepatitis B">
                    <label class="form-check-label font-weight-normal" for="atBirth2">Hepatitis B</label>
                </div>
                </div>
                <div class="col-lg-3 content-two ml-auto mr-auto">
                    @php
                        $twoMonth = $child->Vaccination->two_month;
                    @endphp
                <h5 class="text-dark font-weight-bold mb-4">2 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($twoMonth) && in_array('IPV',$twoMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="twoMonth1" name="twoMonth[]" value="IPV">
                        <label class="form-check-label font-weight-normal" for="twoMonth1">IPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($twoMonth) && in_array('DTPw',$twoMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="twoMonth2" name="twoMonth[]" value="DTPw">
                        <label class="form-check-label font-weight-normal" for="twoMonth2">DTPw</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($twoMonth) && in_array('Hepatitis B',$twoMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="twoMonth3" name="twoMonth[]" value="Hepatitis B">
                        <label class="form-check-label font-weight-normal" for="twoMonth3">Hepatitis B</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($twoMonth) && in_array('Hip',$twoMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="twoMonth4" name="twoMonth[]" value="Hip">
                        <label class="form-check-label font-weight-normal" for="twoMonth4">Hip</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($twoMonth) && in_array('PCV',$twoMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="twoMonth5" name="twoMonth[]" value="PCV">
                        <label class="form-check-label font-weight-normal" for="twoMonth5">PCV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($twoMonth) && in_array('Rota',$twoMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="twoMonth6" name="twoMonth[]" value="Rota">
                        <label class="form-check-label font-weight-normal" for="twoMonth6">Rota</label>
                    </div>
                </div>
                <div class="col-lg-3 content-one ml-auto mr-auto">
                    @php
                        $fourMonth = $child->Vaccination->four_month;
                    @endphp
                    <h5 class="text-dark font-weight-bold mb-4">4 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($fourMonth) && in_array('IPV',$fourMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="fourMonth1" name="fourMonth[]" value="IPV">
                        <label class="form-check-label font-weight-normal" for="fourMonth1">IPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($fourMonth) && in_array('DTPw',$fourMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="fourMonth2" name="fourMonth[]" value="DTPw">
                        <label class="form-check-label font-weight-normal" for="fourMonth2">DTPw</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($fourMonth) && in_array('Hepatitis B',$fourMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="fourMonth3" name="fourMonth[]" value="Hepatitis B">
                        <label class="form-check-label font-weight-normal" for="fourMonth3">Hepatitis B</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($fourMonth) && in_array('Hip',$fourMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="fourMonth4" name="fourMonth[]" value="Hip">
                        <label class="form-check-label font-weight-normal" for="fourMonth4">Hip</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($fourMonth) && in_array('PCV',$fourMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="fourMonth5" name="fourMonth[]" value="PCV">
                        <label class="form-check-label font-weight-normal" for="fourMonth5">PCV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($fourMonth) && in_array('Rota',$fourMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="fourMonth6" name="fourMonth[]" value="Rota">
                        <label class="form-check-label font-weight-normal" for="fourMonth6">Rota</label>
                    </div>
                </div>
                <div class="col-lg-3 content-two ml-auto mr-auto">
                    @php
                        $sixMonth =$child->Vaccination->six_month;
                    @endphp
                    <h5 class="text-dark font-weight-bold mb-4">6 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($sixMonth) && in_array('IPV',$sixMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="sixMonth1" name="sixMonth[]" value="IPV">
                        <label class="form-check-label font-weight-normal" for="sixMonth1">IPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($sixMonth) && in_array('DTPw',$sixMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="sixMonth2" name="sixMonth[]" value="DTPw">
                        <label class="form-check-label font-weight-normal" for="sixMonth2">DTPw</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($sixMonth) && in_array('Hepatitis B',$sixMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="sixMonth3" name="sixMonth[]" value="Hepatitis B">
                        <label class="form-check-label font-weight-normal" for="sixMonth3">Hepatitis B</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($sixMonth) && in_array('Hip',$sixMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="sixMonth4" name="sixMonth[]" value="Hip">
                        <label class="form-check-label font-weight-normal" for="sixMonth4">Hip</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($sixMonth) && in_array('PCV',$sixMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="sixMonth5" name="sixMonth[]" value="PCV">
                        <label class="form-check-label font-weight-normal" for="sixMonth5">PCV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($sixMonth) && in_array('OPV',$sixMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="sixMonth6" name="sixMonth[]" value="OPV">
                        <label class="form-check-label font-weight-normal" for="sixMonth6">OPV</label>
                    </div>
                </div>
                <div class="col-lg-3 content-one ml-auto mr-auto">
                    @php
                        $nineMonth = $child->Vaccination->nine_month;
                    @endphp
                    <h5 class="text-dark font-weight-bold mb-4">9 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($nineMonth) && in_array('Measles',$nineMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="nineMonth1" name="nineMonth[]" value="Measles">
                        <label class="form-check-label font-weight-normal" for="nineMonth1">Measles</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($nineMonth) && in_array('MCV4',$nineMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="nineMonth2" name="nineMonth[]" value="MCV4">
                        <label class="form-check-label font-weight-normal" for="nineMonth2">MCV4</label>
                    </div>
                </div>
                <div class="col-lg-3 content-two ml-auto mr-auto">
                    @php
                        $twelveMonth = $child->Vaccination->twelve_month;
                    @endphp
                    <h5 class="text-dark font-weight-bold mb-4">12 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($twelveMonth) && in_array('OPV',$twelveMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="twelveMonth1" name="twelveMonth[]" value="OPV">
                        <label class="form-check-label font-weight-normal" for="twelveMonth1">OPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($twelveMonth) && in_array('MMR',$twelveMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="twelveMonth2" name="twelveMonth[]" value="MMR"
                        <label class="form-check-label font-weight-normal" for="twelveMonth2">MMR</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($twelveMonth) && in_array('PCV',$twelveMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="twelveMonth3" name="twelveMonth[]" value="PCV">
                        <label class="form-check-label font-weight-normal" for="twelveMonth3">PCV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($twelveMonth) && in_array('MCV4',$twelveMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="twelveMonth4" name="twelveMonth[]" value="MCV4">
                        <label class="form-check-label font-weight-normal" for="twelveMonth4">MCV4</label>
                    </div>
                </div>
                <div class="col-lg-3 content-one ml-auto mr-auto">
                    @php
                       $eighteenMonth = $child->Vaccination->twelve_month;
                    @endphp
                    <h5 class="text-dark font-weight-bold mb-4">18 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($eighteenMonth) && in_array('OPV',$eighteenMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="eighteen_month1" name="eighteenMonth[]" value="OPV">
                        <label class="form-check-label font-weight-normal" for="eighteen_month1">OPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($eighteenMonth) && in_array('DTap',$eighteenMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="eighteen_month2" name="eighteenMonth[]" value="DTap">
                        <label class="form-check-label font-weight-normal" for="eighteen_month2">DTap</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($eighteenMonth) && in_array('Hip',$eighteenMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="eighteen_month3" name="eighteenMonth[]" value="Hip">
                        <label class="form-check-label font-weight-normal" for="eighteen_month3">Hip</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($eighteenMonth) && in_array('MMR',$eighteenMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="eighteen_month4" name="eighteenMonth[]" value="MMR">
                        <label class="form-check-label font-weight-normal" for="eighteen_month4">MMR</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($eighteenMonth) && in_array('Hepatitis A',$eighteenMonth) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="eighteen_month5" name="eighteenMonth[]" value="Hepatitis A">
                        <label class="form-check-label font-weight-normal" for="eighteen_month5">Hepatitis A</label>
                    </div>
                </div>
                <div class="col-lg-3 content-two ml-auto mr-auto">
                    @php
                       $fourtyTwo = $child->Vaccination->twenty_four_month;
                    @endphp
                    <h5 class="text-dark font-weight-bold mb-4">24 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($fourtyTwo) && in_array('Hepatitis A',$fourtyTwo) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="fourtyTwo1" name="fourtyTwo[]" value="Hepatitis A">
                        <label class="form-check-label font-weight-normal" for="fourtyTwo1">Hepatitis A</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($fourtyTwo) && in_array('OPV',$fourtyTwo) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="fourtyTwo2" name="fourtyTwo[]" value="OPV">
                        <label class="form-check-label font-weight-normal" for="fourtyTwo2">OPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($fourtyTwo) && in_array('DTap',$fourtyTwo) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="fourtyTwo3" name="fourtyTwo[]" value="DTap">
                        <label class="form-check-label font-weight-normal" for="fourtyTwo3">DTap</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($fourtyTwo) && in_array('MMR',$fourtyTwo) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="fourtyTwo4" name="fourtyTwo[]" value="MMR">
                        <label class="form-check-label font-weight-normal" for="fourtyTwo4">MMR</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input {{is_array($fourtyTwo) && in_array('Varicella',$fourtyTwo) ? 'checked' : ''}} type="checkbox" class="form-check-input" id="fourtyTwo5" name="fourtyTwo[]" value="Varicella">
                        <label class="form-check-label font-weight-normal" for="fourtyTwo5">Varicella</label>
                    </div>
                </div>
            </div>
            <div class="row mb-5 mt-5">
                <input type="submit" value="Update" class="mr-auto ml-auto col-6 btn btn-success">
            </div>

        </form>
    </div>
</div>
    <!--End-Serv-->
    @include('backEnd.layoutes.footer')
@endsection
