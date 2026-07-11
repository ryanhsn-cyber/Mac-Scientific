@extends('master.front')

@section('title')
 {{ $item->name}}
@endsection

@section('meta')
<meta name="keywords" content="{{$item->meta_keywords}}">
<meta name="description" content="{{$item->meta_description}}">
@endsection

@section('styleplugins')
<style>
    .product-landing-details img {
        max-width: 100% !important;
        height: auto !important;
        display: block;
        margin: 15px auto;
        clear: both;
    }
    .product-landing-details {
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-word;
    }
</style>
@endsection

@section('content')
<div class="page-title">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
            <ul class="breadcrumbs">
                <li><a href="{{route('front.index')}}">{{__('Home')}}</a>
                </li>
                <li class="separator"></li>
                <li><a href="{{route('front.catalog')}}">{{__('Shop')}}</a>
                </li>
                <li class="separator"></li>
                <li>{{$item->name}}</li>
              </ul>
          </div>
      </div>
    </div>
</div>
  <!-- Page Content-->
<div class="container padding-bottom-1x mb-1">
    <div class="row">
      <!-- Poduct Gallery-->
      <div class="col-xxl-5 col-lg-6 col-md-6">
        <div class="product-gallery">
            @if ($item->video)
            <div class="gallery-wrapper">
                <div class="gallery-item video-btn text-center">
                    <a href="{{ $item->video }}" title="Watch video"></a>
                </div>
            </div>
          @endif
          @if($item->is_stock())
          <span class="product-badge
          @if($item->is_type == 'feature')
          bg-warning
          @elseif($item->is_type == 'new')
          bg-success
          @elseif($item->is_type == 'top')
          bg-info
          @elseif($item->is_type == 'best')
          bg-dark
          @elseif($item->is_type == 'flash_deal')
            bg-success
          @endif
          ">{{  $item->is_type != 'undefine' ?  ucfirst(str_replace('_',' ',$item->is_type)) : ''   }}</span>

          @else
          <span class="product-badge bg-secondary border-default text-body
          ">{{__('out of stock')}}</span>
          @endif

          @if($item->previous_price && $item->previous_price !=0)
          <div class="product-badge bg-goldenrod  ppp-t"> -{{PriceHelper::DiscountPercentage($item)}}</div>
          @endif

          <div class="product-thumbnails insize">
            <div class="product-details-slider owl-carousel" >
            <div class="item"><img src="{{asset('assets/images/'.$item->photo)}}" alt="zoom"  /></div>
            @foreach ($galleries as $key => $gallery)
            <div class="item"><img src="{{asset('assets/images/'.$gallery->photo)}}" alt="zoom"  /></div>
            @endforeach
        </div>
      </div>
        </div>
        
        <!-- Store Stats Box (Alibaba Style) -->
        <div class="store-stats-box mt-4 p-3" style="background-color: #f8f9fa; border-radius: 8px;">
            <div class="row text-left">
                <div class="col-6 col-sm-3 mb-3 mb-sm-0">
                    <div class="stat-value font-weight-bold text-dark" style="font-size: 15px;">{{ number_format($item->reviews->avg('rating') ?: 0, 1) }}/5 <span class="text-muted font-weight-normal" style="font-size: 13px; text-decoration: underline;">({{ $item->reviews->count() }})</span></div>
                    <div class="stat-label text-muted" style="font-size: 12px; line-height: 1.3; margin-top: 2px;">Product rating</div>
                </div>
                <div class="col-6 col-sm-3 mb-3 mb-sm-0">
                    <div class="stat-value font-weight-bold text-dark" style="font-size: 15px;">{!! $setting->store_response_time !!}</div>
                    <div class="stat-label text-muted" style="font-size: 12px; line-height: 1.3; margin-top: 2px;">Response Time</div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="stat-value font-weight-bold text-dark" style="font-size: 15px;">{!! $setting->store_on_time_delivery !!}</div>
                    <div class="stat-label text-muted" style="font-size: 12px; line-height: 1.3; margin-top: 2px;">On-time delivery<br>rate</div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="stat-value font-weight-bold text-dark" style="font-size: 15px;">{!! $setting->store_reorder_rate !!}</div>
                    <div class="stat-label text-muted" style="font-size: 12px; line-height: 1.3; margin-top: 2px;">Reorder rate</div>
                </div>
            </div>
        </div>

        
      </div>

        @php
        function renderStarRating($rating,$maxRating=5) {

            $fullStar = "<i class = 'far fa-star filled'></i>";
            $halfStar = "<i class = 'far fa-star-half filled'></i>";
            $emptyStar = "<i class = 'far fa-star'></i>";
            $rating = $rating <= $maxRating?$rating:$maxRating;

            $fullStarCount = (int)$rating;
            $halfStarCount = ceil($rating)-$fullStarCount;
            $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

            $html = str_repeat($fullStar,$fullStarCount);
            $html .= str_repeat($halfStar,$halfStarCount);
            $html .= str_repeat($emptyStar,$emptyStarCount);
            $html = $html;
            return $html;
        }
        @endphp
        <!-- Product Info-->
        <div class="col-xxl-7 col-lg-6 col-md-6">
            <div class="details-page-top-right-content d-flex align-items-start">
                <div class="div w-100">
                    <input type="hidden" id="item_id" value="{{$item->id}}">
                    <input type="hidden" id="demo_price" value="{{PriceHelper::setConvertPrice($item->discount_price)}}">
                    @php
                        $converted_tiers = [];
                        if ($item->tier_prices) {
                            $tiers = json_decode($item->tier_prices, true);
                            if (is_array($tiers)) {
                                foreach ($tiers as $tier) {
                                    $converted_tiers[] = [
                                        'min_qty' => $tier['min_qty'],
                                        'price' => PriceHelper::setConvertPrice($tier['price'])
                                    ];
                                }
                            }
                        }
                    @endphp
                    <input type="hidden" id="tier_prices" value="{{ json_encode($converted_tiers) }}">
                    <input type="hidden" value="{{PriceHelper::setCurrencySign()}}" id="set_currency">
                    <input type="hidden" value="{{PriceHelper::setCurrencyValue()}}" id="set_currency_val">
                    <input type="hidden" value="{{$setting->currency_direction}}" id="currency_direction">
                    <h4 class="mb-2 p-title-main" style="font-weight: 700; color: #1a1a1a;">{{$item->name}}</h4>
                    <p class="text-muted" style="font-size: 15px; margin-bottom: 15px;">{{$item->sort_details}}</p>

                    <div class="mb-3 d-flex align-items-center flex-wrap" style="gap: 10px;">
                        <div class="rating-stars d-inline-block" style="color: #ffb800; font-size: 14px;">
                        {!!renderStarRating($item->reviews->avg('rating'))!!}
                        </div>
                        @php
                            $b_reviews = $item->reviews->count();
                            $b_orders = \App\Models\Order::where('cart', 'like', '%'.$item->name.'%')->count();
                        @endphp
                        <span class="text-primary font-weight-bold" style="font-size: 13px;">(<a href="#details">{{ $b_reviews }} {{ __('Reviews') }}</a>)</span>
                        <span class="text-muted" style="font-size: 12px;">|</span>
                        <span class="text-dark font-weight-bold" style="font-size: 13px;">{{ $b_orders }} {{ __('Orders') }}</span>
                        <span class="text-muted" style="font-size: 12px;">|</span>
                        @if ($item->is_stock())
                            <span class="text-success font-weight-bold" style="font-size: 13px;">{{__('In Stock')}}</span>
                        @else
                            <span class="text-danger font-weight-bold" style="font-size: 13px;">{{__('Out of stock')}}</span>
                        @endif
                    </div>

                    @if($item->is_type == 'flash_deal')
                    @if (date('d-m-y') != \Carbon\Carbon::parse($item->date)->format('d-m-y'))
                    <div class="countdown countdown-alt mb-3" data-date-time="{{ $item->date }}"></div>
                    @endif
                    @endif

                    <div class="price-area d-flex align-items-center mb-4 flex-wrap" style="gap: 15px;">
                        @if ($item->previous_price != 0)
                            <del class="text-muted" style="font-size: 20px; font-weight: 500;">{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                        @endif
                        <span id="main_price" class="main-price text-primary font-weight-bold" style="font-size: 28px;">{{PriceHelper::grandCurrencyPrice($item)}}</span>
                        @if ($item->previous_price != 0)
                            @php
                                $save_amount = $item->previous_price - $item->discount_price;
                                $save_percent = round(($save_amount / $item->previous_price) * 100);
                            @endphp
                            <span class="badge" style="background-color: #e5f7ed; color: #00a651; padding: 6px 12px; font-size: 13px; font-weight: 600; border-radius: 4px;">Save {{PriceHelper::setCurrencyPrice($save_amount)}} ({{$save_percent}}%)</span>
                        @endif
                    </div>

                    <!-- Trust Badges -->
                    <div class="row mb-4" style="gap: 10px 0;">
                        <div class="col-4 px-1">
                            <div class="text-center p-2 d-flex flex-column align-items-center justify-content-center" style="border: 1px solid #e0e0e0; border-radius: 6px; background-color: #fff; height: 100%;">
                                <i class="fas fa-shield-alt text-success mb-1" style="font-size: 18px;"></i>
                                <div style="font-size: 11px; line-height: 1.2; font-weight: 500;">Professional<br>Clinic Grade</div>
                            </div>
                        </div>
                        <div class="col-4 px-1">
                            <div class="text-center p-2 d-flex flex-column align-items-center justify-content-center" style="border: 1px solid #e0e0e0; border-radius: 6px; background-color: #fff; height: 100%;">
                                <i class="fas fa-check-circle text-success mb-1" style="font-size: 18px;"></i>
                                <div style="font-size: 11px; line-height: 1.2; font-weight: 500;">Genuine<br>Product</div>
                            </div>
                        </div>
                        <div class="col-4 px-1">
                            <div class="text-center p-2 d-flex flex-column align-items-center justify-content-center" style="border: 1px solid #e0e0e0; border-radius: 6px; background-color: #fff; height: 100%;">
                                <i class="fas fa-truck text-success mb-1" style="font-size: 18px;"></i>
                                <div style="font-size: 11px; line-height: 1.2; font-weight: 500;">Nationwide<br>Delivery</div>
                            </div>
                        </div>
                        <div class="col-4 px-1 mt-2">
                            <div class="text-center p-2 d-flex flex-column align-items-center justify-content-center" style="border: 1px solid #e0e0e0; border-radius: 6px; background-color: #fff; height: 100%;">
                                <i class="fas fa-lock text-success mb-1" style="font-size: 18px;"></i>
                                <div style="font-size: 11px; line-height: 1.2; font-weight: 500;">Secure<br>Payment</div>
                            </div>
                        </div>
                        <div class="col-4 px-1 mt-2">
                            <div class="text-center p-2 d-flex flex-column align-items-center justify-content-center" style="border: 1px solid #e0e0e0; border-radius: 6px; background-color: #fff; height: 100%;">
                                <i class="fas fa-box text-success mb-1" style="font-size: 18px;"></i>
                                <div style="font-size: 11px; line-height: 1.2; font-weight: 500;">Ready Stock in<br>Bangladesh</div>
                            </div>
                        </div>
                        <div class="col-4 px-1 mt-2">
                            <div class="text-center p-2 d-flex flex-column align-items-center justify-content-center" style="border: 1px solid #e0e0e0; border-radius: 6px; background-color: #fff; height: 100%;">
                                <i class="fas fa-hand-holding-usd text-success mb-1" style="font-size: 18px;"></i>
                                <div style="font-size: 11px; line-height: 1.2; font-weight: 500;">Cash on<br>Delivery</div>
                            </div>
                        </div>
                    </div>

                    <!-- Key Features -->
                    <div class="key-features mb-4 pt-3" style="border-top: 1px solid #eee;">
                        <h6 class="font-weight-bold mb-3" style="color: #1a1a1a; font-size: 16px;">Key Features</h6>
                        <div class="row">
                            @if($item->features)
                                @php
                                    $featuresArray = [];
                                    $decodedFeatures = json_decode($item->features, true);
                                    if(is_array($decodedFeatures)) {
                                        foreach($decodedFeatures as $f) {
                                            if(isset($f['value'])) $featuresArray[] = $f['value'];
                                        }
                                    } else {
                                        $featuresArray = explode(',', $item->features);
                                    }
                                @endphp
                                @foreach($featuresArray as $feature)
                                <div class="col-6 mb-2 d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success mr-2"></i> <span style="font-size: 13px; font-weight: 500;">{{ trim($feature) }}</span>
                                </div>
                                @endforeach
                            @else
                                <div class="col-6 mb-2 d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success mr-2"></i> <span style="font-size: 13px; font-weight: 500;">Premium Quality</span>
                                </div>
                                <div class="col-6 mb-2 d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success mr-2"></i> <span style="font-size: 13px; font-weight: 500;">Fast Performance</span>
                                </div>
                                <div class="col-6 mb-2 d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success mr-2"></i> <span style="font-size: 13px; font-weight: 500;">Reliable Design</span>
                                </div>
                                <div class="col-6 mb-2 d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success mr-2"></i> <span style="font-size: 13px; font-weight: 500;">Easy to Use</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row margin-top-1x">
                        @foreach($attributes as $attribute)
                        @if($attribute->options->count() != 0)
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
                                <select class="form-control attribute_option" id="{{ $attribute->name }}">
                                    @foreach($attribute->options->where('stock','!=','0') as $option)
                                    <option value="{{ $option->name }}" data-type="{{$attribute->id}}" data-href="{{$option->id}}" data-target="{{PriceHelper::setConvertPrice($option->price)}}">{{ $option->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <!-- Tier Pricing -->
                    @if($item->tier_prices)
                    <div class="tier-pricing-table mt-4 mb-3 table-responsive">
                        @php
                            $tiers = json_decode($item->tier_prices, true);
                            if(is_array($tiers)) {
                                usort($tiers, function($a, $b) {
                                    return $a['min_qty'] <=> $b['min_qty']; // ascending
                                });
                            }
                        @endphp
                        @if(is_array($tiers) && count($tiers) > 0)
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" style="font-weight: 600; font-size: 14px; color: #333;">Quantity (Pieces)</th>
                                        <th scope="col" style="font-weight: 600; font-size: 14px; color: #333;">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tiers as $index => $tier)
                                        @php
                                            $next_qty = isset($tiers[$index + 1]) ? ($tiers[$index + 1]['min_qty'] - 1) : null;
                                            $qty_range = $next_qty ? number_format($tier['min_qty']) . ' - ' . number_format($next_qty) : '&ge; ' . number_format($tier['min_qty']);
                                        @endphp
                                        <tr>
                                            <td style="font-size: 14px; color: #555; vertical-align: middle;">{!! $qty_range !!}</td>
                                            <td class="font-weight-bold" style="font-size: 16px; color: #1a1a1a; vertical-align: middle;">{{ PriceHelper::setCurrencyPrice($tier['price']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="action-buttons mb-4 pt-3" style="border-top: 1px solid #eee;">
                        
                        <div class="d-flex mb-3" style="gap: 15px;">
                            @if ($item->item_type == 'normal')
                            <div class="d-flex align-items-start pt-1">
                                <span class="font-weight-bold mr-3" style="font-size: 15px; color: #333; line-height: 44px;">Quantity</span>
                                <div class="qtySelector product-quantity d-flex align-items-center" style="border: 1px solid #e0e0e0; border-radius: 4px; overflow: hidden; height: 44px; width: 110px;">
                                    <span class="decreaseQty subclick" style="width: 35px; height: 100%; display: flex; align-items: center; justify-content: center; cursor: pointer; background: #f8f9fa; color: #333;"><i class="fas fa-minus" style="font-size: 12px;"></i></span>
                                    <input type="text" class="qtyValue cart-amount text-center font-weight-bold m-0" value="1" style="width: 40px; height: 100%; border: none; border-left: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0; padding: 0;">
                                    <span class="increaseQty addclick" style="width: 35px; height: 100%; display: flex; align-items: center; justify-content: center; cursor: pointer; background: #f8f9fa; color: #333;"><i class="fas fa-plus" style="font-size: 12px;"></i></span>
                                    <input type="hidden" value="3333" id="current_stock">
                                </div>
                            </div>
                            @endif

                            <div class="d-flex flex-column flex-grow-1" style="gap: 10px;">
                                @php
                                    $wa_phone = preg_replace('/[^0-9]/', '', $setting->footer_phone);
                                    if(substr($wa_phone, 0, 2) === '01') {
                                        $wa_phone = '88' . $wa_phone;
                                    }
                                @endphp
                                @if ($item->item_type != 'affiliate')
                                    @if ($item->is_stock())
                                    <button class="btn m-0 w-100 d-flex align-items-center justify-content-center" id="add_to_cart" style="background-color: #0d47a1; color: #fff; height: 44px; font-weight: 600; border-radius: 6px; box-shadow: none;">
                                        <i class="fas fa-shopping-cart mr-2"></i><span>Add to Cart</span>
                                    </button>
                                    <button class="btn m-0 w-100 d-flex align-items-center justify-content-center" id="but_to_cart" style="background-color: #0d47a1; color: #fff; height: 44px; font-weight: 600; border-radius: 6px; box-shadow: none;">
                                        <i class="fas fa-bolt mr-2"></i><span>Buy Now</span>
                                    </button>
                                    <a href="https://wa.me/{{ $wa_phone }}?text={{ urlencode('Hello, I want to order this product: ' . $item->name . ' - ' . route('front.product', $item->slug)) }}" target="_blank" class="btn m-0 w-100 d-flex align-items-center justify-content-center" style="background-color: #25D366; color: #fff; height: 44px; font-weight: 600; border-radius: 6px; box-shadow: none;">
                                        <i class="fab fa-whatsapp mr-2" style="font-size: 18px;"></i><span style="font-size: 15px;">Order via WhatsApp</span>
                                    </a>
                                    @else
                                    <button class="btn btn-secondary m-0 w-100 d-flex align-items-center justify-content-center" style="height: 44px; font-weight: 600; border-radius: 6px;" disabled>
                                        <i class="fas fa-shopping-cart mr-2"></i><span>Out of stock</span>
                                    </button>
                                    <a href="https://wa.me/{{ $wa_phone }}?text={{ urlencode('Hello, is this product available? ' . $item->name . ' - ' . route('front.product', $item->slug)) }}" target="_blank" class="btn m-0 w-100 d-flex align-items-center justify-content-center" style="background-color: #25D366; color: #fff; height: 44px; font-weight: 600; border-radius: 6px; box-shadow: none;">
                                        <i class="fab fa-whatsapp mr-2" style="font-size: 18px;"></i><span style="font-size: 15px;">Inquire via WhatsApp</span>
                                    </a>
                                    @endif
                                @else
                                    <a href="{{$item->affiliate_link}}" target="_blank" class="btn m-0 w-100 d-flex align-items-center justify-content-center" style="background-color: #0d47a1; color: #fff; height: 44px; font-weight: 600; border-radius: 6px;">
                                        <i class="fas fa-shopping-cart mr-2"></i><span>Buy Now</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Delivery & Warranty Info -->
                    <div class="row mb-4">
                        <div class="col-6 pr-2">
                            <div class="p-3 d-flex align-items-center" style="border: 1px solid #e0e0e0; border-radius: 8px; background-color: #fafafa; height: 100%;">
                                <i class="fas fa-truck text-primary mr-3" style="font-size: 24px;"></i>
                                <div>
                                    <div class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Delivery Information</div>
                                    <div style="font-size: 10px; color: #555; line-height: 1.4;">
                                        Dhaka: 1 Day Delivery<br>
                                        Outside Dhaka: 2-3 Days<br>
                                        Cash on Delivery Available
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 pl-2">
                            <div class="p-3 d-flex align-items-center" style="border: 1px solid #e0e0e0; border-radius: 8px; background-color: #fafafa; height: 100%;">
                                <i class="fas fa-shield-alt text-primary mr-3" style="font-size: 24px;"></i>
                                <div>
                                    <div class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Warranty</div>
                                    <div style="font-size: 10px; color: #555; line-height: 1.4;">
                                        6 Months Warranty<br>
                                        Service Support<br>
                                        Genuine Spare Parts
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="payment-methods p-3 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px; background-color: #fff;">
                        <div class="font-weight-bold text-dark mb-3" style="font-size: 13px;">Payment Methods</div>
                        <div class="d-flex align-items-center justify-content-center flex-wrap">
                            <img class="d-block" src="{{ $setting->footer_gateway_img ? asset('assets/images/'.$setting->footer_gateway_img) : asset('system/resources/assets/images/placeholder.png') }}" style="max-height: 35px; object-fit: contain;">
                        </div>
                    </div>

                    <div class="div">
                        <div class="t-c-b-area">
                            @if ($item->brand_id)
                            <div class="pt-1 mb-1"><span class="text-medium">{{__('Brand')}}:</span>
                                    <a href="{{route('front.catalog').'?brand='.$item->brand->slug}}">{{$item->brand->name}}</a>
                                </div>
                            @endif

                                <div class="pt-1 mb-1"><span class="text-medium">{{__('Categories')}}:</span>
                                    <a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a>
                                        @if ($item->subcategory->name)
                                        /
                                        @endif
                                    <a href="{{route('front.catalog').'?subcategory='.$item->subcategory->slug}}">{{$item->subcategory->name}}</a>
                                        @if ($item->childcategory->name)
                                        /
                                        @endif
                                    <a href="{{route('front.catalog').'?childcategory='.$item->childcategory->slug}}">{{$item->childcategory->name}}</a>
                                </div>
                                <div class="pt-1 mb-1"><span class="text-medium">{{__('Tags')}}:</span>
                                    @if($item->tags)
                                    @php
                                        $tagsArray = [];
                                        $decodedTags = json_decode($item->tags, true);
                                        if(is_array($decodedTags)) {
                                            foreach($decodedTags as $t) {
                                                if(isset($t['value'])) $tagsArray[] = $t['value'];
                                            }
                                        } else {
                                            $tagsArray = explode(',', $item->tags);
                                        }
                                    @endphp
                                    @foreach ($tagsArray as $tag)
                                    @if ($loop->last)
                                    <a href="{{route('front.catalog').'?tag='.$tag}}">{{trim($tag)}}</a>
                                    @else
                                    <a href="{{route('front.catalog').'?tag='.$tag}}">{{trim($tag)}}</a>,
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                                @if ($item->item_type == 'normal')
                                <div class="pt-1 mb-4"><span class="text-medium">{{__('SKU')}}:</span> #{{$item->sku}}</div>
                                @endif
                        </div>

                        <div class="mt-4 p-d-f-area">
                            <div class="left" style="display: none;">
                            </div>

                            <div class="d-flex align-items-center">
                                <span class="text-muted mr-1">{{__('Share')}}: </span>
                                <div class="d-inline-block a2a_kit">
                                    <a class="facebook  a2a_button_facebook" href="">
                                        <span><i class="fab fa-facebook-f"></i></span>
                                    </a>
                                    <a class="twitter  a2a_button_twitter" href="">
                                        <span><i class="fab fa-twitter"></i></span>
                                    </a>
                                    <a class="linkedin  a2a_button_linkedin" href="">
                                        <span><i class="fab fa-linkedin-in"></i></span>
                                    </a>
                                    <a class="pinterest   a2a_button_pinterest" href="">
                                        <span><i class="fab fa-pinterest"></i></span>
                                    </a>
                                </div>
                                <script async src="https://static.addtoany.com/menu/page.js"></script>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" padding-top-3x mb-3" id="details">
            <div class="col-lg-12">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">{{__('Description')}}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="specification-tab" data-bs-toggle="tab" data-bs-target="#specification" type="button" role="tab" aria-controls="specification" aria-selected="false">{{__('Product Details')}}</a>
                </li>
                @if ($item->how_to_use)
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="how-to-use-tab" data-bs-toggle="tab" data-bs-target="#how-to-use" type="button" role="tab" aria-controls="how-to-use" aria-selected="false">{{__('How to Use')}}</a>
                </li>
                @endif
            </ul>
            <div class="tab-content card">
                <div class="tab-pane fade show active p-3 p-sm-4 p-md-5 product-landing-details" id="description" role="tabpanel" aria-labelledby="description-tab">
                {!! $item->details !!}
                </div>
                <div class="tab-pane fade show p-3 p-sm-4 p-md-5 product-landing-details" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                    @if($item->getHtmlSpecifications())
                        {!! $item->getHtmlSpecifications() !!}
                    @else
                        <div class="text-center">{{__('No Product Details Available')}}</div>
                    @endif
                </div>
                @if ($item->how_to_use)
                <div class="tab-pane fade show p-3 p-sm-4 p-md-5 product-landing-details" id="how-to-use" role="tabpanel" aria-labelledby="how-to-use-tab">
                    {!! $item->how_to_use !!}
                </div>
                @endif
            </div>
            </div>
        </div>
    </div>
</div>


  <!-- Reviews-->
  <div class="container  review-area">
        <!-- FAQ & Reviews Feature Section -->
        <div class="row mt-4 mb-4">
            <!-- Customer Reviews Section -->
            <div class="col-md-6 mb-3">
                <div class="p-4 d-flex flex-column h-100" style="border: 1px solid #e0e0e0; border-radius: 8px; background: #fff;">
                    <h6 class="font-weight-bold mb-4" style="color: #003399; font-size: 16px;">Customer Reviews</h6>
                    
                    <div class="d-flex mb-4 align-items-center">
                        <div class="mr-4 text-center pr-4" style="border-right: 1px solid #f1f1f1;">
                            <h2 class="font-weight-bold text-dark mb-1" style="font-size: 48px; line-height: 1;">{{ number_format($item->reviews->avg('rating') ?: 0, 1) }}</h2>
                            <div class="rating-stars" style="color: #ffb800; font-size: 16px; margin-bottom: 5px;">
                                {!!renderStarRating($item->reviews->avg('rating'))!!}
                            </div>
                            <div class="text-dark font-weight-bold" style="font-size: 13px;">{{ $item->reviews->count() }} Reviews</div>
                        </div>
                        <div class="flex-grow-1">
                            @for($i = 5; $i >= 1; $i--)
                                @php
                                    $count = $item->reviews->where('status',1)->where('rating',$i)->count();
                                    $total = $item->reviews->where('status',1)->count() ?: 1;
                                    $percent = round(($count / $total) * 100);
                                @endphp
                                <div class="d-flex align-items-center mb-2" style="font-size: 12px;">
                                    <span class="text-dark font-weight-bold" style="width: 20px;">{{ $i }} <i class="fas fa-star" style="color: #ffb800; font-size: 10px;"></i></span>
                                    <div class="progress mx-3 flex-grow-1" style="height: 8px; border-radius: 4px; background-color: #f1f1f1;">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $percent }}%; border-radius: 4px; background-color: #ffb800;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span style="width: 35px; text-align: right; color: #555; font-weight: 600;">{{ $percent }}%</span>
                                    <span style="width: 30px; text-align: right; color: #999;">({{ $count }})</span>
                                </div>
                            @endfor
                        </div>
                    </div>
                    
                    @if (Auth::check())
                        <a href="#" data-bs-toggle="modal" data-bs-target="#leaveReview" class="btn btn-outline-primary btn-block py-2 mt-auto" style="border-radius: 6px; font-size: 14px; font-weight: 600; border-color: #003399; color: #003399; background: transparent;">
                            <i class="far fa-edit mr-1"></i> {{ $item->reviews->count() > 0 ? 'Write a review' : 'Be the first to review this product' }}
                        </a>
                    @else
                        <a href="{{ route('user.login') }}" class="btn btn-outline-primary btn-block py-2 mt-auto" style="border-radius: 6px; font-size: 14px; font-weight: 600; border-color: #003399; color: #003399; background: transparent;">
                            <i class="fas fa-sign-in-alt mr-1"></i> Login to write a review
                        </a>
                    @endif
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="col-md-6 mb-3">
                <div class="p-3 h-100" style="border: 1px solid #e0e0e0; border-radius: 8px; background: #fff;">
                    <h6 class="font-weight-bold mb-3" style="color: #003399; font-size: 15px;">Frequently Asked Questions</h6>
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ Item 1 -->
                        <div class="card border-0 mb-1">
                            <div class="card-header p-0 bg-transparent border-0" id="headingOne">
                                <button class="btn btn-link btn-block text-left text-dark text-decoration-none p-2 d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-size: 13px; font-weight: 500;">
                                    Is this suitable for PRP or Exosome therapy?
                                    <i class="fas fa-plus" style="color: #003399;"></i>
                                </button>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#faqAccordion">
                                <div class="card-body p-2 text-muted" style="font-size: 13px;">
                                    Yes, it is highly suitable for both PRP and Exosome therapies, helping active ingredients penetrate deeply.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item 2 -->
                        <div class="card border-0 mb-1" style="border-top: 1px solid #f1f1f1 !important;">
                            <div class="card-header p-0 bg-transparent border-0" id="headingTwo">
                                <button class="btn btn-link btn-block text-left text-dark text-decoration-none p-2 d-flex justify-content-between align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="font-size: 13px; font-weight: 500;">
                                    How many speed levels are available?
                                    <i class="fas fa-plus" style="color: #003399;"></i>
                                </button>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                                <div class="card-body p-2 text-muted" style="font-size: 13px;">
                                    It comes with 5 adjustable speed levels for customized treatments.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item 3 -->
                        <div class="card border-0 mb-1" style="border-top: 1px solid #f1f1f1 !important;">
                            <div class="card-header p-0 bg-transparent border-0" id="headingThree">
                                <button class="btn btn-link btn-block text-left text-dark text-decoration-none p-2 d-flex justify-content-between align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="font-size: 13px; font-weight: 500;">
                                    Is it rechargeable?
                                    <i class="fas fa-plus" style="color: #003399;"></i>
                                </button>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                                <div class="card-body p-2 text-muted" style="font-size: 13px;">
                                    Yes, it features a built-in rechargeable battery for cordless operation.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item 4 -->
                        <div class="card border-0 mb-1" style="border-top: 1px solid #f1f1f1 !important;">
                            <div class="card-header p-0 bg-transparent border-0" id="headingFour">
                                <button class="btn btn-link btn-block text-left text-dark text-decoration-none p-2 d-flex justify-content-between align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="font-size: 13px; font-weight: 500;">
                                    How do I clean and sterilize the pen?
                                    <i class="fas fa-plus" style="color: #003399;"></i>
                                </button>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqAccordion">
                                <div class="card-body p-2 text-muted" style="font-size: 13px;">
                                    Wipe the pen body with alcohol. The cartridges are single-use and should be discarded safely.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item 5 -->
                        <div class="card border-0" style="border-top: 1px solid #f1f1f1 !important;">
                            <div class="card-header p-0 bg-transparent border-0" id="headingFive">
                                <button class="btn btn-link btn-block text-left text-dark text-decoration-none p-2 d-flex justify-content-between align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="font-size: 13px; font-weight: 500;">
                                    What is the warranty?
                                    <i class="fas fa-plus" style="color: #003399;"></i>
                                </button>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faqAccordion">
                                <div class="card-body p-2 text-muted" style="font-size: 13px;">
                                    We provide a 1-year warranty covering manufacturing defects.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title">
                <h2 class="h3">{{ __('Latest Reviews') }}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
              @forelse ($reviews as $review)
              <div class="single-review">
                  <div class="comment">
                    <div class="comment-author-ava"><img class="lazy" data-src="{{asset('assets/images/'.$review->user->photo)}}" alt="Comment author"></div>
                    <div class="comment-body">
                      <div class="comment-header d-flex flex-wrap justify-content-between">
                        <div>
                            <h4 class="comment-title mb-1">{{$review->subject}}</h4>
                            <span>{{$review->user->first_name}}</span>
                            <span class="ml-3">{{$review->created_at->format('M d, Y')}}</span>
                        </div>
                        <div class="mb-2">
                          <div class="rating-stars">
                            @php
                                for($i=0; $i<$review->rating;$i++){
                                 echo "<i class = 'far fa-star filled'></i>";
                                }
                            @endphp
                          </div>
                        </div>
                      </div>
                      <p class="comment-text  mt-2">{{$review->review}}</p>

                    </div>
                  </div>
              </div>
              @empty
              <div class="card p-5">
                {{__('No Review')}}
              </div>
              @endforelse
              <div class="row mt-15">
                <div class="col-lg-12 text-center">
                    {{$reviews->links()}}
                </div>
            </div>

          </div>

    </div>
  </div>

  @if(count($related_items)>0)
  <div class="relatedproduct-section container padding-bottom-3x mb-1 s-pt-30">
    <!-- Related Products Carousel-->
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title">
                <h2 class="h3">{{ __('You May Also Like') }}</h2>
            </div>
        </div>
    </div>
    <!-- Carousel-->
    <div class="row">
        <div class="col-lg-12">
            <div class="relatedproductslider owl-carousel" >
                @foreach ($related_items as $related)
                    <div class="slider-item">
                        <div class="product-card">

                            @if ($related->is_stock())
                                @if($related->is_type == 'new')
                                @else
                                    <div class="product-badge
                                    @if($related->is_type == 'feature')
                                    bg-warning

                                    @elseif($related->is_type == 'top')
                                    bg-info
                                    @elseif($related->is_type == 'best')
                                    bg-dark
                                    @elseif($related->is_type == 'flash_deal')
                                    bg-success
                                    @endif
                                    ">{{  $related->is_type != 'undefine' ?  ucfirst(str_replace('_',' ',$related->is_type)) : ''   }}</div>
                                    @endif
                                    @else
                                    <div class="product-badge bg-secondary border-default text-body
                                    ">{{__('out of stock')}}</div>
                            @endif
                                    @if($related->previous_price && $related->previous_price !=0)
                                    <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($related)}}</div>
                            @endif

                            @if($related->previous_price && $related->previous_price !=0)
                            <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($related)}}</div>
                            @endif
                            <div class="product-thumb">
                                <a href="{{route('front.product',$related->slug)}}">
