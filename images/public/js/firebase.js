
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
                    // SMS sent. Prompt user to type the code from the message, then sign the
                    // user in with confirmationResult.confirm(code).
                    window.confirmationResult = confirmationResult;
                    // alert('msg is sent');
                    console.log(confirmationResult);
                    $('.show-verify').show();
                    $('.reca-div').hide();
                    // $('#error_msg').removeClass("alert alert-danger hideit");
                    // $('#error_msg').addClass( "alert alert-success hideit" );
                    //error_msg.innerHTML= response.message;
                    // $("#loading").hide();

                    }).catch(function (error) {
                    // Error; SMS not sent
                    // ...
                    console.log(error.message);
                    });
                }
                /* end of function phone auth */
                /* function codevervcation */
                function codevervcation(){
                    //     // $('#ve').submit(function(event) {
                    //         // event.preventDefault();
                    //         // event.stopImmediatePropagation();
                    //         //var career_submit = document.getElementById("save");
                    //         //career_submit.disabled = true;
                                console.log('login');
                                    //e.preventDefault();
                                    var code = document.getElementById('verify-code').value;
                                    confirmationResult.confirm(code).then(function(result){
                                        console.log('success register');
                                        // window.location = "{{route('patient.welcome')}}";
                                        // $('.suc-Reg').show();
                                        window.location = "https://localhost/paientHistory/public/verficationCode/" + $(".suc-Reg").text();
                                        var user = result.user;
                                        console.log(user);
                                    }).catch(function(error){
                                        $(".danger-Reg").show().text(error.message);
                                        // console.log(error.message);
                                    });
                                    var credential = firebase.auth.PhoneAuthProvider.credential(confirmationResult.verificationId, code);
                                    firebase.auth().signInWithCredential(credential);


                                }