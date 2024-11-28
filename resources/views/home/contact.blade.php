@extends('shared.layout')
@section('title','Liên hệ | GDX')
@section('content')
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i></a></li>
        <li>Liên hệ</li>
    </ul>

    <div class="row">
        <div id="content" class="col-sm-12">
            <div class="page-title">
                <h2>Liên hệ</h2>
            </div>

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15686.694058152832!2d106.66120639098062!3d10.604679023878242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317536d711fcbf8d%3A0x89b7b2cc34fd9559!2zdHQuIEPhuqduIEdpdeG7mWMsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgTG9uZyBBbiwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1731910038065!5m2!1svi!2s" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
            <div class="info-contact clearfix">
                <div class="col-lg-4 col-sm-4 col-xs-12 info-store">
                    <div class="row">
                        <div class="name-store">
                            <h3>Gia Dụng Xanh</h3>
                        </div>
                        <address>
                            <div class="address clearfix form-group">
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <div class="text">39 QL50, Thị trấn Cần Giuộc, Cần Giuộc, Long An.</div>
                            </div>
                            <div class="phone form-group">
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="text">Điện thoại : 0123456789</div>
                            </div>
                            <div class="comment text-justify">
                                Website đồ gia dụng của chúng tôi cung cấp một trải nghiệm mua sắm tiện lợi và đa dạng, với các sản phẩm chất lượng cao từ các thương hiệu uy tín.
                                Tại đây, bạn có thể dễ dàng tìm thấy các mặt hàng gia dụng như nồi cơm điện, máy xay sinh tố,
                                quạt điện, tủ lạnh, và nhiều thiết bị khác phục vụ cho nhu cầu sinh hoạt hàng ngày.
                                Chúng tôi cam kết đem lại cho khách hàng những sản phẩm chính hãng, giá cả hợp lý và dịch vụ
                                chăm sóc khách hàng tận tâm. Với giao diện thân thiện và các phương thức thanh toán linh hoạt,
                                website của chúng tôi là lựa chọn lý tưởng để bạn trang bị cho gia đình những sản phẩm tiện ích
                                và hiện đại nhất.
                            </div>
                        </address>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-8 col-xs-12 contact-form">
                    <div class="form-horizontal">
                        <fieldset>
                            <legend>Thông tin liên hệ</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-name">Tên khách hàng</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="" id="input-name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-email">Địa chỉ E-Mail</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" value="" id="input-email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-enquiry">Nội dung</label>
                                <div class="col-sm-10">
                                    <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <div class="buttons">
                            <div class="pull-right">
                                <button class="btn btn-primary">
                                    <span>Gửi yêu cầu</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //Main Container -->
@stop