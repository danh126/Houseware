@extends('shared.layout')
@section('title','Thanh toán thất bại | GDX')
@section('content')
<div id="orderSuccess" class="container-fluid">
    <div class="failed-checkmark-circle">
        <div class="background-failed"></div>
        <i class="fa fa-times failed-icon" aria-hidden="true"></i>
    </div>
    <h2>Thanh toán thất bại!</h2>
    <p>Vui lòng thử lại sau.</p>
    <a class="btn btn-primary" href="/">Trở về trang chủ</a>
</div>
@stop