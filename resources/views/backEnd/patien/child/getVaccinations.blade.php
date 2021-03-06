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
        <form action="{{route('Vaccination.store',[$patient->id,$child->id])}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="child_id" value="{{$child->id}}">
            <div class="row col-lg-10 ml-auto mr-auto mt-5">
                <div class="col-lg-2 content-one ml-auto mr-auto">
                    <h5 class="title-one text-primary font-weight-bold mb-4">At Birth</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="atBirth1" name="at_birth[]" value="BCG">
                        <label class="form-check-label font-weight-normal" for="atBirth1">BCG</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="atBirth2" name="at_birth[]" value="Hepatitis B">
                        <label class="form-check-label font-weight-normal" for="atBirth2">Hepatitis B</label>
                    </div>
                </div>
                <div class="col-lg-2 content-two ml-auto mr-auto">
                    <h5 class="title-two text-primary font-weight-bold mb-4">2 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="twoMonth1" name="twoMonth[]" value="IPV">
                        <label class="form-check-label font-weight-normal" for="twoMonth1">IPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="twoMonth2" name="twoMonth[]" value="DTPw">
                        <label class="form-check-label font-weight-normal" for="twoMonth2">DTPw</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="twoMonth3" name="twoMonth[]" value="Hepatitis B">
                        <label class="form-check-label font-weight-normal" for="twoMonth3">Hepatitis B</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="twoMonth4" name="twoMonth[]" value="Hip">
                        <label class="form-check-label font-weight-normal" for="twoMonth4">Hip</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="twoMonth5" name="twoMonth[]" value="PCV">
                        <label class="form-check-label font-weight-normal" for="twoMonth5">PCV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="twoMonth6" name="twoMonth[]" value="Rota">
                        <label class="form-check-label font-weight-normal" for="twoMonth6">Rota</label>
                    </div>
                </div>
                <div class="col-lg-2 content-one ml-auto mr-auto">
                    <h5 class="title-one text-primary font-weight-bold mb-4">4 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="fourMonth1" name="fourMonth[]" value="IPV">
                        <label class="form-check-label font-weight-normal" for="fourMonth1">IPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="fourMonth2" name="fourMonth[]" value="DTPw">
                        <label class="form-check-label font-weight-normal" for="fourMonth2">DTPw</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="fourMonth3" name="fourMonth[]" value="Hepatitis B">
                        <label class="form-check-label font-weight-normal" for="fourMonth3">Hepatitis B</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="fourMonth4" name="fourMonth[]" value="Hip">
                        <label class="form-check-label font-weight-normal" for="fourMonth4">Hip</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="fourMonth5" name="fourMonth[]" value="PCV">
                        <label class="form-check-label font-weight-normal" for="fourMonth5">PCV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="fourMonth6" name="fourMonth[]" value="Rota">
                        <label class="form-check-label font-weight-normal" for="fourMonth6">Rota</label>
                    </div>
                </div>
                <div class="col-lg-2 content-two ml-auto mr-auto">
                    <h5 class="title-two text-primary font-weight-bold mb-4">6 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="sixMonth1" name="sixMonth[]" value="IPV">
                        <label class="form-check-label font-weight-normal" for="sixMonth1">IPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="sixMonth2" name="sixMonth[]" value="DTPw">
                        <label class="form-check-label font-weight-normal" for="sixMonth2">DTPw</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="sixMonth3" name="sixMonth[]" value="Hepatitis B">
                        <label class="form-check-label font-weight-normal" for="sixMonth3">Hepatitis B</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="sixMonth4" name="sixMonth[]" value="Hip">
                        <label class="form-check-label font-weight-normal" for="sixMonth4">Hip</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="sixMonth5" name="sixMonth[]" value="PCV">
                        <label class="form-check-label font-weight-normal" for="sixMonth5">PCV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="sixMonth6" name="sixMonth[]" value="OPV">
                        <label class="form-check-label font-weight-normal" for="sixMonth6">OPV</label>
                    </div>
                </div>
            </div>
            <div class="row col-lg-10 ml-auto mr-auto mt-5">
                <div class="col-lg-2 content-two ml-auto mr-auto">
                    <h5 class="title-two text-primary font-weight-bold mb-4">9 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="nineMonth1" name="nineMonth[]" value="Measles">
                        <label class="form-check-label font-weight-normal" for="nineMonth1">Measles</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="nineMonth2" name="nineMonth[]" value="MCV4">
                        <label class="form-check-label font-weight-normal" for="nineMonth2">MCV4</label>
                    </div>
                </div>
                <div class="col-lg-2 content-one ml-auto mr-auto">
                    <h5 class="title-one text-primary font-weight-bold mb-4">12 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="twelveMonth1" name="twelveMonth[]" value="OPV">
                        <label class="form-check-label font-weight-normal" for="twelveMonth1">OPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="twelveMonth2" name="twelveMonth[]" value="MMR"
                        <label class="form-check-label font-weight-normal" for="twelveMonth2">MMR</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="twelveMonth3" name="twelveMonth[]" value="PCV">
                        <label class="form-check-label font-weight-normal" for="twelveMonth3">PCV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="twelveMonth4" name="twelveMonth[]" value="MCV4">
                        <label class="form-check-label font-weight-normal" for="twelveMonth4">MCV4</label>
                    </div>
                </div>
                <div class="col-lg-2 content-two ml-auto mr-auto">
                    <h5 class="title-two text-primary font-weight-bold mb-4">18 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="eighteen_month1" name="eighteenMonth[]" value="OPV">
                        <label class="form-check-label font-weight-normal" for="eighteen_month1">OPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="eighteen_month2" name="eighteenMonth[]" value="DTap">
                        <label class="form-check-label font-weight-normal" for="eighteen_month2">DTap</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="eighteen_month3" name="eighteenMonth[]" value="Hip">
                        <label class="form-check-label font-weight-normal" for="eighteen_month3">Hip</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="eighteen_month4" name="eighteenMonth[]" value="MMR">
                        <label class="form-check-label font-weight-normal" for="eighteen_month4">MMR</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="eighteen_month5" name="eighteenMonth[]" value="Hepatitis A">
                        <label class="form-check-label font-weight-normal" for="eighteen_month5">Hepatitis A</label>
                    </div>
                </div>
                <div class="col-lg-2 content-one ml-auto mr-auto">
                    <h5 class="title-one text-primary font-weight-bold mb-4">24 Month</h5>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="fourtyTwo1" name="fourtyTwo[]" value="Hepatitis A">
                        <label class="form-check-label font-weight-normal" for="fourtyTwo1">Hepatitis A</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="fourtyTwo2" name="fourtyTwo[]" value="OPV">
                        <label class="form-check-label font-weight-normal" for="fourtyTwo2">OPV</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="fourtyTwo3" name="fourtyTwo[]" value="DTap">
                        <label class="form-check-label font-weight-normal" for="fourtyTwo3">DTap</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="fourtyTwo4" name="fourtyTwo[]" value="MMR">
                        <label class="form-check-label font-weight-normal" for="fourtyTwo4">MMR</label>
                    </div>
                    <div class="form-group form-check pl-5 mt-3">
                        <input type="checkbox" class="form-check-input" id="fourtyTwo5" name="fourtyTwo[]" value="Varicella">
                        <label class="form-check-label font-weight-normal" for="fourtyTwo5">Varicella</label>
                    </div>
                </div>
            </div>
            <div class="row mb-5 mt-5">
                <input type="submit" value="Add" class="mr-auto ml-auto col-6 btn btn-success">
            </div>

        </form>
    </div>
</div>
    <!--End-Serv-->
    @include('backEnd.layoutes.footer')
@endsection
