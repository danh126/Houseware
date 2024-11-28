@extends('shared.layout')
@section('title','Giỏ hàng | GDX')
@section('content')
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i></a></li>
        <li>Giỏ hàng của bạn</li>
    </ul>

    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
            <h2 class="title">Giỏ hàng</h2>
            <div class="table-responsive form-group">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center">Hình ảnh</td>
                            <td class="text-left">Tên sản phẩm</td>
                            <td class="text-left">Thương hiệu</td>
                            <td class="text-left">Số lượng</td>
                            <td class="text-right">Giá bán</td>
                            <td class="text-right">Tổng tiền</td>
                            <td class="text-right"></td>
                        </tr>
                    </thead>
                    <tbody id="cart">
                        @if(isset($cart))
                        @foreach($cart as $c)
                        <tr v="{{$c->id_product}}">
                            <td class="text-center"><a href="/chi-tiet-san-pham-p{{$c->id_product}}"><img width="70px"
                                        src="/image/product/{{$c->imageUrl}}"
                                        alt="{{$c->productName}}"
                                        title="{{$c->productName}}" class="img-thumbnail" /></a>
                            </td>
                            <td class="text-left"><a href="/chi-tiet-san-pham-p{{$c->id_product}}">{{$c->productName}}</a></td>
                            <td class="text-left">{{$c->brandName}}</td>
                            <td class="text-left" width="200px">
                                <div class="input-group quantity-control" id="quantity">
                                    <input class="form-control" type="text" name="quantity" value="{{$c->quantity}}">
                                    <span class="updateQuantity btn btn-primary input-group-addon product_quantity_down">−</span>
                                    <span class="updateQuantity btn btn-primary input-group-addon product_quantity_up">+</span>
                                </div>
                            </td>
                            <td class="text-right">{{formatMoney($c->price)}}</td>
                            <td class="text-right" id="total-product">{{formatMoney($c->price * $c->quantity)}}</td>
                            <td class="text-center"><button class="btn btn-danger clearCart">X</button></td>
                            <input type="hidden" name="total" value="{{$c->price * $c->quantity}}">
                            <input type="hidden" name="price" value="{{$c->price}}">
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-4 col-sm-offset-8">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-right">
                                    <strong>Số lượng:</strong>
                                </td>
                                <td class="text-right countProducts"></td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <strong>Tạm tính:</strong>
                                </td>
                                <td class="text-right total-sub"></td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <strong>Tổng tiền:</strong>
                                </td>
                                <td class="text-right total"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="buttons">
                <div class="pull-left"><a href="/" class="btn btn-primary">Tiếp tục mua hàng</a>
                </div>
                <div class="pull-right"><button class="btn btn-primary checkout">Đặt hàng</button></div>
            </div>
        </div>
        <!--Middle Part End -->
    </div>
</div>
<!-- //Main Container -->
@stop