<img class="lazy" data-src="{{asset('assets/images/'.$related->thumbnail)}}" alt="Product">
</a>
                                <div class="product-button-group">
                                    <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$related->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                                    <a class="product-button product_compare" href="javascript:;" data-target="{{route('fornt.compare.product',$related->id)}}" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                    @include('includes.item_footer',['sitem' => $related])
                                    </div>
                                </div>
                            <div class="product-card-body">
                              <div class="product-category"><a href="{{route('front.catalog').'?category='.$related->category->slug}}">{{$related->category->name}}</a></div>
                              <h3 class="product-title"><a href="{{route('front.product',$related->slug)}}">
                                {{ strlen(strip_tags($related->name)) > 35 ? substr(strip_tags($related->name), 0, 35) : strip_tags($related->name) }}
                            </a></h3>
                              <h4 class="product-price">
                                @if ($related->previous_price !=0)
                                    <del>{{PriceHelper::setPreviousPrice($related->previous_price)}}</del>
                                @endif
                                {{PriceHelper::grandCurrencyPrice($related)}} </h4>
                            </div>

                          </div>
                    </div>
                @endforeach
              </div>
        </div>
    </div>
  </div>
  @endif




@auth
<form class="modal fade ratingForm" action="{{route('front.review.submit')}}" method="post" id="leaveReview" tabindex="-1">
  @csrf
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{__('Leave a Review')}}</h4>
        <button class="close modal_close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        @php
            $user = Auth::user();
        @endphp
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="review-name">{{__('Your Name')}}</label>
              <input class="form-control" type="text" id="review-name" value="{{$user->first_name}}" required>
            </div>
          </div>
          <input type="hidden" name="item_id" value="{{$item->id}}">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="review-email">{{__('Your Email')}}</label>
              <input class="form-control" type="email" id="review-email" value="{{$user->email}}" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="review-subject">{{__('Subject')}}</label>
              <input class="form-control" type="text" name="subject" id="review-subject" required>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="review-rating">{{__('Rating')}}</label>
              <select name="rating" class="form-control" id="review-rating">
                <option value="5">5 {{__('Stars')}}</option>
                <option value="4">4 {{__('Stars')}}</option>
                <option value="3">3 {{__('Stars')}}</option>
                <option value="2">2 {{__('Stars')}}</option>
                <option value="1">1 {{__('Star')}}</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="review-message">{{__('Review')}}</label>
          <textarea class="form-control" name="review" id="review-message" rows="8" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit"><span>{{__('Submit Review')}}</span></button>
      </div>
    </div>
  </div>
</form>
@endauth

@endsection
