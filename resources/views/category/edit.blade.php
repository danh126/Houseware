@extends('shared.admin')
@section('title','Cập nhật danh mục | GDX')
@section('content')
<div class="container-fluid">
    <h1 class="text-center">Cập nhật danh mục sản phẩm</h1>
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-2">
            <label for="parent" class="form-label col-2">Danh mục cha</label>
            <div class="col-7">
                <select name="parent" id="parent" class="form-select" disabled>
                    <option value="0">Không có danh mục cha</option>
                    @foreach($crr as $v)
                    @if($v->id == $o->parent)
                    <option value="{{$v->id}}" selected>{{$v->name}}</option>
                    @else
                    <option value="{{$v->id}}" style="color: red;">{{$v->name}}</option>
                    @if($v->children)
                    @foreach($v->children as $c)
                    @if($c->id == $o->parent)
                    <option value="{{$c->id}}" selected>{{$c->name}}</option>
                    @else
                    <option value="{{$c->id}}">{{$c->name}}</option>
                    @endif
                    @endforeach
                    @endif
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label for="name" class="form-label col-2">Tên danh mục</label>
            <div class="col-7">
                <input type="text" name="name" value="{{$o->name}}" id="name" class="form-control" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="icon" class="form-label col-2">Icon danh mục</label>
            <div class="col-7">
                <img src="/image/category-icon/{{$o->iconUrl}}" alt="Icon danh mục sản phẩm" width="100" class="img-thumbnail">
                <input type="file" name="f" id="icon" class="form-control mt-1" accept="image/*">
            </div>
        </div>
        <div class="mt-2">
            <button class="offset-2 btn btn-primary">Cập nhật danh mục</button>
            <a href="/manage/category" class="btn btn-outline-primary">Quay lại</a>
        </div>
    </form>
</div>
@stop