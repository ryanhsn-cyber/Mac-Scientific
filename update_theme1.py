import os

file_path = "source_code/core/resources/views/front/themes/theme1.blade.php"

content = """@extends('master.front')
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
@endsection

@section('content')
<main class="w-full bg-surface-container-lowest">
    <!-- BEGIN: Hero Section -->
    @if ($setting->is_slider == 1)
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-gutter py-6">
        @if(count($sliders) > 0)
        <div class="relative w-full h-[400px] overflow-hidden rounded-round-four shadow-sm">
            <img alt="Slider" class="w-full h-full object-cover object-right" src="{{ asset('assets/images/' . $sliders[0]->photo) }}"/>
            <div class="absolute inset-0 flex flex-col justify-center items-start px-12 md:px-24">
                <h2 class="text-headline-sm text-[20px] font-light text-on-surface mb-2 tracking-widest">{{ $sliders[0]->subtitle ?? 'YOUR ONLINE SHOP FOR' }}</h2>
                <h1 class="text-display-lg text-[48px] font-bold text-on-surface leading-tight">{{ $sliders[0]->title ?? 'PRP AND INNOVATIVE COSMETIC PRODUCTS' }}</h1>
            </div>
        </div>
        @endif
    </section>
    @endif
    <!-- END: Hero Section -->

    <!-- BEGIN: Highlights Section -->
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-gutter py-6">
        <div class="bg-gray-600 text-white text-center py-2 text-xl font-bold tracking-widest uppercase rounded-t-round-four">
            Our Current Highlights
        </div>
        <div class="border border-t-0 border-outline-variant p-8 rounded-b-round-four flex flex-col md:flex-row items-center justify-between bg-surface-container-lowest">
            <div class="w-full md:w-1/2 pr-8">
                <div class="flex items-center mb-4">
                    <span class="font-display-lg text-[32px] font-bold tracking-tight text-primary">prp</span><span class="font-display-lg text-[32px] font-normal text-on-surface">med</span>
                </div>
                <div class="flex items-end mb-4">
                    <h2 class="text-[120px] font-bold text-primary leading-none">50%</h2>
                    <div class="ml-4 mb-4 border-2 border-primary rounded-full w-24 h-24 flex flex-col items-center justify-center text-primary text-center">
                        <span class="text-xs font-bold uppercase">Only for a</span>
                        <span class="text-xs font-bold uppercase">short time</span>
                        <div class="w-8 h-[1px] bg-primary my-1"></div>
                        <span class="text-[10px] font-bold">MHD</span>
                        <span class="text-[10px] font-bold">31.07.2026</span>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-on-surface tracking-widest mb-2">DISCOUNT</h3>
                <h4 class="text-xl font-light text-secondary tracking-wider mb-8">ON MICRONEEDLING SERUMS</h4>
                <div class="flex space-x-8 mb-8 text-center text-xs text-secondary">
                    <div class="flex flex-col items-center">
                        <span class="material-symbols-outlined text-primary text-3xl mb-2">stars</span>
                        <span>PROFESSIONAL<br/>RESULTS</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="material-symbols-outlined text-primary text-3xl mb-2">science</span>
                        <span>HIGH-QUALITY<br/>INGREDIENTS</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="material-symbols-outlined text-primary text-3xl mb-2">check_circle</span>
                        <span>SUITABLE FOR ALL<br/>SKIN TYPES</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="material-symbols-outlined text-primary text-3xl mb-2">health_and_safety</span>
                        <span>DESIGNED FOR<br/>PROFESSIONALS</span>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{route('front.catalog')}}" class="bg-primary hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-round-four transition-colors flex items-center shadow-md">
                        SECURE NOW <span class="material-symbols-outlined ml-2">chevron_right</span>
                    </a>
                    <div class="flex items-center text-secondary text-sm font-bold">
                        <span class="material-symbols-outlined text-primary text-3xl mr-2">event_available</span>
                        <span>OFFER VALID WHILE<br/>STOCKS LAST</span>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 mt-8 md:mt-0 flex justify-end">
                <img alt="Microneedling Serums" class="max-w-full h-auto object-cover rounded-md" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAII-7TZEFvlywBBWTDABurr4SwS3umwyY6-NeAw2s0nFyYGNJeKIANT92rr7lF3xcXWGpO9l7p1gIXQyIe6s_Wqo-R2kCSqpva8jjOS3sN39Wx_nFpd1zGPee1xXunfmsRZWoPHtHuVKbAO_dLqZVCmnTQlh1XukQtSmSv7Lzb4RMSbFnw87G8H4bI4r0fasZWiVZs5McA8xGgWwuAeXVePWRBZ0dKoREAWRSJCo-z5D94CkOLNe18uw" style="max-height: 400px; width: 100%; object-position: center;"/>
            </div>
        </div>
    </section>
    <!-- END: Highlights Section -->

    <!-- BEGIN: Bestsellers Section -->
    @if ($setting->is_featured_category == 1)
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-gutter py-6 mb-12">
        <div class="bg-gray-600 text-white text-center py-2 text-xl font-bold tracking-widest uppercase rounded-t-round-four">
            Bestsellers
        </div>
        <div class="border border-t-0 border-outline-variant p-6 rounded-b-round-four bg-surface">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach ($feature_category_items as $item)
                <!-- Product -->
                <div class="bg-surface-container-lowest p-4 rounded-round-four shadow-sm border border-outline-variant flex flex-col h-full">
                    <div class="flex-grow flex items-center justify-center mb-4 h-40">
                        <a href="{{route('front.product', $item->slug)}}">
                            <img alt="{{$item->name}}" class="max-h-full object-contain" src="{{asset('assets/images/'.$item->thumbnail)}}"/>
                        </a>
                    </div>
                    <div class="text-xs text-secondary mb-1"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                    <h3 class="font-bold text-sm mb-2 h-16 overflow-hidden"><a href="{{route('front.product', $item->slug)}}">{{$item->name}}</a></h3>
                    <div class="text-[10px] text-secondary mb-2">{{$item->brand->name ?? ''}}<br/>{{$item->sku}}</div>
                    <div class="flex justify-between items-end mb-4 mt-auto">
                        <div class="font-bold text-lg">{{PriceHelper::grandCurrencyPrice($item)}}</div>
                        @if($item->previous_price && $item->previous_price !=0)
                        <div class="text-xs text-secondary line-through">{{PriceHelper::setPreviousPrice($item->previous_price)}}</div>
                        @endif
                    </div>
                    <div class="flex space-x-2">
                        <div class="flex border border-outline-variant rounded-round-four w-1/3">
                            <input class="w-full text-center border-none p-1 text-sm rounded-l-round-four focus:ring-0" type="number" value="1"/>
                        </div>
                        <a href="javascript:;" data-target="{{ $item->id }}" class="add_to_single_cart w-2/3 border border-outline-variant rounded-round-four py-1 text-sm font-bold flex items-center justify-center hover:border-primary hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[16px] mr-1">shopping_bag</span> Add
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- END: Bestsellers Section -->

    <!-- BEGIN: Payment and Trust Badges -->
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-gutter py-6 mb-12">
        <div class="bg-gray-600 text-white text-center py-2 text-xl font-bold tracking-widest uppercase mb-8 rounded-round-four">
            PAYMENT OPTIONS
        </div>
        <div class="flex justify-center mb-12">
            <div class="flex space-x-2 bg-surface-container-lowest p-2 rounded-md shadow-sm">
                <div class="w-12 h-8 bg-black rounded flex items-center justify-center"><div class="w-4 h-4 bg-red-500 rounded-full mix-blend-screen"></div><div class="w-4 h-4 bg-yellow-500 rounded-full -ml-2 mix-blend-screen"></div></div>
                <div class="w-12 h-8 bg-[#e60050] rounded flex items-center justify-center text-white font-bold text-xs">iDEAL</div>
                <div class="w-12 h-8 bg-black rounded flex items-center justify-center"><div class="w-4 h-4 bg-red-500 rounded-full mix-blend-screen"></div><div class="w-4 h-4 bg-yellow-500 rounded-full -ml-2 mix-blend-screen"></div></div>
                <div class="w-12 h-8 bg-blue-700 rounded flex items-center justify-center text-white font-bold text-xs italic">VISA</div>
                <div class="w-12 h-8 bg-white border border-gray-200 rounded flex items-center justify-center text-black font-bold text-[10px]">Pay</div>
                <div class="w-12 h-8 bg-[#003087] rounded flex items-center justify-center text-white font-bold text-xs italic">PayPal</div>
                <div class="w-12 h-8 bg-white border border-gray-200 rounded flex items-center justify-center text-blue-500 font-bold text-xs">K</div>
                <div class="w-12 h-8 bg-[#00a5e5] rounded flex items-center justify-center text-white font-bold text-xs">giropay</div>
                <div class="w-12 h-8 bg-[#e3000f] rounded flex items-center justify-center text-white font-bold text-xs">S</div>
            </div>
        </div>
        <div class="flex flex-wrap justify-between items-center border-t border-b border-outline-variant py-8">
            <div class="text-blue-900 font-bold text-lg flex items-center"><span class="material-symbols-outlined text-4xl mr-2">verified_user</span> MITGLIED<br/><span class="text-sm font-normal">Händlerbund</span></div>
            <div class="flex items-center text-yellow-600 font-bold"><span class="material-symbols-outlined text-4xl mr-2">shopping_cart_checkout</span> KAUFER SIEGEL<br/><span class="text-xs font-normal text-black">SICHER EINKAUFEN</span></div>
            <div class="border-2 border-blue-600 p-2 text-blue-600 font-bold text-xl rounded flex flex-col items-center">FairCommerce<div class="bg-blue-600 text-white text-xs px-2 py-1 mt-1 w-full text-center">DAS ORIGINAL</div></div>
            <div class="text-red-600 font-bold text-4xl italic flex items-center bg-yellow-400 p-2 rounded">DHL</div>
        </div>
    </section>
    <!-- END: Payment and Trust Badges -->
</main>
@endsection
"""

with open(file_path, "w") as f:
    f.write(content)
print("Updated theme1.blade.php with Tailwind HTML.")
