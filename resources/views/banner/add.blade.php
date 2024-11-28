@extends('shared.admin')
@section('title','Thêm quảng cáo | GDX')
@section('content')
<div class="container-fluid">
    <h1 class="text-center mt-2 mb-2">Thêm quảng cáo</h1>
    <!-- Hiển thị thông báo lỗi -->
    @error('banner')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <label for="brandName" class="form-label col-2">Loại quảng cáo</label>
            <div class="col-10">
                <select name="banner_type" class="form-select" required>
                    <option value="">-- Vui lòng chọn loại quảng cáo --</option>
                    <option value="1">Quảng cáo đầu trang</option>
                    <option value="2">Quảng cáo hot 1</option>
                    <option value="3">Quảng cáo hot 2</option>
                    <option value="4">Quảng cáo khuyến mãi 1</option>
                    <option value="5">Quảng cáo khuyến mãi 2</option>
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <label for="image_url" class="form-label col-2">Hỉnh ảnh</label>
            <div class="col-10">
                <input type="file" name="image_url[]" id="image_url" multiple class="form-control" accept="image/*" required>
            </div>
        </div>
        <div class="mt-2">
            <button class="offset-2 btn btn-primary">Thêm</button>
            <a href="/manage/banner" class="btn btn-outline-primary">Quay lại</a>
        </div>
    </form>
</div>
@stop