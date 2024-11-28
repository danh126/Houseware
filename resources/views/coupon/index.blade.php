@extends('shared.admin')
@section('title','Danh sách mã giảm giá | GDX')
@section('content')
<div class="container">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/manage">Trang chủ</a></li>
        <li class="breadcrumb-item active">Mã giảm giá</li>
    </ol>

    <a class="mt-2 mb-2 btn btn-primary" href="/manage/coupon/add">Thêm mã giảm giá</a>

    <p class="text-danger">
        <b>(*)Tỷ lệ giảm giá:</b>
        <span>đơn vị tính %.</span>
    </p>

    <table class="table table-bordered">
        <thead class="table-info">
            <tr>
                <th>ID giảm giá</th>
                <th>Mã giảm giá</th>
                <th>Tỷ lệ giảm</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupon as $a)
            <tr>
                <td>{{$a->id}}</td>
                <td>{{$a->code_coupon}}</td>
                <td>{{$a->coupon_apply}}</td>
                <td>
                    <a class="btn btn-primary" href="/manage/coupon/edit/{{$a->id}}">Cập nhật</a>
                    <a class="btn btn-danger" href="">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
    </div>
</div>
@stop