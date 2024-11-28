@extends('shared.admin')
@section('title','Danh sách quảng cáo | GDX')
@section('content')
<div class="container">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/manage">Trang chủ</a></li>
        <li class="breadcrumb-item active">Quảng cáo</li>
    </ol>

    <a class="mb-2 btn btn-primary" href="/manage/banner/add">Thêm quảng cáo</a>
    <a class="mb-2 btn btn-success" href="/manage/banner">Làm mới</a>

    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <table class="table table-bordered">
        <thead class="table-info">
            <tr>
                <th>Loại quảng cáo</th>
                <th>Hình ảnh</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banner as $v)
            <tr>
                <td>{{$v->banner_type}}</td>
                <td>
                    <img src="/image/banner/{{$v->image_url}}" width="100" class="img-thumbnail" alt="banner">
                </td>
                <td>
                    <a class="btn btn-primary" href="/manage/banner/edit/{{$v->id}}">Cập nhật</a>
                    <a class="btn btn-danger" href="">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex">
        <div class="ms-auto">
            {{$banner->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>
@stop