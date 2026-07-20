
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
@if (url()->current() == route('front.index'))
<title>@yield('hometitle')</title>
@else
<title>{{$setting->title}} -@yield('title')</title>
@endif

<!-- SEO Meta Tags-->
@yield('meta')
<meta name="author" content="{{$setting->title}}">
<meta name="distribution" content="web">
<!-- Mobile Specific Meta Tag-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Favicon Icons-->
<link rel="icon" type="image/png" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="167x167" href="{{asset('assets/images/'.$setting->favicon)}}">
<!-- Preload Critical CSS -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="preload" as="style">
<style>
@include('master.fonts')
</style>
<link rel="preload" href="{{asset('assets/front/css/plugins.min.css')}}" as="style">
<link rel="preload" href="{{asset('assets/front/css/styles.min.css')}}" as="style">
<link rel="preload" href="{{asset('assets/front/css/responsive.css')}}" as="style">

<!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
<link rel="stylesheet" media="screen" href="{{asset('assets/front/css/plugins.min.css')}}">

@yield('styleplugins')

<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/styles.min.css')}}">
<link id="responsiveStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/responsive.css')}}">
<link rel="preload" href="{{asset('assets/front/css/paymentfont.min.css')}}" as="style">
<link rel="stylesheet" media="screen" href="{{asset('assets/front/css/paymentfont.min.css')}}">
<!-- Color css -->
<style>
@php
    $color = $setting->primary_color ?? '#FF6A00';
@endphp
.left-category-area .category-header h4,
.section-title h2::before,
.product-card .countdown span,
.flash-deal-slider.owl-carousel .owl-nav div:hover,
.features-slider.owl-carousel .owl-nav div:hover,
.newproduct-slider.owl-carousel .owl-nav div:hover,
.bestseller-slider.owl-carousel .owl-nav div:hover,
.toprated-slider.owl-carousel .owl-nav div:hover,
.pagination li a:hover, .pagination li span:hover,
.pagination li.active span, .pagination li.active a,
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active,
.u-d-d i,
.details-page-top-right-content .countdown span,
.mm-heading-area,
.section-title .links a::before,
.flash-sell-area.theme2 .product-card .countdown,
.menu-top-area,
.product-card .product-button-group .product-button,
.deal-of-day-section .countdown,
.bestseller-slider.owl-carousel .owl-nav div:hover, 
.brand-slider.owl-carousel .owl-nav div:hover, 
.features-slider.owl-carousel .owl-nav div:hover, 
.flash-deal-slider.owl-carousel .owl-nav div:hover, 
.home-blog-slider.owl-carousel .owl-nav div:hover, 
.newproduct-slider.owl-carousel .owl-nav div:hover, 
.popular-category-slider.owl-carousel .owl-nav div:hover, 
.toprated-slider.owl-carousel .owl-nav div:hover,
.btn,
.footer-social-links a,
.a2a_kit a
{
    background : {{ $color }}  !important;
}

.site-header .toolbar .toolbar-item > a > div > .compare-icon > .count-label, .site-header .toolbar .toolbar-item > a > div > .cart-icon > .count-label,
.btn-primary,
.hero-slider > .owl-carousel.dots-inside .owl-dots .owl-dot,
.widget-title::after,
.scroll-to-top-btn:hover,
a.list-group-item::before, .list-group-item-action::before
{
    background-color : {{ $color }} !important;
}


