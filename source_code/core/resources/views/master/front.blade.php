
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

<!-- Tailwind CSS Integration -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Arial', 'Helvetica', 'sans-serif'],
                        'headline-md': ['Arial', 'Helvetica', 'sans-serif'],
                        'body-md': ['Arial', 'Helvetica', 'sans-serif'],
                        'label-md': ['Arial', 'Helvetica', 'sans-serif'],
                        'display-lg': ['Arial', 'Helvetica', 'sans-serif'],
                        'headline-sm': ['Arial', 'Helvetica', 'sans-serif'],
                        'body-sm': ['Arial', 'Helvetica', 'sans-serif'],
                    },
                    colors: {
                        primary: '#ccac00',
                        'primary-fixed': '#ccac00',
                        surface: '#f9f9f9',
                        'surface-dim': '#dadada',
                        'surface-bright': '#f9f9f9',
                        'surface-container-lowest': '#ffffff',
                        'surface-container-low': '#f3f3f4',
                        'inverse-surface': '#333333',
                        'on-surface': '#111111',
                        secondary: '#555555',
                        'outline-variant': '#e0e0e0',
                        outline: '#cccccc',
                    },
                    maxWidth: {
                        'container-max': '1440px',
                    },
                    spacing: {
                        'gutter': '2rem',
                        'margin-mobile': '1rem',
                        'section-padding': '4rem',
                        'stack-lg': '2rem',
                    },
                    borderRadius: {
                        'round-four': '0.25rem',
                    }
                }
            }
        }
</script>

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
<!-- Header-->
<header class="w-full bg-surface" style="box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
<!-- Utility Bar -->
<div class="bg-surface-container-low text-xs py-1 border-b border-outline-variant">
<div class="w-full max-w-container-max mx-auto px-4 md:px-6 flex justify-between items-center">
  <!-- Left Links (Reduced text size) -->
  <div class="flex space-x-3 text-[11px] font-medium tracking-wide uppercase">
    <a class="text-secondary hover:text-primary transition-colors" href="{{route('front.index')}}">{{__('Home')}}</a>
    @if ($setting->is_contact == 1)
    <a class="text-secondary hover:text-primary transition-colors" href="{{route('front.contact')}}">{{__('Contact us')}}</a>
    @endif
    @if ($setting->is_blog == 1)
    <a class="text-secondary hover:text-primary transition-colors" href="{{route('front.blog')}}">{{__('Blog')}}</a>
    @endif
  </div>

  <!-- Right Actions (Language Switcher with Flag + Wishlist) -->
  <div class="flex items-center space-x-3 text-[11px] font-medium justify-end">
    <!-- Language Switcher -->
    @php
        $currLang = Session::has('language') ? DB::table('languages')->find(Session::get('language')) : DB::table('languages')->where('is_default',1)->first();
        if(!$currLang) {
            $currLang = DB::table('languages')->first();
        }
    @endphp
    <div class="relative flex items-center space-x-1 cursor-pointer text-secondary hover:text-primary transition-colors t-h-dropdown">
      <a class="main-link text-secondary hover:text-primary transition-colors flex items-center space-x-1 py-0.5" href="#">
        @if(strtolower($currLang->language ?? '') == 'english' || strtolower($currLang->language ?? '') == 'en')
            <span class="text-xs mr-0.5">🇬🇧</span>
        @elseif(strtolower($currLang->language ?? '') == 'german' || strtolower($currLang->language ?? '') == 'de')
            <span class="text-xs mr-0.5">🇩🇪</span>
        @elseif(strtolower($currLang->language ?? '') == 'arabic' || strtolower($currLang->language ?? '') == 'ar')
            <span class="text-xs mr-0.5">🇸🇦</span>
        @else
            <span class="text-xs mr-0.5">🌐</span>
        @endif
        <span>{{ $currLang->language ?? __('Language') }}</span>
        <span class="material-symbols-outlined text-[14px] ml-0.5">expand_more</span>
      </a>
      <div class="t-h-dropdown-menu bg-white border border-outline-variant shadow-md rounded-round-four mt-1 p-1.5 absolute right-0 top-full z-50 w-28 min-w-max">
          @foreach (DB::table('languages')->get() as $language)
              <a class="flex items-center space-x-1.5 px-2 py-1 hover:bg-gray-100 rounded-sm text-[11px] transition-colors {{Session::get('language') == $language->id ? 'text-primary font-bold' : ($language->is_default == 1 && !Session::has('language') ? 'text-primary font-bold' : 'text-secondary')}}" href="{{route('front.language.setup',$language->id)}}">
                  @if(strtolower($language->language) == 'english' || strtolower($language->language) == 'en')
                      <span>🇬🇧</span>
                  @elseif(strtolower($language->language) == 'german' || strtolower($language->language) == 'de')
                      <span>🇩🇪</span>
                  @elseif(strtolower($language->language) == 'arabic' || strtolower($language->language) == 'ar')
                      <span>🇸🇦</span>
                  @else
                      <span>🌐</span>
                  @endif
                  <span>{{$language->language}}</span>
              </a>
          @endforeach
      </div>
    </div>

    <!-- Wishlist -->
    <a class="flex items-center space-x-1 text-secondary hover:text-primary transition-colors" href="{{route('user.wishlist.index')}}">
      <span class="material-symbols-outlined text-[14px]">favorite</span>
      <span>{{ __('Wishlist') }} ({{Session::has('wishlist') ? count(Session::get('wishlist')) : '0'}})</span>
    </a>
  </div>
