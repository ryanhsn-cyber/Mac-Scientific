
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php if(url()->current() == route('front.index')): ?>
<title><?php echo $__env->yieldContent('hometitle'); ?></title>
<?php else: ?>
<title><?php echo e($setting->title); ?> -<?php echo $__env->yieldContent('title'); ?></title>
<?php endif; ?>

<!-- SEO Meta Tags-->
<?php echo $__env->yieldContent('meta'); ?>
<meta name="author" content="<?php echo e($setting->title); ?>">
<meta name="distribution" content="web">
<!-- Mobile Specific Meta Tag-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicon Icons-->
<link rel="icon" type="image/png" href="<?php echo e(asset('assets/images/'.$setting->favicon)); ?>">
<link rel="apple-touch-icon" href="<?php echo e(asset('assets/images/'.$setting->favicon)); ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(asset('assets/images/'.$setting->favicon)); ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('assets/images/'.$setting->favicon)); ?>">
<link rel="apple-touch-icon" sizes="167x167" href="<?php echo e(asset('assets/images/'.$setting->favicon)); ?>">
<!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
<link rel="stylesheet" media="screen" href="<?php echo e(asset('assets/front/css/plugins.min.css')); ?>">

<?php echo $__env->yieldContent('styleplugins'); ?>

<link id="mainStyles" rel="stylesheet" media="screen" href="<?php echo e(asset('assets/front/css/styles.min.css')); ?>">

<link id="mainStyles" rel="stylesheet" media="screen" href="<?php echo e(asset('assets/front/css/responsive.css')); ?>">
<!-- Color css -->
<link href="<?php echo e(asset('assets/front/css/color.php?primary_color=').str_replace('#','',$setting->primary_color)); ?>" rel="stylesheet">

<!-- Modernizr-->
<script src="<?php echo e(asset('assets/front/js/modernizr.min.js')); ?>"></script>

<?php if(DB::table('languages')->where('is_default',1)->first()->rtl == 1): ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/rtl.css')); ?>">
<?php endif; ?>
<style>
    <?php echo e($setting->custom_css); ?>

</style>

<?php if($setting->is_google_adsense == '1'): ?>
    <?php echo $setting->google_adsense; ?>

<?php endif; ?>



<?php if($setting->is_google_analytics == '1'): ?>
    <?php echo $setting->google_analytics; ?>

<?php endif; ?>



<?php if($setting->is_facebook_pixel == '1'): ?>
    <?php echo $setting->facebook_pixel; ?>

<?php endif; ?>


