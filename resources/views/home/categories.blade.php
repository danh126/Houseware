@extends('shared.layout')
@section('title')
{{ $sub->name }} | GDX
@endsection
@section('content')
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i></a></li>
        <li>{{$parent->name}}</li>
        <li>{{$sub->name}}</li>
    </ul>

    <div class="row">
        <!--Left Part Start -->
        <aside class="col-sm-4 col-md-3" id="column-left">
            <div class="module menu-category titleLine">
                <h3 class="modtitle">{{$parent->name}}</h3>
                <div class="modcontent">
                    <div class="box-category">
                        <ul id="cat_accordion" class="list-group">
                            @foreach($groupSub as $v)
                            @if($v->id == $sub->id)
                            <li class="">
                                <a href="/danh-muc-san-pham-c{{$v->id}}" class="cutom-parent active"><span><img src="/image/category-icon/{{$v->iconUrl}}" width="20" alt="{{$v->name}}"></span>&nbsp;{{$v->name}}</a><span class="dcjq-icon"></span>
                            </li>
                            @else
                            <li>
                                <a href="/danh-muc-san-pham-c{{$v->id}}" class="cutom-parent"><span><img src="/image/category-icon/{{$v->iconUrl}}" width="20" alt="{{$v->name}}"></span>&nbsp;{{$v->name}}</a><span class="dcjq-icon"></span>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="module menu-category titleLine">
                <h3 class="modtitle">Thương hiệu</h3>
                <div class="modcontent">
                    <div class="box-category">
                        <ul id="cat_accordion" class="list-group">
                            @foreach($brands as $b)
                            <li>
                                <a class="cutom-parent">
                                    <span><img src="/image/brands/{{$b->brandLogo}}" width="30" alt="{{$b->brandName}}"></span>
                                    &nbsp;{{$b->brandName}}&nbsp;({{$b->Total}})
                                    <span><input type="checkbox" class="check" value="{{$b->id}}" name="bid"></span>
                                </a>
                                <span class="dcjq-icon"></span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
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
                    @foreach($arr as $a)
                    <div class="product-layout col-md-4 col-sm-6 col-xs-12 ">
                        <div class="product-item-container">
                            <div class="left-block">
                                <div class="product-image-container lazy second_img ">
                                    <img src="/image/product/{{$a->imageUrl}}" alt="{{$a->productName}}" class="img-responsive" />
                                    <img data-src="/image/product/{{$a->imageUrl}}" src="/image/product/{{$a->imageUrl}}" alt="{{$a->productName}}" class="img_0 img-responsive" />
                                </div>
                                <!--Sale Label-->
                                <span class="label label-sale">-10%</span>

                                <!--full quick view block-->
                                <a class="quickview iframe-link visible-lg" data-fancybox-type="iframe" href="/xem-nhanh-san-pham/{{$a->id}}"> Xem nhanh</a>
                                <!--end full quick view block-->
                            </div>


                            <div class="right-block">
                                <div class="caption">
                                    <h4><a href="/chi-tiet-san-pham-p{{$a->id}}" style="max-width: 230px; display: inline-block; 
                                    overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$a->productName}}</a></h4>
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
                                        <span class="price-new">{{ formatMoney($a->price * 0.9) }}</span>
                                        <span class="price-old">{{ formatMoney($a->price) }}</span>
                                        <!-- <span class="label label-percent">-10%</span> -->
                                    </div>
                                    <div class="description item-desc hidden" style="display: inline-block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        <p>{{$a->description}}</p>
                                    </div>
                                </div>

                                <div class="button-group">
                                    <button class="addToCart" type="button" data-toggle="tooltip" title="Thêm vào giỏ" onclick="cart.add('{{$a->id}}', '1','{{$a->price * 0.9}}','{{$a->productName}}','{{$a->imageUrl}}');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs">Thêm vào giỏ</span></button>
                                    <button class="wishlist" type="button" data-toggle="tooltip" title="Thêm sản phẩm yêu thích" onclick="wishlist.add('{{$a->id}}','{{$a->price * 0.9}}','{{$a->productName}}','{{$a->imageUrl}}');"><i class="fa fa-heart"></i></button>
                                    <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick=""><i class="fa fa-exchange"></i></button>
                                </div>
                            </div><!-- right block -->

                        </div>
                    </div>
                    <div class="clearfix visible-xs-block"></div>
                    @endforeach
                </div>
                <!--// End Changed listings-->

                <!-- Filters -->
                <div class="product-filter product-filter-bottom filters-panel">
                    <div class="row">
                        <div class="col-md-2 hidden-sm hidden-xs"></div>
                        <div class="box-pagination col-md-7 col-sm-8 col-xs-12 text-center">
                            {{ $arr->links('pagination::bootstrap-4') }}
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
<script type="text/javascript">
    // Check if Cookie exists
    if ($.cookie('display')) {
        view = $.cookie('display');
    } else {
        view = 'grid';
    }
    if (view) display(view);
    //

    // Get Filters By Url
    let url = window.location.pathname + '?';
</script>

<script type="text/javascript" src="/js/filters.js"></script>
@stop