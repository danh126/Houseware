@extends('shared.layout')
@section('title','Thanh toán thành công | GDX')
@section('content')
<div id="orderSuccess" class="container-fluid">
    <div class="checkmark-circle">
        <div class="background-checkmark"></div>
        <div class="checkmark draw"></div>
    </div>
    <h2>Bạn đã thanh toán đơn hàng thành công!</h2>
    <p>Số tiền thanh toán: <b>{{formatMoney($total_amount)}}</b></p>
    <p>Cảm ơn bạn đã mua sắm tại <b>Gia Dụng Xanh</b>.</p>
    <p>Mã đơn hàng của bạn là: <b>{{$orderId}}</b></p>
    <a class="btn btn-primary" href="/">Trở về trang chủ</a>
</div>
@stop