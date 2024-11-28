@extends('shared.admin')
@section('title','Cập nhật thương hiệu | GDX')
@section('content')
<div class="container-fluid">
    <h1 class="text-center mt-2 mb-2">Cập nhật thương hiệu</h1>
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <label for="brandName" class="form-label col-2">Tên thương hiệu</label>
            <div class="col-10">
                <input type="text" name="brandName" value="{{$o->brandName}}" id="brandName" class="form-control">
            </div>
        </div>
        <div class="row mt-2">
            <label for="description" class="form-label col-2">Mô tả</label>
            <div class="col-10">
                <textarea name="description" id="description" class="form-control">{{$o->description}}</textarea>
            </div>
        </div>
        <div class="row mt-2">
            <label for="logo" class="form-label col-2">Logo</label>
            <div class="col-10">
                <img src="/image/brands/{{$o->brandLogo}}" width="100" class="mt-2 mb-2 img-thumbnail" alt="{{$o->brandName}}">
                <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
            </div>
        </div>
        <div class="mt-2">
            <button class="offset-2 btn btn-primary">Cập nhật</button>
            <a href="/manage/brand" class="btn btn-outline-primary">Quay lại</a>
        </div>
    </form>
</div>
@stop