.hero-slider .owl-carousel .owl-nav div,
.left-category-area .category-list .navi-link:hover span.text-gray-dark,
.site-header .navbar .nav-inner .right-info i,
.h-t-social-area ul li a:hover,
.menu-top-area .login-register:hover,
.t-h-dropdown a:hover,
.t-h-dropdown a.active,
.product-card .product-price,
.genius-banner .content .content-inner p,
.navi-link:hover,
.site-header .site-menu > ul > li:hover > a,
.widget-categories ul > li.active > a,
.widget-links ul > li.active > a,
.details-page-top-right-content  a,
.widget-categories ul > li > a:hover,
.widget-links ul > li > a:hover,
.product-card .product-title > a:hover,
.product-card .product-category > a:hover,
.nav-tabs .nav-link:hover,
.post-title > a:hover,
.post-meta > li > a:hover,
.widget-featured-posts > .entry .entry-title > a:hover,
.widget-featured-products > .entry .entry-title > a:hover,
.widget-cart > .entry .entry-title > a:hover,
.entry .entry-delete a,
.steps .step.active .step-title, .steps .step.active > i,
.text-primary,
.shopping-cart .product-item .product-title > a:hover,
.wishlist-table .product-item .product-title > a:hover,
.order-table .product-item .product-title > a:hover,
.list-group-item.active,
a.list-group-item:hover,
 a.list-group-item:focus, a.list-group-item:active,
 .list-group-item-action:hover,
 .list-group-item-action:focus,
 .list-group-item-action:active,
 .progress-steps li.active .icon,
 .comparison-table .comparison-item .comparison-item-title:hover,
 .site-header .site-menu > ul > li.active > a,
 .breadcrumbs > li > a:hover,
 .faq-box:hover .link,
 .left-category-area .category-list .sub-c-box .title:hover,
 .left-category-area .category-list .sub-c-box .child-category a:hover,
 .section-title .links a:hover, 
 .section-title .links a.active,
 #quick_filter li a:hover,
 #quick_filter li a.active,
 .section-title .right_link:hover,
 .popular-category.theme3 .links a.active,
 .popular-category.theme3 .links a:hover,
 .site-header .search-box-wrap .input-group .serch-result .bottom-area a:hover,
 .shop-view>a,
 .genius-banner .inner-content p,
 .details-page-top-right-content .price-area .main-price,
 .free-shippin-aa
{
    color : {{ $color }} !important;
}



.site-header .toolbar .toolbar-item > a > div > .compare-icon > .count-label,
.btn-primary:hover,
.scroll-to-top-btn:hover,
.pagination li a:hover,
.pagination li span:hover,
.pagination li.active span,
.pagination li.active a,
.nav-tabs .nav-link.active:hover,
.btn
{
    color : #fff !important;
}

.shop-view>a.active{
    color: #fff !important;
}

.category-scroll::-webkit-scrollbar-thumb {
    background-color:  {{ $color }};
}

.category-scroll {
    scrollbar-color:  {{ $color }} #e4e4e4;
    scrollbar-width: thin;
}

.btn-outline-primary {
    border-color: {{ $color }};
    color: {{ $color }};
    background: none;
}
.btn-outline-primary:hover {
    background-color: {{ $color }};
    color: #fff !important;
}
.t-h-dropdown .t-h-dropdown-menu {
    border-top: 2px solid {{ $color }};
}
.product-card:hover,
.brand-slider .slider-item a:hover,
.genius-banner:hover
{
    border-color: {{ $color }};
}
.form-control:focus {
    border-color: {{ $color }};
}
.input-group .form-control:focus ~ .input-group-addon {
    color: {{ $color }};
}
.shop-view > a.active {
    border-color: {{ $color }};
    background-color: {{ $color }};
}
.custom-control .custom-control-input:checked ~ .custom-control-label::before {
    border-color: {{ $color }};
    background-color: {{ $color }};
}
.product-gallery .product-thumbnails > li.active > a,
.steps .step.active
{
    border-color: {{ $color }};
}

.quickFilter .quickFilter-title:hover {
    border-color: {{ $color }} !important;
}
#quick_filter {
    border-color: {{ $color }};
}
</style>
<!-- Modernizr-->
<script defer src="{{asset('assets/front/js/modernizr.min.js')}}"></script>

@if (DB::table('languages')->where('is_default',1)->first()->rtl == 1)
    <link rel="stylesheet" href="{{asset('assets/front/css/rtl.css')}}">
