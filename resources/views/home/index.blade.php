@extends('shared.layout')
@section('title','Gia Dụng Xanh | GDX')
@section('content')

<!-- //Block Spotlight1  -->
<section class="so-spotlight1">
    <div class="container">
        <div class="row">
            <div id="yt_header_left" class="col-md-9 col-md-12">
                <div class="slider-container ">
                    <div id="so-slideshow">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="4000">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                @foreach($banner_top as $index => $v)
                                <li data-target="#myCarousel" data-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @foreach($banner_top as $index => $v)
                                <div class="item @if($loop->first) active @endif">
                                    <a href="#"><img src="/image/banner/{{$v->image_url}}" style="height: 400px;" alt="slider{{ $index }}" class="img-responsive"></a>
                                </div>
                                @endforeach
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!-- 
                        <div class="loadeding"></div> -->
                    </div>

                </div>
            </div>
            <div id="yt_header_right" class="col-md-3 hidden-sm hidden-xs">
                <div class="module ">
                    <div class="modcontent clearfix">
                        <div id="so_deals_308741472747190"
                            class="so-deal preset00-1 preset01-1 preset02-1 preset03-1 preset04-1 button-type1 grid">
                            <div class="extraslider-inner grid">
                                <div class="ltabs-item product-layout">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img ">
                                                <img src="/image/product/{{$itemRandom->imageUrl}}"
                                                    alt="{{$itemRandom->productName}}" class="img-responsive" />
                                                <img src="/image/product/{{$itemRandom->imageUrl}}"
                                                    alt="{{$itemRandom->productName}}" class="img_0 img-responsive" />
                                            </div>
                                            <!--Sale Label-->
                                            <span class="label label-sale">-30%</span>
                                            <!--countdown box-->
                                            <div class="countdown_box">
                                                <div class="countdown_inner">
                                                    <div class="title">Ưu đãi có hạn kết thúc sau</div>

                                                    <div class="defaultCountdown-30"></div>
                                                </div>
                                            </div>
                                            <!--end countdown box-->
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4 style="max-width: 230px; display: inline-block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                                    <a href="/chi-tiet-san-pham-p{{$itemRandom->id}}">{{$itemRandom->productName}}</a>
                                                </h4>
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

                                                <div class="price">
                                                    <span class="price-new">{{formatMoney($itemRandom->price * 0.7)}}</span>
                                                    <span class="price-old">{{formatMoney($itemRandom->price)}}</span>
                                                </div>
                                            </div>

                                            <div class="button-group">
                                                <button class="addToCart" type="button" data-toggle="tooltip"
                                                    title="Thêm vào giỏ" onclick="cart.add('{{$itemRandom->id}}', '1','{{$itemRandom->price * 0.7}}','{{$itemRandom->productName}}','{{$itemRandom->imageUrl}}');"><i
                                                        class="fa fa-shopping-cart"></i> <span
                                                        class="hidden-xs">Thêm vào giỏ</span></button>
                                                <button class="wishlist" type="button" data-toggle="tooltip"
                                                    title="Thêm sản phẩm yêu thích" onclick="wishlist.add('{{$itemRandom->id}}','{{$itemRandom->price * 0.7}}','{{$itemRandom->productName}}','{{$itemRandom->imageUrl}}');"><i
                                                        class="fa fa-heart"></i></button>
                                                <button class="compare hidden-md" type="button"
                                                    data-toggle="tooltip" title="So sánh sản phẩm"
                                                    onclick=""><i
                                                        class="fa fa-exchange"></i></button>
                                            </div>
                                        </div><!-- right block -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="banner-html col-sm-12">
                <div class="module customhtml policy-v3">
                    <div class="modcontent clearfix">
                        <div class="block-policy-v3">
                            <div class="policy policy1 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="policy-inner"><span class="ico-policy"></span>
                                    <h2>30 days return</h2><a href="#">money back</a>
                                </div>
                            </div>
                            <div class="policy policy2 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="policy-inner"><span class="ico-policy"></span><a href="#">
                                        <h2>free shipping</h2>on all orders over $99
                                    </a>
                                </div>
                            </div>
                            <div class="policy policy3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="policy-inner"><span class="ico-policy"></span><a href="#">
                                        <h2>lowest price</h2>guarantee
                                    </a>
                                </div>
                            </div>
                            <div class="policy policy4 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="policy-inner"><span class="ico-policy"></span><a href="#">
                                        <h2>safe shopping</h2>guarantee
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- //Block Spotlight1  -->

