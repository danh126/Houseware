$(document).ready(function () {
    //Register
    $('#register .signup-button').click(function () {
        let user_name = $(this).parent().find('input[name="user_name"]').val();
        let email = $(this).parent().find('input[name="email"]').val();
        let password = $(this).parent().find('input[name="password"]').val();
        let confirm_password = $(this).parent().find('input[name="confirm_password"]').val();
        let token = $('.box-2').find('input[name="_token"]').val();

        let register_error = false;

        //Validate user name
        let user_error = $('#register .user-error');

        if (user_name === '') {
            user_error.text('Tên tài khoản không được để trống!');
            register_error = true;

            clearText(user_error);
        } else if (containsSpecialChars(user_name)) {
            user_error.text('Tên tài khoản không hợp lệ!');
            register_error = true;

            clearText(user_error);
        }

        //Validate Email
        let email_error = $('#register .email-error');

        if (email === '') {
            email_error.text('Email không được để trống!');
            register_error = true;

            clearText(email_error);
        } else if (!isValidEmail(email)) {
            email_error.text('Email không hợp lệ!');
            $('#register').find('input[name="password"]').val('');
            $('#register').find('input[name="confirm_password"]').val('');
            register_error = true;

            clearText(email_error);
        }

        //Validate Password
        let password_error = $('#register .pwd-error');

        if (password === '') {
            password_error.text('Mật khẩu không được để trống!');
            register_error = true;

            clearText(password_error);
        } else if (password.length < 8 || password.length > 16) {
            password_error.text('Độ dài mật khẩu từ 8 đến 16 ký tự!');
            register_error = true;

            clearText(password_error);
        }

        //Validate Password Confirm
        let pwd_confirm_error = $('#register .pwd-confirm-error ');

        if (password !== '') {
            if (confirm_password === '') {
                pwd_confirm_error.text('Xác nhận mật khẩu không được để trống!');
                register_error = true;

                clearText(pwd_confirm_error);
            } else if (confirm_password !== password) {
                pwd_confirm_error.text('Mật khẩu xác nhận không khớp!');
                register_error = true;

                clearText(pwd_confirm_error);
            }
        }

        if (!register_error) {
            NProgress.start();
            $.post('/auth/register', {
                '_token': token,
                'user_name': user_name,
                'email': email,
                'password': password
            }, (d) => {
                if (d.register) {
                    let register_result = $('#login .register-result');
                    $('.button-2').click();
                    register_result.text('Đăng ký tài khoản thành công!');

                    clearText(register_result);
                } else if (!d.register) {
                    let register_result = $('#register .register-result');
                    register_result.text('Email đã tồn tại!');

                    clearText(register_result);
                }
            })
            NProgress.done();
        }
    })

    //Login
    $('#login .login-submit').click(function () {
        let email = $('#login').find('input[name="email"]').val();
        let password = $('#login').find('input[name="pwd"]').val();
        let remember = $('#login .remember').find('input[name="rem"]:checked').val();
        let token = $('.box-2').find('input[name="_token"]').val();

        let login_error = false;

        //Validate Email
        let email_error = $('#login .email-error');

        if (email === '') {
            email_error.text('Email không được để trống!');
            login_error = true;

            clearText(email_error);
        } else if (!isValidEmail(email)) {
            email_error.text('Email không hợp lệ!');
            $('#login').find('input[name="email"]').val('');
            $('#login').find('input[name="pwd"]').val('');
            login_error = true;

            clearText(email_error);
        }

        //Validate Password
        let password_error = $('#login .pwd-error');

        if (password === '') {
            password_error.text('Mật khẩu khộng được để trống!');
            login_error = true;

            clearText(password_error);
        }

        // console.log(login_error);

        if (!login_error) {
            NProgress.start();
            $.post('/auth/login', {
                '_token': token,
                'email': email,
                'password': password
            }, (d) => {
                let login_result = $('#login .login-result');

                if (d.check_email === false) {
                    login_result.text('Email không tồn tại trong hệ thống!')
                    $('#login').find('input[name="pwd"]').val('');

                    clearText(login_result)
                } else if (d.check_pass === false) {
                    login_result.text('Mật khẩu không chính xác!')
                    clearText(login_result)
                }

                if (d.login_success === true) {
                    location.href = '/';
                }

                // console.log(d);
            })
            NProgress.done();
        }
    })

    //Login With Google
    $('#login .login-google').click(function () {
        NProgress.start();
        location.href = '/auth/google';
        NProgress.done();
    })
});