@endif
<style>
    /* Fix LCP render delay for hero slider */
    .hero-slider-main.owl-carousel:not(.owl-loaded) {
        display: block !important;
    }
    .hero-slider-main.owl-carousel:not(.owl-loaded) .item:not(:first-child) {
        display: none !important;
    }
    
    {{$setting->custom_css}}
    .site-header .site-menu > ul > li > a {
        padding: 12px 8px !important;
        font-size: 13px !important;
        white-space: nowrap !important;
    }
    .left-category-area .category-header h4 {
        font-size: 14px !important;
        padding: 12px 10px !important;
    }
    /* Header Topbar Perfect Alignment */
    .topbar .d-flex.justify-content-between {
        align-items: center !important;
    }
    /* Header Logo Sizing Fix */
    .site-header .site-branding .site-logo {
        width: auto !important;
        max-width: 250px !important;
    }
    /* Hero Slider Border Radius */
    .hero-slider, .heroarea-slider {
        border-radius: 12px !important;
        overflow: hidden !important;
    }
    .site-header .site-branding .site-logo img {
        width: auto !important;
        max-height: 80px !important;
        object-fit: contain !important;
    }

    .site-header .search-box-wrap {
        padding: 10px 20px !important;
        align-self: center !important;
    }
    /* Product Details Tab Spacing */
    .product-landing-details,
    .product-landing-details * {
        line-height: 2.2 !important;
        font-size: 15px !important;
    }
    .product-landing-details p, 
    .product-landing-details li, 
    .product-landing-details div,
    .product-landing-details span {
        margin-bottom: 12px !important;
    }
    .product-landing-details br {
        display: block !important;
        margin-bottom: 12px !important;
        content: "" !important;
    }
    .site-header .search-box-wrap .search-box-inner {
        width: 100%;
        align-self: center !important;
    }
    .topbar .search-box-inner .search-box {
        display: flex !important;
        align-items: center !important;
    }
    .topbar .search-box-inner .search-box select {
        height: 44px !important;
        border: 1px solid #e0e0e0 !important;
        border-right: 0 !important;
        border-radius: 4px 0 0 4px !important;
        background-color: #fff !important;
    }
    .topbar .search-box-inner .search-box form.input-group {
        display: flex !important;
        align-items: center !important;
    }
    .topbar .search-box-inner .search-box form.input-group .form-control {
        height: 44px !important;
        border: 1px solid #e0e0e0 !important;
        border-radius: 0 4px 4px 0 !important;
    }
    .site-header .toolbar {
        display: flex !important;
        align-items: center !important;
    }
    @media (min-width: 992px) {
        .site-header .toolbar .toolbar-item.visible-on-mobile {
            display: none !important;
        }
    }

    /* Product Details Landing Page Formatting */
    #details .nav-tabs {
        border-bottom: 1px solid #e5e7eb !important;
        margin-bottom: 0 !important;
        gap: 5px;
    }
    #details .nav-tabs .nav-item {
        margin-bottom: -1px;
    }
    #details .nav-tabs .nav-link {
        font-size: 15px !important;
        font-weight: 600 !important;
        color: #8c8c8c !important;
        padding: 15px 30px !important;
        border: 1px solid transparent !important;
        border-top: 3px solid transparent !important;
        transition: all 0.25s ease !important;
        background: transparent !important;
        border-radius: 0 !important;
    }
    #details .nav-tabs .nav-link:hover {
        color: #1a1a1a !important;
    }
    #details .nav-tabs .nav-link.active {
        color: #000000 !important;
        background: #ffffff !important;
        border: 1px solid #e5e7eb !important;
        border-top: 3px solid #0d6efd !important;
        border-bottom-color: #ffffff !important;
    }

    #description.product-landing-details {
        color: #2d3748;
        font-size: 15px;
        line-height: 1.75;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    #description.product-landing-details h1, 
    #description.product-landing-details h2, 
    #description.product-landing-details h3, 
    #description.product-landing-details h4, 
    #description.product-landing-details h5, 
    #description.product-landing-details h6 {
        color: #1a202c;
        font-weight: 700;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        line-height: 1.35;
        clear: both;
    }
    #description.product-landing-details h1 { font-size: 1.85rem; }
    #description.product-landing-details h2 { font-size: 1.6rem; border-bottom: 2px solid #edf2f7; padding-bottom: 8px; }
    #description.product-landing-details h3 { font-size: 1.35rem; }
    #description.product-landing-details h4 { font-size: 1.18rem; }
    #description.product-landing-details h5 { font-size: 1.05rem; }
    #description.product-landing-details h6 { font-size: 0.95rem; }

    #description.product-landing-details h2.text-center, 
    #description.product-landing-details h3.text-center {
        border-bottom: none;
    }

    #description.product-landing-details p {
        margin-bottom: 1.25rem;
        line-height: 1.75;
        color: #334155;
    }

    #description.product-landing-details ul, 
    #description.product-landing-details ol {
        margin-top: 0.5rem;
        margin-bottom: 1.5rem;
        padding-left: 1.75rem;
    }
    #description.product-landing-details ul li, 
    #description.product-landing-details ol li {
        margin-bottom: 0.5rem;
        line-height: 1.65;
        color: #334155;
    }
    #description.product-landing-details ul li::marker {
        color: #0d6efd;
    }

    #description.product-landing-details img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 8px;
        margin: 12px 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
    }

    #description.product-landing-details .alignleft,
    #description.product-landing-details img.alignleft,
    #description.product-landing-details img[style*="float: left"],
    #description.product-landing-details img[style*="float:left"] {
        float: left;
        margin: 6px 24px 20px 0 !important;
        max-width: 48% !important;
    }

    #description.product-landing-details .alignright,
    #description.product-landing-details img.alignright,
    #description.product-landing-details img[style*="float: right"],
    #description.product-landing-details img[style*="float:right"] {
        float: right;
        margin: 6px 0 20px 24px !important;
        max-width: 48% !important;
    }

    #description.product-landing-details .aligncenter,
    #description.product-landing-details img.aligncenter,
    #description.product-landing-details img[style*="float: center"] {
        display: block;
        margin: 20px auto !important;
        clear: both;
    }

    @media (max-width: 767.98px) {
        #description.product-landing-details .alignleft,
        #description.product-landing-details img.alignleft,
        #description.product-landing-details img[style*="float: left"],
        #description.product-landing-details img[style*="float:left"],
        #description.product-landing-details .alignright,
        #description.product-landing-details img.alignright,
        #description.product-landing-details img[style*="float: right"],
        #description.product-landing-details img[style*="float:right"] {
            float: none !important;
            display: block !important;
            margin: 15px auto !important;
            max-width: 100% !important;
        }
    }

    #description.product-landing-details::after {
        content: "";
        clear: both;
        display: table;
    }

    #description.product-landing-details .callout-box,
    #description.product-landing-details .alert-info,
    #description.product-landing-details .notice-box,
    #description.product-landing-details .highlight-box {
        background-color: #f0f7ff;
        border-left: 4px solid #0d6efd;
        padding: 18px 24px;
        border-radius: 8px;
        margin: 24px 0;
        color: #0f172a;
        box-shadow: 0 2px 8px rgba(13, 110, 253, 0.06);
    }

    #description.product-landing-details .feature-title-red {
        color: #dc2626;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 1.1rem;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        letter-spacing: 0.5px;
    }

    #description.product-landing-details table {
        width: 100% !important;
        margin: 20px 0;
        border-collapse: collapse;
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    #description.product-landing-details th, 
    #description.product-landing-details td {
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        text-align: left;
    }
    #description.product-landing-details th {
        background-color: #f8fafc;
        font-weight: 600;
        color: #1e293b;
    }
