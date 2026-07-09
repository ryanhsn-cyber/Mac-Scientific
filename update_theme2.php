<?php
$file = 'source_code/core/resources/views/front/themes/theme2.blade.php';
$content = file_get_contents($file);

// 1. Fix the image links in theme2.blade.php
$pattern = '/(<img class="lazy" data-src="\{\{asset\(\'assets\/images\/\'\.(\$[^}]+)->thumbnail\)\}\}" alt="Product">)/';
$content = preg_replace_callback($pattern, function($matches) {
    $imgTag = $matches[1];
    $var = $matches[2]; 
    return "<a href=\"{{route('front.product',{$var}->slug)}}\">\n" . $imgTag . "\n</a>";
}, $content);

// Remove any nested <a> tags if we accidentally double-wrapped
$content = preg_replace('/<a href="\{\{route\(\'front\.product\',\$[^>]+\)\}\}">\s*(<img class="lazy"[^>]+>)\s*<\/a><\/a>/s', "$1\n</a>", $content);

// 2. Add the All Products section
$allProductsSection = <<<HTML
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
                @foreach (\$products->orderBy('id','DESC')->take(24)->get() as \$item)
                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="product-card ">
                            <div class="product-thumb" >
                                @if (!\$item->is_stock())
                                    <div class="product-badge bg-secondary border-default text-body
                                    ">{{__('out of stock')}}</div>
                                @endif
                                @if(\$item->previous_price && \$item->previous_price !=0)
                                <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage(\$item)}}</div>
                                @endif
                                <a href="{{route('front.product',\$item->slug)}}">
                                    <img class="lazy" data-src="{{asset('assets/images/'.\$item->thumbnail)}}" alt="Product">
                                </a>
                                <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',\$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                                    <a data-target="{{route('fornt.compare.product',\$item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                    @include('includes.item_footer',['sitem' => \$item])
                                </div>
                            </div>
                            <div class="product-card-inner">
                            <div class="product-card-body">
                                <div class="product-category"><a href="{{route('front.catalog').'?category='.\$item->category->slug}}">{{\$item->category->name}}</a></div>
                                <h3 class="product-title"><a href="{{route('front.product',\$item->slug)}}">
                                    {{ strlen(strip_tags(\$item->name)) > 35 ? substr(strip_tags(\$item->name), 0, 35) : strip_tags(\$item->name) }}
                                </a></h3>
                                <div class="rating-stars">
                                    {!! renderStarRating(\$item->reviews->avg('rating')) !!}
                                </div>
                                <h4 class="product-price">
                                @if (\$item->previous_price != 0)
                                <del>{{PriceHelper::setPreviousPrice(\$item->previous_price)}}</del>
                                @endif
                                {{PriceHelper::grandCurrencyPrice(\$item)}}
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

    @if (\$extra_settings->is_t2_bestseller_product == 1 && \$products->where('is_type', 'best')->count() > 0)
HTML;

$content = str_replace(
    "        </section>\n    @endif\n\n    @if (\$extra_settings->is_t2_bestseller_product == 1 && \$products->where('is_type', 'best')->count() > 0)",
    $allProductsSection,
    $content
);

file_put_contents($file, $content);
echo "Theme2 updated successfully\n";
