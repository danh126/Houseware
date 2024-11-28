@extends('shared.admin')
@section('title','Thêm thương hiệu | GDX')
@section('content')
<div class="container-fluid">
    <h1 class="text-center mt-2 mb-2">Thêm thương hiệu</h1>
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <label for="brandName" class="form-label col-2">Tên thương hiệu</label>
            <div class="col-10">
                <input type="text" name="brandName" id="brandName" class="form-control">
            </div>
        </div>
        <div class="row mt-2">
            <label for="description" class="form-label col-2">Mô tả</label>
            <div class="col-10">
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
        </div>
        <div class="row mt-2">
            <label for="logo" class="form-label col-2">Logo</label>
            <div class="col-10">
                <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
            </div>
        </div>
        <div class="mt-2">
            <button class="offset-2 btn btn-primary">Thêm</button>
            <a href="/manage/brand" class="btn btn-outline-primary">Quay lại</a>
        </div>
    </form>
</div>
@stop