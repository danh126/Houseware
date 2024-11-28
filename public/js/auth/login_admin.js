$(document).ready(function () {
    $('#admin-login .login-submit').click(function () {
        let email = $('#inputEmail').val();
        let password = $('#inputPassword').val();
        let token = $('#admin-login').find('input[name="_token"]').val();

        let admin_login_error = false;

        //Validate Email
        let email_error = $('#admin-login .email-error');

        if (email === '') {
            email_error.text('Email không được để trống!');
            admin_login_error = true;

            clearText(email_error);
        } else if (!isValidEmail(email)) {
            email_error.text('Email không hợp lệ!');
            admin_login_error = true;

            clearText(email_error);
        }

        //Validate Password 
        let password_error = $('#admin-login .pwd-error');

        if (password === '') {
            password_error.text('Mật khẩu không được để trống!');
            admin_login_error = true;

            clearText(password_error);
        } else if (password.length < 8 || password.length > 16) {
            password_error.text('Độ dài mật khẩu từ 8 đến 16 ký tự!');
            admin_login_error = true;

            clearText(password_error);
        }

        if (!admin_login_error) {
            $.post('/admin/login', {
                '_token': token,
                'email': email,
                'password': password
            }, (d) => {
                if (d.admin_login === true) {
                    location.href = '/manage';
                    return;
                }

                let result = $('#admin-login .admin-login-result');

                if (d.check_email_admin === false) {
                    result.addClass('text-danger text-center').text('Bạn không có quyền truy cập!');

                    clearText(result);
                } else if (d.check_password_admin === false) {
                    result.addClass('text-danger text-center').text('Mật khẩu không chính xác!');

                    clearText(result);
                }
            })
        }
    })
});