@extends('backEnd.layoutes.mastar')
@section('title',' verify')
@section('content')
@include('backEnd.layoutes.navbar')
<div class="back-ground" style="padding-top:80px;">
    <div class="container row no-gutters bg-message card ml-auto mr-auto" style="flex-direction: row; margin-top:120px; margin-bottom:50px;">
        <div class="col-lg-5 order-lg-1 mt-5 text-center">
            <img src="{{url('imgs/messege.png')}}" class="img-fluid float-left order-lg-2 mb-lg-5 mt-5" alt="Responsive image" height="400" width="500">
        </div>
        <div class="col-lg-6 order-lg-2 mt-5 pt-5 mb-5">
            <h4 class="ml-auto mr-auto col-10 mb-3 font-weight-bold">Verify Your Phone Number</h4>
            <h6 class="ml-auto mr-auto col-10">For your security clinic History wants to make sure its really you. clinic History will send a text message with a 6-digit verification code.</6>
            <div class="reca-div mt-4">
                <div id="mobile-number" class="ml-auto mr-auto col-8 mb-5 verify h5"><i class="fa fa-phone ml-3 mr-3 text-success"></i> {{$clinic['phoneNumber']}}</div>
                <div class="mt-2 font-weight-bold">Get a Verification code to</div>
                <div id="mobile-number" class="mt-2 mb-2">clinic History Will Send a Verification code to {{$clinic['phoneNumber']}}</div>
                <div id="recaptcha-container" class="mt-3 mb-3"></div>
                <button class="btn btn-success mb-3 mt-3 text-center text-weight-bold" onclick="phoneAuth();">Send Mobile</button>
            </div>
            <div class="col-12 show-verify" style="display: none">
                <input class="form-control col-6 mt-5" type="text" id="verify-code" maxLength="6" size="1" min="0" max="9" pattern="[0-9]" />
                <div class="row">
                    <div class="col-4">
                        <button class="h2 btn btn-success mt-3 mb-3" onclick="codevervcation();" id="send-verify" type="submit">Send Verify</button>
                    </div>
                    <div class="col-6">
                        <button class="h2 btn btn-success mt-3 mb-3" onclick="r_send()" id="r-send" type="submit">R-send</button>
                    </div>
                    <p class="alert alert-danger danger-Reg" style="display: none;margin-bottom:0;"></p>
                </div>
            </div>
            <br/><a  style="display:none; color:white;" class="mt-3 btn btn-success suc-Reg text-white" href="{{route('clinic_verifcationCode',$clinic['id'])}}">{{$clinic['id']}} </a>
            <div class="row">
                <p id="config_app" class="d-none">{{ config('app.url') }}</p>
            </div>
        </div>
    </div>
</div>



@include('backEnd.layoutes.footer')

@endsection


@section("scripts")

<script>
    window.onload = function(){
    render();
}
function render(){
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render().then(function(widgetId) {
        window.recaptchaWidgetId = widgetId;
    });
}
function phoneAuth(){
                    var numberval = document.getElementById('mobile-number').textContent;
                    console.log(numberval);
                    var appVerifier  = window.recaptchaVerifier;
                    firebase.auth().signInWithPhoneNumber(numberval, appVerifier)
                    .then(function (confirmationResult) {
                    window.confirmationResult = confirmationResult;

                    console.log(confirmationResult);
                    $('.show-verify').show();
                    $('.reca-div').hide();


                    }).catch(function (error) {

                    console.log(error.message);
                    });
                }
                /* end of function phone auth */
                /* function codevervcation */
                function codevervcation(){
                    console.log('login');
                        //e.preventDefault();
                        var code = document.getElementById('verify-code').value;
                        confirmationResult.confirm(code).then(function(result){
                            console.log('success register');
                            // window.location = "https://localhost/clinic_history_last_update/public/verficationCode/" + $(".suc-Reg").text();
                            window.location = $("#config_app").text()+"Phistory/public/clinic/confirm/password/" + $(".suc-Reg").text();
                            var user = result.user;
                            console.log(user);
                        }).catch(function(error){
                            $(".danger-Reg").show().text(error.message);
                            $("#r-send").show();
                            // console.log(error.message);
                        });
                        var credential = firebase.auth.PhoneAuthProvider.credential(confirmationResult.verificationId, code);
                        firebase.auth().signInWithCredential(credential);

                        }
                        /* end of function */

                        /* function r-send */
                        function r_send(){
                            location.reload();
                        }

                        /* end function r-send */

</script>
@endsection
@section('scripts')


@stop


