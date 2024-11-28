$(document).ready(function () {
    $('#login').click(function () {
        NProgress.start();
        location.href = '/tai-khoan/dang-nhap';
        NProgress.done();
    })

    //Forgot
    $('#forgot .forgot-submit').click(function () {
        let email = $('#forgot').find('input[name="email"]').val();
        let token = $('.box-2').find('input[name="_token"]').val();

        let forgot_error = false;

        //Validate Email
        let email_error = $('#forgot .email-error');

        if (email === '') {
            email_error.text('Email không được để trống!');
            forgot_error = true;

            clearText(email_error);
        } else if (!isValidEmail(email)) {
            email_error.text('Email không hợp lệ!');
            forgot_error = true;

            clearText(email_error);
        }

        if (!forgot_error) {
            NProgress.start();
            $.post('/tai-khoan/quen-mat-khau', {
                '_token': token,
                'email': email
            }, (d) => {
                if (d.check_email_forgot === false) {
                    let forgot_result = $('#forgot .forgot-error');
                    forgot_result.text('Email không tồn tại!');

                    clearText(forgot_result);
                } else if (d.check_email_forgot === true && d.email !== undefined) {
                    $('#forgot').find('input[name="email"]').val('');

                    $('#forgot').removeClass('visible').addClass('hidden');
                    $('#reset-pass').removeClass('hidden').addClass('visible');

                    //Reset Password
                    $('#reset-pass .reset-submit').click(function () {
                        let email = d.email;
                        let password = $('#reset-pass').find('input[name="password"]').val();
                        let confirm_password = $('#reset-pass').find('input[name="confirm_password"]').val();
                        let token = $('.box-2').find('input[name="_token"]').val();

                        let reset_password_error = false;

                        //Validate Password
                        let password_error = $('#reset-pass .pwd-error');

                        if (password === '') {
                            password_error.text('Mật khẩu không được để trống!');
                            reset_password_error = true;

                            clearText(password_error);
                        } else if (password.length < 8 || password.length > 16) {
                            password_error.text('Độ dài mật khẩu từ 8 đến 16 ký tự!');
                            reset_password_error = true;

                            clearText(password_error);
                        }

                        //Validate Password Confirm
                        let pwd_confirm_error = $('#reset-pass .pwd-confirm-error');

                        if (password !== '') {
                            if (confirm_password === '') {
                                pwd_confirm_error.text('Xác nhận mật khẩu không được để trống!');
                                reset_password_error = true;

                                clearText(pwd_confirm_error);
                            } else if (confirm_password !== password) {
                                pwd_confirm_error.text('Mật khẩu xác nhận không khớp!');
                                reset_password_error = true;

                                clearText(pwd_confirm_error);
                            }
                        }

                        if (!reset_password_error) {
                            $.post('/auth/reset-password', {
                                '_token': token,
                                'email': email,
                                'password': password
                            }, (d) => {
                                if (d.reset_password === true) {
                                    $('#reset-pass').find('input[name="password"]').val('');
                                    $('#reset-pass').find('input[name="confirm_password"]').val('');

                                    $('#forgot').removeClass('hidden').addClass('visible');
                                    $('#reset-pass').removeClass('visible').addClass('hidden');

                                    let forgot_result = $('#forgot .forgot-result');
                                    forgot_result.text('Đặt lại mật khẩu thành công!');

                                    clearText(forgot_result);
                                }
                            })
                        }
                    })
                }
            })
            NProgress.done();
        }
    })
});