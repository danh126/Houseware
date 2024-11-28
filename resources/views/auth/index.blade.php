@extends('shared.layout')
@section('title','Đăng nhập | GDX')
@section('content')
<link rel="stylesheet" href="/css/form.css">

<div class="container-login">
    <!--Data or Content-->
    <div class="box-1">
        <div class="content-holder">
            <h2 style="color:aliceblue">Chào mừng bạn đến với Gia Dụng Xanh!</h2>
            <button class="button-1" onclick="toggleForm(true)">Đăng ký tài khoản</button>
            <button class="button-2" onclick="toggleForm(false)">Đăng nhập</button>
        </div>
    </div>

    <!--Forms-->
    <div class="box-2">
        <div class="text-right">
            <img src="/image/logos/icon-logo-mini.png" width="50" alt="Gia Dụng Xanh">
        </div>
        @csrf
        <div class="login-form-container visible" id="login">
            <h1>Đăng nhập tài khoản</h1>
            <p class="register-result text-info"></p>
            <p class="login-result" style="color: red;"></p>
            <input type="text" placeholder="Nhâp vào Email" name="email" class="input-field" required>
            <p class="email-error error-null"></p>
            <input type="password" placeholder="Nhập vào mật khẩu" name="pwd" class="input-field" required>
            <p class="pwd-error error-null"></p>
            <div class="remember">
                <label for="rem">Ghi nhớ tài khoản</label>&ensp;
                <input type="checkbox" name="rem" id="rem" value="1">
            </div>
            <div class="forgot-password">
                <a href="/tai-khoan/quen-mat-khau">Quên mật khẩu?</a>
            </div>
            <button class="login-button login-submit">Đăng nhập</button>
            <div>
                <button class="login-button login-google"><img src="/image/logos/google.png" alt="google" width="20">Đăng nhập bằng Google</button>
            </div>
        </div>

        <!--Signup Form-->
        <div class="signup-form-container hidden" id="register">
            <h1>Đăng ký tài khoản</h1>
            <p class="register-result" style="color: red;"></p>
            <input type="text" placeholder="Tên tài khoản" name="user_name" class="input-field" required>
            <p class="user-error error-null"></p>
            <input type="email" placeholder="Địa chỉ Email" name="email" class="input-field" required>
            <p class="email-error error-null"></p>
            <input type="password" placeholder="Mật khẩu" name="password" class="input-field" required>
            <p class="pwd-error error-null"></p>
            <input type="password" placeholder="Nhập lại mật khẩu" name="confirm_password" class="input-field" required>
            <p class="pwd-confirm-error error-null"></p>
            <button class="signup-button">Đăng ký</button>
        </div>
    </div>
</div>
@stop

@section('script')
<script>
    function toggleForm(showSignup) {
        const login = document.querySelector("#login");
        const register = document.querySelector("#register");
        const button1 = document.querySelector(".button-1");
        const button2 = document.querySelector(".button-2");

        const loginInputs = login.querySelectorAll("input");
        const registerInputs = register.querySelectorAll("input");

        loginInputs.forEach(input => input.value = "");
        registerInputs.forEach(input => input.value = "");

        const checkboxes = login.querySelectorAll("input[type='checkbox'], #register input[type='checkbox']");
        checkboxes.forEach(checkbox => checkbox.checked = false);

        NProgress.start();
        if (showSignup) {
            login.classList.replace("visible", "hidden");
            register.classList.replace("hidden", "visible");
            button1.style.display = "none";
            button2.style.display = "inline-block";
        } else {
            register.classList.replace("visible", "hidden");
            login.classList.replace("hidden", "visible");
            button2.style.display = "none";
            button1.style.display = "inline-block";
        }
        NProgress.done();
    }
</script>
<script src="/js/validate/validate.js"></script>
<script src="/js/auth/login_register.js"></script>
@stop