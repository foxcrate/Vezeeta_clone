var email = document.getElementById('txtEmailId');
        var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        email.onchange = function(){
            if(!pattern.test(email.value)) {
                email.classList.add('error');
                document.getElementById('span-error').classList.remove('d-none');
            }
        }
