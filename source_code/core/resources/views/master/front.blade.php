
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
<style>
@font-face{font-family:"Open Sans";font-style:normal;font-weight:300;font-stretch:normal;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v44/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsiH0C4n.ttf) format("truetype")}@font-face{font-family:"Open Sans";font-style:normal;font-weight:400;font-stretch:normal;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v44/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsjZ0C4n.ttf) format("truetype")}@font-face{font-family:"Open Sans";font-style:normal;font-weight:500;font-stretch:normal;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v44/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsjr0C4n.ttf) format("truetype")}@font-face{font-family:"Open Sans";font-style:normal;font-weight:600;font-stretch:normal;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v44/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsgH1y4n.ttf) format("truetype")}@font-face{font-family:"Open Sans";font-style:normal;font-weight:700;font-stretch:normal;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v44/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsg-1y4n.ttf) format("truetype")}@font-face{font-family:"Open Sans";font-style:normal;font-weight:800;font-stretch:normal;font-display:swap;src:url(https://fonts.gstatic.com/s/opensans/v44/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgshZ1y4n.ttf) format("truetype")}:root{--bs-blue:#0d6efd;--bs-indigo:#6610f2;--bs-purple:#6f42c1;--bs-pink:#d63384;--bs-red:#dc3545;--bs-orange:#fd7e14;--bs-yellow:#ffc107;--bs-green:#198754;--bs-teal:#20c997;--bs-cyan:#0dcaf0;--bs-white:#fff;--bs-gray:#6c757d;--bs-gray-dark:#343a40;--bs-gray-100:#f8f9fa;--bs-gray-200:#e9ecef;--bs-gray-300:#dee2e6;--bs-gray-400:#ced4da;--bs-gray-500:#adb5bd;--bs-gray-600:#6c757d;--bs-gray-700:#495057;--bs-gray-800:#343a40;--bs-gray-900:#212529;--bs-primary:#0d6efd;--bs-secondary:#6c757d;--bs-success:#198754;--bs-info:#0dcaf0;--bs-warning:#ffc107;--bs-danger:#dc3545;--bs-light:#f8f9fa;--bs-dark:#212529;--bs-primary-rgb:13,110,253;--bs-secondary-rgb:108,117,125;--bs-success-rgb:25,135,84;--bs-info-rgb:13,202,240;--bs-warning-rgb:255,193,7;--bs-danger-rgb:220,53,69;--bs-light-rgb:248,249,250;--bs-dark-rgb:33,37,41;--bs-white-rgb:255,255,255;--bs-black-rgb:0,0,0;--bs-body-color-rgb:33,37,41;--bs-body-bg-rgb:255,255,255;--bs-font-sans-serif:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--bs-font-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--bs-gradient:linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));--bs-body-font-family:var(--bs-font-sans-serif);--bs-body-font-size:1rem;--bs-body-font-weight:400;--bs-body-line-height:1.5;--bs-body-color:#212529;--bs-body-bg:#fff}*,::after,::before{box-sizing:border-box}@media (prefers-reduced-motion:no-preference){:root{scroll-behavior:smooth}}body{margin:0;font-family:var(--bs-body-font-family);font-size:var(--bs-body-font-size);font-weight:var(--bs-body-font-weight);line-height:var(--bs-body-line-height);color:var(--bs-body-color);text-align:var(--bs-body-text-align);background-color:var(--bs-body-bg);-webkit-text-size-adjust:100%}.h3,h2,h3,h4,h6{margin-top:0;margin-bottom:.5rem;font-weight:500;line-height:1.2}h2{font-size:calc(1.325rem + .9vw)}@media (min-width:1200px){h2{font-size:2rem}}.h3,h3{font-size:calc(1.3rem + .6vw)}@media (min-width:1200px){.h3,h3{font-size:1.75rem}}h4{font-size:calc(1.275rem + .3vw)}@media (min-width:1200px){h4{font-size:1.5rem}}h6{font-size:1rem}p{margin-top:0;margin-bottom:1rem}ul{padding-left:2rem}ul{margin-top:0;margin-bottom:1rem}a{color:#0d6efd;text-decoration:underline}img{vertical-align:middle}button{border-radius:0}button,input,select{margin:0;font-family:inherit;font-size:inherit;line-height:inherit}button,select{text-transform:none}select{word-wrap:normal}[type=submit],button{-webkit-appearance:button}::-moz-focus-inner{padding:0;border-style:none}::-webkit-datetime-edit-day-field,::-webkit-datetime-edit-fields-wrapper,::-webkit-datetime-edit-hour-field,::-webkit-datetime-edit-minute,::-webkit-datetime-edit-month-field,::-webkit-datetime-edit-text,::-webkit-datetime-edit-year-field{padding:0}::-webkit-inner-spin-button{height:auto}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-color-swatch-wrapper{padding:0}::file-selector-button{font:inherit}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}.container{width:100%;padding-right:var(--bs-gutter-x,.75rem);padding-left:var(--bs-gutter-x,.75rem);margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.row{--bs-gutter-x:1.5rem;--bs-gutter-y:0;display:flex;flex-wrap:wrap;margin-top:calc(var(--bs-gutter-y)*-1);margin-right:calc(var(--bs-gutter-x)*-.5);margin-left:calc(var(--bs-gutter-x)*-.5)}.row>*{flex-shrink:0;width:100%;max-width:100%;padding-right:calc(var(--bs-gutter-x)*.5);padding-left:calc(var(--bs-gutter-x)*.5);margin-top:var(--bs-gutter-y)}.g-3{--bs-gutter-x:1rem}.g-3{--bs-gutter-y:1rem}@media (min-width:576px){.col-sm-6{flex:0 0 auto;width:50%}}@media (min-width:768px){.col-md-4{flex:0 0 auto;width:33.33333333%}.col-md-8{flex:0 0 auto;width:66.66666667%}}@media (min-width:992px){.col-lg-2{flex:0 0 auto;width:16.66666667%}.col-lg-3{flex:0 0 auto;width:25%}.col-lg-10{flex:0 0 auto;width:83.33333333%}.col-lg-12{flex:0 0 auto;width:100%}}.form-control{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem}.form-control::-webkit-date-and-time-value{height:1.5em}.form-control::-moz-placeholder{color:#6c757d;opacity:1}.form-control::-webkit-file-upload-button{padding:.375rem .75rem;margin:-.375rem -.75rem;-webkit-margin-end:.75rem;margin-inline-end:.75rem;color:#212529;background-color:#e9ecef;border-color:inherit;border-style:solid;border-width:0;border-inline-end-width:1px;border-radius:0}.input-group{position:relative;display:flex;flex-wrap:wrap;align-items:stretch;width:100%}.input-group>.form-control{position:relative;flex:1 1 auto;width:1%;min-width:0}.input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu){border-top-right-radius:0;border-bottom-right-radius:0}.input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback){margin-left:-1px;border-top-left-radius:0;border-bottom-left-radius:0}.fade:not(.show){opacity:0}.nav{display:flex;flex-wrap:wrap;padding-left:0;margin-bottom:0;list-style:none}.nav-tabs{border-bottom:1px solid #dee2e6}.tab-content>.tab-pane{display:none}.tab-content>.active{display:block}.navbar{position:relative;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;padding-top:.5rem;padding-bottom:.5rem}.navbar>.container{display:flex;flex-wrap:inherit;align-items:center;justify-content:space-between}.d-inline-block{display:inline-block!important}.d-block{display:block!important}.d-flex{display:flex!important}.d-none{display:none!important}.w-100{width:100%!important}.justify-content-between{justify-content:space-between!important}.align-items-center{align-items:center!important}.align-self-center{align-self:center!important}.mt-0{margin-top:0!important}.mb-0{margin-bottom:0!important}.mb-2{margin-bottom:.5rem!important}.p-0{padding:0!important}.pt-0{padding-top:0!important}.text-center{text-align:center!important}.text-body{--bs-text-opacity:1;color:rgba(var(--bs-body-color-rgb),var(--bs-text-opacity))!important}.text-muted{--bs-text-opacity:1;color:#6c757d!important}.bg-info{--bs-bg-opacity:1;background-color:rgba(var(--bs-info-rgb),var(--bs-bg-opacity))!important}@media (min-width:992px){.d-lg-block{display:block!important}.d-lg-none{display:none!important}}:root{--animate-duration:1s;--animate-delay:1s;--animate-repeat:1}.fab,.far{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;display:inline-block;font-style:normal;font-variant:normal;text-rendering:auto;line-height:1}.fa-star:before{content:""}.fa-whatsapp:before{content:""}@font-face{font-family:"Font Awesome 5 Brands";font-style:normal;font-weight:400;font-display:auto;src:url(assets/front/fonts/fa-brands-400.eot);src:url(assets/front/fonts/fa-brands-400.eot?#iefix) format("embedded-opentype"),url(assets/front/fonts/fa-brands-400.woff2) format("woff2"),url(assets/front/fonts/fa-brands-400.woff) format("woff"),url(assets/front/fonts/fa-brands-400.ttf) format("truetype"),url(assets/front/fonts/fa-brands-400.svg#fontawesome) format("svg")}.fab{font-family:"Font Awesome 5 Brands"}@font-face{font-family:"Font Awesome 5 Pro";font-style:normal;font-weight:300;font-display:auto;src:url(assets/front/fonts/fa-light-300.eot);src:url(assets/front/fonts/fa-light-300.eot?#iefix) format("embedded-opentype"),url(assets/front/fonts/fa-light-300.woff2) format("woff2"),url(assets/front/fonts/fa-light-300.woff) format("woff"),url(assets/front/fonts/fa-light-300.ttf) format("truetype"),url(assets/front/fonts/fa-light-300.svg#fontawesome) format("svg")}@font-face{font-family:"Font Awesome 5 Pro";font-style:normal;font-weight:400;font-display:auto;src:url(assets/front/fonts/fa-regular-400.eot);src:url(assets/front/fonts/fa-regular-400.eot?#iefix) format("embedded-opentype"),url(assets/front/fonts/fa-regular-400.woff2) format("woff2"),url(assets/front/fonts/fa-regular-400.woff) format("woff"),url(assets/front/fonts/fa-regular-400.ttf) format("truetype"),url(assets/front/fonts/fa-regular-400.svg#fontawesome) format("svg")}.far{font-family:"Font Awesome 5 Pro";font-weight:400}@font-face{font-family:"Font Awesome 5 Pro";font-style:normal;font-weight:900;font-display:auto;src:url(assets/front/fonts/fa-solid-900.eot);src:url(assets/front/fonts/fa-solid-900.eot?#iefix) format("embedded-opentype"),url(assets/front/fonts/fa-solid-900.woff2) format("woff2"),url(assets/front/fonts/fa-solid-900.woff) format("woff"),url(assets/front/fonts/fa-solid-900.ttf) format("truetype"),url(assets/front/fonts/fa-solid-900.svg#fontawesome) format("svg")}@font-face{font-family:feather;src:url(assets/front/fonts/feather.eot);src:url(assets/front/fonts/feather.eot?#iefix) format("embedded-opentype"),url(assets/front/fonts/feather.woff) format("woff"),url(assets/front/fonts/feather.ttf) format("truetype"),url(assets/front/fonts/feather.svg#feather) format("svg")}[class^=icon-]{font-family:feather!important;speak:none;font-style:normal;font-weight:400;font-variant:normal;text-transform:none;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.icon-align-justify:before{content:""}.icon-chevron-down:before{content:""}.icon-chevron-right:before{content:""}.icon-heart:before{content:""}.icon-map-pin:before{content:""}.icon-menu:before{content:""}.icon-repeat:before{content:""}.icon-search:before{content:""}.icon-shopping-cart:before{content:""}.icon-x:before{content:""}button::-moz-focus-inner{padding:0;border:0}.toolbar-dropdown{display:none;position:absolute;top:80%;left:0;width:200px;padding:10px 0;border:1px solid #e5e5e5;border-bottom-right-radius:5px;border-bottom-left-radius:5px;background-color:#fff;line-height:1.5;box-shadow:0 7px 22px -5px rgba(0,0,0,.2)}a{text-decoration:none!important}.slideable-menu{position:relative;border-top:1px solid #e5e5e5;background-color:#fff;overflow:hidden;padding:10px 15px}.slideable-menu ul{margin:0;padding:0}.slideable-menu ul li{list-style:none}.slideable-menu ul li a{color:#505050;line-height:28px}html *{text-rendering:optimizeLegibility;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}body{background-position:center;background-color:#f3f5f6;background-repeat:no-repeat;background-size:cover;color:#6c757d;font-family:"Open Sans",sans-serif;font-size:15px;font-weight:400;line-height:1.5;text-transform:none;text-decoration:none}a{color:#377dff;text-decoration:underline}.navi-link{color:#505050;text-decoration:none}img{max-width:100%;height:auto;vertical-align:middle}*{box-sizing:border-box}::after,::before{box-sizing:border-box}.input-group>.form-control{display:block!important;width:100%!important;max-width:100%!important;border-radius:0!important}@media (max-width:1200px){.container{width:100%!important;max-width:100%!important}}.text-muted{color:#777!important}.text-gray-dark{color:#232323!important}.text-body{color:#505050!important}.bg-info{background-color:#2196f3!important}.mb-30{margin-bottom:30px!important}.mt-30{margin-top:30px!important}.mt-50{margin-top:50px!important}@media (max-width:767px){.menu-top-area .right-area{text-align:center!important}}.h3,h2,h3,h4,h6{margin:0;color:#232323;text-transform:none}h2{margin-bottom:20px;font-size:32px;font-weight:300;line-height:1.2}@media (max-width:768px){h2{font-size:30px}}.h3,h3{margin-bottom:20px;font-size:28px;font-weight:300;line-height:1.25}h4{margin-bottom:16px;font-size:24px;line-height:1.3}h6{margin-bottom:12px;font-size:18px;font-weight:400;line-height:1.4}p{margin:0 0 20px}.text-sm{font-size:13px}ul{margin-top:0;margin-bottom:20px;padding-left:18px;line-height:1.8}ul ul{margin-bottom:0}.form-control{padding:0 18px;border:1px solid #e0e0e0;border-radius:5px;background-color:#fff;color:#505050;font-family:"Open Sans",sans-serif;font-size:14px;-webkit-appearance:none;-moz-appearance:none;appearance:none}.form-control:not(textarea){height:46px}.form-control::-moz-placeholder{color:#999;opacity:1}.form-control:-ms-input-placeholder{color:#999}.form-control::-webkit-input-placeholder{color:#999}.input-group{display:block;position:relative}.input-group .input-group-btn{display:inline-block;position:absolute;top:50%;margin-top:2px;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);font-size:1.1em}.input-group .input-group-btn{margin-top:3px}.input-group .form-control{padding-left:37px}.input-group .input-group-btn{right:10px;z-index:9}.input-group .input-group-btn button{border:0;background:0;color:#505050;font-size:1.2em}.input-group .input-group-btn~.form-control{padding-right:38px;padding-left:18px}.nav-tabs{border-bottom:0!important;text-align:center;display:block}.tab-content{padding:30px;overflow:hidden;border-radius:6px;background:#fff}.tab-content ul:last-child{margin-bottom:0}.toolbar-dropdown{right:-1px;left:auto;z-index:10}.toolbar-dropdown.cart-dropdown{right:0;width:280px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);border:0;max-height:350px;overflow-y:auto}.owl-carousel{display:none;position:relative;width:100%;z-index:1}.slider-area-wrapper{margin-top:30px}.hero-slider{background-color:#fff;position:relative;border-radius:10px;overflow:hidden}.hero-slider .item{overflow:hidden;height:440px;display:flex;align-items:center;padding:0 60px;background-size:cover!important;background-repeat:no-repeat!important;background-position:center!important}@media (max-width:991px){.site-header .topbar{border-bottom:0!important}}.widget-categories ul{margin:0;padding:0;list-style:none}.widget-categories ul>li{position:relative;margin-bottom:5px;padding-left:16px}.widget-categories ul>li:last-child{margin-bottom:0}.widget-categories ul>li::before{display:block;position:absolute;top:-1px;left:0;-webkit-transform:rotate(-90deg);-ms-transform:rotate(-90deg);transform:rotate(-90deg);color:#999;font-family:feather;font-size:1.15em;content:""}.widget-categories ul>li>a{display:inline-block;color:#6c757d;font-size:14px;text-decoration:none}.widget-categories ul>li.has-children ul{border-left:1px solid #e2e2e2}.widget-categories ul>li.has-children ul li::before{top:14px;width:8px;height:1px;-webkit-transform:none;-ms-transform:none;transform:none;border:0;background-color:#e2e2e2;color:transparent}.widget-categories ul>li.has-children ul li a{font-size:13px}.widget-categories ul>li.has-children>ul{max-height:0;overflow:hidden}.site-header{position:relative;z-index:1000}.site-header .topbar{border-bottom:1px solid #e5e5e5;background-color:#fff}.site-header .navbar{position:relative;width:100%;background:#fff}.site-header .navbar .nav-inner{display:flex;padding-left:4px}.site-header .site-branding{-ms-flex-preferred-size:auto;flex-basis:auto;-webkit-box-flex:0;-ms-flex-positive:0;flex-grow:0;-ms-flex-negative:0;flex-shrink:0;padding:18px 0}.site-header .site-branding .site-logo{display:block;width:136px;color:#232323!important;text-decoration:none}.site-header .site-branding .site-logo>img{display:block;width:100%}.site-header .search-box-wrap{width:100%;padding:18px 30px}.site-header .search-box-wrap .search-box-inner{width:100%}.site-header .search-box-wrap .search-box{width:100%}.site-header .search-box-wrap .input-group{width:100%;position:relative}.site-header .search-box-wrap .input-group .serch-result{position:absolute;top:100%;left:0;z-index:999;background:#fff;width:100%;padding:15px 15px 7px;border:1px solid #e0e0e0;border-top:0}.site-header .toolbar{-ms-flex-preferred-size:auto;flex-basis:auto;-webkit-box-flex:0;-ms-flex-positive:0;flex-grow:0;-ms-flex-negative:0;flex-shrink:0}.site-header .toolbar .toolbar-item{position:relative;width:90px;margin-left:10px}.site-header .toolbar .toolbar-item.visible-on-mobile{display:none}.site-header .toolbar .toolbar-item>a{display:block;position:absolute;top:0;left:0;width:100%;height:100%;padding:5px;color:#505050;text-align:center;text-decoration:none;background:border-box}.site-header .toolbar .toolbar-item>a>div{position:absolute;top:50%;left:0;width:100%;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);text-align:center}.site-header .toolbar .toolbar-item>a>div i{display:inline-block;margin-bottom:6px;font-size:20px}.site-header .toolbar .toolbar-item>a>div>.text-label{display:block;font-size:12px;font-weight:400}.site-header .toolbar .toolbar-item>a>div>.cart-icon,.site-header .toolbar .toolbar-item>a>div>.compare-icon{display:inline-block;position:relative}.site-header .toolbar .toolbar-item>a>div>.cart-icon>.count-label,.site-header .toolbar .toolbar-item>a>div>.compare-icon>.count-label{display:block;position:absolute;top:-6px;right:-13px;width:18px;height:18px;border-radius:50%;background-color:#377dff;color:#fff;font-size:11px;line-height:18px}.site-header .toolbar .toolbar-item>a>div>.compare-icon>.count-label{right:-17px;border:1px solid #e5e5e5;background-color:#f5f5f5;color:#505050}.site-header .site-menu{display:block;position:relative;width:100%;z-index:1}.site-header .site-menu ul{margin:0;padding:0;list-style:none}.site-header .site-menu ul>li>a{color:#505050;text-decoration:none}.site-header .site-menu>ul>li{display:table-cell;position:relative;vertical-align:middle}.site-header .site-menu>ul>li>a{display:block;position:relative;padding:13px 30px;border-right:1px solid transparent;border-left:1px solid transparent;font-size:15px;z-index:5;font-weight:500}.site-header .site-menu>ul>li>a:first-child{padding-left:0}.site-header .site-menu>ul>li>a::after{display:none}.site-header .site-menu>ul>li.active>a{color:#377dff}.mm-heading-area{display:flex;justify-content:space-between;padding:10px 15px;background:red;color:#fff}.mm-heading-area h4{font-size:18px;font-weight:400;margin-bottom:0;color:#fff}.mm-heading-area .mm-t-two i{color:#fff}.mobile-menu{display:none;position:fixed;top:0;left:0;width:300px;height:100%;overflow-y:auto;background-color:#fff;z-index:999999;box-shadow:0 7px 30px -6px rgba(0,0,0,.15)}.mobile-menu .nav-tabs{display:flex}.mobile-menu .nav-tabs li{width:50%}.mobile-menu .nav-tabs li span{width:100%;background:#f5f6f9;display:block;font-size:15px;font-weight:400;padding:5px 0}.mobile-menu .nav-tabs li span.active{background:#fff}@media (max-width:360px){.site-header .toolbar .toolbar-item{width:75px}}@media (max-width:991px){body{padding-top:0!important}.hidden-on-mobile,.navbar{display:none!important}.site-header .site-branding{border:0}.site-header .toolbar .toolbar-item.visible-on-mobile{display:block}.t-h-dropdown .t-h-dropdown-menu{left:auto!important;right:0}.left-category-area{margin-bottom:30px}.site-header .toolbar .toolbar-item.visible-on-mobile .text-label,.site-header .toolbar .toolbar-item>a>div>.text-label{display:none}.site-header .toolbar .toolbar-item{position:relative;width:45px;margin-left:10px}}.product-card{display:block;position:relative;width:100%;border-radius:10px;background-color:#fff;overflow:hidden;border:1px solid #fff}.product-card .product-card-body{padding:15px 15px 10px}.product-card .product-thumb{display:block;width:100%;border-top-left-radius:5px;border-top-right-radius:5px;overflow:hidden;position:relative}.product-card .product-category{width:100%;margin-bottom:6px;font-size:13px}.product-card .product-category>a{color:#999;text-decoration:none}.product-card .product-title{margin-bottom:5px;font-size:16px;font-weight:400}.product-card .product-title>a{color:#232323;text-decoration:none;font-size:14px;height:37px;display:block;font-weight:500;line-height:18px}.product-card .product-price{display:inline-block;margin-bottom:10px;font-size:15px;font-weight:600;text-align:center;color:#377dff}.product-card .product-price>del{margin-right:5px;color:#999;font-weight:400;font-size:14px}.product-card .product-button-group{position:absolute;left:0;bottom:-15px;width:100%;text-align:center;opacity:0;visibility:hidden;z-index:2}.product-card .product-button-group .product-button{height:35px;width:35px;line-height:36px;color:#fff;padding:0;text-align:center;text-decoration:none;display:inline-block;border-radius:50%;box-shadow:2px 2px 5px 0 #0000000f;margin:0 4px}.product-card .product-badge{top:15px;left:0;border-radius:0 9px 30px 0;padding:0 12px 0 10px}.product-card .product-badge.product-badge2{left:auto;right:0;border-radius:9px 0 0 30px;padding:0 10px 0 12px;background:#daa520!important}.product-card .rating-stars{display:block;margin-bottom:5px}.product-badge{position:absolute;height:24px;padding:0 14px;border-radius:3px;color:#fff;font-size:12px;font-weight:400;letter-spacing:.025em;line-height:24px;white-space:nowrap;z-index:9}.rating-stars{display:inline-block}.rating-stars>i{display:inline-block;margin-right:2px;color:#777;font-size:12px}.rating-stars>i.filled{color:#ffa000}.rating-stars>i:last-child{margin-right:0}@media screen and (-ms-high-contrast:active),screen and (-ms-high-contrast:none){.product-card .product-button-group .product-button>i{-webkit-transform:translateY(0)!important;-ms-transform:translateY(0)!important;transform:translateY(0)!important}}@supports (-ms-ime-align:auto){.product-card .product-button-group .product-button>i{-webkit-transform:translateY(0)!important;-ms-transform:translateY(0)!important;transform:translateY(0)!important}}.menu-top-area{padding:10px 0;background:#fff}.menu-top-area .right-area{text-align:right}.track-order-link{color:#fff;font-size:15px;font-weight:500;text-decoration:none;display:inline-block}.track-order-link i{margin-top:2px;position:relative;top:2px;right:4px}.t-h-dropdown .main-link{color:#fff}.t-h-dropdown{position:relative;display:inline-block;margin-right:30px}.t-h-dropdown .main-link i{margin-top:2px;position:relative;top:2px;left:4px}.t-h-dropdown .t-h-dropdown-menu{position:absolute;left:0;top:100%;background:#fff;text-align:left;display:block;z-index:999;width:140px;padding:10px 15px;border-top:2px solid #377dff;box-shadow:2px 2px 10px 0 rgba(0,0,0,.2);visibility:hidden;opacity:0}.t-h-dropdown .t-h-dropdown-menu a{display:block;line-height:26px}.login-register{display:inline-block}.menu-top-area .login-register a,.t-h-dropdown a{color:#505050;font-size:15px;font-weight:500;text-decoration:none}.menu-top-area .login-register .track-order-link{color:#fff}.t-h-dropdown a.active{color:#377dff}.navbar{padding:0!important}.left-category-area{background:#fff;border-radius:5px;position:relative}.left-category-area .category-header h4{background:#377dff;color:#fff;font-size:18px;padding:15px;margin-bottom:0}.left-category-area .category-header h4 i{position:relative;top:2px;margin-right:3px}.left-category-area .category-list{padding:9px 0;position:absolute;left:0;top:100%;margin-top:0;width:100%;border-radius:5px;background:#fff;opacity:0;visibility:hidden}.left-category-area .category-list .navi-link{display:flex;justify-content:start;padding:8px 15px}.left-category-area .category-list .navi-link:last-child{border-bottom:0}.left-category-area .category-list .navi-link span{display:inline-block;padding-left:8px}.left-category-area .category-list .navi-link i{float:right;position:relative;right:-7px;top:11px}.left-category-area .category-list .sub-c-box{position:absolute;left:100%;top:0;width:250px;min-height:100%;background:#fff;box-shadow:0 1px 3px rgba(0,0,0,.06),0 1px 3px rgba(0,0,0,.06);border-radius:5px;display:none;background-repeat:no-repeat;background-position:right bottom}.left-category-area .category-list .sub-c-box .child-c-box{border-bottom:1px solid #e5e5e5}.left-category-area .category-list .sub-c-box .child-c-box:last-child{border-bottom:0}.left-category-area .category-list .sub-c-box .title{color:#555;display:block;line-height:40px;display:block;padding:0 15px}.left-category-area .category-list .c-item{border-bottom:1px solid #e5e5e5}.section-title{border-bottom:2px solid rgba(0,0,0,.06);padding-bottom:0;margin-bottom:25px}.section-title h2{padding-bottom:12px;margin-bottom:0;font-weight:600;font-size:24px;position:relative}.section-title h2::before{position:absolute;content:"";height:2px;width:100%;bottom:-2px;left:0;background:#377dff}.section-title{display:flex;justify-content:space-between;align-items:flex-start;align-items:center}.service-section{padding:30px 0 0}.single-service{background:#f0e6d9;padding:20px;height:100%;border-radius:10px;-webkit-transform:translate3d(0,0,0);-moz-transform:translate3d(0,0,0);-ms-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}.single-service img{height:60px;margin-bottom:10px}.nav-tabs .nav-item{display:inline-block;margin-bottom:0!important}.slider-area-wrapper .item-inner{max-width:50%}.slider-area-wrapper .item-inner .brand-logo{max-height:40px;max-width:160px;margin-bottom:25px}.slider-area-wrapper .item-inner .title{font-size:40px;font-weight:700;margin-bottom:0}.slider-area-wrapper .item-inner .subtitle{font-size:22px;line-height:32px;margin-bottom:30px;font-weight:500}@media (max-width:575px){.slider-area-wrapper .item-inner{max-width:100%;width:100%}.hero-slider .item{height:370px;padding:0 30px}.site-header .site-branding .site-logo>img{width:100px}}.compare-mobile{margin-right:20px}.mobile-cat .has-children .category_search{display:block}.mobile-cat .has-children .category_search span{float:right;background:#f5f6f9;width:25px;height:25px;line-height:28px;text-align:center}.single-service.single-service2{padding:15px}.single-service.single-service2{display:flex;align-items:center;text-align:left}.single-service.single-service2 .content{flex:1;text-align:left}.single-service.single-service2 .content h6{font-weight:500;font-size:17px}.section-title.section-title2{text-align:center;display:block;border-bottom:0}.section-title.section-title2 h2::before{display:none}.section-title.section-title2 h2{font-size:28px}.section-title3{position:relative;background:#f5f6f9}.section-title3 .h3{background-color:#f5f6f9;position:relative;z-index:2;display:inline-block;padding:0 20px}.section-title3::after{position:absolute;content:"";height:1px;width:100%;left:0;top:50%;margin-top:-1px;background:rgba(0,0,0,.2)}.body_theme2 .hero-slider .item{height:450px}.body_theme2 .hero-slider{border-radius:0}.topbar .search-box-inner .search-box select{background:#fff;border:1px solid #e0e0e0;padding:0 10px;width:120px}.cookie-consent{position:fixed;background-color:#242424;bottom:0;width:100%;padding:30px;z-index:99;color:#fff}span.cookie-consent__message{background-color:transparent!important}@media (max-width:1366px){.slider-area-wrapper .item-inner{max-width:70%}}@media (max-width:1050px){.left-category-area .category-list .navi-link{padding:17px 8px}.left-category-area .category-list{padding:14px 0}.left-category-area .category-list .navi-link i{top:5px}}@media (max-width:991px){.slider-area-wrapper .item-inner{max-width:100%}.topbar{position:relative}.compare-mobile{margin-right:0;margin-left:10px}.site-header .search-box-wrap{position:absolute;left:0;width:100%;background:#fff;width:100%;height:100%;top:0;z-index:999}.close-m-serch{font-size:24px;margin-left:20px}.track-order-link.wishlist-mobile{margin-right:10px}.t-h-dropdown{margin-right:10px}.hero-slider .item{height:350px}.body_theme2 .hero-slider .item{height:350px}}@media (max-width:767px){.hero-slider .item{padding:0 20px}.t-m-s-a{text-align:center}}@media (max-width:576px){.hero-slider .item{height:250px}}@media (max-width:500px){.slider-area-wrapper .item-inner .title{font-size:30px}.slider-area-wrapper .item-inner .subtitle{font-size:15px;line-height:24px}.product-card .product-title>a{font-size:13px!important;display:block}.product-card .product-category>a{font-size:12px}.site-header .toolbar .toolbar-item{width:34px;margin-left:6px}.topbar .search-box-inner .search-box select{width:80px}.site-header .search-box-wrap .input-group{position:unset}.site-header .search-box-wrap .search-box-inner{position:relative}}@media (max-width:414px){.g-3{--bs-gutter-y:10px!important}.g-3{--bs-gutter-x:10px!important}.t-h-dropdown{margin-right:8px}.section-title h2{font-size:20px}}@media (max-width:390px){.product-card .product-price>del{display:block}}@media (max-width:360px){.product-card .product-title>a{font-size:12px!important}.product-card .product-card-body{padding:10px 5px 0}}.left-category-area .category-header h4,.menu-top-area,.mm-heading-area,.product-card .product-button-group .product-button,.section-title h2::before{background:#112bb1!important}.site-header .toolbar .toolbar-item>a>div>.cart-icon>.count-label,.site-header .toolbar .toolbar-item>a>div>.compare-icon>.count-label{background-color:#112bb1!important}.product-card .product-price,.site-header .site-menu>ul>li.active>a,.t-h-dropdown a.active{color:#112bb1!important}.site-header .toolbar .toolbar-item>a>div>.compare-icon>.count-label{color:#fff!important}.t-h-dropdown .t-h-dropdown-menu{border-top:2px solid #112bb1}.hero-slider-main.owl-carousel:not(.owl-loaded){display:block!important}.hero-slider-main.owl-carousel:not(.owl-loaded) .item:not(:first-child){display:none!important}.site-header .site-menu>ul>li>a{padding:12px 8px!important;font-size:13px!important;white-space:nowrap!important}.left-category-area .category-header h4{font-size:14px!important;padding:12px 10px!important}.topbar .d-flex.justify-content-between{align-items:center!important}.site-header .site-branding .site-logo{width:auto!important;max-width:250px!important}.hero-slider{border-radius:12px!important;overflow:hidden!important}.site-header .site-branding .site-logo img{width:auto!important;max-height:80px!important;object-fit:contain!important}.site-header .search-box-wrap{padding:10px 20px!important;align-self:center!important}.site-header .search-box-wrap .search-box-inner{width:100%;align-self:center!important}.topbar .search-box-inner .search-box{display:flex!important;align-items:center!important}.topbar .search-box-inner .search-box select{height:44px!important;border:1px solid #e0e0e0!important;border-right:0!important;border-radius:4px 0 0 4px!important;background-color:#fff!important}.topbar .search-box-inner .search-box form.input-group{display:flex!important;align-items:center!important}.topbar .search-box-inner .search-box form.input-group .form-control{height:44px!important;border:1px solid #e0e0e0!important;border-radius:0 4px 4px 0!important}.site-header .toolbar{display:flex!important;align-items:center!important}@media (min-width:992px){.site-header .toolbar .toolbar-item.visible-on-mobile{display:none!important}}.hero-slider-main:not(.owl-loaded){display:block!important;overflow:hidden}.hero-slider-main:not(.owl-loaded) .item{display:none}.hero-slider-main:not(.owl-loaded) .item:first-child{display:block}.whatsapp-fab{position:fixed;bottom:20px;right:20px;background-color:#25d366;color:#fff;width:60px;height:60px;border-radius:50%;display:flex;justify-content:center;align-items:center;font-size:35px;box-shadow:2px 2px 5px rgba(0,0,0,.3);z-index:9999;text-decoration:none}.whatsapp-fab i{margin-top:0;margin-left:1px}@media (max-width:767.98px){.whatsapp-fab{bottom:20px;right:20px;width:50px;height:50px;font-size:30px}}
</style>
<link rel="stylesheet" media="print" onload="this.media='all'" href="{{asset('assets/front/css/plugins.min.css')}}">
<noscript><link rel="stylesheet" href="{{asset('assets/front/css/plugins.min.css')}}"></noscript>

@yield('styleplugins')

<link id="mainStyles" rel="stylesheet" media="print" onload="this.media='all'" href="{{asset('assets/front/css/styles.min.css')}}">
<noscript><link rel="stylesheet" href="{{asset('assets/front/css/styles.min.css')}}"></noscript>
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
