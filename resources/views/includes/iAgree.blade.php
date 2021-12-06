var i_agree = document.getElementById('i_agree'),
            button_submit = document.getElementById('sign-in-button');
            i_agree.onchange = function(){
                if(button_submit.hasAttribute('disabled')){
                        button_submit.removeAttribute('disabled');
                }else{
                        button_submit.setAttribute('disabled','disabled');
                }
            
        }