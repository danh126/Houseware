@extends('shared.layout')
@section('title','Chi tiết sản phẩm | GDX')
@section('content')
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i></a></li>
        <li><a href="/danh-muc-san-pham-c{{$category->id}}">{{$category->name}}</a></li>
        <li>{{$o->productName}}</li>
    </ul>

    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-md-12 col-sm-12">
            <div class="product-view row">
                <div class="left-content-product col-lg-12 col-xs-12">
                    <div class="row">
                        <div class="content-product-left class-honizol col-sm-6 col-xs-12 ">
                            <div class="large-image  ">
                                <img itemprop="image" class="product-image-zoom"
                                    src="/image/product/{{$o->imageUrl}}"
                                    data-zoom-image="/image/product/{{$o->imageUrl}}" title="Bint Beef"
                                    alt="Bint Beef">
                            </div>
                            <div id="thumb-slider" class="owl-theme owl-loaded owl-drag full_slider">
                                <a data-index="{{$o->id}}" class="img thumbnail "
                                    data-image="/image/product/{{$o->imageUrl}}" title="Bint Beef">
                                    <img src="/image/product/{{$o->imageUrl}}" title="Bint Beef" alt="Bint Beef">
                                </a>
                                @foreach($img as $i)
                                <a data-index="{{$i->id}}" class="img thumbnail "
                                    data-image="/image/product/{{$i->imageUrl}}" title="Bint Beef">
                                    <img src="/image/product/{{$i->imageUrl}}" title="Bint Beef" alt="Bint Beef">
                                </a>
                                @endforeach
                            </div>

                        </div>

                        <div class="content-product-right col-sm-6 col-xs-12">
                            <div class="title-product">
                                <h1>{{$o->productName}}</h1>
                            </div>
                            <!-- Review ---->
                            <div class="box-review form-group">
                                <div class="ratings">
                                    <div class="rating-box">
                                        <span class="fa fa-stack"><i
                                                class="fa fa-star-o fa-stack-1x"></i></span>
                                        <span class="fa fa-stack"><i
                                                class="fa fa-star-o fa-stack-1x"></i></span>
                                        <span class="fa fa-stack"><i
                                                class="fa fa-star-o fa-stack-1x"></i></span>
                                        <span class="fa fa-stack"><i
                                                class="fa fa-star-o fa-stack-1x"></i></span>
                                        <span class="fa fa-stack"><i
                                                class="fa fa-star-o fa-stack-1x"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="product-label form-group">
                                <div class="product_page_price price" itemprop="offerDetails" itemscope=""
                                    itemtype="http://data-vocabulary.org/Offer">
                                    <span class="price-new" itemprop="price">{{formatMoney($o->price * 0.9)}}</span>
                                    <span class="price-old">{{formatMoney($o->price)}}</span>
                                </div>
                            </div>

                            <div class="product-box-desc">
                                <div class="inner-box-desc">
                                    <div class="brand"><span>Thương hiệu:</span>&nbsp;<a href="#">{{$brand->brandName}}</a> </div>
                                </div>
                            </div>

                            <div id="product">
                                <div class="form-group box-info-product">
                                    <div class="option quantity">
                                        <div class="input-group quantity-control" id="quantity">
                                            <label>Số lượng</label>
                                            <input class="form-control" type="text" name="quantity" value="1">
                                            <span class="input-group-addon product_quantity_down">−</span>
                                            <span class="input-group-addon product_quantity_up">+</span>
                                        </div>
                                    </div>
                                    <div class="cart">
                                        <input type="button" data-toggle="tooltip" title="" value="Thêm vào giỏ"
                                            data-loading-text="Loading..." id="button-cart"
                                            class="btn btn-mega btn-lg addToCart" onclick="cart.add('{{$o->id}}', $('input[name=\'quantity\']').val(),'{{$o->price * 0.9}}','{{$o->productName}}','{{$o->imageUrl}}');"
                                            data-original-title="Thêm vào giỏ">
                                    </div>
                                    <div class="add-to-links wish_comp">
                                        <ul class="blank list-inline">
                                            <li class="wishlist">
                                                <a class="icon" data-toggle="tooltip" title=""
                                                    onclick="wishlist.add('{{$o->id}}','{{$o->price * 0.9}}','{{$o->productName}}','{{$o->imageUrl}}')"
                                                    data-original-title="Thêm sản phẩm yêu thích"><i
                                                        class="fa fa-heart"></i>
                                                </a>
                                            </li>
                                            <li class="compare">
                                                <a class="icon" data-toggle="tooltip" title=""
                                                    onclick="compare.add('50');"
                                                    data-original-title="Compare this Product"><i
                                                        class="fa fa-exchange"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                            </div>
                            <!-- end box info product -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Attribute -->
            <div class="col-12">
                <h2 class="text-uppercase">Thông tin sản phẩm</h2>
                <table class="table table-striped">
                    @foreach($attr as $v)
                    <tr>
                        <th class="text-left">{{$v->name}}</th>
                        <td>{{$v->value}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <!-- Product Tabs -->
            <div class="producttab ">
                <div class="tabsslider  vertical-tabs col-xs-12">
                    <ul class="nav nav-tabs col-lg-2 col-sm-3">
                        <li class="active"><a data-toggle="tab" href="#tab-1">Mô tả</a></li>
                        <li class="item_nonactive"><a data-toggle="tab" href="#tab-review">Đánh giá (0)</a></li>
                    </ul>
                    <div class="tab-content col-lg-10 col-sm-9 col-xs-12">
                        <div id="tab-1" class="tab-pane fade active in">{{$o->description}}</div>
                        <div id="tab-review" class="tab-pane fade">
                            <!-- <form>
                                <div id="review">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 50%;"><strong>Super Administrator</strong>
                                                </td>
                                                <td class="text-right">29/07/2015</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <p>Best this product opencart</p>
                                                    <div class="ratings">
                                                        <div class="rating-box">
                                                            <span class="fa fa-stack"><i
                                                                    class="fa fa-star fa-stack-1x"></i><i
                                                                    class="fa fa-star-o fa-stack-1x"></i></span>
                                                            <span class="fa fa-stack"><i
                                                                    class="fa fa-star fa-stack-1x"></i><i
                                                                    class="fa fa-star-o fa-stack-1x"></i></span>
                                                            <span class="fa fa-stack"><i
                                                                    class="fa fa-star fa-stack-1x"></i><i
                                                                    class="fa fa-star-o fa-stack-1x"></i></span>
                                                            <span class="fa fa-stack"><i
                                                                    class="fa fa-star fa-stack-1x"></i><i
                                                                    class="fa fa-star-o fa-stack-1x"></i></span>
                                                            <span class="fa fa-stack"><i
                                                                    class="fa fa-star-o fa-stack-1x"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-right"></div>
                                </div>
                                <h2 id="review-title">Write a review</h2>
                                <div class="contacts-form">
                                    <div class="form-group"> <span class="icon icon-user"></span>
                                        <input type="text" name="name" class="form-control" value="Your Name"
                                            onblur="if (this.value == '') {this.value = 'Your Name';}"
                                            onfocus="if(this.value == 'Your Name') {this.value = '';}">
                                    </div>
                                    <div class="form-group"> <span class="icon icon-bubbles-2"></span>
                                        <textarea class="form-control" name="text"
                                            onblur="if (this.value == '') {this.value = 'Your Review';}"
                                            onfocus="if(this.value == 'Your Review') {this.value = '';}">Your Review</textarea>
                                    </div>
                                    <span style="font-size: 11px;"><span class="text-danger">Note:</span> HTML
                                        is not translated!</span>

                                    <div class="form-group">
                                        <b>Rating</b> <span>Bad</span>&nbsp;
                                        <input type="radio" name="rating" value="1"> &nbsp;
                                        <input type="radio" name="rating" value="2"> &nbsp;
                                        <input type="radio" name="rating" value="3"> &nbsp;
                                        <input type="radio" name="rating" value="4"> &nbsp;
                                        <input type="radio" name="rating" value="5"> &nbsp;<span>Good</span>

                                    </div>
                                    <div class="buttons clearfix"><a id="button-review"
                                            class="btn buttonGray">Continue</a></div>
                                </div>
                            </form> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- //Product Tabs -->

            <!-- Related Products -->
            <div class="related titleLine products-list grid module ">
                <h3 class="modtitle">Sản phẩm liên quan </h3>
                <div class="releate-products ">
                    @foreach($arr as $v)
                    <div class="product-layout">
                        <div class="product-item-container">
                            <div class="left-block">
                                <div class="product-image-container second_img ">
                                    <img src="/image/product/{{$v->imageUrl}}" title="{{$v->productName}}"
                                        class="img-responsive" />
                                    <img src="/image/product/{{$v->imageUrl}}" title="{{$v->productName}}"
                                        class="img_0 img-responsive" />
                                </div>
                                <!--Sale Label-->
                                <span class="label label-sale">Sale</span>
                                <!--full quick view block-->
                                <a class="quickview iframe-link visible-lg" data-fancybox-type="iframe"
                                    href="/xem-nhanh-san-pham/{{$v->id}}"> Xem nhanh</a>
                                <!--end full quick view block-->
                            </div>


                            <div class="right-block">
                                <div class="caption">
                                    <h4><a style="max-width: 230px; display: inline-block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;" href="/chi-tiet-san-pham-p{{$v->id}}">{{$v->productName}}</a></h4>
                                    <div class="ratings">
                                        <div class="rating-box">
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i
                                                    class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i
                                                    class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i
                                                    class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i
                                                    class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i
                                                    class="fa fa-star-o fa-stack-1x"></i></span>
                                        </div>
                                    </div>

                                    <div class="price">
                                        <span class="price-new">{{formatMoney($v->price * 0.9)}}</span>
                                        <span class="price-old">{{formatMoney($v->price)}}</span>
                                        <span class="label label-percent">-10%</span>
                                    </div>
                                </div>

                                <div class="button-group">
                                    <button class="addToCart" type="button" data-toggle="tooltip"
                                        title="Thêm vào giỏ" onclick="cart.add('{{$v->id}}', '1','{{$v->price * 0.9}}','{{$v->productName}}','{{$v->imageUrl}}');"><i
                                            class="fa fa-shopping-cart"></i> <span class="hidden-xs">Thêm vào giỏ</span></button>
                                    <button class="wishlist" type="button" data-toggle="tooltip"
                                        title="Thêm sản phẩm yêu thích" onclick="wishlist.add('{{$v->id}}','{{$v->price * 0.9}}','{{$v->productName}}','{{$v->imageUrl}}');"><i
                                            class="fa fa-heart"></i></button>
                                    <button class="compare" type="button" data-toggle="tooltip"
                                        title="Compare this Product" onclick="compare.add('42');"><i
                                            class="fa fa-exchange"></i></button>
                                </div>
                            </div><!-- right block -->

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- end Related  Products-->
        </div>
    </div>
    <!--Middle Part End-->
</div>
<!-- //Main Container -->
@stop
@section('script')
<script type="text/javascript" src="/js/themejs/addtocart.js"></script>
@stop