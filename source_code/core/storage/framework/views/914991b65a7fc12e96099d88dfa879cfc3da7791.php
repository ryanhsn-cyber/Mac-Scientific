
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


<!-- Tailwind CSS Integration -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif'],
                        'headline-md': ['Manrope', 'sans-serif'],
                        'body-md': ['Manrope', 'sans-serif'],
                        'label-md': ['Manrope', 'sans-serif'],
                        'display-lg': ['Manrope', 'sans-serif'],
                        'headline-sm': ['Manrope', 'sans-serif'],
                        'body-sm': ['Manrope', 'sans-serif'],
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
<!-- Header-->
<header class="w-full bg-surface" style="box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
<!-- Utility Bar -->
<div class="bg-surface-container-low text-body-sm py-1 border-b border-outline-variant">
<div class="w-full max-w-container-max mx-auto px-margin-mobile md:px-gutter flex justify-between items-center">
<div class="flex space-x-4">
<a class="text-secondary hover:text-primary transition-colors" href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a>
<?php if($setting->is_contact == 1): ?>
<a class="text-secondary hover:text-primary transition-colors" href="<?php echo e(route('front.contact')); ?>"><?php echo e(__('Contact us')); ?></a>
<?php endif; ?>
<?php if($setting->is_blog == 1): ?>
<a class="text-secondary hover:text-primary transition-colors" href="<?php echo e(route('front.blog')); ?>"><?php echo e(__('Blog')); ?></a>
<?php endif; ?>
</div>
<div class="flex space-x-4 items-center">
<div class="flex items-center space-x-1 cursor-pointer hover:text-primary transition-colors text-secondary t-h-dropdown">
  <a class="main-link text-secondary hover:text-primary transition-colors flex items-center" href="#"><?php echo e(__('Currency')); ?> <span class="material-symbols-outlined text-[16px] ml-1">expand_more</span></a>
  <div class="t-h-dropdown-menu bg-white border border-outline-variant shadow-sm mt-2 p-2 absolute z-50">
      <?php $__currentLoopData = DB::table('currencies')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a class="block px-2 py-1 hover:bg-gray-100 text-sm <?php echo e(Session::get('currency') == $currency->id ? 'text-primary font-bold' : ($currency->is_default == 1 && !Session::has('currency') ? 'text-primary font-bold' : 'text-secondary')); ?>" href="<?php echo e(route('front.currency.setup',$currency->id)); ?>"><?php echo e($currency->name); ?></a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>
<a class="flex items-center space-x-1 text-secondary hover:text-primary transition-colors" href="<?php echo e(route('user.wishlist.index')); ?>">
<span class="material-symbols-outlined text-[16px]">favorite</span>
<span><?php echo e(__('Wishlist')); ?> (<?php echo e(Session::has('wishlist') ? count(Session::get('wishlist')) : '0'); ?>)</span>
</a>
</div>
</div>
</div>
<!-- Main Header -->
<div class="w-full max-w-container-max mx-auto px-margin-mobile md:px-gutter py-6 flex flex-col md:flex-row justify-between items-center">
<!-- Logo -->
<a class="flex-shrink-0 mb-4 md:mb-0 site-logo" href="<?php echo e(route('front.index')); ?>">
<img src="<?php echo e(asset('assets/images/'.$setting->logo)); ?>" alt="<?php echo e($setting->title); ?>" style="max-height: 60px;">
</a>
<!-- Search Bar -->
<div class="w-full md:w-1/2 max-w-2xl mb-4 md:mb-0 px-4">
<form class="relative w-full" action="<?php echo e(route('front.catalog')); ?>" method="get">
<input name="search" class="w-full py-2 px-4 border border-outline rounded-round-four focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary bg-surface-container-lowest text-body-md" placeholder="<?php echo e(__('Search our catalog')); ?>" type="text"/>
<button type="submit" class="absolute right-3 top-2.5 text-secondary hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[20px]">search</span>
</button>
</form>
</div>
<!-- Actions -->
<div class="flex items-center space-x-6">
<div class="flex items-center space-x-2">
<div class="relative text-on-surface">
<a href="<?php echo e(route('front.cart')); ?>">
<span class="material-symbols-outlined text-[28px]">shopping_bag</span>
<span class="absolute -top-1 -right-2 bg-primary text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center"><?php echo e(Session::has('cart') ? count(Session::get('cart')) : '0'); ?></span>
</a>
</div>
<div class="flex flex-col text-sm ml-1">
<span class="font-bold text-on-surface"><a href="<?php echo e(route('front.cart')); ?>"><?php echo e(__('Cart')); ?></a></span>
</div>
</div>
<div class="login-register">
<?php if(!Auth::user()): ?>
<a class="flex items-center space-x-1 text-secondary hover:text-primary transition-colors text-label-md" href="<?php echo e(route('user.login')); ?>">
<span class="material-symbols-outlined text-[20px]">person</span>
<span><?php echo e(__('Sign in')); ?></span>
</a>
<?php else: ?>
<div class="t-h-dropdown flex items-center space-x-1 text-secondary hover:text-primary transition-colors text-label-md cursor-pointer relative">
    <a class="main-link flex items-center" href="#"><span class="material-symbols-outlined text-[20px] mr-1">person</span> <?php echo e(Auth::user()->first_name); ?></a>
    <div class="t-h-dropdown-menu bg-white border border-outline-variant shadow-sm mt-2 py-2 absolute z-50 right-0 w-32">
        <a class="block px-4 py-1 text-sm text-secondary hover:bg-gray-100" href="<?php echo e(route('user.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
        <a class="block px-4 py-1 text-sm text-secondary hover:bg-gray-100" href="<?php echo e(route('user.logout')); ?>"><?php echo e(__('Logout')); ?></a>
    </div>
</div>
<?php endif; ?>
</div>
</div>
</div>
<!-- Main Navigation -->
<nav class="border-t border-b border-outline-variant py-3 bg-surface">
<div class="w-full max-w-container-max mx-auto px-margin-mobile md:px-gutter">
<ul class="flex flex-wrap justify-center md:justify-start space-x-6 lg:space-x-8 text-label-md font-bold uppercase text-[13px]">
<?php $__currentLoopData = DB::table('categories')->whereStatus(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li><a class="text-secondary hover:text-primary transition-colors border-b-2 border-transparent hover:border-primary pb-1" href="<?php echo e(route('front.catalog').'?category='.$category->slug); ?>"><?php echo e($category->name); ?></a></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
</div>
</nav>
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