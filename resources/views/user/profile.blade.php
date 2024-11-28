@extends('shared.layout')
@section('title','Thông tin tài khoản')
@section('content')
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i></a></li>
        <li>Tài khoản</li>
    </ul>

    <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
            <p class="lead">Xin chào, <strong>{{Auth::guard('web')->user()->user_name}}</strong></p>
            <div class="row">
                <div class="col-sm-6">
                    <fieldset id="personal-details">
                        <legend>Thông tin cá nhân</legend>
                        <div class="form-group">
                            <label for="input-fullname" class="control-label">Họ & Tên</label>
                            <input type="text" class="form-control" id="input-fullname" placeholder="Họ & Tên" value="{{Auth::guard('web')->user()->fullname}}" disabled name="fullname">
                        </div>
                        <div class="form-group">
                            <label for="input-email" class="control-label">E-Mail</label>
                            <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="{{Auth::guard('web')->user()->email}}" disabled name="email">
                        </div>
                        <div class="form-group">
                            <label for="input-telephone" class="control-label">Số điện thoại</label>
                            <input type="tel" class="form-control" id="input-telephone" placeholder="Số điện thoại" value="{{Auth::guard('web')->user()->phone}}" disabled name="telephone">
                        </div>
                        <div class="form-group">
                            <label for="input-address" class="control-label">Địa chỉ giao hàng</label>
                            <input type="text" class="form-control" id="input-address" placeholder="address" value="{{Auth::guard('web')->user()->address}}" disabled name="address">
                        </div>
                    </fieldset>
                    <br>
                </div>
                <div class="col-sm-6">
                    <fieldset class="changePassword hidden">
                        <legend>Đổi mật khẩu</legend>
                        <div class="form-group required">
                            <label for="input-password" class="control-label">Mật khẩu cũ</label>
                            <input type="password" class="form-control" id="input-password" placeholder="Nhập vào mật khẩu cũ" value="" name="old-password">
                        </div>
                        <div class="form-group required">
                            <label for="input-password" class="control-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="input-password" placeholder="Nhập vào mật khẩu mới" value="" name="new-password">
                        </div>
                        <div class="form-group required">
                            <label for="input-confirm" class="control-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="input-confirm" placeholder="Nhập lại mật khẩu mới" value="" name="new-confirm">
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-md btn-primary">Cập nhật mật khẩu</button>
                            <button class="btn btn-md btn-danger btnClose">Thoát</button>
                        </div>
                    </fieldset>
                    <fieldset class="changeAddress hidden">
                        <legend>Thay đổi địa chỉ</legend>
                        <div class="form-group required">
                            <label for="input-payment-address" class="control-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="input-payment-address" placeholder="Nhập vào địa chỉ" value="" name="address">
                            <div style="color: red;" class="mt-2 error-address"></div>
                        </div>
                        <div class="form-group required">
                            <label for="input-payment-city" class="control-label">Tỉnh / Thành Phố</label>
                            <select class="form-control" id="province" name="province_id">
                                <option value="" class="defaut"> --- Vui lòng chọn Tỉnh/TP --- </option>
                                <option value=""></option>
                            </select>
                            <div style="color: red;" class="mt-2 error-province"></div>
                        </div>
                        <div class="form-group required">
                            <label for="input-payment-country" class="control-label">Quận / Huyện</label>
                            <select class="form-control" id="district" name="district_id">
                                <option value="" class="defaut"> --- Vui lòng chọn Quận / Huyện --- </option>
                            </select>
                            <div style="color: red;" class="mt-2 error-district"></div>
                        </div>
                        <div class="form-group required">
                            <label for="input-payment-zone" class="control-label">Phường / Xã</label>
                            <select class="form-control" id="ward" name="wards_id">
                                <option value=""> --- Vui lòng chọn Tỉnh / Thành Phố --- </option>
                            </select>
                            <div style="color: red;" class="mt-2 error-ward"></div>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-md btn-primary">Xác nhận địa chỉ</button>
                            <button class="btn btn-md btn-danger btnClose">Thoát</button>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="buttons clearfix">
                <div class="pull-left">
                    <button class="btn btn-md btn-primary" id="btnChangePass">Đổi mật khẩu</button>
                    <button class="btn btn-md btn-primary" id="btnChangeAddress">Cập nhật địa chỉ</button>
                </div>
            </div>
        </div>
        <!--Middle Part End-->
        <!--Right Part Start -->
        <aside class="col-sm-3 hidden-xs" id="column-right">
            <h2 class="subtitle">Tài khoản</h2>
            <div class="list-group">
                <ul class="list-item">
                    <li><a href="/tai-khoan/san-pham-yeu-thich">Sản phẩm yêu thích</a>
                    </li>
                    <li><a href="/tai-khoan/don-dat-hang">Đơn đặt hàng</a>
                    </li>
                </ul>
            </div>
        </aside>
        <!--Right Part End -->
    </div>
</div>
<!-- //Main Container -->
@stop

@section('script')
<script>
    $('#btnChangePass').click(function() {
        $('#content .changeAddress').addClass('hidden');
        $('#btnChangeAddress').removeClass('hidden');

        $('#content .changePassword').removeClass('hidden');
        $(this).addClass('hidden');
    });

    $('#btnChangeAddress').click(function() {
        $('#content .changePassword').addClass('hidden');
        $('#btnChangePass').removeClass('hidden');

        $('#content .changeAddress').removeClass('hidden');
        $(this).addClass('hidden');
    });

    $('#content .btnClose').click(function() {
        $('#content .changePassword').addClass('hidden');
        $('#content .changeAddress').addClass('hidden');

        $('#btnChangePass').removeClass('hidden');
        $('#btnChangeAddress').removeClass('hidden');
    });
</script>
@stop