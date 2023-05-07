$(document).ready(function (){
    $("#registerBtn").on('click', function (e){
        e.preventDefault();

        const alert = $("#registerAlert");
        alert.css("display", "none");

        const username = $("#username");
        const email = $("#email");
        const phone = $("#phone");
        const pass = $("#password");
        const passCon = $("#passwordConfirm");

        const regexName = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/;
        const regexEmail = /^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i;
        const regexPhone = /^[0][6][0-9]{6,10}$/;
        const regexPassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/;

        let errorNum = 0;
        // USERNAME REGEX
        if (!regexName.test(username.val())) {
            errorNum++;
            username.next().html("Samo slova i bar jedan broj, dužina mora biti između 8 i 20.");
            } else {
                username.next().html("");
            }

        // EMAIL REGEX
        if (!regexEmail.test(email.val())) {
            errorNum++;
            email.next().html("Neispravna email adresa.");
        } else {
            email.next().html("");
        }

        // PHONE REGEX
        if (!regexPhone.test(phone.val())) {
            errorNum++;
            phone.next().html("Neispravan broj telefona (Mora početi sa 06).");
        } else {
            phone.next().html("");
        }

        // PASSWORD REGEX
        if (!regexPassword.test(pass.val())) {
            errorNum++;
            pass.next().html("Lozinka mora imati barem 8 karatkera i bar jedno slovo i broj.");
        } else {
            pass.next().html("");
        }

        // PASSWORD REGEX
        if (pass.val() !== passCon.val()) {
            errorNum++;
            passCon.next().html("Ne poklapa se sa lozinkom iznad.");
        } else {
            passCon.next().html("");
        }

        if(errorNum === 0){
            const data = {
                username: username.val(),
                email: email.val(),
                phone: phone.val(),
                password: pass.val()
            }
            $.ajax({
                url: 'models/auth/register.php',
                method: 'POST',
                data: data,
                dataType: 'JSON',
                success: function (res) {
                    const alert = $("#registerAlert");
                    alert.css("display", "block");
                    alert.html(res.response);
                },
                error: function (err) {
                    const alert = $("#registerAlert");
                    alert.css("display", "block");
                    alert.html(err);
                }
            })
        }


    })

    $("#loginBtn").on('click', function (e){
        e.preventDefault();

        const email = $("#email");
        const pass = $("#password");

        const regexEmail = /^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i;
        const regexPassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/;

        let errorNum = 0;

        // EMAIL REGEX
        if (!regexEmail.test(email.val())) {
            errorNum++;
            email.next().html("Neispravna email adresa.");
        } else {
            email.next().html("");
        }

        // PASSWORD REGEX
        if (!regexPassword.test(pass.val())) {
            errorNum++;
            pass.next().html("Lozinka mora imati barem 8 karatkera i bar jedno slovo i broj.");
        } else {
            pass.next().html("");
        }

        if(errorNum === 0){
            const data = {
                email: email.val(),
                password: pass.val()
            }
            $.ajax({
                url: 'models/auth/login.php',
                method: 'POST',
                data: data,
                dataType: 'JSON',
                success: function (res) {
                    if(res.redirect == 1){
                        window.location.href = "index.php?page=home";
                    }else{
                        const alert = $("#loginAlert");
                        alert.css("display", "block");
                        alert.html(res.response);
                    }
                },
                error: function (err) {
                    const alert = $("#loginAlert");
                    alert.css("display", "block");
                    alert.html(err);
                }
            })

        }

    })
})