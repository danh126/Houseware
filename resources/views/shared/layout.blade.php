<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <!-- Basic page needs
	============================================ -->
    <title>@yield('title','Gia Dụng Xanh')</title>
    <meta charset="utf-8">
    <meta name="keywords"
        content="boostrap, responsive, html5, css3, jquery, theme, multicolor, parallax, retina, business" />
    <meta name="author" content="Magentech">
    <meta name="robots" content="index, follow" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Mobile specific metas
	============================================ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Favicon
	============================================ -->
    <link rel="shortcut icon" href="/image/logos/icon-logo-mini.png">

    <!-- Google web fonts
	============================================ -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

    <!-- Libs CSS
	============================================ -->
    <link rel="stylesheet" href="/css/bootstrap/css/bootstrap.min.css">
    <link href="/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="/js/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/css/themecss/lib.css" rel="stylesheet">
    <link href="/js/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <!-- Theme CSS
	============================================ -->
    <link href="/css/themecss/so_megamenu.css" rel="stylesheet">
    <link href="/css/themecss/so-categories.css" rel="stylesheet">
    <link href="/css/themecss/so-listing-tabs.css" rel="stylesheet">
    <link href="/css/footer1.css" rel="stylesheet">
    <link href="/css/header4.css" rel="stylesheet">
    <link id="color_scheme" href="/css/home4.css" rel="stylesheet">
    <!-- <link id="color_scheme" href="css/home5.css" rel="stylesheet"> -->
    <link href="/css/responsive.css" rel="stylesheet">

    @vite('resources/js/app.js');


    <script type="module">
        window.Echo.channel('user')
            .listen('UserSessionChange', (e) => {
                console.log(e);
            })
    </script>

</head>

