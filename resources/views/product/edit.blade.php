@extends('shared.admin')
@section('title','Cập nhật sản phẩm | GDX')
@section('content')
<div class="container-fluid">
    <h1 class="text-center">Cập nhật sản phẩm</h1>
    <!-- Hiển thị thông báo lỗi -->
    @error('product_edit')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    <form method="post" action="/manage/product/doEdit" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <input type="hidden" name="id" value="{{$o->id}}">

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
                <input type="text" name="productName" value="{{$o->productName}}" id="productName" class="form-control" required>
            </div>
        </div>
        <div class="row mt-2">
            <label for="description" class="form-label col-2">Mô tả</label>
            <div class="col-10">
                <textarea name="description" id="description" class="form-control">{{$o->description}}</textarea>
            </div>
        </div>
        <div class="row mt-2">
            <label for="f" class="form-label col-2">Ảnh bìa</label>
            <div class="col-10">
                <img src="/image/product/{{$o->imageUrl}}" width="150" class="mt-2 mb-2 img-thumbnail" alt="{{$o->productName}}">
                <input type="file" name="f" id="f" class="form-control" accept="image/*">
                <input type="hidden" name="imageUrl" value="{{$o->imageUrl}}">
            </div>
        </div>
        <div class="row mt-2">
            <label for="imageProduct" class="form-label col-2">Hình ảnh chi tiết</label>
            <div class="col-10">
                @foreach($images as $img)
                <img src="/image/product/{{$img->imageUrl}}" width="150" class="mt-2 mb-2 img-thumbnail" alt="{{$o->productName}}">
                @endforeach
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
                            <input type="text" name="values[]" value="{{$v->value}}" id="attr" class="form-control">
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row mt-2">
            <label for="quantity" class="form-label col-2">Số lượng</label>
            <div class="col-10">
                <input type="number" name="quantity" value="{{$o->quantity}}" id="quantity" class="form-control" required>
            </div>
        </div>
        <div class="row mt-2">
            <label for="price" class="form-label col-2">Giá bán</label>
            <div class="col-10">
                <input type="number" name="price" value="{{$o->price}}" id="price" class="form-control" required>
            </div>
        </div>
        <div class="mt-2 mb-2">
            <button class="offset-2 btn btn-primary">Cập nhật</button>
            <a href="/manage/product" class="btn btn-outline-primary">Quay lại</a>
        </div>
    </form>
</div>
@stop
@section('script')
<script>
    let categoryId = <?= $o->categoryId ?>;
    let brandId = <?= $o->brandId ?>;

    $('#category option').each(function() {
        if ($(this).val() == categoryId) {
            $(this).prop('selected', true);
        }
    });

    $('#brand option').each(function() {
        if ($(this).val() == brandId) {
            $(this).prop('selected', true);
        }
    });
</script>
@stop