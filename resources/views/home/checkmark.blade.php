@extends('shared.layout')
@section('title','Đặt hàng thành công | GDX')
@section('content')
<div id="orderSuccess" class="container-fluid">
    <div class="checkmark-circle">
        <div class="background-checkmark"></div>
        <div class="checkmark draw"></div>
    </div>
    <h2>Đặt Hàng Thành Công!</h2>
    <p>Cảm ơn bạn đã mua sắm tại <b>Gia Dụng Xanh</b>.</p>
    <p>Mã đơn hàng của bạn là: <span id="orderId"><b>{{$orderId}}</b></span></p>
    <a class="btn btn-primary" href="/">Trở về trang chủ</a>
</div>
@stop