<body class="common-home res layout-home4">

    <div id="wrapper" class="wrapper-full banners-effect-11">

        <!-- Header Container  -->
        <header id="header" class=" variantleft type_4">
            <!-- Header Top -->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="header-top-left col-md-7 col-sm-6">
                            <div class="col-md-6 col-sm-12 navbar-welcome"> Liên hệ tư vấn mua hàng: <b>+9999.9999.99</b></div>
                        </div>
                        <div class="header-top-right collapsed-block text-right col-md-5 col-sm-6 col-xs-12">
                            <h5 class="tabBlockTitle visible-xs"> Xem thêm <a class="expander " href="#TabBlock-1"><i
                                        class="fa fa-angle-down"></i></a></h5>
                            <div class="tabBlock" id="TabBlock-1">
                                <ul class="top-link list-inline">
                                    @if(Auth::guard('web')->check() && Auth::guard('web')->user()->role == 0)
                                    <li class="account btn-group" id="my_account">
                                        <a href="#" title="Tài khoản" class="btn btn-xs dropdown-toggle" data-toggle="dropdown" style="display: inline-flex; align-items: center;">
                                            <span class="text-truncate" style="max-width: 120px; display: inline-block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                                Xin chào {{ Auth::guard('web')->user()->user_name }}
                                            </span>
                                            <span class="fa fa-angle-down"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/tai-khoan/thong-tin-tai-khoan"><i class="fa fa-user"></i> Thông tin tài khoản</a></li>
                                            <li><a href="/tai-khoan/don-dat-hang"><i class="fa fa-shopping-cart"></i> Đơn đặt hàng</a></li>
                                            <li><a href="/tai-khoan/dang-xuat-nguoi-dung"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                                        </ul>
                                    </li>
                                    @else
                                    <li class="account btn-group" id="my_account">
                                        <a href="#" title="Tài khoản" class="btn btn-xs dropdown-toggle"
                                            data-toggle="dropdown"> Tài khoản <span
                                                class="fa fa-angle-down"></span></a>
                                        <ul class="dropdown-menu ">
                                            <li><a href="/tai-khoan/dang-nhap"><i class="fa fa-pencil-square-o"></i> Đăng nhập</a>
                                            </li>
                                        </ul>
                                    </li>
                                    @endif
                                    <!-- <li class="wishlist"><a href="#" class="top-link-wishlist"
                                            title="Tin tức"><span class="hidden-xs">Tin tức</span></a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //Header Top -->

            <!-- Header center -->
            <div class="header-center left">
                <div class="container">
                    <div class="row">
                        <!-- Logo -->
                        <div class="navbar-logo col-md-3 col-sm-4 col-xs-12">
                            <a href="/"><img src="/image/logos/logo-gia-dung-xanh.png" width="120" title="Gia Dụng Xanh"
                                    alt="Gia Dụng Xanh" /></a>
                        </div>
                        <!-- //end Logo -->

                        <!-- Secondary menu -->
                        <div class="col-md-9 col-sm-8 text-right">
                            <ul class="list-inline wishlist-block">
                                <li>
                                    <a href="/tai-khoan/san-pham-yeu-thich" id="wishlist-total" class="top-link-wishlist"
                                        title="Sản phẩm yêu thích (0)"> <i class="fa fa-heart"></i> </a>
                                </li>
                                <li>
                                    <a href="#" id="comapre-total" class="top-link-wishlist" title="So sánh sản phẩm">
                                        <i class="fa fa-bar-chart-o"></i></a>
                                </li>
                            </ul>

                            <div class="form-group languages-block ">
                                <form id="bt-language">
                                    <a class="btn btn-xs dropdown-toggle" href="{{route('home.contact')}}">
                                        <b>Liên hệ</b>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- //Header center -->

            <!-- Header Bottom -->
            <div class="header-bottom compact-hidden">
                <div class="container">
                    <div class="row">
                        <div class="sidebar-menu col-md-3 col-sm-3 col-xs-12  ">
                            <div class="responsive so-megamenu ">
                                <div class="so-vertical-menu no-gutter compact-hidden">
                                    <nav class="navbar-default">
                                        <div class="container-megamenu vertical">
                                            <div id="menuHeading">
                                                <div class="megamenuToogle-wrapper">
                                                    <div class="megamenuToogle-pattern">
                                                        <div class="container">
                                                            <div>
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                            </div>
                                                            Danh mục sản phẩm
                                                            <i
                                                                class="fa pull-right arrow-circle fa-chevron-circle-up"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="navbar-header">
                                                <button type="button" id="show-verticalmenu" data-toggle="collapse"
                                                    class="navbar-toggle fa fa-list-alt">

                                                </button>
                                                Danh mục sản phẩm
                                            </div>
                                            <div class="vertical-wrapper">
                                                <span id="remove-verticalmenu" class="fa fa-times"></span>
                                                <div class="megamenu-pattern">
                                                    <div class="container">
                                                        <ul class="megamenu">
                                                            @foreach($crr as $v)
                                                            <li class="item-vertical style1 with-sub-menu hover">
                                                                <p class="close-menu"></p>
                                                                <a class="clearfix">
                                                                    <img src="/image/category-icon/{{$v->iconUrl}}" width="20" alt="icon">
                                                                    <span>{{$v->name}}</span>
                                                                    <b class="caret"></b>
                                                                </a>
                                                                @if($v->children)
                                                                <div class="sub-menu" data-subwidth="100">
                                                                    <div class="content">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    @foreach($v->children as $c)
                                                                                    <div class="col-md-4 static-menu">
                                                                                        <div class="menu">
                                                                                            <ul>
                                                                                                <li>
                                                                                                    <a class="main-menu">{{$c->name}}</a>
                                                                                                    @if($c->children)
                                                                                                    <ul>
                                                                                                        @foreach($c->children as $d)
                                                                                                        <li><a href="/danh-muc-san-pham-c{{$d->id}}">{{$d->name}}</a>
                                                                                                        </li>
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                    @endif
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </div>

                        </div>

                        <!-- Search -->
                        <div class="col-md-6 col-sm-5 search-pro collapsed-block">
                            <h5 class="tabBlockTitle visible-xs">Tìm kiếm sản phẩm<a class="expander " href="#sosearchpro"><i
                                        class="fa fa-angle-down"></i></a></h5>
                            <div id="sosearchpro" class="col-xs-12 search-pro tabBlock">
                                <form method="GET" action="/tim-kiem-san-pham">
                                    <div id="search0" class="search input-group">
                                        <input class="autosearch-input form-control" type="text" value="{{isset($_GET['search']) ? $_GET['search'] : ''}}" size="50"
                                            autocomplete="off" placeholder="Bạn muốn tìm kiếm sản phẩm nào?" name="search">
                                        <span class="input-group-btn">
                                            <button type="submit" class="button-search btn btn-primary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <ul id="suggestion-list" class="suggestion-list invisible">
                                        <!--Hiện gợi ý tìm kiếm -->
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- //end Search -->

                        <!--cart-->
                        <div class="col-md-3 col-sm-4  shopping_cart  ">
                            <!--cart-->
                            <div id="cart" class=" btn-group btn-shopping-cart">
                                <a data-loading-text="Loading..." class="top_cart dropdown-toggle"
                                    data-toggle="dropdown">
                                    <div class="shopcart">
                                        <span class="handle pull-left visible-lg"></span>
                                        <span class="title">Giỏ hàng</span>
                                        <p class="text-shopping-cart cart-total-full"></p>
                                    </div>
                                </a>

                                <ul class="tab-content content dropdown-menu pull-right shoppingcart-box" role="menu">
                                    <li>
                                        <table class="table table-striped">
                                            <tbody id="views-cart">
                                            </tbody>
                                        </table>
                                    </li>
                                    <li>
                                        <div>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-left"><strong>Tạm tính</strong>
                                                        </td>
                                                        <td class="text-right sub-total"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left"><strong>Tổng tiền</strong>
                                                        </td>
                                                        <td class="text-right total"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p class="text-right"> <a class="btn view-cart" href="/gio-hang"><i
                                                        class="fa fa-shopping-cart"></i>Xem giỏ hàng</a>&nbsp;&nbsp;&nbsp;
                                                <a class="btn btn-mega checkout-cart" href="/dat-hang"><i
                                                        class="fa fa-share"></i>Đặt hàng</a>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--//cart-->

                        </div>
                        <!--//cart-->
                    </div>
                </div>

            </div>

            <!-- Navbar switcher -->
            <!-- //end Navbar switcher -->
        </header>
        <!-- //Header Container  -->

        @yield('content')

        <!-- Footer Container -->
        <footer class="footer-container type_footer1">
            <!-- Footer Top Container -->
            <section class="footer-top">
                <div class="container content">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 box-information">
                            <div class="module clearfix">
                                <h3 class="modtitle">Thông tin liên hệ</h3>
                                <div class="modcontent">
                                    <ul class="menu">
                                        <li>Phía Bắc & Trung</li>
                                        <li>Mua hàng &nbsp;<a href="tel:(024) 3568 6969">(024) 3568 6969</a></li>
                                        <li>Bảo hành &nbsp;<a href="tel:(028) 38 333 222">(028) 38 333 222</a></li></br>
                                        <li>Phía Nam</li>
                                        <li>Mua hàng &nbsp;<a href="tel:(028) 3833 6666">(028) 3833 6666</a></li>
                                        <li>Bảo hành &nbsp;<a href="tel:(028) 38 333 222">(028) 38 333 222</a></li></br>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3 box-service">
                            <div class="module clearfix">
                                <h3 class="modtitle">Hỗ trợ khách hàng</h3>
                                <div class="modcontent">
                                    <ul class="menu">
                                        <li><a href="">Khiếu nại bồi thường</a></li>
                                        <li><a href="">Hình thức thanh toán</a></li>
                                        <li><a href="">Chính sách và Quy định chung</a></li>
                                        <li><a href="">Chính sách Bảo hành</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3 box-account">
                            <div class="module clearfix">
                                <h3 class="modtitle">Quản lý tài khoản</h3>
                                <div class="modcontent">
                                    <ul class="menu">
                                        <li><a href="#">Thay đổi thông tin</a></li>
                                        <li><a href="#">Lấy lại mật khẩu</a></li>
                                        <li><a href="#">Tra cứu đơn hàng</a></li>
                                        <li><a href="#">Quản lý giỏ hàng</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3 collapsed-block ">
                            <div class="module clearfix">
                                <h3 class="modtitle">Gia Dụng Xanh</h3>
                                <div class="modcontent">
                                    <ul class="contact-address">
                                        <li><span class="fa fa-map-marker"></span>39 QL50, Thị trấn Cần Giuộc, Cần Giuộc, Long An.</li>
                                        <li><span class="fa fa-envelope-o"></span> Email: <a href="#">
                                                info@giadungxanh.com.vn</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /Footer Top Container -->

            <!-- Footer Bottom Container -->
            <div class="footer-bottom-block ">
                <div class=" container">
                    <div class="row">
                        <div class="col-sm-5 copyright-text"> © 2024 Gia Dụng Xanh. All Rights Reserved. </div>
                        <div class="col-sm-7">
                            <div class="block-payment text-right"><img src="/image/demo/content/payment.png"
                                    alt="payment" title="payment"></div>
                        </div>
                        <!--Back To Top-->
                        <div class="back-to-top"><i class="fa fa-angle-up"></i></div>

                    </div>
                </div>
            </div>
            <!-- /Footer Bottom Container -->

            <div class="zalo-container right">
                <a id="zalo-btn" href="https://zalo.me/0943065370" target="_blank" rel="noopener nofollow">
                    <div class="animated_zalo infinite zoomIn_zalo cmoz-alo-circle"></div>
                    <div class="animated_zalo infinite pulse_zalo cmoz-alo-circle-fill"></div>
                    <span><img src="/image/icons/zalo-2.png" alt="Contact Me on Zalo"></span>
                    <span class="chat-text">Liên hệ với chúng tôi</span>
                </a>
            </div>
        </footer>
        <!-- //end Footer Container -->

    </div>

    <!-- Include Libs & Plugins
============================================ -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="/js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="/js/themejs/libs.js"></script>
    <script type="text/javascript" src="/js/unveil/jquery.unveil.js"></script>
    <script type="text/javascript" src="/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js"></script>
    <script type="text/javascript" src="/js/datetimepicker/moment.js"></script>
    <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/modernizr/modernizr-2.6.2.min.js"></script>
    <script type="text/javascript" src="/js/countdown/jquery.countdown.min.js"></script>

    <!-- Theme files
============================================ -->
    <script type="text/javascript" src="/js/themejs/application.js"></script>
    <script type="text/javascript" src="/js/themejs/homepage.js"></script>
    <script type="text/javascript" src="/js/themejs/toppanel.js"></script>
    <script type="text/javascript" src="/js/themejs/so_megamenu.js"></script>
    <script type="text/javascript" src="/js/cart/cart.js"></script>
    <script type="text/javascript" src="/js/themejs/addtocart.js"></script>
    <script type="text/javascript" src="/js/nprogress.js"></script>
    <script type="text/javascript" src="/js/search/search-suggestions.js"></script>
    @yield('script')
</body>

</html>