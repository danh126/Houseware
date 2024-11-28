<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Basic page needs
	============================================ -->
    <title>Xem nhanh sản phẩm</title>
    <meta charset="utf-8" />
    <meta name="keywords"
        content="boostrap, responsive, html5, css3, jquery, theme, multicolor, parallax, retina, business" />
    <meta name="author" content="Magentech" />
    <meta name="robots" content="index, follow" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Mobile specific metas
	============================================ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Favicon
	============================================ -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
    <link rel="shortcut icon" href="ico/favicon.png" />

    <!-- Google web fonts
	============================================ -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

    <!-- Libs CSS
	============================================ -->
    <link rel="stylesheet" href="/css/bootstrap/css/bootstrap.min.css" />
    <link href="/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="/js/owl-carousel/owl.carousel.css" rel="stylesheet" />
    <link href="/css/themecss/lib.css" rel="stylesheet" />
    <link href="/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />

    <!-- Theme CSS
	============================================ -->
    <link href="/css/themecss/so_megamenu.css" rel="stylesheet" />
    <link href="/css/themecss/so-categories.css" rel="stylesheet" />
    <link href="/css/themecss/so-listing-tabs.css" rel="stylesheet" />
    <link id="color_scheme" href="/css/home4.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet" />

</head>

<body class="res layout-subpage">
    <div id="wrapper" class="wrapper-full">
        <!-- Main Container  -->
        <div class="main-container container">
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-md-12 col-sm-12">
                    <div class="product-view row">
                        <div class="left-content-product col-lg-12 col-xs-12">
                            <div class="row">
                                <div class="content-product-left  col-sm-6 col-xs-12 ">
                                    <div class="large-image  ">
                                        <img itemprop="image" class="product-image-zoom"
                                            src="/image/product/{{$o->imageUrl}}"
                                            data-zoom-image="/image/product/{{$o->imageUrl}}" title="{{$o->productName}}"
                                            alt="{{$o->productName}}" />
                                    </div>

                                    <div id="thumb-slider" class="owl-theme owl-loaded owl-drag full_slider">
                                        @foreach($img as $i)
                                        <a data-index="{{$i->id}}" class="img thumbnail "
                                            data-image="/image/product/{{$i->imageUrl}}" title="{{$o->productName}}">
                                            <img src="/image/product/{{$i->imageUrl}}" title="{{$o->productName}}"
                                                alt="{{$o->productName}}" />
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
                                            <div class="brand"><span>Thương hiệu: </span><a href="#">{{$o->brand->brandName}} </a> </div>
                                        </div>
                                    </div>

                                    <div id="product">
                                        <div class="form-group box-info-product">
                                            <div class="option quantity">
                                                <div class="input-group quantity-control" id="quantity">
                                                    <label>Số lượng </label>
                                                    <input class="form-control" type="text" name="quantity" value="1" />
                                                    <span class="input-group-addon product_quantity_down">− </span>
                                                    <span class="input-group-addon product_quantity_up">+ </span>
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
                                                            onclick="wishlist.add('{{$o->id}}','{{$o->price * 0.9}}','{{$o->productName}}','{{$o->imageUrl}}');"
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

                </div>
            </div>
            <!--Middle Part End-->
        </div>
        <!-- //Main Container -->

        <style type="text/css">
            #wrapper {
                box-shadow: none;
            }

            #wrapper>*:not(.main-container) {
                display: none;
            }

            #content {
                margin: 0
            }

            .container {
                width: 100%;
            }

            .product-info .product-view,
            .left-content-product,
            .box-info-product {
                margin: 0;
            }

            .left-content-product .content-product-right .box-info-product .cart input {
                padding: 12px 16px;
            }

            .left-content-product .content-product-right .box-info-product .add-to-links {
                width: auto;
                float: none;
                margin-top: 0px;
                clear: none;
            }

            .add-to-links ul li {
                margin: 0;
            }
        </style>
    </div>

    <!-- Include Libs & Plugins
	============================================ -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="/js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="/js/themejs/libs.js"></script>
    <script type="text/javascript" src="/js/unveil/jquery.unveil.js"></script>
    <script type="text/javascript" src="/js/countdown/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js"></script>
    <script type="text/javascript" src="/js/datetimepicker/moment.js"></script>
    <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui/jquery-ui.min.js"></script>

    <!-- Theme files
    ============================================ -->

    <script type="text/javascript" src="/js/themejs/so_megamenu.js"></script>
    <script type="text/javascript" src="/js/themejs/addtocart.js"></script>
    <script type="text/javascript" src="/js/themejs/application.js"></script>
    <script type="text/javascript" src="/js/cart/cart.js"></script>
</body>

</html>