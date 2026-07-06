
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
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicon Icons-->
<link rel="icon" type="image/png" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="167x167" href="{{asset('assets/images/'.$setting->favicon)}}">
<!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
<link rel="stylesheet" media="screen" href="{{asset('assets/front/css/plugins.min.css')}}">

@yield('styleplugins')

<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/styles.min.css')}}">

<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/responsive.css')}}">
<!-- Color css -->
<link href="{{ asset('assets/front/css/color.php?primary_color=').str_replace('#','',$setting->primary_color) }}" rel="stylesheet">

<!-- Modernizr-->
<script src="{{asset('assets/front/js/modernizr.min.js')}}"></script>

@if (DB::table('languages')->where('is_default',1)->first()->rtl == 1)
    <link rel="stylesheet" href="{{asset('assets/front/css/rtl.css')}}">
@endif
<style>
    {{$setting->custom_css}}
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
<style>
    /* Custom Reference Design Styles Phase 1 & 2 */
    .site-header { box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .menu-top-area { background-color: #F5F5F5; padding: 8px 0; border-bottom: 1px solid #EAEAEA; font-size: 13px; color: #555; }
    .menu-top-area a { color: #555; text-decoration: none; margin-right: 15px; transition: color 0.3s; }
    .menu-top-area a:hover { color: #D4AF37; }
    
    .topbar { padding: 25px 0; background-color: #FFFFFF; }
    .topbar .search-box-wrap { flex-grow: 1; margin: 0 20px; }
    .topbar .search-box { border: 2px solid #D4AF37; border-radius: 4px; overflow: hidden; display: flex; align-items: center; }
    .topbar .search-box select { border: none; background: #f9f9f9; padding: 10px; color: #333; outline: none; border-right: 1px solid #EAEAEA; }
    .topbar .search-box input { border: none; padding: 10px 15px; outline: none; flex-grow: 1; }
    .topbar .search-box button { background-color: #D4AF37; color: #FFF; border: none; padding: 0 25px; cursor: pointer; transition: background 0.3s; }
    .topbar .search-box button:hover { background-color: #b5952f; }
    
    .topbar .toolbar-item { margin-left: 25px; text-align: center; }
    .topbar .toolbar-item .text-label { display: block; font-size: 12px; font-weight: 600; color: #2E2E2E; margin-top: 5px; text-transform: uppercase; }
    .topbar .toolbar-item .icon-shopping-cart, .topbar .toolbar-item .icon-repeat, .topbar .toolbar-item .icon-heart { font-size: 22px; color: #2E2E2E; }
    
    .navbar { background-color: #2E2E2E; padding: 0; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    .navbar .site-menu ul { display: flex; margin: 0; padding: 0; list-style: none; justify-content: center; }
    .navbar .site-menu ul li { margin: 0; }
    .navbar .site-menu ul li a { color: #FFFFFF; padding: 16px 25px; display: block; font-weight: 600; font-family: 'Inter', 'Montserrat', sans-serif; text-transform: uppercase; font-size: 14px; border-right: 1px solid #444; transition: all 0.3s; }
    .navbar .site-menu ul li:first-child a { border-left: 1px solid #444; }
    .navbar .site-menu ul li a:hover, .navbar .site-menu ul li.active a { background-color: #D4AF37; color: #FFFFFF; border-color: #D4AF37; }
</style>
<header class="site-header navbar-sticky">
    <div class="menu-top-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-left d-none d-md-block">
                    <a href="#"><i class="icon-phone"></i> Hotline: {{$setting->footer_phone}}</a>
                    <a href="mailto:{{$setting->footer_email}}"><i class="icon-mail"></i> {{$setting->footer_email}}</a>
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-inline-block mr-3">
                        <a href="{{route('user.wishlist.index')}}"><i class="icon-heart"></i> {{ __('Wishlist') }}</a>
                    </div>
                    <div class="t-h-dropdown d-inline-block mr-3">
                        <a class="main-link" href="#">{{ __('Currency') }} <i class="icon-chevron-down"></i></a>
                        <div class="t-h-dropdown-menu">
                            @foreach (DB::table('currencies')->get() as $currency)
                                <a class="{{Session::get('currency') == $currency->id ? 'active' : ($currency->is_default == 1 && !Session::has('currency') ? 'active' : '')}}" href="{{route('front.currency.setup',$currency->id)}}">{{$currency->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="login-register d-inline-block">
                        @if(!Auth::user())
                        <a href="{{route('user.login')}}"><i class="icon-user"></i> {{__('Login/Register')}}</a>
                        @else
                        <div class="t-h-dropdown">
                            <div class="main-link">
                                <i class="icon-user pr-1"></i> {{Auth::user()->first_name}}
                            </div>
                            <div class="t-h-dropdown-menu">
                                <a href="{{route('user.dashboard')}}">{{ __('Dashboard') }}</a>
                                <a href="{{route('user.logout')}}">{{ __('Logout') }}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Topbar-->
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo-->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="site-branding">
                        <a class="site-logo" href="{{route('front.index')}}"><img src="{{asset('assets/images/'.$setting->logo)}}" alt="{{$setting->title}}" style="max-height: 60px;"></a>
                    </div>
                </div>
                <!-- Search -->
                <div class="col-lg-6 col-md-4 d-none d-lg-block">
                    <div class="search-box-wrap w-100">
                        <form class="input-group search-box" id="header_search_form" action="{{route('front.catalog')}}" method="get">
                            <select name="category" id="category_select">
                                <option value="">{{__('All Categories')}}</option>
                                @foreach (DB::table('categories')->whereStatus(1)->get() as $category)
                                <option value="{{$category->slug}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <input type="text" data-target="{{route('front.search.suggest')}}" id="__product__search" name="search" placeholder="{{__('Search for products...')}}">
                            <button type="submit"><i class="icon-search"></i></button>
                            <div class="serch-result d-none"></div>
                        </form>
                    </div>
                </div>
                <!-- Toolbar-->
                <div class="col-lg-3 col-md-8 col-sm-6 text-right">
                    <div class="toolbar d-flex justify-content-end align-items-center">
                        <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#">
                            <div><i class="icon-menu" style="font-size: 22px;"></i><span class="text-label">{{__('Menu')}}</span></div>
                            </a>
                        </div>
                        <div class="toolbar-item hidden-on-mobile">
                            <a href="{{route('fornt.compare.index')}}">
                                <div>
                                    <span class="compare-icon"><i class="icon-repeat"></i><span class="count-label compare_count">{{Session::has('compare') ? count(Session::get('compare')) : '0'}}</span></span>
                                    <span class="text-label">{{ __('Compare') }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="toolbar-item">
                            <a href="{{route('front.cart')}}">
                                <div>
                                    <span class="cart-icon"><i class="icon-shopping-cart"></i><span class="count-label cart_count">{{Session::has('cart') ? count(Session::get('cart')) : '0'}}</span></span>
                                    <span class="text-label">{{ __('Cart') }}</span>
                                </div>
                            </a>
                            <div class="toolbar-dropdown cart-dropdown widget-cart cart_view_header" id="header_cart_load" data-target="{{route('front.header.cart')}}">
                                @include('includes.header_cart')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Menu-->
            <div class="mobile-menu">
                <!-- Slideable (Mobile) Menu-->
                <div class="mm-heading-area">
                    <h4>{{ __('Navigation') }}</h4>
                    <div class="toolbar-item visible-on-mobile mobile-menu-toggle mm-t-two">
                        <a href="#">
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
                                @if ($setting->is_shop == 1)
                                <li class="{{ request()->routeIs('front.catalog*')  ? 'active' : '' }}"><a href="{{route('front.catalog')}}"><i class="icon-chevron-right"></i>{{__('Shop')}}</a></li>
                                @endif
                                @if ($setting->is_campaign == 1)
                                <li class="{{ request()->routeIs('front.campaign')  ? 'active' : '' }}"><a href="{{route('front.campaign')}}"><i class="icon-chevron-right"></i>{{__('Campaign')}}</a></li>
                                @endif
                                @if ($setting->is_brands == 1)
                                <li class="{{ request()->routeIs('front.brand')  ? 'active' : '' }}"><a href="{{route('front.brand')}}"><i class="icon-chevron-right"></i>{{__('Brand')}}</a></li>
                                @endif
                                @if ($setting->is_blog == 1)
                                <li class="{{ request()->routeIs('front.blog*') ? 'active' : '' }}"><a href="{{route('front.blog')}}"><i class="icon-chevron-right"></i>{{__('Blog')}}</a></li>
                                @endif
                                <li class="t-h-dropdown">
                                    <a class="" href="#"><i class="icon-chevron-right"></i>{{__('Pages')}} <i class="icon-chevron-down"></i></a>
                                    <div class="t-h-dropdown-menu">
                                        @if ($setting->is_faq == 1)
                                        <a class="{{ request()->routeIs('front.faq*') ? 'active' : '' }}" href="{{route('front.faq')}}"><i class="icon-chevron-right pr-2"></i>{{__('Faq')}}</a>
                                        @endif
                                        @foreach (DB::table('pages')->wherePos(0)->orwhere('pos',2)->get() as $page)
                                        <a class="{{request()->url() == route('front.page',$page->slug) ? 'active' : ''}} " href="{{route('front.page',$page->slug)}}"><i class="icon-chevron-right pr-2"></i>{{$page->title}}</a>
                                        @endforeach
                                    </div>
                                </li>
                                @if ($setting->is_contact == 1)
                                <li class="{{ request()->routeIs('front.contact') ? 'active' : '' }}"><a href="{{route('front.contact')}}"><i class="icon-chevron-right"></i>{{__('Contact')}}</a></li>
                                @endif
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
  <!-- Navbar-->
  <div class="navbar d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="site-menu">
                        <ul>
                            <li class="{{ request()->routeIs('front.index') ? 'active' : '' }}"><a href="{{route('front.index')}}">{{__('HOME')}}</a></li>
                            @if ($setting->is_shop == 1)
                            <li class="{{ request()->routeIs('front.catalog*')  ? 'active' : '' }}"><a href="{{route('front.catalog')}}">{{__('SHOP')}}</a></li>
                            @endif
                            @if ($setting->is_campaign == 1)
                            <li class="{{ request()->routeIs('front.campaign')  ? 'active' : '' }}"><a href="{{route('front.campaign')}}">{{__('CAMPAIGN')}}</a></li>
                            @endif
                            @if ($setting->is_brands == 1)
                            <li class="{{ request()->routeIs('front.brand')  ? 'active' : '' }}"><a href="{{route('front.brand')}}">{{__('BRANDS')}}</a></li>
                            @endif
                            @if ($setting->is_blog == 1)
                            <li class="{{ request()->routeIs('front.blog*') ? 'active' : '' }}"><a href="{{route('front.blog')}}">{{__('MAGAZINE')}}</a></li>
                            @endif
                            <li class="t-h-dropdown">
                                <a class="main-link" href="#">{{__('PAGES')}} <i class="icon-chevron-down"></i></a>
                                <div class="t-h-dropdown-menu" style="background:#fff; color:#333; text-transform:none;">
                                    @if ($setting->is_faq == 1)
                                    <a class="{{ request()->routeIs('front.faq*') ? 'active' : '' }}" href="{{route('front.faq')}}">{{__('Faq')}}</a>
                                    @endif
                                    @foreach (DB::table('pages')->wherePos(0)->orwhere('pos',2)->get() as $page)
                                    <a class="{{request()->url() == route('front.page',$page->slug) ? 'active' : ''}}" href="{{route('front.page',$page->slug)}}">{{$page->title}}</a>
                                    @endforeach
                                </div>
                            </li>
                            @if ($setting->is_contact == 1)
                            <li class="{{ request()->routeIs('front.contact') ? 'active' : '' }}"><a href="{{route('front.contact')}}">{{__('CONTACT US')}}</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Page Content-->
@yield('content')

<!--    announcement banner section start   -->
<a class="announcement-banner" href="#announcement-modal"></a>
<div id="announcement-modal" class="mfp-hide white-popup">
    @if ($setting->announcement_type == 'newletter')
        <div class="announcement-with-content">
            <div class="left-area">
                <img src="{{ asset('assets/images/'.$setting->announcement) }}" alt="">
            </div>
            <div class="right-area">
                <h3 class="">{{  $setting->announcement_title }}</h3>
                <p>{{ $setting->announcement_details }}</p>
                <form class="subscriber-form" action="{{route('front.subscriber.submit')}}" method="post">
                    @csrf
                    <div class="input-group">
                        <input class="form-control" type="email" name="email" placeholder="{{__('Your e-mail')}}">
                        <span class="input-group-addon"><i class="icon-mail"></i></span> </div>
                    <div aria-hidden="true">
                        <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                    </div>

                    <button class="btn btn-primary btn-block mt-2" type="submit">
                        <span>{{__('Subscribe')}}</span>
                    </button>
                </form>
            </div>
        </div>
    @else
        <a href="{{ $setting->announcement_link }}">
            <img src="{{ asset('assets/images/'.$setting->announcement) }}" alt="">
        </a>
    @endif


</div>
<!--    announcement banner section end   -->

<!-- Trust Strip -->
<div class="trust-strip py-5 mt-5" style="background-color: #2E2E2E; color: #D4AF37;">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                <i class="icon-truck" style="font-size: 36px; display: block; margin-bottom: 15px;"></i>
                <h5 class="text-white" style="font-weight: 600; font-size: 16px; text-transform: uppercase;">Fast Shipping</h5>
                <p class="mb-0" style="font-size: 13px; color: #A0A0A0;">On all orders over $99</p>
            </div>
            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                <i class="icon-credit-card" style="font-size: 36px; display: block; margin-bottom: 15px;"></i>
                <h5 class="text-white" style="font-weight: 600; font-size: 16px; text-transform: uppercase;">Secure Payment</h5>
                <p class="mb-0" style="font-size: 13px; color: #A0A0A0;">100% secure checkout</p>
            </div>
            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                <i class="icon-phone" style="font-size: 36px; display: block; margin-bottom: 15px;"></i>
                <h5 class="text-white" style="font-weight: 600; font-size: 16px; text-transform: uppercase;">24/7 Support</h5>
                <p class="mb-0" style="font-size: 13px; color: #A0A0A0;">Dedicated support team</p>
            </div>
            <div class="col-md-3 col-sm-6">
                <i class="icon-award" style="font-size: 36px; display: block; margin-bottom: 15px;"></i>
                <h5 class="text-white" style="font-weight: 600; font-size: 16px; text-transform: uppercase;">Premium Quality</h5>
                <p class="mb-0" style="font-size: 13px; color: #A0A0A0;">Guaranteed satisfaction</p>
            </div>
        </div>
    </div>
</div>

<!-- Site Footer-->
<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <!-- Contact Info-->
          <section class="widget widget-light-skin">
            <h3 class="widget-title"><span style="color: white;">Get In Touch&nbsp;</span></h3>
            <p class="mb-1"><strong>{{__('Address')}}: </strong> {{$setting->footer_address}}</p>
            <p class="mb-1"><strong>{{__('Phone')}}: </strong> {{$setting->footer_phone}}</p>
            <p class="mb-3"><strong>{{__('Email')}}: </strong> {{$setting->footer_email}}</p>
            <ul class="list-unstyled text-sm">
              <li><span class=""><strong>{{__('Monday-Friday')}}: </strong></span>{{$setting->friday_start}} - {{$setting->friday_end}}</li>
              <li><span class=""><strong>{{__('Saturday')}}: </strong></span>{{$setting->satureday_start}} - {{$setting->satureday_end}}</li>
            </ul>
            @php
            $links = json_decode($setting->social_link,true)['links'];
            $icons = json_decode($setting->social_link,true)['icons'];
          @endphp
            <div class="footer-social-links mt-3">
                @foreach ($links as $link_key => $link)
                <a href="{{$link}}"><span><i class="{{$icons[$link_key]}}"></i></span></a>
                @endforeach
            </div>
          </section>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <!-- Customer Info-->
          <div class="widget widget-links widget-light-skin">
            <h3 class="widget-title"><span style="color: white;">Useful Links&nbsp;</span></h3>
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
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <!-- Customer Service -->
          <div class="widget widget-links widget-light-skin">
            <h3 class="widget-title"><span style="color: white;">Customer Service&nbsp;</span></h3>
            <ul>
                <li><a href="{{route('user.login')}}">{{__('My Account')}}</a></li>
                <li><a href="{{route('front.order.track')}}">{{__('Track Order')}}</a></li>
                <li><a href="{{route('user.wishlist.index')}}">{{__('Wishlist')}}</a></li>
                <li><a href="{{route('front.cart')}}">{{__('Cart')}}</a></li>
                @if ($setting->is_contact == 1)
                <li><a href="{{route('front.contact')}}">{{__('Contact Us')}}</a></li>
                @endif
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <!-- Subscription-->
            <section class="widget">
              <h3 class="widget-title"><span style="color: white;">Newsletter&nbsp;</span></h3>
              <form class="row subscriber-form" action="{{route('front.subscriber.submit')}}" method="post">
                @csrf
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control" type="email" name="email" placeholder="{{__('Your e-mail')}}" style="border: 1px solid #444; background: transparent; color: #FFF;">
                    <span class="input-group-addon" style="border: 1px solid #444; background: #D4AF37; color: #FFF; border-color: #D4AF37;"><i class="icon-mail"></i></span> </div>
                  <div aria-hidden="true">
                    <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                  </div>
                </div>
                <div class="col-sm-12">
                  <button class="btn btn-block mt-2 text-white" style="background-color: #D4AF37; border-color: #D4AF37; width: 100%;" type="submit">
                      <span>{{__('Subscribe')}}</span>
                  </button>
                </div>
                <div class="col-lg-12">
                    <p class="text-sm opacity-80 pt-2">{{__('Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.')}}</p>
                </div>
              </form>
              <div class="pt-3"><img class="d-block gateway_image" src="{{ $setting->footer_gateway_img ? asset('assets/images/'.$setting->footer_gateway_img) : asset('system/resources/assets/images/placeholder.png') }}" style="max-width: 100%;"></div>
            </section>
          </div>
      </div>
      <!-- Copyright-->
      <p class="footer-copyright"> {{$setting->copy_right}} | Website Designed By : <a href="https://www.elitedesign.com.bd" target="_blank"><span style="color: white;">&nbsp;Elite Design</span></a></p>
    </div>
  </footer>

<!-- Back To Top Button-->
<a class="scroll-to-top-btn" href="#">
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
<script type="text/javascript" src="{{asset('assets/front/js/plugins.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/scripts.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/lazy.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/lazy.plugin.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/myscript.js')}}"></script>
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
      $(document).ready(function(){
        DangerNotification('{{Session::get('error')}}')
      })

    </script>
    @endif
    @if(Session::has('success'))
    <script>
      $(document).ready(function(){
        SuccessNotification('{{Session::get('success')}}');
      })

    </script>
    @endif

</body>
</html>
