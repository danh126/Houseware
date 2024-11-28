@extends('shared.layout')
@section('title','Sản phẩm yêu thích | GDX')
@section('content')
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li>Tài khoản</li>
        <li>Sản phẩm yêu thích</li>
    </ul>

    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
            <h2 class="title">Sản phẩm yêu thích</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td class="text-center">Hình ảnh</td>
                            <td class="text-left">Tên sản phẩm</td>
                            <td class="text-left">Thương hiệu</td>
                            <td class="text-right">Giá bán</td>
                            <td class="text-right">Tác vụ</td>
                        </tr>
                    </thead>
                    <tbody id="wishlist">
                        @foreach($wishlist as $v)
                        <tr v="{{$v->product_id}}">
                            <td class="text-center">
                                <a href="/chi-tiet-san-pham-p{{$v->product_id}}"><img width="50px" src="/image/product/{{$v->imageUrl}}" alt="{{$v->productName}}" title="{{$v->productName}}">
                                </a>
                            </td>
                            <td class="text-left"><a href="/chi-tiet-san-pham-p{{$v->product_id}}">{{$v->productName}}</a>
                            </td>
                            <td class="text-left">{{$v->brandName}}</td>
                            <td class="text-right">
                                <div class="price"> <span class="price-new">{{formatMoney($v->price)}}</span></div>
                            </td>
                            <td class="text-right">
                                <button class="btn btn-primary addToCart"
                                    data-toggle="tooltip"
                                    onclick="cart.add('{{$v->product_id}}', '1','{{$v->price * 0.9}}','{{$v->productName}}','{{$v->imageUrl}}');"
                                    type="button" data-original-title="Thêm vào giỏ hàng"><i class="fa fa-shopping-cart"></i>
                                </button>
                                <button class="btn btn-danger delWishList" data-toggle="tooltip" data-original-title="Xóa"><i class="fa fa-times"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!--Middle Part End-->
        <aside class="col-sm-3 hidden-xs" id="column-right">
            <h2 class="subtitle">Tài khoản</h2>
            <div class="list-group">
                <ul class="list-item">
                    <li><a href="/tai-khoan/thong-tin-tai-khoan">Thông tin tài khoản</a>
                    </li>
                    <li><a href="/tai-khoan/don-dat-hang">Đơn đặt hàng</a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</div>
<!-- //Main Container -->
@stop