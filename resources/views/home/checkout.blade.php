@extends('shared.layout')
@section('title','Đặt hàng | GDX')
@section('content')
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i></a></li>
        <li>Đặt hàng</li>
    </ul>

    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
            <h2 class="title">Đặt hàng</h2>
            <div class="so-onepagecheckout ">
                <div class="col-left col-sm-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="fa fa-user"></i> Thông tin khách hàng</h4>
                        </div>
                        <div class="panel-body">
                            <fieldset id="account">
                                <div class="form-group required">
                                    <label for="input-payment-fullname" class="control-label">Họ Tên Khách Hàng</label>
                                    <input type="text" class="form-control" id="input-payment-fullname" placeholder="Nhập vào Họ Tên" value="{{!empty($user) ? $user->fullname : ''}}" name="fullname" @disabled($user && $user->fullname)>
                                    <div style="color: red;" class="mt-2 error-fullname"></div>
                                </div>
                                <div class="form-group required">
                                    <label for="input-payment-email" class="control-label">E-Mail</label>
                                    <input type="email" class="form-control" id="input-payment-email" placeholder="Nhập vào E-Mail" value="{{!empty($user) ? $user->email : ''}}" name="email" @disabled($user && $user->email)>
                                    <div style="color: red;" class="mt-2 error-email"></div>
                                </div>
                                <div class="form-group required">
                                    <label for="input-payment-phone" class="control-label">Số điện thoại</label>
                                    <input type="phone" class="form-control" id="input-payment-phone" placeholder="Nhập vào số điện thoại" value="{{!empty($user) ? $user->phone : ''}}" name="phone" @disabled($user && $user->phone)>
                                    <div style="color: red;" class="mt-2 error-phone"></div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="fa fa-book"></i> Địa chỉ giao hàng</h4>
                        </div>
                        <div class="panel-body">
                            <fieldset id="address" class="required">
                                <div class="form-group required">
                                    <label for="input-payment-address" class="control-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="input-payment-address" placeholder="Nhập vào địa chỉ" value="{{!empty($user) ? $user->address : ''}}" name="address" @disabled($user && $user->address)>
                                    <div style="color: red;" class="mt-2 error-address"></div>
                                </div>
                                @if(empty($user) || empty($user->address))
                                <div class="form-group required">
                                    <label for="input-payment-city" class="control-label">Tỉnh / Thành Phố</label>
                                    <select class="form-control" id="province" name="province_id">
                                        <option value="" class="defaut"> --- Vui lòng chọn Tỉnh/TP --- </option>
                                        @foreach($province as $p)
                                        <option value="{{$p->province_id}}">{{$p->name}}</option>
                                        @endforeach
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
                                @endif
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="col-right col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default no-padding">
                                <div class="col-sm-6 checkout-shipping-methods">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-truck"></i> Hình thức vận chuyển</h4>
                                    </div>
                                    <div class="panel-body ">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" checked="checked" name="GHN">GHN Express</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6  checkout-payment-methods">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-credit-card"></i> Thanh toán</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="shipCode" checked>Thanh toán khi nhận hàng</label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="vnpay">Thanh toán online</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-ticket"></i> Nhập mã giảm giá</h4>
                                </div>
                                <div class="panel-body row">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="input-coupon" placeholder="Nhập vào mã giảm giá" value="" name="coupon">
                                            <span class="input-group-btn">
                                                <input type="button" class="btn btn-primary" data-loading-text="Loading..." id="button-coupon" value="Áp dụng">
                                            </span>
                                        </div>
                                        <div style="color: red;" class="result-coupon"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Thông tin đơn hàng</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td class="text-center">Hình ảnh</td>
                                                    <td class="text-left">Tên sản phẩm</td>
                                                    <td class="text-left">Thương hiệu</td>
                                                    <td class="text-left">Số lượng</td>
                                                    <td class="text-right">Giá bán</td>
                                                    <td class="text-right">Tổng tiền</td>
                                                </tr>
                                            </thead>
                                            <tbody class="views-cart">
                                                @if(!empty($cart))
                                                @foreach($cart as $v)
                                                <tr>
                                                    <td class="text-center"><img width="60px" src="/image/product/{{$v->imageUrl}}" alt="{{$v->productName}}" title="{{$v->productName}}" class="img-thumbnail"></td>
                                                    <td class="text-left" style="max-width: 230px; display: inline-block;
                                                        overflow: hidden; white-space: nowrap; text-overflow: ellipsis; border: none;">
                                                        {{$v->productName}}
                                                    </td>
                                                    <td class="text-left">{{$v->brandName}}</td>
                                                    <td class="text-left">{{$v->quantity}}</td>
                                                    <td class="text-right quantity">{{formatMoney($v->price)}}</td>
                                                    <td class="text-right">{{formatMoney($v->price * $v->quantity)}}</td>
                                                    <input type="hidden" name="total" value="{{$v->price * $v->quantity}}">
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-right" colspan="5"><strong>Tạm tính:</strong></td>
                                                    <td class="text-right sub-total-checkout"></td>
                                                </tr>
                                                <tr id="coupon-apply" style="display: none;">
                                                    <td class="text-right" colspan="5"><strong>Giảm giá:</strong></td>
                                                    <td class="text-right coupon"></td>
                                                    <input type="hidden" name="couponApply">
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="5"><strong>Phí vận chuyển:</strong></td>
                                                    <td class="text-right shipping"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="5"><strong>Tổng tiền:</strong></td>
                                                    <td class="text-right total-checkout"></td>
                                                    <input type="hidden" name="total_amount" id="total_amount" value="">
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-pencil"></i> Ghi chú</h4>
                                </div>
                                <div class="panel-body">
                                    <textarea rows="4" class="form-control" id="confirm_comment" name="comments"></textarea>
                                    <br>
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <input type="button" class="btn btn-primary" id="button-confirm" value="Xác nhận đặt hàng">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Middle Part End -->

    </div>
</div>
<!-- //Main Container -->
@stop
@section('script')
<script>
    function hasAddress() {
        let user_login = <?= json_encode(!empty($user) ? $user : '') ?>;

        return user_login.address !== null;
    }

    function hasUser() {
        let user_login = <?= json_encode(!empty($user) ? $user : '') ?>;

        return !$.isEmptyObject(user_login);
    }
</script>
<script src="/js/validate/validate.js"></script>
<script src="/js/cart/checkout.js"></script>
@stop