</head>
<!-- Body-->
<body class="
<?php if($setting->theme == 'theme1'): ?>
body_theme1
<?php elseif($setting->theme == 'theme2'): ?>
body_theme2
<?php elseif($setting->theme == 'theme3'): ?>
body_theme3
<?php elseif($setting->theme == 'theme4'): ?>
body_theme4
<?php endif; ?>
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
                    <a href="#"><i class="icon-phone"></i> Hotline: <?php echo e($setting->footer_phone); ?></a>
                    <a href="mailto:<?php echo e($setting->footer_email); ?>"><i class="icon-mail"></i> <?php echo e($setting->footer_email); ?></a>
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-inline-block mr-3">
                        <a href="<?php echo e(route('user.wishlist.index')); ?>"><i class="icon-heart"></i> <?php echo e(__('Wishlist')); ?></a>
                    </div>
                    <div class="t-h-dropdown d-inline-block mr-3">
                        <a class="main-link" href="#"><?php echo e(__('Currency')); ?> <i class="icon-chevron-down"></i></a>
                        <div class="t-h-dropdown-menu">
                            <?php $__currentLoopData = DB::table('currencies')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="<?php echo e(Session::get('currency') == $currency->id ? 'active' : ($currency->is_default == 1 && !Session::has('currency') ? 'active' : '')); ?>" href="<?php echo e(route('front.currency.setup',$currency->id)); ?>"><?php echo e($currency->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="login-register d-inline-block">
                        <?php if(!Auth::user()): ?>
                        <a href="<?php echo e(route('user.login')); ?>"><i class="icon-user"></i> <?php echo e(__('Login/Register')); ?></a>
                        <?php else: ?>
                        <div class="t-h-dropdown">
                            <div class="main-link">
                                <i class="icon-user pr-1"></i> <?php echo e(Auth::user()->first_name); ?>

                            </div>
                            <div class="t-h-dropdown-menu">
                                <a href="<?php echo e(route('user.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
                                <a href="<?php echo e(route('user.logout')); ?>"><?php echo e(__('Logout')); ?></a>
                            </div>
                        </div>
                        <?php endif; ?>
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
                        <a class="site-logo" href="<?php echo e(route('front.index')); ?>"><img src="<?php echo e(asset('assets/images/'.$setting->logo)); ?>" alt="<?php echo e($setting->title); ?>" style="max-height: 60px;"></a>
                    </div>
                </div>
                <!-- Search -->
                <div class="col-lg-6 col-md-4 d-none d-lg-block">
                    <div class="search-box-wrap w-100">
                        <form class="input-group search-box" id="header_search_form" action="<?php echo e(route('front.catalog')); ?>" method="get">
                            <select name="category" id="category_select">
                                <option value=""><?php echo e(__('All Categories')); ?></option>
                                <?php $__currentLoopData = DB::table('categories')->whereStatus(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="text" data-target="<?php echo e(route('front.search.suggest')); ?>" id="__product__search" name="search" placeholder="<?php echo e(__('Search for products...')); ?>">
                            <button type="submit"><i class="icon-search"></i></button>
                            <div class="serch-result d-none"></div>
                        </form>
                    </div>
                </div>
                <!-- Toolbar-->
                <div class="col-lg-3 col-md-8 col-sm-6 text-right">
                    <div class="toolbar d-flex justify-content-end align-items-center">
                        <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#">
                            <div><i class="icon-menu" style="font-size: 22px;"></i><span class="text-label"><?php echo e(__('Menu')); ?></span></div>
                            </a>
                        </div>
                        <div class="toolbar-item hidden-on-mobile">
                            <a href="<?php echo e(route('fornt.compare.index')); ?>">
                                <div>
                                    <span class="compare-icon"><i class="icon-repeat"></i><span class="count-label compare_count"><?php echo e(Session::has('compare') ? count(Session::get('compare')) : '0'); ?></span></span>
                                    <span class="text-label"><?php echo e(__('Compare')); ?></span>
                                </div>
                            </a>
                        </div>
                        <div class="toolbar-item">
                            <a href="<?php echo e(route('front.cart')); ?>">
                                <div>
                                    <span class="cart-icon"><i class="icon-shopping-cart"></i><span class="count-label cart_count"><?php echo e(Session::has('cart') ? count(Session::get('cart')) : '0'); ?></span></span>
                                    <span class="text-label"><?php echo e(__('Cart')); ?></span>
                                </div>
                            </a>
                            <div class="toolbar-dropdown cart-dropdown widget-cart cart_view_header" id="header_cart_load" data-target="<?php echo e(route('front.header.cart')); ?>">
                                <?php echo $__env->make('includes.header_cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Menu-->
            <div class="mobile-menu">
                <!-- Slideable (Mobile) Menu-->
                <div class="mm-heading-area">
                    <h4><?php echo e(__('Navigation')); ?></h4>
                    <div class="toolbar-item visible-on-mobile mobile-menu-toggle mm-t-two">
                        <a href="#">
                            <div> <i class="icon-x"></i></div>
                        </a>
                    </div>
                </div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation99">
                      <span class="active" id="mmenu-tab" data-bs-toggle="tab" data-bs-target="#mmenu"  role="tab" aria-controls="mmenu" aria-selected="true"><?php echo e(__('Menu')); ?></span>
                    </li>
                    <li class="nav-item" role="presentation99">
                      <span class="" id="mcat-tab" data-bs-toggle="tab" data-bs-target="#mcat"  role="tab" aria-controls="mcat" aria-selected="false"><?php echo e(__('Category')); ?></span>
                    </li>
                </ul>
                <div class="tab-content p-0" >
                    <div class="tab-pane fade show active" id="mmenu" role="tabpanel" aria-labelledby="mmenu-tab">
                        <nav class="slideable-menu">
                            <ul>
                                <li class="<?php echo e(request()->routeIs('front.index') ? 'active' : ''); ?>"><a href="<?php echo e(route('front.index')); ?>"><i class="icon-chevron-right"></i><?php echo e(__('Home')); ?></a></li>
                                <?php if($setting->is_shop == 1): ?>
                                <li class="<?php echo e(request()->routeIs('front.catalog*')  ? 'active' : ''); ?>"><a href="<?php echo e(route('front.catalog')); ?>"><i class="icon-chevron-right"></i><?php echo e(__('Shop')); ?></a></li>
                                <?php endif; ?>
                                <?php if($setting->is_campaign == 1): ?>
                                <li class="<?php echo e(request()->routeIs('front.campaign')  ? 'active' : ''); ?>"><a href="<?php echo e(route('front.campaign')); ?>"><i class="icon-chevron-right"></i><?php echo e(__('Campaign')); ?></a></li>
                                <?php endif; ?>
                                <?php if($setting->is_brands == 1): ?>
                                <li class="<?php echo e(request()->routeIs('front.brand')  ? 'active' : ''); ?>"><a href="<?php echo e(route('front.brand')); ?>"><i class="icon-chevron-right"></i><?php echo e(__('Brand')); ?></a></li>
                                <?php endif; ?>
                                <?php if($setting->is_blog == 1): ?>
                                <li class="<?php echo e(request()->routeIs('front.blog*') ? 'active' : ''); ?>"><a href="<?php echo e(route('front.blog')); ?>"><i class="icon-chevron-right"></i><?php echo e(__('Blog')); ?></a></li>
                                <?php endif; ?>
                                <li class="t-h-dropdown">
                                    <a class="" href="#"><i class="icon-chevron-right"></i><?php echo e(__('Pages')); ?> <i class="icon-chevron-down"></i></a>
                                    <div class="t-h-dropdown-menu">
                                        <?php if($setting->is_faq == 1): ?>
                                        <a class="<?php echo e(request()->routeIs('front.faq*') ? 'active' : ''); ?>" href="<?php echo e(route('front.faq')); ?>"><i class="icon-chevron-right pr-2"></i><?php echo e(__('Faq')); ?></a>
                                        <?php endif; ?>
                                        <?php $__currentLoopData = DB::table('pages')->wherePos(0)->orwhere('pos',2)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="<?php echo e(request()->url() == route('front.page',$page->slug) ? 'active' : ''); ?> " href="<?php echo e(route('front.page',$page->slug)); ?>"><i class="icon-chevron-right pr-2"></i><?php echo e($page->title); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </li>
                                <?php if($setting->is_contact == 1): ?>
                                <li class="<?php echo e(request()->routeIs('front.contact') ? 'active' : ''); ?>"><a href="<?php echo e(route('front.contact')); ?>"><i class="icon-chevron-right"></i><?php echo e(__('Contact')); ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                    <div class="tab-pane fade" id="mcat" role="tabpanel" aria-labelledby="mcat-tab">
                        <nav class="slideable-menu">
                            <?php echo $__env->make('includes.mobile-category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <li class="<?php echo e(request()->routeIs('front.index') ? 'active' : ''); ?>"><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('HOME')); ?></a></li>
                            <?php if($setting->is_shop == 1): ?>
                            <li class="<?php echo e(request()->routeIs('front.catalog*')  ? 'active' : ''); ?>"><a href="<?php echo e(route('front.catalog')); ?>"><?php echo e(__('SHOP')); ?></a></li>
                            <?php endif; ?>
                            <?php if($setting->is_campaign == 1): ?>
                            <li class="<?php echo e(request()->routeIs('front.campaign')  ? 'active' : ''); ?>"><a href="<?php echo e(route('front.campaign')); ?>"><?php echo e(__('CAMPAIGN')); ?></a></li>
                            <?php endif; ?>
                            <?php if($setting->is_brands == 1): ?>
                            <li class="<?php echo e(request()->routeIs('front.brand')  ? 'active' : ''); ?>"><a href="<?php echo e(route('front.brand')); ?>"><?php echo e(__('BRANDS')); ?></a></li>
                            <?php endif; ?>
                            <?php if($setting->is_blog == 1): ?>
                            <li class="<?php echo e(request()->routeIs('front.blog*') ? 'active' : ''); ?>"><a href="<?php echo e(route('front.blog')); ?>"><?php echo e(__('MAGAZINE')); ?></a></li>
                            <?php endif; ?>
                            <li class="t-h-dropdown">
                                <a class="main-link" href="#"><?php echo e(__('PAGES')); ?> <i class="icon-chevron-down"></i></a>
                                <div class="t-h-dropdown-menu" style="background:#fff; color:#333; text-transform:none;">
                                    <?php if($setting->is_faq == 1): ?>
                                    <a class="<?php echo e(request()->routeIs('front.faq*') ? 'active' : ''); ?>" href="<?php echo e(route('front.faq')); ?>"><?php echo e(__('Faq')); ?></a>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = DB::table('pages')->wherePos(0)->orwhere('pos',2)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="<?php echo e(request()->url() == route('front.page',$page->slug) ? 'active' : ''); ?>" href="<?php echo e(route('front.page',$page->slug)); ?>"><?php echo e($page->title); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </li>
                            <?php if($setting->is_contact == 1): ?>
                            <li class="<?php echo e(request()->routeIs('front.contact') ? 'active' : ''); ?>"><a href="<?php echo e(route('front.contact')); ?>"><?php echo e(__('CONTACT US')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Page Content-->
<?php echo $__env->yieldContent('content'); ?>

<!--    announcement banner section start   -->
<a class="announcement-banner" href="#announcement-modal"></a>
<div id="announcement-modal" class="mfp-hide white-popup">
    <?php if($setting->announcement_type == 'newletter'): ?>
        <div class="announcement-with-content">
            <div class="left-area">
                <img src="<?php echo e(asset('assets/images/'.$setting->announcement)); ?>" alt="">
            </div>
            <div class="right-area">
                <h3 class=""><?php echo e($setting->announcement_title); ?></h3>
                <p><?php echo e($setting->announcement_details); ?></p>
                <form class="subscriber-form" action="<?php echo e(route('front.subscriber.submit')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="input-group">
                        <input class="form-control" type="email" name="email" placeholder="<?php echo e(__('Your e-mail')); ?>">
                        <span class="input-group-addon"><i class="icon-mail"></i></span> </div>
                    <div aria-hidden="true">
                        <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                    </div>

                    <button class="btn btn-primary btn-block mt-2" type="submit">
                        <span><?php echo e(__('Subscribe')); ?></span>
                    </button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <a href="<?php echo e($setting->announcement_link); ?>">
            <img src="<?php echo e(asset('assets/images/'.$setting->announcement)); ?>" alt="">
        </a>
    <?php endif; ?>


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
            <p class="mb-1"><strong><?php echo e(__('Address')); ?>: </strong> <?php echo e($setting->footer_address); ?></p>
            <p class="mb-1"><strong><?php echo e(__('Phone')); ?>: </strong> <?php echo e($setting->footer_phone); ?></p>
            <p class="mb-3"><strong><?php echo e(__('Email')); ?>: </strong> <?php echo e($setting->footer_email); ?></p>
            <ul class="list-unstyled text-sm">
              <li><span class=""><strong><?php echo e(__('Monday-Friday')); ?>: </strong></span><?php echo e($setting->friday_start); ?> - <?php echo e($setting->friday_end); ?></li>
              <li><span class=""><strong><?php echo e(__('Saturday')); ?>: </strong></span><?php echo e($setting->satureday_start); ?> - <?php echo e($setting->satureday_end); ?></li>
            </ul>
            <?php
            $links = json_decode($setting->social_link,true)['links'];
            $icons = json_decode($setting->social_link,true)['icons'];
          ?>
            <div class="footer-social-links mt-3">
                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link_key => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($link); ?>"><span><i class="<?php echo e($icons[$link_key]); ?>"></i></span></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </section>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <!-- Customer Info-->
          <div class="widget widget-links widget-light-skin">
            <h3 class="widget-title"><span style="color: white;">Useful Links&nbsp;</span></h3>
            <ul>
                <?php if($setting->is_faq == 1): ?>
                <li>
                    <a class="" href="<?php echo e(route('front.faq')); ?>"><?php echo e(__('Faq')); ?></a>
                </li>
                <?php endif; ?>
                <?php $__currentLoopData = DB::table('pages')->wherePos(2)->orwhere('pos',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(route('front.page',$page->slug)); ?>"><?php echo e($page->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <!-- Customer Service -->
          <div class="widget widget-links widget-light-skin">
            <h3 class="widget-title"><span style="color: white;">Customer Service&nbsp;</span></h3>
            <ul>
                <li><a href="<?php echo e(route('user.login')); ?>"><?php echo e(__('My Account')); ?></a></li>
                <li><a href="<?php echo e(route('front.order.track')); ?>"><?php echo e(__('Track Order')); ?></a></li>
                <li><a href="<?php echo e(route('user.wishlist.index')); ?>"><?php echo e(__('Wishlist')); ?></a></li>
                <li><a href="<?php echo e(route('front.cart')); ?>"><?php echo e(__('Cart')); ?></a></li>
                <?php if($setting->is_contact == 1): ?>
                <li><a href="<?php echo e(route('front.contact')); ?>"><?php echo e(__('Contact Us')); ?></a></li>
                <?php endif; ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <!-- Subscription-->
            <section class="widget">
              <h3 class="widget-title"><span style="color: white;">Newsletter&nbsp;</span></h3>
              <form class="row subscriber-form" action="<?php echo e(route('front.subscriber.submit')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control" type="email" name="email" placeholder="<?php echo e(__('Your e-mail')); ?>" style="border: 1px solid #444; background: transparent; color: #FFF;">
                    <span class="input-group-addon" style="border: 1px solid #444; background: #D4AF37; color: #FFF; border-color: #D4AF37;"><i class="icon-mail"></i></span> </div>
                  <div aria-hidden="true">
                    <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                  </div>
                </div>
                <div class="col-sm-12">
                  <button class="btn btn-block mt-2 text-white" style="background-color: #D4AF37; border-color: #D4AF37; width: 100%;" type="submit">
                      <span><?php echo e(__('Subscribe')); ?></span>
                  </button>
                </div>
                <div class="col-lg-12">
                    <p class="text-sm opacity-80 pt-2"><?php echo e(__('Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.')); ?></p>
                </div>
              </form>
              <div class="pt-3"><img class="d-block gateway_image" src="<?php echo e($setting->footer_gateway_img ? asset('assets/images/'.$setting->footer_gateway_img) : asset('system/resources/assets/images/placeholder.png')); ?>" style="max-width: 100%;"></div>
            </section>
          </div>
      </div>
      <!-- Copyright-->
      <p class="footer-copyright"> <?php echo e($setting->copy_right); ?> | Website Designed By : <a href="https://www.elitedesign.com.bd" target="_blank"><span style="color: white;">&nbsp;Elite Design</span></a></p>
    </div>
  </footer>

<!-- Back To Top Button-->
<a class="scroll-to-top-btn" href="#">
    <i class="icon-chevron-up"></i>
</a>
<!-- Backdrop-->
<div class="site-backdrop"></div>

<!-- Cookie alert dialog  -->
<?php if($setting->is_cookie == 1): ?>
<?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<!-- Cookie alert dialog  -->


<?php
    $mainbs = [];
    $mainbs['is_announcement'] = $setting->is_announcement;
    $mainbs['announcement_delay'] = $setting->announcement_delay;
    $mainbs['overlay'] = $setting->overlay;
    $mainbs = json_encode($mainbs);
?>

<script>
    var mainbs = <?php echo $mainbs; ?>;
    var decimal_separator = '<?php echo $setting->decimal_separator; ?>';
    var thousand_separator = '<?php echo $setting->thousand_separator; ?>';
</script>

<script>
    let language = {
        Days : '<?php echo e(__('Days')); ?>',
        Hrs : '<?php echo e(__('Hrs')); ?>',
        Min : '<?php echo e(__('Min')); ?>',
        Sec : '<?php echo e(__('Sec')); ?>',
    }

</script>



<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/plugins.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/scripts.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/lazy.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/lazy.plugin.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/myscript.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>

<?php if($setting->is_facebook_messenger	== '1'): ?>
 <?php echo $setting->facebook_messenger; ?>

<?php endif; ?>



<script type="text/javascript">
    let mainurl = '<?php echo e(route('front.index')); ?>';

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

    <?php if(Session::has('error')): ?>
    <script>
      $(document).ready(function(){
        DangerNotification('<?php echo e(Session::get('error')); ?>')
      })

    </script>
    <?php endif; ?>
    <?php if(Session::has('success')): ?>
    <script>
      $(document).ready(function(){
        SuccessNotification('<?php echo e(Session::get('success')); ?>');
      })

    </script>
    <?php endif; ?>

</body>
</html>
<?php /**PATH /var/www/html/source_code/core/resources/views/master/front.blade.php ENDPATH**/ ?>