</div>
</div>
<!-- Main Header -->
<div class="w-full max-w-container-max mx-auto px-4 md:px-6 py-4 flex flex-col md:flex-row justify-between items-center">
<!-- Logo -->
<a class="flex-shrink-0 mb-3 md:mb-0 site-logo" href="{{route('front.index')}}">
<img src="{{asset('assets/images/'.$setting->logo)}}" alt="{{$setting->title}}" style="max-height: 55px;">
</a>
<!-- Search Bar -->
<div class="w-full md:w-1/2 max-w-xl mb-3 md:mb-0 px-2">
<form class="relative w-full" action="{{route('front.catalog')}}" method="get">
<input name="search" class="w-full py-2 px-4 border border-outline rounded-round-four focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary bg-surface-container-lowest text-body-md" placeholder="{{__('Search our catalog')}}" type="text"/>
<button type="submit" class="absolute right-3 top-2.5 text-secondary hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[20px]">search</span>
</button>
</form>
</div>
<!-- Actions -->
<div class="flex items-center space-x-4">
<div class="flex items-center space-x-2">
<div class="relative text-on-surface">
<a href="{{route('front.cart')}}">
<span class="material-symbols-outlined text-[28px]">shopping_bag</span>
<span class="absolute -top-1 -right-2 bg-primary text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">{{Session::has('cart') ? count(Session::get('cart')) : '0'}}</span>
</a>
</div>
<div class="flex flex-col text-sm ml-1">
<span class="font-bold text-on-surface"><a href="{{route('front.cart')}}">{{ __('Cart') }}</a></span>
</div>
</div>
<div class="login-register">
@if(!Auth::user())
<a class="flex items-center space-x-1 text-secondary hover:text-primary transition-colors text-label-md" href="{{route('user.login')}}">
<span class="material-symbols-outlined text-[20px]">person</span>
<span>{{__('Sign in')}}</span>
</a>
@else
<div class="t-h-dropdown flex items-center space-x-1 text-secondary hover:text-primary transition-colors text-label-md cursor-pointer relative">
    <a class="main-link flex items-center" href="#"><span class="material-symbols-outlined text-[20px] mr-1">person</span> {{Auth::user()->first_name}}</a>
    <div class="t-h-dropdown-menu bg-white border border-outline-variant shadow-sm mt-2 py-2 absolute z-50 right-0 w-32">
        <a class="block px-4 py-1 text-sm text-secondary hover:bg-gray-100" href="{{route('user.dashboard')}}">{{ __('Dashboard') }}</a>
        <a class="block px-4 py-1 text-sm text-secondary hover:bg-gray-100" href="{{route('user.logout')}}">{{ __('Logout') }}</a>
    </div>
</div>
@endif
</div>
</div>
</div>
<!-- Main Navigation -->
<nav class="border-t border-b border-outline-variant py-3 bg-surface">
<div class="w-full max-w-container-max mx-auto px-margin-mobile md:px-gutter">
<ul class="flex flex-wrap justify-center md:justify-start space-x-6 lg:space-x-8 text-label-md font-bold uppercase text-[13px]">
@foreach (DB::table('categories')->whereStatus(1)->get() as $category)
<li><a class="text-secondary hover:text-primary transition-colors border-b-2 border-transparent hover:border-primary pb-1" href="{{route('front.catalog').'?category='.$category->slug}}">{{$category->name}}</a></li>
@endforeach
</ul>
</div>
</nav>
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
