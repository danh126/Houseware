@extends('shared.admin')
@section('title','Thêm mã giảm giá | GDX')
@section('content')
<div class="container-fluid">
    <h1 class="text-center mt-2 mb-2">Thêm mã giảm giá</h1>
    <form method="post">
        @csrf
        <div class="row">
            <label for="code_coupon" class="form-label col-2">Mã giảm giá</label>
            <div class="col-10">
                <input type="text" name="code_coupon" id="code_coupon" class="form-control">
            </div>
            @error('code_coupon')
            <div class="text-danger text-center">{{$message}}</div>
            @enderror
        </div>
        <div class="row mt-2">
            <label for="coupon_apply" class="form-label col-2">Tỷ lệ giảm</label>
            <div class="col-10">
                <input type="number" step="0.1" min="0.1" name="coupon_apply" id="coupon_apply" class="form-control" accept="image/*">
            </div>
            @error('coupon_apply')
            <div class="text-danger text-center">{{$message}}</div>
            @enderror
        </div>
        <div class="mt-2">
            <button class="offset-2 btn btn-primary">Thêm</button>
            <a href="/manage/coupon" class="btn btn-outline-primary">Quay lại</a>
        </div>
    </form>
</div>
@stop