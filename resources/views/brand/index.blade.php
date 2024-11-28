@extends('shared.admin')
@section('title','Danh sách thương hiệu | GDX')
@section('content')
<div class="container">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/manage">Trang chủ</a></li>
        <li class="breadcrumb-item active">Thương hiệu</li>
    </ol>

    <a class="mt-2 mb-2 btn btn-primary" href="/manage/brand/add">Thêm thương hiệu</a>
    <a class="mt-2 mb-2 btn btn-success" href="/manage/brand">Làm mới</a>

    <!-- Form tìm kiếm -->
    <form action="" method="GET" class="d-flex justify-content-end mb-3">
        <input type="text" name="search" value="{{$_GET['search'] ?? null}}" class="form-control w-25"
            placeholder="Tìm kiếm thương hiệu...">
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
                <th>ID thương hiệu</th>
                <th>Tên thương hiệu</th>
                <th>Mô tả</th>
                <th>Logo</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $a)
            <tr>
                <td>{{$a->id}}</td>
                <td>{{$a->brandName}}</td>
                <td>{{$a->description}}</td>
                <td>
                    <img src="/image/brands/{{$a->brandLogo}}" width="100" class="img-thumbnail" alt="{{$a->brandName}}">
                </td>
                <td>
                    <a class="btn btn-primary" href="/manage/brand/edit/{{$a->id}}">Cập nhật</a>
                    <a class="btn btn-danger" href="">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        <div class="ms-auto">
            {{$brands->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>
@stop