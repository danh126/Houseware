@extends('shared.layout')
@section('title','Kết quả tìm kiếm | GDX')
@section('content')
<style>
    .load-more {
        margin: 0px 0px 5px 0px;
        padding: 10px 20px;
        background: #4D90E0;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .load-more:disabled {
        background: #aaa;
    }
</style>
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i></a></li>
        <li>Kết quả tìm kiếm</li>
        <li>"{{$search}}"</li>
    </ul>

    <div class="row">
        <!--Left Part Start -->
        <aside class="col-sm-4 col-md-3" id="column-left">
            <div class="module menu-category titleLine">
                <h3 class="modtitle">Danh mục</h3>
                <div class="modcontent">
                    <div class="box-category" id="categories">
                        <ul id="cat_accordion" class="list-group">
                        </ul>
                    </div>
                    <button id="load-more-categories" class="load-more" data-page="1">Tải thêm</button>
                </div>
            </div>
            <div class="module menu-category titleLine">
                <h3 class="modtitle">Thương hiệu</h3>
                <div class="modcontent">
                    <div class="box-category" id="brands">
                        <ul id="cat_accordion" class="list-group">
                        </ul>
                    </div>
                    <button id="load-more-brands" class="load-more" data-page="1">Tải thêm</button>
                </div>
            </div>
            <div class="module latest-product titleLine">
                <h3 class="modtitle">Sản phẩm mới</h3>
                <div class="modcontent ">
                    @foreach($latestProduct as $v)
                    <div class="product-latest-item">
                        <div class="media">
                            <div class="media-left">
                                <a href="/chi-tiet-san-pham-p{{$v->id}}"><img src="/image/product/{{$v->imageUrl}}" alt="{{$v->productName}}" title="{{$v->productName}}" class="img-responsive" style="width: 100px; height: 82px;"></a>
                            </div>
                            <div class="media-body">
                                <div class="caption">
                                    <h4><a href="/chi-tiet-san-pham-p{{$v->id}}">{{$v->productName}}</a></h4>

                                    <div class="price">
                                        <span class="price-new">{{formatMoney($v->price)}}</span>
                                    </div>
                                    <div class="ratings">
                                        <div class="rating-box">
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="module">
                <div class="modcontent clearfix">
                    <div class="banners">
                        <div>
                            <a href="#"><img src="/image/banner/banner-km.jpg" alt="left-image"></a>
                        </div>
                    </div>

                </div>
            </div>
        </aside>
        <!--Left Part End -->

        <!--Middle Part Start-->
        <div id="content" class="col-md-9 col-sm-8">
            <div class="products-category">
                <!-- Filters -->
                <div class="product-filter filters-panel">
                    <div class="row">
                        <div class="col-md-2 visible-lg">
                            <div class="view-mode">
                                <div class="list-view">
                                    <button class="btn btn-default grid active" data-view="grid" data-toggle="tooltip" data-original-title="Grid"><i class="fa fa-th"></i></button>
                                    <button class="btn btn-default list" data-view="list" data-toggle="tooltip" data-original-title="List"><i class="fa fa-th-list"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //end Filters -->
                <!--changed listings-->
                <div class="products-list row grid">
                    @foreach($products as $p)
                    <div class="product-layout col-md-4 col-sm-6 col-xs-12 ">
                        <div class="product-item-container">
                            <div class="left-block">
                                <div class="product-image-container lazy second_img ">
                                    <img src="/image/product/{{$p->imageUrl}}" alt="{{$p->productName}}" class="img-responsive" />
                                    <img data-src="/image/product/{{$p->imageUrl}}" src="/image/product/{{$p->imageUrl}}" alt="{{$p->productName}}" class="img_0 img-responsive" />
                                </div>
                                <!--Sale Label-->
                                <span class="label label-sale">-10%</span>

                                <!--full quick view block-->
                                <a class="quickview iframe-link visible-lg" data-fancybox-type="iframe" href="/xem-nhanh-san-pham/{{$p->id}}"> Xem nhanh</a>
                                <!--end full quick view block-->
                            </div>


                            <div class="right-block">
                                <div class="caption">
                                    <h4><a href="/chi-tiet-san-pham-p{{$p->id}}" style="max-width: 230px; display: inline-block; 
                                    overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$p->productName}}</a></h4>
                                    <div class="ratings">
                                        <div class="rating-box">
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                        </div>
                                    </div>

                                    <div class="price">
                                        <span class="price-new">{{ formatMoney($p->price * 0.9) }}</span>
                                        <span class="price-old">{{ formatMoney($p->price) }}</span>
                                        <!-- <span class="label label-percent">-10%</span> -->
                                    </div>
                                    <div class="description item-desc hidden" style="display: inline-block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        <p>{{$p->description}}</p>
                                    </div>
                                </div>

                                <div class="button-group">
                                    <button class="addToCart" type="button" data-toggle="tooltip" title="Thêm vào giỏ" onclick="cart.add('{{$p->id}}', '1','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs">Thêm vào giỏ</span></button>
                                    <button class="wishlist" type="button" data-toggle="tooltip" title="Thêm sản phẩm yêu thích" onclick="wishlist.add('{{$p->id}}','{{$p->price * 0.9}}','{{$p->productName}}','{{$p->imageUrl}}');"><i class="fa fa-heart"></i></button>
                                    <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick=""><i class="fa fa-exchange"></i></button>
                                </div>
                            </div><!-- right block -->

                        </div>
                    </div>
                    <div class="clearfix visible-xs-block"></div>
                    @endforeach
                </div> <!--// End Changed listings-->
                <!-- Filters -->
                <div class="product-filter product-filter-bottom filters-panel">
                    <div class="row">
                        <div class="col-md-2 hidden-sm hidden-xs"></div>
                        <div class="box-pagination col-md-7 col-sm-8 col-xs-12 text-center">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
                <!-- //end Filters -->
            </div>
        </div>
    </div>
    <!--Middle Part End-->
</div>
<!-- //Main Container -->
@stop
@section('script')
<script type="text/javascript" src="/js/themejs/addtocart.js"></script>

<script>
    // Check if Cookie exists
    if ($.cookie('display')) {
        view = $.cookie('display');
    } else {
        view = 'grid';
    }
    if (view) display(view);

    // Get Filters By Url
    let search = '{{$search}}';

    let url = '/tim-kiem-san-pham?search=' + search + '&';
</script>

<script src="/js/search/load_data_search.js"></script>
<script src="/js/filters.js"></script>
@stop