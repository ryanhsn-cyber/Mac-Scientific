@extends('master.front')
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
    @if(isset($sliders) && $sliders->count() > 0)
        @php
            $first_photo = $sliders->first()->photo;
            $encoded_photo = implode('/', array_map('rawurlencode', explode('/', $first_photo)));
        @endphp
        <link rel="preload" as="image" href="{{ asset('assets/images/' . $encoded_photo) }}?v={{ strtotime(isset($sliders[0]) ? ($sliders[0]->updated_at ?? 'now') : ($sliders->first()->updated_at ?? 'now')) }}" fetchpriority="high">
    @endif
@endsection

@section('content')


    @php
        function renderStarRating($rating, $maxRating = 5)
        {
            $fullStar = "<i class = 'far fa-star filled'></i>";
            $halfStar = "<i class = 'far fa-star-half filled'></i>";
            $emptyStar = "<i class = 'far fa-star'></i>";
            $rating = $rating <= $maxRating ? $rating : $maxRating;

            $fullStarCount = (int) $rating;
            $halfStarCount = ceil($rating) - $fullStarCount;
            $emptyStarCount = $maxRating - $fullStarCount - $halfStarCount;

            $html = str_repeat($fullStar, $fullStarCount);
            $html .= str_repeat($halfStar, $halfStarCount);
            $html .= str_repeat($emptyStar, $emptyStarCount);
            $html = $html;
            return $html;
        }
    @endphp

    @if ($extra_settings->is_t2_slider == 1)
        <div class="slider-area-wrapper mt-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Main Slider-->
                        <style>
                            .hero-slider-main:not(.owl-loaded) { display: block !important; overflow: hidden; }
                            .hero-slider-main:not(.owl-loaded) .item { display: none; }
                            .hero-slider-main:not(.owl-loaded) .item:first-child { display: block; height: 100%; }
                        </style>
                        <div class="hero-slider" style="border-radius: 10px; overflow: hidden;">
                            <div class="hero-slider-main owl-carousel dots-inside">
                                @php $is_rtl = DB::table('languages')->where('is_default',1)->first()->rtl == 1; @endphp
                                @foreach ($sliders as $index => $slider)
                                    @php
                                        $encoded_slider_photo = implode('/', array_map('rawurlencode', explode('/', $slider->photo)));
                                    @endphp
                                    <div class="item
                                        @if ($is_rtl)
                                        d-flex justify-content-end
                                        @endif
                                        " style="position: relative;">
                                        @if($loop->first)
                                        <img src="{{ asset('assets/images/' . $encoded_slider_photo) }}?v={{ strtotime($slider->updated_at ?? 'now') }}" fetchpriority="high" alt="Slider Image" width="1920" height="1080" style="width: 100%; height: auto; display: block; object-fit: cover;">
                                        @else
                                        <img class="lazy" loading="lazy" src="{{ asset('assets/images/' . $encoded_slider_photo) }}?v={{ strtotime($slider->updated_at ?? 'now') }}" alt="Slider Image" width="1920" height="1080" style="width: 100%; height: auto; display: block; object-fit: cover;">
                                        @endif
                                        <div class="item-inner" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none;">
                                            <div class="from-bottom" style="pointer-events: auto;">
                                                @if ($slider->logo)
                                                    <img class="d-inline-block brand-logo"
                                                    src="{{ asset('assets/images/' . $slider->logo) }}" alt="Brand Logo" width="200" height="133" style="width: auto; height: auto;">
                                                @endif

                                                <div class="title text-body"></div>
                                                <div class="subtitle text-body"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($extra_settings->is_t2_service_section == 1)
        <section class="service-section mt-30 pt-0">
            <div class="container">
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-lg-3 col-sm-6 text-center mb-30">
                            <div class="single-service single-service2">
                                <img src="{{ asset('assets/images/'.$service->photo) }}" alt="Shipping" loading="lazy" width="60" height="60">
                                <div class="content">
                                    <h6 class="mb-2">{{ $service->title }}</h6>
                                    <p class="text-sm text-muted mb-0">{{ $service->details }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($extra_settings->is_t2_3_column_banner_first == 1)
        <div class="bannner-section mt-30">
            <div class="container ">
                <div class="row gx-3">
                    <div class="col-md-4">
                        <a href="{{$banner_first['firsturl1']}}" class="genius-banner">
                            <img src="{{ asset('assets/images/'.$banner_first['img1']) }}" alt="Banner 1" width="400" height="200" loading="lazy">
                            <div class="inner-content">
                                @if (isset($banner_first['subtitle1']))
                                    <p>{{$banner_first['subtitle1']}}</p>
                                @endif
                                @if (isset($banner_first['title1']))
                                    <h4>{{$banner_first['title1']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{$banner_first['firsturl2']}}" class="genius-banner">
                            <img src="{{ asset('assets/images/'.$banner_first['img2']) }}" alt="Banner 2" width="400" height="200" loading="lazy">
                            <div class="inner-content">
                                @if (isset($banner_first['subtitle2']))
                                    <p>{{$banner_first['subtitle2']}}</p>
                                @endif
                                @if (isset($banner_first['title2']))
                                    <h4>{{$banner_first['title2']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{$banner_first['firsturl3']}}" class="genius-banner">
                            <img src="{{ asset('assets/images/'.$banner_first['img3']) }}" alt="Banner 3" width="400" height="200" loading="lazy">
                            <div class="inner-content">
                                @if (isset($banner_first['subtitle3']))
                                    <p>{{$banner_first['subtitle3']}} </p>
                                @endif
                                @if (isset($banner_first['title3']))
                                    <h4>{{$banner_first['title3']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if ($extra_settings->is_t1_falsh == 1)
        <div class="flash-sell-new-section mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="section-title section-title2 section-title3section-title section-title2 section-title3">
                            <h2 class="h3">{{ __('Flash Deal') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-content">
                            <div class="flash-deal-slider owl-carousel" >
                                @foreach (\App\Models\Item::with('category')->whereStatus(1)->where('is_type', 'flash_deal')->whereNotNull('date')->orderBy('id','DESC')->take(4)->get() as $item)
                                    <div class="slider-item">
                                        <div class="product-card ">
                                            <div class="product-thumb">
                                                @if (!$item->is_stock())
                                                <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('out of stock')}}</div>
                                                @endif
                                                @if($item->previous_price && $item->previous_price !=0)
                                                <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                                                @endif
                                                <a href="{{route('front.product',$item->slug)}}">
<img class="lazy" loading="lazy" width="400" height="400" src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product">
</a>
                                                <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                                                    <a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                                    @include('includes.item_footer',['sitem' => $item])
                                                </div>
                                            </div>
                                            <div class="product-card-inner">
                                                <div class="product-card-body">

                                                    <div class="product-category"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                                                    <h3 class="product-title"><a href="{{route('front.product',$item->slug)}}">
                                                        {{ strlen(strip_tags($item->name)) > 50 ? substr(strip_tags($item->name), 0, 50) : strip_tags($item->name) }}
                                                    </a></h3>
                                                    <div class="rating-stars">
                                                        {!! renderStarRating($item->reviews->avg('rating')) !!}
                                                    </div>
                                                    <h4 class="product-price">
                                                    @if ($item->previous_price != 0)
                                                    <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                                                    @endif

                                                    {{PriceHelper::grandCurrencyPrice($item)}}
                                                    </h4>
                                                    @if (date('d-m-y') != \Carbon\Carbon::parse($item->date)->format('d-m-y'))
                                                    <div class="countdown countdown-alt mb-3" data-date-time="{{ $item->date }}">
                                                    </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if ($extra_settings->is_t2_new_product == 1)
        <section class="selected-product-section mt-50 theme2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title section-title2 section-title3">
                            <h2 class="h3">{{__('Our Current Highlight')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="genius-banner">
                            <img class="img-fluid w-100 rounded" src="/assets/images/featured-banner.png" alt="Our Current Highlight" width="1200" height="300" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($extra_settings->is_t2_3_column_banner_second == 1)
        <div class="bannner-section mt-60">
            <div class="container ">
                <div class="row gx-3">
                    <div class="col-md-4">
                        <a href="{{$banner_secend['url1']}}" class="genius-banner">
                            <img class="lazy" loading="lazy" width="400" height="400" src="{{ asset('assets/images/'.$banner_secend['img1']) }}" alt="">
                            <div class="inner-content">
                                @if (isset($banner_secend['subtitle1']))
                                    <p>{{$banner_secend['subtitle1']}}</p>
                                @endif

                                @if (isset($banner_secend['title1']))
                                    <h4>{{$banner_secend['title1']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{$banner_secend['url2']}}" class="genius-banner">
                            <img class="lazy" loading="lazy" width="400" height="400" src="{{ asset('assets/images/'.$banner_secend['img2']) }}" alt="">
                            <div class="inner-content">
                                @if (isset($banner_secend['subtitle2']))
                                    <p>{{$banner_secend['subtitle2']}}</p>
                                @endif

                                @if (isset($banner_secend['title2']))
                                    <h4> {{$banner_secend['title2']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{$banner_secend['url3']}}" class="genius-banner">
                            <img class="lazy" loading="lazy" width="400" height="400" src="{{ asset('assets/images/'.$banner_secend['img3']) }}" alt="">
                            <div class="inner-content">
                                @if (isset($banner_secend['subtitle3']))
                                    <p>{{$banner_secend['subtitle3']}} </p>
                                @endif

                                @if (isset($banner_secend['title3']))
                                    <h4>{{$banner_secend['title3']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($extra_settings->is_t2_featured_product == 1 && \App\Models\Item::whereStatus(1)->where('is_type', 'feature')->exists())
        <section class="selected-product-section mt-50 theme2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title section-title2 section-title3">
                            <h2 class="h3">{{__('Featured Products')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12" >

                        <div class="features-slider  owl-carousel" >
                            @foreach (\App\Models\Item::with('category')->whereStatus(1)->where('is_type', 'feature')->orderBy('id','DESC')->take(4)->get() as $item)
                                    <div class="slider-item">
                                        <div class="product-card ">
                                            <div class="product-thumb" >
                                                @if (!$item->is_stock())
                                                    <div class="product-badge bg-secondary border-default text-body
                                                    ">{{__('out of stock')}}</div>
                                                @endif
                                                @if($item->previous_price && $item->previous_price !=0)
                                                <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                                                @endif
                                                <a href="{{route('front.product',$item->slug)}}">
<img class="lazy" loading="lazy" width="400" height="400" src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product">
</a>
                                                <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                                                    <a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                                    @include('includes.item_footer',['sitem' => $item])
                                                </div>
                                            </div>
                                            <div class="product-card-inner">
                                            <div class="product-card-body">
                                                <div class="product-category"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                                                <h3 class="product-title"><a href="{{route('front.product',$item->slug)}}">
                                                    {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
                                                </a></h3>
                                                <div class="rating-stars">
                                                    {!! renderStarRating($item->reviews->avg('rating')) !!}
                                                </div>
                                                <h4 class="product-price">
                                                @if ($item->previous_price != 0)
                                                <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                                                @endif
                                                {{PriceHelper::grandCurrencyPrice($item)}}
                                                </h4>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

    <section class="selected-product-section mt-50 theme2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title section-title2 section-title3">
                        <h2 class="h3">{{__('All Products')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach (\App\Models\Item::with('category')->whereStatus(1)->orderBy('created_at','DESC')->take(4)->get() as $item)
                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="product-card ">
                            <div class="product-thumb" >
                                @if (!$item->is_stock())
                                    <div class="product-badge bg-secondary border-default text-body
                                    ">{{__('out of stock')}}</div>
                                @endif
                                @if($item->previous_price && $item->previous_price !=0)
                                <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                                @endif
                                <a href="{{route('front.product',$item->slug)}}">
                                    <img class="lazy" loading="lazy" width="400" height="400" src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product">
                                </a>
                                <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                                    <a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                    @include('includes.item_footer',['sitem' => $item])
                                </div>
                            </div>
                            <div class="product-card-inner">
                            <div class="product-card-body">
                                <div class="product-category"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                                <h3 class="product-title"><a href="{{route('front.product',$item->slug)}}">
                                    {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
                                </a></h3>
                                <div class="rating-stars">
                                    {!! renderStarRating($item->reviews->avg('rating')) !!}
                                </div>
                                <h4 class="product-price">
                                @if ($item->previous_price != 0)
                                <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                                @endif
                                {{PriceHelper::grandCurrencyPrice($item)}}
                                </h4>
                            </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="{{route('front.catalog')}}" class="btn btn-primary">{{__('View All Products')}}</a>
                </div>
            </div>
        </div>
    </section>

    @if ($extra_settings->is_t2_bestseller_product == 1 && \App\Models\Item::whereStatus(1)->where('is_type', 'best')->exists())
        <section class="selected-product-section mt-50  theme2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title section-title2  section-title3">
                            <h2 class="h3">{{__('Best Seller')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="features-slider  owl-carousel" >
                            @foreach (\App\Models\Item::with('category')->whereStatus(1)->where('is_type', 'best')->orderBy('id','DESC')->take(4)->get() as $item)
                                    <div class="slider-item">
                                        <div class="product-card ">
                                            <div class="product-thumb">
                                            @if (!$item->is_stock())
                                                <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('out of stock')}}</div>
                                            @endif
                                            @if($item->previous_price && $item->previous_price !=0)
                                            <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                                            @endif
                                            <a href="{{route('front.product',$item->slug)}}">
<img class="lazy" loading="lazy" width="400" height="400" src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product">
</a>
                                            <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                                                <a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                                @include('includes.item_footer',['sitem' => $item])
                                            </div>

                                        </div>
                                            <div class="product-card-inner">
                                            <div class="product-card-body">
                                                <div class="product-category"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                                                <h3 class="product-title"><a href="{{route('front.product',$item->slug)}}">
                                                    {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
                                                </a></h3>
                                                <div class="rating-stars">
                                                    {!! renderStarRating($item->reviews->avg('rating')) !!}
                                                </div>
                                                <h4 class="product-price">
                                                @if ($item->previous_price != 0)
                                                <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                                                @endif
                                                {{PriceHelper::grandCurrencyPrice($item)}}
                                                </h4>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

    @if ($extra_settings->is_t2_toprated_product == 1)
        <section class="selected-product-section mt-50  theme2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title section-title2  section-title3">
                            <h2 class="h3">{{__('Top Rated')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="features-slider  owl-carousel" >
                            @foreach (\App\Models\Item::with('category')->whereStatus(1)->where('is_type', 'top')->orderBy('id','DESC')->take(4)->get() as $item)
                                    <div class="slider-item">
                                        <div class="product-card ">
                                            <div class="product-thumb">
                                            @if (!$item->is_stock())
                                                <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('out of stock')}}</div>
                                            @endif
                                            @if($item->previous_price && $item->previous_price !=0)
                                            <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                                            @endif
                                            <a href="{{route('front.product',$item->slug)}}">
<img class="lazy" loading="lazy" width="400" height="400" src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product">
</a>
                                            <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                                                <a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                                @include('includes.item_footer',['sitem' => $item])
                                            </div>
                                        </div>
                                            <div class="product-card-inner">
                                            <div class="product-card-body">
                                                <div class="product-category"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                                                <h3 class="product-title"><a href="{{route('front.product',$item->slug)}}">
                                                    {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
                                                </a></h3>
                                                <div class="rating-stars">
                                                    {!! renderStarRating($item->reviews->avg('rating')) !!}
                                                </div>
                                                <h4 class="product-price">
                                                @if ($item->previous_price != 0)
                                                <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                                                @endif
                                                {{PriceHelper::grandCurrencyPrice($item)}}
                                                </h4>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

    @if ($extra_settings->is_t2_2_column_banner == 1)
        <div class="bannner-section mt-50">
            <div class="container ">
                <div class="row gx-3">
                    <div class="col-md-6">
                        <a href="{{$banner_third['url1']}}" class="genius-banner">
                            <img class="lazy" loading="lazy" width="400" height="400" src="{{ asset('assets/images/'.$banner_third['img1']) }}" alt="">
                            <div class="inner-content">
                                @if (isset($banner_third['subtitle1']))
                                    <p>{{$banner_third['subtitle1']}}</p>
                                @endif
                                @if (isset($banner_third['title1']))
                                    <h4>{{$banner_third['title1']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$banner_third['url2']}}" class="genius-banner">
                            <img class="lazy" loading="lazy" width="400" height="400" src="{{ asset('assets/images/'.$banner_third['img2']) }}" alt="">
                            <div class="inner-content">
                                @if (isset($banner_third['subtitle2']))
                                    <p>{{$banner_third['subtitle2']}} </p>
                                @endif
                                @if (isset($banner_third['title2']))
                                    <h4>{{$banner_third['title2']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($extra_settings->is_t2_three_column_category == 1)
    <div class="flash-sell-area three_column_product mt-50">
        <div class="container">
            <div class="row gx-3 justify-content-center">
                @foreach ($two_column_categoriess as $two_column_key => $two_column_category)
                <div class="col-xl-4 col-lg-6">
                    <div class="section-title">
                        <h2 class="h3">{{ $two_column_category['name']->name }}</h2>
                    </div>
                    <div class="main-content">
                        <div class="newproduct-slider owl-carousel">
                            @foreach ($two_column_categoriess[$two_column_key]['items']->chunk(4) as $two_column_category_itemt)
                                <div class="slider-item">
                                    @foreach ($two_column_category_itemt as $two_column_category_item)
                                    <div class="product-card p-col">
                                        <a class="product-thumb" href="{{route('front.product',$two_column_category_item->slug)}}">
                                            @if(!$two_column_category_item->is_stock())
                                                <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('out of stock')}}</div>
                                                @endif

                                            <a href="{{route('front.product',$two_column_category_item->slug)}}">
<img class="lazy" loading="lazy" width="400" height="400" src="{{asset('assets/images/'.$two_column_category_item->thumbnail)}}" alt="Product">
</a></a>
                                        <div class="product-card-body">
                                            <h3 class="product-title"><a href="{{route('front.product',$two_column_category_item->slug)}}">
                                                {{ strlen(strip_tags($two_column_category_item->name)) > 40 ? substr(strip_tags($two_column_category_item->name), 0, 40) : strip_tags($two_column_category_item->name) }}
                                            </a></h3>
                                            <div class="rating-stars">
                                                {!! renderStarRating($two_column_category_item->reviews->avg('rating')) !!}
                                            </div>
                                            <h4 class="product-price">
                                            @if ($two_column_category_item->previous_price != 0)
                                            <del>{{PriceHelper::setPreviousPrice($two_column_category_item->previous_price)}}</del>
                                            @endif
                                                {{PriceHelper::grandCurrencyPrice($two_column_category_item)}}
                                            </h4>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    @endif


@endsection





