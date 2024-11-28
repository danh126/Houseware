@extends('shared.admin')
@section('title','Danh sách danh mục sản phẩm | GDX')
@section('content')
<div class="container">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/manage">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh mục sản phẩm</li>
    </ol>

    <a class="btn btn-primary" href="/manage/category/add">Thêm danh mục</a>
    <a class="btn btn-success" href="/manage/category">Làm mới</a>

    <!-- Form tìm kiếm -->
    <form action="" method="GET" class="d-flex justify-content-end mb-3">
        <input type="text" name="search" value="{{$_GET['search'] ?? null}}" class="form-control w-25"
            placeholder="Tìm kiếm danh mục sản phẩm...">
        <button type="submit" class="btn btn-primary ms-2">Tìm kiếm</button>
    </form>

    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-bordered">
        <thead class="table-info">
            <tr>
                <th>ID danh mục</th>
                <th>Tên danh mục</th>
                <th>Danh mục cha</th>
                <th>Icon</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($crr as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->parent}}</td>
                <td>
                    <img src="/image/category-icon/{{$v->iconUrl}}" alt="icon danh mục" class="img-thumbnail" width="100">
                </td>
                <td>
                    <a class="btn btn-primary" href="/manage/category/edit/{{$v->id}}">Cập nhật</a>
                    <a class="btn btn-danger" href="/manage/category/delete">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        <div class="ms-auto">
            {{$crr->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>
@stop