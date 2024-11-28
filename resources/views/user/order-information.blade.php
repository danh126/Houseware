@extends('shared.layout')
@section('title','Thông tin đơn hàng | GDX')
@section('content')
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i></a></li>
        <li>Tài khoản</li>
        <li>Thông tin đơn hàng</li>
        <li>#{{$o[0]->order_id}}</li>
    </ul>

    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
            <h2 class="title">Thông tin đơn hàng</h2>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td colspan="2" class="text-left">Chi tiết đơn hàng</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 50%;" class="text-left"> <b>Mã đơn hàng:</b> #{{$o[0]->order_id}}
                            <br>
                            <b>Ngày đặt:</b> {{$o[0]->created_at->format('d/m/Y')}}
                        </td>
                        <td style="width: 50%;" class="text-left"> <b>Hình thức thanh toán:</b> Thanh toán khi nhận hàng
                            <br>
                            <b>Hình thức vận chuyển:</b> Vận chuyển nhanh
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="tracking">
                <div class="track">
                    <div class="step"> <span class="icon" v="1"> <i class="fa fa-check"></i> </span> <span class="text">Đang xử lý</span> </div>
                    <div class="step"> <span class="icon" v="2"> <i class="fa fa-user"></i> </span> <span class="text">Chờ đơn vị vận chuyển</span> </div>
                    <div class="step"> <span class="icon" v="3"> <i class="fa fa-truck"></i> </span> <span class="text">Đang vận chuyển</span> </div>
                    <div class="step"> <span class="icon" v="4"> <i class="fa fa-archive"></i> </span> <span class="text">Tiến hành giao hàng</span> </div>
                    <div class="step"> <span class="icon" v="5"> <i class="fa fa-home"></i></i> </span> <span class="text">Đã giao</span> </div>
                </div>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td style="width: 50%; vertical-align: top;" class="text-left">Địa chỉ giao hàng</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left">{{$o[0]->address}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td class="text-center">Hình ảnh</td>
                            <td class="text-left">Tên sản phẩm</td>
                            <td class="text-left">Thương hiệu</td>
                            <td class="text-center">Số lượng</td>
                            <td class="text-right">Tổng tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($o as $v)
                        <tr>
                            <td class="text-center">
                                <img width="50" class="img-thumbnail" title="{{$v->productName}}" alt="{{$v->productName}}" src="/image/product/{{$v->imageUrl}}">
                            </td>
                            <td class="text-left">{{$v->productName}}</td>
                            <td class="text-left">{{$v->brandName}}</td>
                            <td class="text-right">{{$v->quantity}}</td>
                            <td class="text-right">{{formatMoney($v->price)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Tạm tính</b>
                            </td>
                            <td class="text-right">{{formatMoney($subTotal)}}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Phí vận chuyển</b>
                            </td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Giảm giá</b>
                            </td>
                            <td class="text-right">- {{formatMoney($o[0]->order_discount)}}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Tổng đơn hàng</b>
                            </td>
                            <td class="text-right">{{formatMoney($o[0]->total_amount)}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="buttons clearfix">
                <div class="pull-right">
                    <button class="btn btn-md btn-danger btnCancel" data-orderId="{{$o[0]->order_id}}">Hủy đơn hàng</button>
                    <a href="/tai-khoan/don-dat-hang" class="btn btn-md btn-primary">Quay lại</a>
                </div>
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
<script src="/js/user/orders.js"></script>
<script>
    let status = <?= $o[0]->status ?>;
    statusApply(status);
</script>
@stop