<!-- Block Spotlight3  -->
<section class="so-spotlight3">
    <div class="container">
        <div class="row">

            <div id="so_categories_173761471880018"
                class="so-categories module titleLine preset01-4 preset02-3 preset03-3 preset04-1 preset05-1">
                <h3 class="modtitle"><img src="/image/icons/hot-icon.png" width="30">&nbsp;Danh mục nổi bật</h3>

                <div class="wrap-categories scroll-fade">
                    <div class="cat-wrap theme3">
                        @foreach($categories as $c)
                        <div class="content-box">
                            <div class="image-cat">
                                <a href="/danh-muc-san-pham-c{{$c->id}}" title="{{$c->name}}">
                                    <img src="/image/category-icon/{{$c->iconUrl}}"
                                        title="{{$c->name}}" alt="{{$c->name}}">
                                </a>
                            </div>
                            <div class="inner">
                                <div class="title-cat">
                                    <a href="/danh-muc-san-pham-c{{$c->id}}" title="{{$c->name}}">{{$c->name}}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //Block Spotlight3  -->

<!-- Main Container  -->
<div class="main-container container">
    <div class="row">
        <div id="content" class="col-sm-12">
            <!-- Banner Sale -->
            <div class="module">
                <div class="modcontent clearfix">
                    <div class="banner-wraps">
                        <div class="m-banner row">
                            @foreach($banner_hot_1 as $v)
                            <div class="banner htmlconten1 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="banners">
                                    <div>
                                        <a href="">
                                            <img src="/image/banner/{{$v->image_url}}" alt="banner1">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- List Product 1 -->
            <div class="module extraslider-home5 titleLine">
                <h3 class="modtitle">Sản phẩm <img src="/image/icons/hot.png" width="80"></h3>
                <div id="so_extraslider_1">
                    <!-- Begin extraslider-inner -->
                    <div class="so-extraslider products-list grid product-style__5" data-autoplay="no"
                        data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="35"
                        data-items_column0="4" data-items_column1="3" data-items_column2="2"
                        data-items_column3="2" data-items_column4="1" data-arrows="yes"
                        data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">

                        @foreach($productsHot as $p)
                        <!--Begin Items-->
                        <div class="ltabs-item product-layout scroll-fade">
                            <div class="product-item-container">
                                <div class="left-block">
                                    <div class="product-image-container second_img">
                                        <img src="/image/product/{{$p->imageUrl}}"
                                            alt="{{$p->productName}}" class="img-responsive" />
                                        <img src="/image/product/{{$p->imageUrl}}"
                                            alt="{{$p->productName}}" class="img_0 img-responsive" />
                                    </div>
                                    <!--Sale Label-->
                                    <span class="label label-sale">-10%</span>
                                    <span class="label label-new">Hot</span>

                                    <!--full quick view block-->
                                    <a class="quickview iframe-link visible-lg"
                                        data-fancybox-type="iframe" href="/xem-nhanh-san-pham/{{$p->id}}"> Xem nhanh</a>
                                    <!--end full quick view block-->
                                </div>
                                <div class="right-block">
                                    <div class="caption">
                                        <h4>
                                            <a href="/chi-tiet-san-pham-p{{$p->id}}" style="max-width: 230px; display: inline-block; 
                                        overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$p->productName}}</a>
                                        </h4>
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

                                        <div class="price">
                                            <span class="price-new">{{formatMoney($p->price * 0.9)}}</span>
                                            <span class="price-old">{{formatMoney($p->price)}}</span>
                                        </div>
                                    </div>

                                    <div class="button-group">
                                        <button class="addToCart" type="button" data-toggle="tooltip"
                                            title="Thêm vào giỏ" onclick="cart.add('{{$p->id}}', '1','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                class="fa fa-shopping-cart"></i> <span
                                                class="hidden-xs">Thêm vào giỏ</span></button>
                                        <button class="wishlist" type="button" data-toggle="tooltip"
                                            title="Thêm sản phẩm yêu thích" onclick="wishlist.add('{{$p->id}}','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                class="fa fa-heart"></i></button>
                                        <button class="compare hidden-md" type="button"
                                            data-toggle="tooltip" title="So sánh sản phẩm"
                                            onclick=""><i
                                                class="fa fa-exchange"></i></button>
                                    </div>
                                </div><!-- right block -->
                            </div>
                        </div>
                        @endforeach
                        <!--End Items-->
                    </div>
                    <!--End extraslider-inner -->
                </div>
            </div>

            <!-- List Product 2 -->
            <div class="module">
                <div class="modcontent clearfix">
                    <div class="banner-wraps">
                        <div class="m-banner row">
                            @foreach($banner_sale_1 as $v)
                            <div class="banner htmlconten1 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                <div class="banners">
                                    <div>
                                        <img src="/image/banner/{{$v->image_url}}" style="height: 455px;" alt="banner1">
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- List Product 2 -->
                            <div class="module extraslider-home5 col-9">
                                <h3 class="modtitle"><img src="/image/icons/do-gia-dung-icon.png" width="25">&nbsp;QUẠT, MÁY LÀM MÁT</h3>
                                <div id="so_extraslider_1">
                                    <!-- Begin extraslider-inner -->
                                    <div class="so-extraslider products-list grid product-style__5" data-autoplay="no"
                                        data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="35"
                                        data-items_column0="4" data-items_column1="3" data-items_column2="2"
                                        data-items_column3="2" data-items_column4="1" data-arrows="yes"
                                        data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">

                                        @foreach($listProducts9 as $p)
                                        <!--Begin Items-->
                                        <div class="ltabs-item product-layout scroll-fade">
                                            <div class="product-item-container">
                                                <div class="left-block">
                                                    <div class="product-image-container second_img">
                                                        <img src="/image/product/{{$p->imageUrl}}"
                                                            alt="{{$p->productName}}" class="img-responsive" />
                                                        <img src="/image/product/{{$p->imageUrl}}"
                                                            alt="{{$p->productName}}" class="img_0 img-responsive" />
                                                    </div>
                                                    <!--Sale Label-->
                                                    <span class="label label-sale">-10%</span>
                                                    <span class="label label-new">Hot</span>

                                                    <!--full quick view block-->
                                                    <a class="quickview iframe-link visible-lg"
                                                        data-fancybox-type="iframe" href="/xem-nhanh-san-pham/{{$p->id}}"> Xem nhanh</a>
                                                    <!--end full quick view block-->
                                                </div>
                                                <div class="right-block">
                                                    <div class="caption">
                                                        <h4>
                                                            <a href="/chi-tiet-san-pham-p{{$p->id}}" style="max-width: 230px; display: inline-block; 
                                        overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$p->productName}}</a>
                                                        </h4>
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

                                                        <div class="price">
                                                            <span class="price-new">{{formatMoney($p->price * 0.9)}}</span>
                                                            <span class="price-old">{{formatMoney($p->price)}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="button-group">
                                                        <button class="addToCart" type="button" data-toggle="tooltip"
                                                            title="Thêm vào giỏ" onclick="cart.add('{{$p->id}}', '1','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                                class="fa fa-shopping-cart"></i> <span
                                                                class="hidden-xs">Thêm vào giỏ</span></button>
                                                        <button class="wishlist" type="button" data-toggle="tooltip"
                                                            title="Thêm sản phẩm yêu thích" onclick="wishlist.add('{{$p->id}}','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                                class="fa fa-heart"></i></button>
                                                        <button class="compare hidden-md" type="button"
                                                            data-toggle="tooltip" title="So sánh sản phẩm"
                                                            onclick=""><i
                                                                class="fa fa-exchange"></i></button>
                                                    </div>
                                                </div><!-- right block -->
                                            </div>
                                        </div>
                                        @endforeach
                                        <!--End Items-->
                                    </div>
                                    <!--End extraslider-inner -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List Product 3 -->
            <div class="module extraslider-home5 titleLine">
                <h3 class="modtitle"><img src="/image/icons/hot-icon.png" width="30">&nbsp;Máy pha cà phê</h3>
                <div id="so_extraslider_1">
                    <!-- Begin extraslider-inner -->
                    <div class="so-extraslider products-list grid product-style__5" data-autoplay="no"
                        data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="35"
                        data-items_column0="4" data-items_column1="3" data-items_column2="2"
                        data-items_column3="2" data-items_column4="1" data-arrows="yes"
                        data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">

                        @foreach($listProducts10 as $p)
                        <!--Begin Items-->
                        <div class="ltabs-item product-layout scroll-fade">
                            <div class="product-item-container">
                                <div class="left-block">
                                    <div class="product-image-container second_img">
                                        <img src="/image/product/{{$p->imageUrl}}"
                                            alt="{{$p->productName}}" class="img-responsive" />
                                        <img src="/image/product/{{$p->imageUrl}}"
                                            alt="{{$p->productName}}" class="img_0 img-responsive" />
                                    </div>
                                    <!--Sale Label-->
                                    <span class="label label-sale">-10%</span>
                                    <span class="label label-new">Hot</span>

                                    <!--full quick view block-->
                                    <a class="quickview iframe-link visible-lg"
                                        data-fancybox-type="iframe" href="/xem-nhanh-san-pham/{{$p->id}}"> Xem nhanh</a>
                                    <!--end full quick view block-->
                                </div>
                                <div class="right-block">
                                    <div class="caption">
                                        <h4>
                                            <a href="/chi-tiet-san-pham-p{{$p->id}}" style="max-width: 230px; display: inline-block; 
                                        overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$p->productName}}</a>
                                        </h4>
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

                                        <div class="price">
                                            <span class="price-new">{{formatMoney($p->price * 0.9)}}</span>
                                            <span class="price-old">{{formatMoney($p->price)}}</span>
                                        </div>
                                    </div>

                                    <div class="button-group">
                                        <button class="addToCart" type="button" data-toggle="tooltip"
                                            title="Thêm vào giỏ" onclick="cart.add('{{$p->id}}', '1','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                class="fa fa-shopping-cart"></i> <span
                                                class="hidden-xs">Thêm vào giỏ</span></button>
                                        <button class="wishlist" type="button" data-toggle="tooltip"
                                            title="Thêm sản phẩm yêu thích" onclick="wishlist.add('{{$p->id}}','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                class="fa fa-heart"></i></button>
                                        <button class="compare hidden-md" type="button"
                                            data-toggle="tooltip" title="So sánh sản phẩm"
                                            onclick=""><i
                                                class="fa fa-exchange"></i></button>
                                    </div>
                                </div><!-- right block -->
                            </div>
                        </div>
                        @endforeach
                        <!--End Items-->
                    </div>
                    <!--End extraslider-inner -->
                </div>
            </div>

            <!-- List Product 4 -->
            <div class="module">
                <div class="modcontent clearfix">
                    <div class="banner-wraps">
                        <div class="m-banner row">
                            @foreach($banner_sale_2 as $v)
                            <div class="banner htmlconten1 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                <div class="banners">
                                    <div>
                                        <img src="/image/banner/{{$v->image_url}}" style="height: 455px;" alt="banner1">
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- List Product 2 -->
                            <div class="module extraslider-home5 col-9">
                                <h3 class="modtitle"><img src="/image/icons/do-gia-dung-icon.png" width="25">&nbsp;NỒI CƠM ĐIỆN</h3>
                                <div id="so_extraslider_1">
                                    <!-- Begin extraslider-inner -->
                                    <div class="so-extraslider products-list grid product-style__5" data-autoplay="no"
                                        data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="35"
                                        data-items_column0="4" data-items_column1="3" data-items_column2="2"
                                        data-items_column3="2" data-items_column4="1" data-arrows="yes"
                                        data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">

                                        @foreach($listProducts12 as $p)
                                        <!--Begin Items-->
                                        <div class="ltabs-item product-layout scroll-fade">
                                            <div class="product-item-container">
                                                <div class="left-block">
                                                    <div class="product-image-container second_img">
                                                        <img src="/image/product/{{$p->imageUrl}}"
                                                            alt="{{$p->productName}}" class="img-responsive" />
                                                        <img src="/image/product/{{$p->imageUrl}}"
                                                            alt="{{$p->productName}}" class="img_0 img-responsive" />
                                                    </div>
                                                    <!--Sale Label-->
                                                    <span class="label label-sale">-10%</span>
                                                    <span class="label label-new">Hot</span>

                                                    <!--full quick view block-->
                                                    <a class="quickview iframe-link visible-lg"
                                                        data-fancybox-type="iframe" href="/xem-nhanh-san-pham/{{$p->id}}"> Xem nhanh</a>
                                                    <!--end full quick view block-->
                                                </div>
                                                <div class="right-block">
                                                    <div class="caption">
                                                        <h4>
                                                            <a href="/chi-tiet-san-pham-p{{$p->id}}" style="max-width: 230px; display: inline-block; 
                                        overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$p->productName}}</a>
                                                        </h4>
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

                                                        <div class="price">
                                                            <span class="price-new">{{formatMoney($p->price * 0.9)}}</span>
                                                            <span class="price-old">{{formatMoney($p->price)}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="button-group">
                                                        <button class="addToCart" type="button" data-toggle="tooltip"
                                                            title="Thêm vào giỏ" onclick="cart.add('{{$p->id}}', '1','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                                class="fa fa-shopping-cart"></i> <span
                                                                class="hidden-xs">Thêm vào giỏ</span></button>
                                                        <button class="wishlist" type="button" data-toggle="tooltip"
                                                            title="Thêm sản phẩm yêu thích" onclick="wishlist.add('{{$p->id}}','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                                class="fa fa-heart"></i></button>
                                                        <button class="compare hidden-md" type="button"
                                                            data-toggle="tooltip" title="So sánh sản phẩm"
                                                            onclick=""><i
                                                                class="fa fa-exchange"></i></button>
                                                    </div>
                                                </div><!-- right block -->
                                            </div>
                                        </div>
                                        @endforeach
                                        <!--End Items-->
                                    </div>
                                    <!--End extraslider-inner -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner Sale -->
            <div class="module">
                <div class="modcontent clearfix">
                    <div class="banner-wraps">
                        <div class="m-banner row">
                            @foreach($banner_hot_2 as $v)
                            <div class="banner htmlconten1 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="banners">
                                    <div>
                                        <a href="">
                                            <img src="/image/banner/{{$v->image_url}}" style="height: 150px;" alt="banner1">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- List Product 5 -->
            <div class="module extraslider-home5 titleLine">
                <h3 class="modtitle"><img src="/image/icons/hot-icon.png" width="30">&nbsp;Máy giặt, sấy</h3>
                <div id="so_extraslider_1">
                    <!-- Begin extraslider-inner -->
                    <div class="so-extraslider products-list grid product-style__5" data-autoplay="no"
                        data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="35"
                        data-items_column0="4" data-items_column1="3" data-items_column2="2"
                        data-items_column3="2" data-items_column4="1" data-arrows="yes"
                        data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">

                        @foreach($listProducts7 as $p)
                        <!--Begin Items-->
                        <div class="ltabs-item product-layout scroll-fade">
                            <div class="product-item-container">
                                <div class="left-block">
                                    <div class="product-image-container second_img">
                                        <img src="/image/product/{{$p->imageUrl}}"
                                            alt="{{$p->productName}}" class="img-responsive" />
                                        <img src="/image/product/{{$p->imageUrl}}"
                                            alt="{{$p->productName}}" class="img_0 img-responsive" />
                                    </div>
                                    <!--Sale Label-->
                                    <span class="label label-sale">-10%</span>
                                    <span class="label label-new">Hot</span>

                                    <!--full quick view block-->
                                    <a class="quickview iframe-link visible-lg"
                                        data-fancybox-type="iframe" href="/xem-nhanh-san-pham/{{$p->id}}"> Xem nhanh</a>
                                    <!--end full quick view block-->
                                </div>
                                <div class="right-block">
                                    <div class="caption">
                                        <h4>
                                            <a href="/chi-tiet-san-pham-p{{$p->id}}" style="max-width: 230px; display: inline-block; 
                                        overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$p->productName}}</a>
                                        </h4>
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

                                        <div class="price">
                                            <span class="price-new">{{formatMoney($p->price * 0.9)}}</span>
                                            <span class="price-old">{{formatMoney($p->price)}}</span>
                                        </div>
                                    </div>

                                    <div class="button-group">
                                        <button class="addToCart" type="button" data-toggle="tooltip"
                                            title="Thêm vào giỏ" onclick="cart.add('{{$p->id}}', '1','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                class="fa fa-shopping-cart"></i> <span
                                                class="hidden-xs">Thêm vào giỏ</span></button>
                                        <button class="wishlist" type="button" data-toggle="tooltip"
                                            title="Thêm sản phẩm yêu thích" onclick="wishlist.add('{{$p->id}}','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                class="fa fa-heart"></i></button>
                                        <button class="compare hidden-md" type="button"
                                            data-toggle="tooltip" title="So sánh sản phẩm"
                                            onclick=""><i
                                                class="fa fa-exchange"></i></button>
                                    </div>
                                </div><!-- right block -->
                            </div>
                        </div>
                        @endforeach
                        <!--End Items-->
                    </div>
                    <!--End extraslider-inner -->
                </div>
            </div>

            <!-- List Product 6 -->
            <div class="module extraslider-home5 titleLine">
                <h3 class="modtitle"><img src="/image/icons/hot-icon.png" width="30">&nbsp;Tủ lạnh</h3>
                <div id="so_extraslider_1">
                    <!-- Begin extraslider-inner -->
                    <div class="so-extraslider products-list grid product-style__5" data-autoplay="no"
                        data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="35"
                        data-items_column0="4" data-items_column1="3" data-items_column2="2"
                        data-items_column3="2" data-items_column4="1" data-arrows="yes"
                        data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">

                        @foreach($listProducts39 as $p)
                        <!--Begin Items-->
                        <div class="ltabs-item product-layout scroll-fade">
                            <div class="product-item-container">
                                <div class="left-block">
                                    <div class="product-image-container second_img">
                                        <img src="/image/product/{{$p->imageUrl}}"
                                            alt="{{$p->productName}}" class="img-responsive" />
                                        <img src="/image/product/{{$p->imageUrl}}"
                                            alt="{{$p->productName}}" class="img_0 img-responsive" />
                                    </div>
                                    <!--Sale Label-->
                                    <span class="label label-sale">-10%</span>
                                    <span class="label label-new">Hot</span>

                                    <!--full quick view block-->
                                    <a class="quickview iframe-link visible-lg"
                                        data-fancybox-type="iframe" href="/xem-nhanh-san-pham/{{$p->id}}"> Xem nhanh</a>
                                    <!--end full quick view block-->
                                </div>
                                <div class="right-block">
                                    <div class="caption">
                                        <h4>
                                            <a href="/chi-tiet-san-pham-p{{$p->id}}" style="max-width: 230px; display: inline-block; 
                                        overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$p->productName}}</a>
                                        </h4>
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

                                        <div class="price">
                                            <span class="price-new">{{formatMoney($p->price * 0.9)}}</span>
                                            <span class="price-old">{{formatMoney($p->price)}}</span>
                                        </div>
                                    </div>

                                    <div class="button-group">
                                        <button class="addToCart" type="button" data-toggle="tooltip"
                                            title="Thêm vào giỏ" onclick="cart.add('{{$p->id}}', '1','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                class="fa fa-shopping-cart"></i> <span
                                                class="hidden-xs">Thêm vào giỏ</span></button>
                                        <button class="wishlist" type="button" data-toggle="tooltip"
                                            title="Thêm sản phẩm yêu thích" onclick="wishlist.add('{{$p->id}}','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i
                                                class="fa fa-heart"></i></button>
                                        <button class="compare hidden-md" type="button"
                                            data-toggle="tooltip" title="So sánh sản phẩm"
                                            onclick=""><i
                                                class="fa fa-exchange"></i></button>
                                    </div>
                                </div><!-- right block -->
                            </div>
                        </div>
                        @endforeach
                        <!--End Items-->
                    </div>
                    <!--End extraslider-inner -->
                </div>
            </div>

            <!-- Brands -->
            <div class="module titleLine">
                <h3 class="modtitle">Thương hiệu&nbsp;<img src="/image/icons/hot.png" width="80"></h3>
                <div class="modcontent clearfix">
                    <div class="yt-content-slider slider-brand--home6" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="35" data-items_column0="6" data-items_column1="4" data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                        @foreach($brands as $b)
                        <div class="yt-content-slide">
                            <a title="{{$b->brandName}}" href="#"><img src="image/brands/{{$b->brandLogo}}" alt="{{$b->brandName}}"></a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- //Main Container -->
@stop
@section('script')
<script>
    window.addEventListener('scroll', function() {
        const elements = document.querySelectorAll('.scroll-fade');
        const windowHeight = window.innerHeight;

        elements.forEach((element) => {
            const elementTop = element.getBoundingClientRect().top;

            if (elementTop < windowHeight - 100) {
                element.classList.add('show');
            }
        });
    });
</script>
@stop