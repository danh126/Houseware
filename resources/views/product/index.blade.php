@extends('shared.admin')
@section('title','Danh sách sản phẩm | GDX')
@section('content')
<div class="container">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/manage">Trang chủ</a></li>
        <li class="breadcrumb-item active">Sản phẩm</li>
    </ol>

    <a class="mt-2 mb-2 btn btn-primary" href="/manage/product/add">Thêm sản phẩm</a>
    <a class="mt-2 mb-2 btn btn-success" href="/manage/product">Làm mới</a>

    <!-- Form tìm kiếm -->
    <form action="" method="GET" class="d-flex justify-content-end mb-3">
        <input type="text" name="search" value="{{$_GET['search'] ?? null}}" class="form-control w-25" placeholder="Tìm kiếm sản phẩm...">
        <button type="submit" class="btn btn-primary ms-2">Tìm kiếm</button>
    </form>

    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($products[0] == null)
    <div class="alert alert-danger">
        Không có sản phẩm nào!
    </div>
    @endif

    <table class="table table-bordered">
        <thead class="table-info">
            <tr>
                <th>ID sản phẩm</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá bán</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $v)
            <tr>
                <td class="text-center">{{$v->id}}</td>
                @foreach($crr as $c)
                @if($c->id == $v['categoryId'])
                <td class="text-truncate" style="max-width: 180px;">{{$c->name}}</td>
                @endif
                @endforeach
                @foreach($brr as $b)
                @if($b->id == $v['brandId'])
                <td>{{$b->brandName}}</td>
                @endif
                @endforeach
                <td class="text-truncate" style="max-width: 350px;">{{$v->productName}}</td>
                <td>
                    <img src="/image/product/{{$v->imageUrl}}" alt="{{$v->productName}}" class="img-thumbnail" width="100">
                </td>
                <td class="text-center">{{$v->quantity}}</td>
                <td class="text-center">{{formatMoney($v->price)}}</td>
                <td>
                    <a class="btn btn-primary" href="/manage/product/edit/{{$v->id}}">Cập nhật</a>
                    <a class="btn btn-danger" href="/manage/product/delete">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        <div class="ms-auto">
            {{$products->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>
@stop