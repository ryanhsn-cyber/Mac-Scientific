import sys

file_path = "source_code/core/resources/views/master/front.blade.php"
with open(file_path, "r") as f:
    lines = f.readlines()

new_header = """<!-- Header-->
<header class="w-full bg-surface" style="box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
<!-- Utility Bar -->
<div class="bg-surface-container-low text-body-sm py-1 border-b border-outline-variant">
<div class="w-full max-w-container-max mx-auto px-margin-mobile md:px-gutter flex justify-between items-center">
<div class="flex space-x-4">
<a class="text-secondary hover:text-primary transition-colors" href="{{route('front.index')}}">{{__('Home')}}</a>
@if ($setting->is_contact == 1)
<a class="text-secondary hover:text-primary transition-colors" href="{{route('front.contact')}}">{{__('Contact us')}}</a>
@endif
@if ($setting->is_blog == 1)
<a class="text-secondary hover:text-primary transition-colors" href="{{route('front.blog')}}">{{__('Blog')}}</a>
@endif
</div>
<div class="flex space-x-4 items-center">
<div class="flex items-center space-x-1 cursor-pointer hover:text-primary transition-colors text-secondary t-h-dropdown">
  <a class="main-link text-secondary hover:text-primary transition-colors flex items-center" href="#">{{ __('Currency') }} <span class="material-symbols-outlined text-[16px] ml-1">expand_more</span></a>
  <div class="t-h-dropdown-menu bg-white border border-outline-variant shadow-sm mt-2 p-2 absolute z-50">
      @foreach (DB::table('currencies')->get() as $currency)
          <a class="block px-2 py-1 hover:bg-gray-100 text-sm {{Session::get('currency') == $currency->id ? 'text-primary font-bold' : ($currency->is_default == 1 && !Session::has('currency') ? 'text-primary font-bold' : 'text-secondary')}}" href="{{route('front.currency.setup',$currency->id)}}">{{$currency->name}}</a>
      @endforeach
  </div>
</div>
<a class="flex items-center space-x-1 text-secondary hover:text-primary transition-colors" href="{{route('user.wishlist.index')}}">
<span class="material-symbols-outlined text-[16px]">favorite</span>
<span>{{ __('Wishlist') }} ({{Session::has('wishlist') ? count(Session::get('wishlist')) : '0'}})</span>
</a>
</div>
</div>
</div>
<!-- Main Header -->
<div class="w-full max-w-container-max mx-auto px-margin-mobile md:px-gutter py-6 flex flex-col md:flex-row justify-between items-center">
<!-- Logo -->
<a class="flex-shrink-0 mb-4 md:mb-0 site-logo" href="{{route('front.index')}}">
<img src="{{asset('assets/images/'.$setting->logo)}}" alt="{{$setting->title}}" style="max-height: 60px;">
</a>
<!-- Search Bar -->
<div class="w-full md:w-1/2 max-w-2xl mb-4 md:mb-0 px-4">
<form class="relative w-full" action="{{route('front.catalog')}}" method="get">
<input name="search" class="w-full py-2 px-4 border border-outline rounded-round-four focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary bg-surface-container-lowest text-body-md" placeholder="{{__('Search our catalog')}}" type="text"/>
<button type="submit" class="absolute right-3 top-2.5 text-secondary hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[20px]">search</span>
</button>
</form>
</div>
<!-- Actions -->
<div class="flex items-center space-x-6">
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
"""

# The start index is line 127 (index 126), and the end index is line 351 (index 351).
# We want to replace lines[126:351] with the new_header.
lines[126:351] = [new_header + "\n"]

with open(file_path, "w") as f:
    f.writelines(lines)
print("Replaced header successfully")
