@extends('shared.layout')
@section('title','Quên mật khẩu | GDX')
@section('content')
<link rel="stylesheet" href="/css/form.css">

<div class="container-forgot">
    <!--Data or Content-->
    <div class="box-1">
        <div class="content-holder">
            <h2 style="color:aliceblue">Chào mừng bạn đến với Gia Dụng Xanh!</h2>
            <button id="login">Đăng nhập</button>
        </div>
    </div>

    <!--Forms-->
    <div class="box-2">
        <div class="text-right">
            <img src="/image/logos/icon-logo-mini.png" width="50" alt="Gia Dụng Xanh">
        </div>
        @csrf
        <div class="login-form-container visible forgot" id="forgot">
            <h1>Quên mật khẩu</h1>
            <p class="forgot-result text-info"></p>
            <p class="forgot-error" style="color: red;"></p>
            <input type="email" placeholder="Nhâp vào Email" name="email" class="input-field" required>
            <p class="email-error error-null"></p>
            <button class="login-button forgot-submit">Tiếp tục</button>
        </div>

        <div class="login-form-container hidden forgot" id="reset-pass">
            <h1>Đặt lại mật khẩu</h1>
            <input type="password" placeholder="Nhâp vào mật khẩu mới" name="password" class="input-field" required>
            <p class="pwd-error error-null"></p>
            <input type="password" placeholder="Xác nhận mật khẩu mới" name="confirm_password" class="input-field" required>
            <p class="pwd-confirm-error error-null"></p>
            <button class="login-button reset-submit">Xác nhận</button>
        </div>

    </div>
</div>
@stop

@section('script')
<script src="/js/validate/validate.js"></script>
<script src="/js/auth/forgot.js"></script>
@stop