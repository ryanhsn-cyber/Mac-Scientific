
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
<header class="site-header navbar-sticky">
    <div class="menu-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="t-m-s-a">
                        <a class="track-order-link" href="<?php echo e(route('front.order.track')); ?>"><i class="icon-map-pin"></i><?php echo e(__('Track Order')); ?></a>
                        <a class="track-order-link compare-mobile d-lg-none" href="<?php echo e(route('fornt.compare.index')); ?>"><?php echo e(__('Compare')); ?></a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="right-area">

                        <a class="track-order-link wishlist-mobile d-inline-block d-lg-none" href="<?php echo e(route('user.wishlist.index')); ?>"><i class="icon-heart"></i><?php echo e(__('Wishlist')); ?></a>
                        
                        <div class="t-h-dropdown ">
                            <a class="main-link" href="#"><?php echo e(__('Currency')); ?><i class="icon-chevron-down"></i></a>
                            <div class="t-h-dropdown-menu">
                                <?php $__currentLoopData = DB::table('currencies')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="<?php echo e(Session::get('currency') == $currency->id ? 'active' : ($currency->is_default == 1 && !Session::has('currency') ? 'active' : '')); ?>" href="<?php echo e(route('front.currency.setup',$currency->id)); ?>"><i class="icon-chevron-right pr-2"></i><?php echo e($currency->name); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="login-register ">
                            <?php if(!Auth::user()): ?>
                            <a class="track-order-link mr-0" href="<?php echo e(route('user.login')); ?>">
                            <?php echo e(__('Login/Register')); ?>

                            </a>
                            <?php else: ?>
                            <div class="t-h-dropdown">
                                <div class="main-link">
                                    <i class="icon-user pr-2"></i> <span class="text-label"><?php echo e(Auth::user()->first_name); ?></span>
                                </div>
                                <div class="t-h-dropdown-menu">
                                    <a href="<?php echo e(route('user.dashboard')); ?>"><i class="icon-chevron-right pr-2"></i><?php echo e(__('Dashboard')); ?></a>
                                    <a href="<?php echo e(route('user.logout')); ?>"><i class="icon-chevron-right pr-2"></i><?php echo e(__('Logout')); ?></a>
                                </div>
                            </div>
                            <?php endif; ?>
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
                        <div class="site-branding"><a class="site-logo align-self-center" href="<?php echo e(route('front.index')); ?>"><img src="<?php echo e(asset('assets/images/'.$setting->logo)); ?>" alt="<?php echo e($setting->title); ?>"></a></div>
                        <!-- Search / Categories-->
                        <div class="search-box-wrap d-none d-lg-block d-flex">
                        <div class="search-box-inner align-self-center">
                            <div class="search-box d-flex">
                                <select name="category" id="category_select" class="categoris">
									<option value=""><?php echo e(__('All')); ?></option>
                                    <?php $__currentLoopData = DB::table('categories')->whereStatus(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
                                <form class="input-group" id="header_search_form" action="<?php echo e(route('front.catalog')); ?>" method="get">
                                    <input type="hidden" name="category" value="" id="search__category">
                                    <span class="input-group-btn">
                                    <button type="submit"><i class="icon-search"></i></button>
                                    </span>
                                    <input class="form-control" type="text" data-target="<?php echo e(route('front.search.suggest')); ?>" id="__product__search" name="search" placeholder="<?php echo e(__('Search by product name')); ?>">
                                    <div class="serch-result d-none">
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                            <span class="d-block d-lg-none close-m-serch"><i class="icon-x"></i></span>
                        </div>
                        <!-- Toolbar-->
                        <div class="toolbar d-flex align-items-center">

                        <div class="toolbar-item close-m-serch visible-on-mobile"><a href="#">
                            <div>
                                <i class="icon-search"></i>
                            </div>
                            </a>
                        </div>
                        <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#">
                            <div><i class="icon-menu"></i><span class="text-label"><?php echo e(__('Menu')); ?></span></div>
                            </a>
                        </div>

                        <div class="toolbar-item hidden-on-mobile"><a href="<?php echo e(route('fornt.compare.index')); ?>">
                            <div><span class="compare-icon"><i class="icon-repeat"></i><span class="count-label compare_count"><?php echo e(Session::has('compare') ? count(Session::get('compare')) : '0'); ?></span></span><span class="text-label"><?php echo e(__('Compare')); ?></span></div>
                            </a>
                        </div>
                        <?php if(Auth::check()): ?>
                        <div class="toolbar-item hidden-on-mobile"><a href="<?php echo e(route('user.wishlist.index')); ?>">
                            <div><span class="compare-icon"><i class="icon-heart"></i><span class="count-label wishlist_count"><?php echo e(Auth::user()->wishlists->count()); ?></span></span><span class="text-label"><?php echo e(__('Wishlist')); ?></span></div>
                            </a>
                        </div>
                        <?php else: ?>
                        <div class="toolbar-item hidden-on-mobile"><a href="<?php echo e(route('user.wishlist.index')); ?>">
                          <div><span class="compare-icon"><i class="icon-heart"></i><span class="count-label wishlist_count">0</span></span><span class="text-label"><?php echo e(__('Wishlist')); ?></span></div>
                          </a>
                      </div>
                        <?php endif; ?>
                        <div class="toolbar-item"><a href="<?php echo e(route('front.cart')); ?>">
                            <div><span class="cart-icon"><i class="icon-shopping-cart"></i><span class="count-label cart_count"><?php echo e(Session::has('cart') ? count(Session::get('cart')) : '0'); ?> </span></span><span class="text-label"><?php echo e(__('Cart')); ?></span></div>
                            </a>
                            <div class="toolbar-dropdown cart-dropdown widget-cart  cart_view_header" id="header_cart_load" data-target="<?php echo e(route('front.header.cart')); ?>">
                            <?php echo $__env->make('includes.header_cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                            <?php $__currentLoopData = DB::table('categories')->whereStatus(1)->orderBy('serial', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="<?php echo e(request()->fullUrl() == route('front.catalog').'?category='.$category->slug ? 'active' : ''); ?>"><a href="<?php echo e(route('front.catalog').'?category='.$category->slug); ?>"><i class="icon-chevron-right"></i><?php echo e($category->name); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            </div>
        </div>
    </div>
  <!-- Navbar-->
  <div class="navbar">
        <div class="container">
            <div class="row g-3 w-100">
                <div class="col-lg-2">
                    <?php echo $__env->make('includes.categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-lg-10 d-flex justify-content-between">
                    <div class="nav-inner">
                        <nav class="site-menu">
                            <ul>
                                <li class="<?php echo e(request()->routeIs('front.index') ? 'active' : ''); ?>"><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a></li>
                                <?php $__currentLoopData = DB::table('categories')->whereStatus(1)->orderBy('serial', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php echo e(request()->fullUrl() == route('front.catalog').'?category='.$category->slug ? 'active' : ''); ?>"><a href="<?php echo e(route('front.catalog').'?category='.$category->slug); ?>"><?php echo e($category->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </nav>

                    </div>
                    <?php
                        $free_shipping = DB::table('shipping_services')->whereStatus(1)->whereIsCondition(1)->first()
                    ?>

                </div>
            </div>
        </div>
    </div>

</header>
<!-- Page Content-->
<?php echo $__env->yieldContent('content'); ?>

<!--    announcement banner section removed   -->

<!-- Site Footer-->
<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <!-- Contact Info-->
          <section class="widget widget-light-skin">
            <h3 class="widget-title"><span style="color: white;">Get In Touch&nbsp;</span></h3>
            <p class="mb-1"><strong><?php echo e(__('Address')); ?>: </strong> <?php echo e($setting->footer_address); ?></p>
            <p class="mb-1"><strong><?php echo e(__('Phone')); ?>: </strong> <a href="tel:<?php echo e($setting->footer_phone); ?>" class="text-white"><?php echo e($setting->footer_phone); ?></a></p>
            <p class="mb-1"><strong><?php echo e(__('WhatsApp')); ?>: </strong> <a href="https://wa.me/8801312699221" target="_blank" class="text-white">+8801312699221</a></p>
            <p class="mb-3"><strong><?php echo e(__('Email')); ?>: </strong> <a href="mailto:<?php echo e($setting->footer_email); ?>" class="text-white"><?php echo e($setting->footer_email); ?></a></p>
            <?php
            $links = json_decode($setting->social_link,true)['links'];
            $icons = json_decode($setting->social_link,true)['icons'];
            ?>
            <div class="footer-social-links">
                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link_key => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($link); ?>" target="_blank"><span><i class="<?php echo e($icons[$link_key]); ?>"></i></span></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </section>
        </div>
        <div class="col-lg-4 col-sm-6">
          <!-- Customer Info-->
          <div class="widget widget-links widget-light-skin">
            <h3 class="widget-title"><span style="color: white;">Usefull Links&nbsp;</span></h3>
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
        <div class="col-lg-4">
            <!-- Subscription-->
            <section class="widget">
              <h3 class="widget-title"><span style="color: white;">Newsletter&nbsp;</span></h3>
              <form class="row subscriber-form" action="<?php echo e(route('front.subscriber.submit')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control" type="email" name="email" placeholder="<?php echo e(__('Your e-mail')); ?>">
                    <span class="input-group-addon"><i class="icon-mail"></i></span> </div>
                  <div aria-hidden="true">
                    <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                  </div>

                </div>
                <div class="col-sm-12">
                  <button class="btn btn-primary btn-block mt-2" type="submit">
                      <span><?php echo e(__('Subscribe')); ?></span>
                  </button>
                </div>
                <div class="col-lg-12">
                    <p class="text-sm opacity-80 pt-2"><?php echo e(__('Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.')); ?></p>
                </div>
              </form>
              <div class="pt-3"><img class="d-block gateway_image" src="<?php echo e($setting->footer_gateway_img ? asset('assets/images/'.$setting->footer_gateway_img) : asset('system/resources/assets/images/placeholder.png')); ?>"></div>
            </section>
          </div>
      </div>
      <p class="footer-copyright"> <?php echo e($setting->copy_right); ?> | Website Designed By : <a href="#" target="_blank"><span style="color: white;">&nbsp;Shohoj Solution</span></a></p>
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