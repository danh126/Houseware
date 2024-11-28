@extends('shared.admin')
@section('title','Thêm danh mục | GDX')
@section('content')
<div class="container-fluid">
    <h1 class="text-center">Thêm danh mục sản phẩm</h1>
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-2">
            <label for="parent" class="form-label col-2">Danh mục cha</label>
            <div class="col-7">
                <select name="parent" id="parent" class="form-select">
                    <option value="0">Không có danh mục cha</option>
                    @foreach($crr as $v)
                    <option value="{{$v->id}}" style="color: red;">{{$v->name}}</option>
                    @if($v->children)
                    @foreach($v->children as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label for="name" class="form-label col-2">Tên danh mục</label>
            <div class="col-7">
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="icon" class="form-label col-2">Icon danh mục</label>
            <div class="col-7">
                <input type="file" name="f" id="icon" class="form-control" accept="image/*">
            </div>
        </div>
        <div class="mt-2">
            <button class="offset-2 btn btn-primary">Thêm danh mục</button>
            <a href="/manage/category" class="btn btn-outline-primary">Quay lại</a>
        </div>
    </form>
</div>
@stop