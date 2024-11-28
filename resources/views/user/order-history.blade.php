@extends('shared.layout')
@section('title','Đơn đặt hàng | GDX')
@section('content')
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li>Tài khoản</li>
        <li>Đơn đặt hàng</li>
    </ul>

    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
            <h2 class="title">Đơn hàng của bạn</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td class="text-center">Hình ảnh</td>
                            <td class="text-left">Tên sản phẩm</td>
                            <td class="text-center">Mã đơn hàng</td>
                            <td class="text-center">Số lượng</td>
                            <td class="text-center">Trạng thái</td>
                            <td class="text-center">Ngày đặt</td>
                            <td class="text-right">Tổng tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody id="order-history">
                        @foreach($orders as $v)
                        <tr>
                            <td class="text-center">
                                <a href="product.html"><img width="85" class="img-thumbnail" title="{{$v->productName}}" alt="{{$v->productName}}" src="/image/product/{{$v->imageUrl}}">
                                </a>
                            </td>
                            <td class="text-left"><a href="product.html">{{$v->productName}}</a>
                            </td>
                            <td class="text-center">#{{$v->order_id}}</td>
                            <td class="text-center">{{$v->quantity}}</td>
                            <td class="text-center">{{$v->status}}</td>
                            <td class="text-center">{{$v->created_at->format('d/m/Y')}}</td>
                            <td class="text-right">{{formatMoney($v->total_amount)}}</td>
                            <td class="text-center">
                                <a class="btn btn-info" data-toggle="tooltip" href="/tai-khoan/chi-tiet-don-hang-id={{$v->order_id}}" data-original-title="Chi tiết"><i class="fa fa-eye"></i></a>
                                </br>&nbsp;
                                <a class="btn btn-danger" title="" data-toggle="tooltip" href="/chi-tiet-san-pham-p{{$v->product_id}}" data-original-title="Mua lại"><i class="fa fa-shopping-cart"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <!--Middle Part End-->
        <!--Right Part Start -->
        <aside class="col-sm-3 hidden-xs" id="column-right">
            <h2 class="subtitle">Tài khoản</h2>
            <div class="list-group">
                <ul class="list-item">
                    <li><a href="/tai-khoan/thong-tin-tai-khoan">Thông tin tài khoản</a>
                    </li>
                    <li><a href="/tai-khoan/san-pham-yeu-thich">Sản phẩm yêu thích</a>
                    </li>
                    <li><a href="/tai-khoan/don-dat-hang">Đơn đặt hàng</a>
                    </li>
                </ul>
            </div>
        </aside>
        <!--Right Part End -->
    </div>
</div>
<!-- //Main Container -->
@stop

@section('script')
<script>
    let itemOrder = $('#order-history').children('tr');
    let quantity = itemOrder.length;

    if (quantity === 0) {
        let messsage = 'Bạn chưa có đơn đặt hàng nào!';
        $('#order-history').append(`
            <tr>
                <td colspan="8" class="text-center">${messsage}</td>
            </tr>
        `);
    }
</script>
@stop