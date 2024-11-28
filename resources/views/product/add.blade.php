@extends('shared.admin')
@section('title','Thêm sản phẩm | GDX')
@section('content')
<div class="container-fluid">
    <h1 class="text-center">Thêm sản phẩm</h1>
    <!-- Hiển thị thông báo lỗi -->
    @error('product_add')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <label for="cat" class="form-label col-2">Tên danh mục</label>
            <div class="col-10">
                <select name="categoryId" id="category" class="form-select">
                    @foreach($crr as $v)
                    <option value="{{$v->id}}" id="category" disabled class="text-danger">{{$v->name}}</option>
                    @if($v->children)
                    @foreach($v->children as $c)
                    <option value="{{$c->id}}" class="text-info" disabled id="category">{{$c->name}}</option>
                    @if($c->children)
                    @foreach($c->children as $d)
                    <option value="{{$d->id}}" id="category">{{$d->name}}</option>
                    @endforeach
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <label for="brand" class="form-label col-2">Tên thương hiệu</label>
            <div class="col-10">
                <select name="brandId" id="brand" class="form-select">
                    @foreach($brr as $v)
                    <option value="{{$v->id}}">{{$v->brandName}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <label for="productName" class="form-label col-2">Tên sản phẩm</label>
            <div class="col-10">
                <input type="text" name="productName" id="productName" class="form-control" required>
            </div>
        </div>
        <div class="row mt-2">
            <label for="description" class="form-label col-2">Mô tả</label>
            <div class="col-10">
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
        </div>
        <div class="row mt-2">
            <label for="f" class="form-label col-2">Ảnh bìa</label>
            <div class="col-10">
                <input type="file" name="f" id="f" class="form-control" accept="image/*" required>
            </div>
        </div>
        <div class="row mt-2">
            <label for="imageProduct" class="form-label col-2">Hình ảnh chi tiết</label>
            <div class="col-10">
                <input type="file" name="imageProduct[]" id="imageProduct" multiple class="form-control" accept="image/*">
            </div>
        </div>
        <div class="row mt-2">
            <label for="attr" class="form-label col-2">Thông tin sản phẩm</label>
            <div class="col-10">
                <table class="table table-bordered">
                    @foreach($attr as $v)
                    <tr>
                        <td>{{$v->name}}</td>
                        <td>
                            <input type="hidden" name="ids[]" value="{{$v->id}}">
                            <input type="text" name="values[]" id="attr" class="form-control">
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row mt-2">
            <label for="quantity" class="form-label col-2">Số lượng</label>
            <div class="col-10">
                <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>
        </div>
        <div class="row mt-2">
            <label for="price" class="form-label col-2">Giá bán</label>
            <div class="col-10">
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
        </div>
        <div class="mt-2 mb-2">
            <button class="offset-2 btn btn-primary">Thêm sản phẩm</button>
            <a href="/manage/product" class="btn btn-outline-primary">Quay lại</a>
        </div>
    </form>
</div>
@stop