</style>
{{-- Google AdSense Start --}}
@if ($setting->is_google_adsense == '1')
    {!! $setting->google_adsense !!}
@endif
{{-- Google AdSense End --}}

{{-- Google AnalyTics Start --}}
@if ($setting->is_google_analytics == '1')
    {!! $setting->google_analytics !!}
@endif
{{-- Google AnalyTics End --}}

{{-- Facebook pixel  Start --}}
@if ($setting->is_facebook_pixel == '1')
    {!! $setting->facebook_pixel !!}
@endif
{{-- Facebook pixel End --}}

</head>
<!-- Body-->
<body class="
@if($setting->theme == 'theme1')
body_theme1
@elseif($setting->theme == 'theme2')
body_theme2
@elseif($setting->theme == 'theme3')
body_theme3
@elseif($setting->theme == 'theme4')
body_theme4
@endif
">


<!-- Header-->
<header class="site-header navbar-sticky">
    <div class="menu-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="t-m-s-a">
                        <a class="track-order-link" href="{{route('front.order.track')}}"><i class="icon-map-pin"></i>{{ __('Track Order') }}</a>
                        <a class="track-order-link compare-mobile d-lg-none" href="{{route('fornt.compare.index')}}">{{ __('Compare') }}</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="right-area">

                        <a class="track-order-link wishlist-mobile d-inline-block d-lg-none" href="{{route('user.wishlist.index')}}"><i class="icon-heart"></i>{{ __('Wishlist') }}</a>
                        
                        <div class="t-h-dropdown ">
                            <a class="main-link" href="#">{{ __('Currency') }}<i class="icon-chevron-down"></i></a>
                            <div class="t-h-dropdown-menu">
                                @foreach (DB::table('currencies')->get() as $currency)
                                    <a class="{{Session::get('currency') == $currency->id ? 'active' : ($currency->is_default == 1 && !Session::has('currency') ? 'active' : '')}}" href="{{route('front.currency.setup',$currency->id)}}"><i class="icon-chevron-right pr-2"></i>{{$currency->name}}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="login-register ">
                            @if(!Auth::user())
                            <a class="track-order-link mr-0" href="{{route('user.login')}}">
                            {{__('Login/Register')}}
                            </a>
                            @else
                            <div class="t-h-dropdown">
                                <div class="main-link">
                                    <i class="icon-user pr-2"></i> <span class="text-label">{{Auth::user()->first_name}}</span>
                                </div>
                                <div class="t-h-dropdown-menu">
                                    <a href="{{route('user.dashboard')}}"><i class="icon-chevron-right pr-2"></i>{{ __('Dashboard') }}</a>
                                    <a href="{{route('user.logout')}}"><i class="icon-chevron-right pr-2"></i>{{ __('Logout') }}</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Topbar-->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Logo-->
                        <div class="site-branding"><a class="site-logo align-self-center" href="{{route('front.index')}}"><img width="120" height="80" src="{{asset('assets/images/'.$setting->logo)}}" alt="{{$setting->title}}"></a></div>
                        <!-- Search / Categories-->
                        <div class="search-box-wrap d-none d-lg-block d-flex">
                        <div class="search-box-inner align-self-center">
                            <div class="search-box d-flex">
                                <select name="category" id="category_select" class="categoris" aria-label="{{__('Category')}}">
									<option value="">{{__('All')}}</option>
                                    @foreach (DB::table('categories')->whereStatus(1)->get() as $category)
                                    <option value="{{$category->slug}}">{{$category->name}}</option>
                                    @endforeach
									</select>
                                <form class="input-group" id="header_search_form" action="{{route('front.catalog')}}" method="get">
                                    <input type="hidden" name="category" value="" id="search__category">
                                    <span class="input-group-btn">
                                    <button type="submit" aria-label="Search"><i class="icon-search"></i></button>
                                    </span>
                                    <input class="form-control" type="text" data-target="{{route('front.search.suggest')}}" id="__product__search" name="search" placeholder="{{__('Search by product name')}}" aria-label="Search by product name">
                                    <div class="serch-result d-none">
                                       {{-- search result --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                            <span class="d-block d-lg-none close-m-serch"><i class="icon-x"></i></span>
                        </div>
                        <!-- Toolbar-->
                        <div class="toolbar d-flex align-items-center">

                        <div class="toolbar-item close-m-serch visible-on-mobile"><a href="#" aria-label="Toggle Search">
                            <div>
                                <i class="icon-search"></i>
                            </div>
                            </a>
                        </div>
                        <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#" aria-label="Toggle Menu">
                            <div><i class="icon-menu"></i><span class="text-label">{{__('Menu')}}</span></div>
                            </a>
                        </div>

                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('fornt.compare.index')}}">
                            <div><span class="compare-icon"><i class="icon-repeat"></i><span class="count-label compare_count">{{Session::has('compare') ? count(Session::get('compare')) : '0'}}</span></span><span class="text-label">{{ __('Compare') }}</span></div>
                            </a>
                        </div>
                        @if(Auth::check())
                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('user.wishlist.index')}}">
                            <div><span class="compare-icon"><i class="icon-heart"></i><span class="count-label wishlist_count">{{Auth::user()->wishlists->count()}}</span></span><span class="text-label">{{__('Wishlist')}}</span></div>
                            </a>
                        </div>
                        @else
                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('user.wishlist.index')}}">
                          <div><span class="compare-icon"><i class="icon-heart"></i><span class="count-label wishlist_count">0</span></span><span class="text-label">{{__('Wishlist')}}</span></div>
                          </a>
                      </div>
                        @endif
                        <div class="toolbar-item"><a href="{{route('front.cart')}}">
                            <div><span class="cart-icon"><i class="icon-shopping-cart"></i><span class="count-label cart_count">{{Session::has('cart') ? count(Session::get('cart')) : '0'}} </span></span><span class="text-label">{{ __('Cart') }}</span></div>
                            </a>
                            <div class="toolbar-dropdown cart-dropdown widget-cart  cart_view_header" id="header_cart_load" data-target="{{route('front.header.cart')}}">
                            @include('includes.header_cart')
                            </div>
                        </div>
                        </div>

                        <!-- Mobile Menu-->
                        <div class="mobile-menu">
                            <!-- Slideable (Mobile) Menu-->
                            <div class="mm-heading-area">
                                <h4>{{ __('Navigation') }}</h4>
                                <div class="toolbar-item visible-on-mobile mobile-menu-toggle mm-t-two">
                                    <a href="#" aria-label="Close Menu">
                                        <div> <i class="icon-x"></i></div>
                                    </a>
                                </div>
                            </div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation99">
                                  <span class="active" id="mmenu-tab" data-bs-toggle="tab" data-bs-target="#mmenu"  role="tab" aria-controls="mmenu" aria-selected="true">{{ __('Menu') }}</span>
                                </li>
                                <li class="nav-item" role="presentation99">
                                  <span class="" id="mcat-tab" data-bs-toggle="tab" data-bs-target="#mcat"  role="tab" aria-controls="mcat" aria-selected="false">{{ __('Category') }}</span>
                                </li>

                              </ul>
                              <div class="tab-content p-0" >
                                <div class="tab-pane fade show active" id="mmenu" role="tabpanel" aria-labelledby="mmenu-tab">
                                    <nav class="slideable-menu">
                                        <ul>
                                            <li class="{{ request()->routeIs('front.index') ? 'active' : '' }}"><a href="{{route('front.index')}}"><i class="icon-chevron-right"></i>{{__('Home')}}</a></li>
                                            @foreach (DB::table('categories')->whereStatus(1)->orderBy('serial', 'asc')->get() as $category)
                                            <li class="{{ request()->fullUrl() == route('front.catalog').'?category='.$category->slug ? 'active' : '' }}"><a href="{{route('front.catalog').'?category='.$category->slug}}"><i class="icon-chevron-right"></i>{{$category->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </nav>
                                </div>
                                <div class="tab-pane fade" id="mcat" role="tabpanel" aria-labelledby="mcat-tab">
                                    <nav class="slideable-menu">
                                        @include('includes.mobile-category')

                                    </nav>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Navbar-->
  <div class="navbar">
        <div class="container">
            <div class="row g-3 w-100">
                <div class="col-lg-2">
                    @include('includes.categories')
                </div>
                <div class="col-lg-10 d-flex justify-content-between">
                    <div class="nav-inner">
                        <nav class="site-menu">
                            <ul>
                                <li class="{{ request()->routeIs('front.index') ? 'active' : '' }}"><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                                @foreach (DB::table('categories')->whereStatus(1)->orderBy('serial', 'asc')->get() as $category)
                                <li class="{{ request()->fullUrl() == route('front.catalog').'?category='.$category->slug ? 'active' : '' }}"><a href="{{route('front.catalog').'?category='.$category->slug}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </nav>

                    </div>
                    @php
                        $free_shipping = DB::table('shipping_services')->whereStatus(1)->whereIsCondition(1)->first()
                    @endphp

                </div>
            </div>
        </div>
    </div>

</header>
<!-- Page Content-->
@yield('content')

<!--    announcement banner section removed   -->

<!-- Site Footer-->
<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <!-- Contact Info-->
          <section class="widget widget-light-skin">
            <h3 class="widget-title"><span style="color: white;">Get In Touch&nbsp;</span></h3>
            <p class="mb-1"><strong>{{__('Address')}}: </strong> {{$setting->footer_address}}</p>
            <p class="mb-1"><strong>{{__('Phone')}}: </strong> <a href="tel:{{$setting->footer_phone}}" class="text-white">{{$setting->footer_phone}}</a></p>
            <p class="mb-1"><strong>{{__('WhatsApp')}}: </strong> <a href="https://wa.me/8801312699221" target="_blank" class="text-white">+8801312699221</a></p>
            <p class="mb-3"><strong>{{__('Email')}}: </strong> <a href="mailto:{{$setting->footer_email}}" class="text-white">{{$setting->footer_email}}</a></p>
            @php
            $links = json_decode($setting->social_link,true)['links'];
            $icons = json_decode($setting->social_link,true)['icons'];
            @endphp
            <div class="footer-social-links">
                @foreach ($links as $link_key => $link)
                <a href="{{$link}}" target="_blank" aria-label="Social link {{$link_key}}"><span><i class="{{$icons[$link_key]}}"></i></span></a>
                @endforeach
            </div>
          </section>
        </div>
        <div class="col-lg-4 col-sm-6">
          <!-- Customer Info-->
          <div class="widget widget-links widget-light-skin">
            <h3 class="widget-title"><span style="color: white;">Usefull Links&nbsp;</span></h3>
            <ul>
                @if ($setting->is_faq == 1)
                <li>
                    <a class="" href="{{route('front.faq')}}">{{__('Faq')}}</a>
                </li>
                @endif
                @foreach (DB::table('pages')->wherePos(2)->orwhere('pos',1)->get() as $page)
                <li><a href="{{route('front.page',$page->slug)}}">{{$page->title}}</a></li>

                @endforeach

            </ul>
          </div>
        </div>
        <div class="col-lg-4">
            <!-- Subscription-->
            <section class="widget">
              <h3 class="widget-title"><span style="color: white;">Newsletter&nbsp;</span></h3>
              <form class="row subscriber-form" action="{{route('front.subscriber.submit')}}" method="post">
                @csrf
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control" type="email" name="email" placeholder="{{__('Your e-mail')}}" aria-label="{{__('Your e-mail')}}">
                    <span class="input-group-addon"><i class="icon-mail"></i></span> </div>
                  <div aria-hidden="true">
                    <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                  </div>

                </div>
                <div class="col-sm-12">
                  <button class="btn btn-primary btn-block mt-2" type="submit">
                      <span>{{__('Subscribe')}}</span>
                  </button>
                </div>
                <div class="col-lg-12">
                    <p class="text-sm opacity-80 pt-2">{{__('Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.')}}</p>
                </div>
              </form>
              <div class="pt-3"><img class="d-block gateway_image" width="324" height="31" src="{{ $setting->footer_gateway_img ? asset('assets/images/'.$setting->footer_gateway_img) : asset('system/resources/assets/images/placeholder.png') }}"></div>
            </section>
          </div>
      </div>
      <p class="footer-copyright"> {{$setting->copy_right}} | Website Designed By : <a href="#" target="_blank"><span style="color: white;">&nbsp;Shohoj Solution</span></a></p>
    </div>
  </footer>

<!-- Back To Top Button-->
<a class="scroll-to-top-btn" href="#" aria-label="Scroll to top">
    <i class="icon-chevron-up"></i>
</a>
<!-- Backdrop-->
<div class="site-backdrop"></div>

<!-- Cookie alert dialog  -->
@if ($setting->is_cookie == 1)
@include('cookieConsent::index')
@endif

<!-- Cookie alert dialog  -->


@php
    $mainbs = [];
    $mainbs['is_announcement'] = $setting->is_announcement;
    $mainbs['announcement_delay'] = $setting->announcement_delay;
    $mainbs['overlay'] = $setting->overlay;
    $mainbs = json_encode($mainbs);
@endphp

<script>
    var mainbs = {!! $mainbs !!};
    var decimal_separator = '{!! $setting->decimal_separator !!}';
    var thousand_separator = '{!! $setting->thousand_separator !!}';
</script>

<script>
    let language = {
        Days : '{{__('Days')}}',
        Hrs : '{{__('Hrs')}}',
        Min : '{{__('Min')}}',
        Sec : '{{__('Sec')}}',
    }

</script>



<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
<script defer type="text/javascript" src="{{asset('assets/front/js/plugins.min.js')}}"></script>
<script defer type="text/javascript" src="{{asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script defer type="text/javascript" src="{{asset('assets/front/js/scripts.min.js')}}"></script>
<script defer type="text/javascript" src="{{asset('assets/front/js/lazy.min.js')}}"></script>
<script defer type="text/javascript" src="{{asset('assets/front/js/lazy.plugin.js')}}"></script>
<script defer type="text/javascript" src="{{asset('assets/front/js/myscript.js')}}"></script>
@yield('script')

@if($setting->is_facebook_messenger	== '1')
 {!!  $setting->facebook_messenger !!}
@endif



<script type="text/javascript">
    let mainurl = '{{route('front.index')}}';

    let view_extra_index = 0;
      // Notifications
      function SuccessNotification(title){
            $.notify({
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-check-circle'
                },{
                element: 'body',
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }

        function DangerNotification(title){
            $.notify({
                // options
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-exclamation-triangle'
                },{
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }
        // Notifications Ends
    </script>

    @if(Session::has('error'))
    <script>
      window.addEventListener('DOMContentLoaded', function() {
        DangerNotification('{{Session::get('error')}}');
      });

    </script>
    @endif
    @if(Session::has('success'))
    <script>
      window.addEventListener('DOMContentLoaded', function() {
        SuccessNotification('{{Session::get('success')}}');
      });

    </script>
    @endif

    <style>
        .whatsapp-fab {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 35px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
            z-index: 9999;
            transition: transform 0.3s ease;
            text-decoration: none;
        }
        .whatsapp-fab:hover {
            transform: scale(1.1);
            color: white;
        }
        .whatsapp-fab i {
            margin-top: 0px;
            margin-left: 1px;
        }
        @media (max-width: 767.98px) {
            .whatsapp-fab {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 30px;
            }
        }
    </style>
    <a href="https://wa.me/8801410699221" class="whatsapp-fab" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp" aria-hidden="true"></i>
    </a>

</body>
</html>
