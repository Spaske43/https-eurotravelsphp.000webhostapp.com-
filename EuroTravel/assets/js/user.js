$( document ).ready(function() {
    // REGISTRACIJA
        $("#register-btn").on('click', function (e){
            e.preventDefault();
            const username = $("#username");
            const email = $("#email");
            const phone = $("#phone");
            const password = $("#password");
            const passwordConfirm = $("#passwordConfirm");
    
            // REGEX
            const usernameReg = /^[a-z][a-z0-9]{5,16}$/i;
            const emailReg = /^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i;
            const phoneReg = /^[0][6][0-9]{7,12}$/;
            const passwordReg = /^(?=.*[a-z])(?=.*\d)[a-z\d]{8,20}$/i;
    
            let errors = 0;
    
            if(!usernameReg.test(username.val())){
                username.next().html('Dozvoljeni su samo brojevi i slova i morate početi slovom.');
                errors++;
            }else{
                username.next().html('');
            }
    
            if(!emailReg.test(email.val())){
                email.next().html('Neispravna email adrese.');
                errors++;
            }else{
                email.next().html('');
            }
    
            if(!phoneReg.test(phone.val())){
                phone.next().html('Telefon mora početi sa 06.');
                errors++;
            }else{
                phone.next().html('');
            }
            if(!passwordReg.test(password.val()) || password.val() === ""){
                password.next().html('Dozvoljeni su samo slova i brojevi. Minimum 8 karaktera.');
                errors++;
            }else{
                password.next().html('');
            }
    
            if(passwordConfirm.val() !== password.val() || passwordConfirm.val() === ""){
                passwordConfirm.next().html('Ne poklapa se sa lozinkom iznad.');
                errors++;
            }else{
                passwordConfirm.next().html('');
            }
    
    
            if(errors === 0){
                $.ajax({
                    url: 'models/user/register.php',
                    method: 'POST',
                    data: {
                        username: username.val(),
                        email: email.val(),
                        phone: phone.val(),
                        password: password.val(),
                    },
                    dataType: 'json',
                    success: function (res){
                        console.log(res)
                        let alert = document.getElementById("register-alert");
    
                        alert.style.display = "block";
                        alert.innerHTML = res.response;
                    },
                    error: function (err){
                        console.log(err)
                    }
                })
            }
        })
    
    //     LOGOVANJE
        $("#login-btn").on('click', function (e){
            e.preventDefault();
    
            const email = $("#email");
            const password = $("#password");
    
            // REGEX
            const emailReg = /^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i;
            const passwordReg = /^(?=.*[a-z])(?=.*\d)[a-z\d]{8,20}$/i;
    
            let errors = 0;
    
            if(!emailReg.test(email.val())){
                email.next().html('Neispravna email adrese.');
                errors++;
            }else{
                email.next().html('');
            }
    
            if(!passwordReg.test(password.val()) || password.val() === ""){
                password.next().html('Dozvoljeni su samo slova i brojevi. Minimum 8 karaktera.');
                errors++;
            }else{
                password.next().html('');
            }
    
            if(errors === 0){
                $.ajax({
                    url: 'models/user/login.php',
                    method: 'POST',
                    data: {
                        email: email.val(),
                        password: password.val(),
                    },
                    dataType: 'json',
                    success: function (res){
                        if(!res.login){
                            let alert = document.getElementById("login-alert");
    
                            alert.style.display = "block";
                            alert.innerHTML = res.response;
                        }else{
                            let loginSuccessModal = new bootstrap.Modal(document.getElementById('login-modal'));
                            $("#login-modal-content").html(res.response);
                            loginSuccessModal.show();
                        }
    
                    },
                    error: function (err){
                        console.log(err)
                    }
                })
            }
        })
    })