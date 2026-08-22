@extends('master.front')

@section('title')
    {{__('Medical Aesthetics & Technology Blog')}}
@endsection

@section('meta')
<meta name="keywords" content="PRP, PRF, Labware, Centrifuge, Medical Aesthetics, Dermatology, Mac Scientific Blog">
<meta name="description" content="Discover the latest scientific advancements, protocols, and equipment guides for PRP, PRF, and aesthetic medicine from Mac Scientific.">
<meta property="og:title" content="Medical Aesthetics & Technology Blog | {{ $setting->title }}">
<meta property="og:description" content="Discover the latest scientific advancements, protocols, and equipment guides for PRP, PRF, and aesthetic medicine from Mac Scientific.">
<meta property="og:url" content="{{ route('front.blog') }}">
<meta property="og:type" content="website">
<meta property="og:image" content="{{ asset('assets/images/'.$setting->logo) }}">
@endsection

@section('content')
    <!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('Blog')}}</li>
                  </ul>
            </div>
        </div>
    </div>
  </div>

  <div class="container padding-bottom-3x mb-1 blog-page">
    <div class="row ">
            <!-- Content-->
            <div class="col-xl-9 col-lg-8 order-lg-2">
                <div class="row">
                    @forelse ($posts as $post)
                        <div class="col-md-6">
                            <a href="{{route('front.blog.details',$post->slug)}}" class="blog-post">
                                <div class="post-thumb">
                                    @php
                                        $decoded = json_decode($post->photo, true);
                                        $photoPath = is_array($decoded) && count($decoded) > 0 ? $decoded[array_key_first($decoded)] : (is_string($decoded) ? $decoded : $post->photo);
                                        $photoPath = trim($photoPath, '"'');
                                        $photoPath = empty($photoPath) ? 'placeholder.png' : $photoPath;
                                    @endphp
                                    <img class="lazy" loading="lazy" width="400" height="400" src="{{ asset('assets/images/' . $photoPath) }}"
                                        alt="{{ $post->title }}">
                                    </div>
                                <div class="post-body">

                                    <h3 class="post-title"> {{ strlen(strip_tags($post->title)) > 55 ? substr(strip_tags($post->title), 0, 55) : strip_tags($post->title) }}
                                    </h3>
                                    <ul class="post-meta">

                                        <li><i class="icon-user"></i>{{ __('Admin') }}</li>
                                        <li><i class="icon-clock"></i>{{ date('jS F, Y', strtotime($post->created_at)) }}</li>
                                    </ul>
                                    <p>{{ strlen(strip_tags($post->details)) > 120 ? substr(strip_tags($post->details), 0, 120) : strip_tags($post->details) }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        @empty
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    {{ __('No Data Found') }}
                                </div>
                            </div>
                        </div>
                     @endforelse

                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
            <!-- Sidebar          -->
            <div class="col-xl-3 col-lg-4 order-lg-1">
              <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
              <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i class="icon-x"></i></span>
                <!-- Widget Search-->
                <section class="widget">
                  <form action="{{route('front.blog')}}" class="input-group form-group" method="get"><span class="input-group-btn">
                      <button type="submit"><i class="icon-search"></i></button></span>
                    <input class="form-control" name="search" type="text" placeholder="{{ __('Search blog') }}">
                  </form>
                </section>
                <!-- Widget Categories-->
                <section class="widget widget-categories card rounded p-4 mt-n3">
                  <h3 class="widget-title">{{__('Blog Categories')}}</h3>
                  <ul>
                    @foreach ($categories as $category)
                    <li><a href="{{route('front.blog').'?category='.$category->slug}}">{{$category->name}}</a><span>{{$category->posts_count}}</span></li>
                    @endforeach

                  </ul>
                </section>
                <!-- Widget Featured Posts-->
                <section class="widget widget-featured-posts card rounded p-4">
                  <h3 class="widget-title">{{__('Most Recent Added Posts')}}</h3>
                 @foreach ($recent_posts as $recent)
                 <div class="entry">
                  @php
                      $decoded = json_decode($recent->photo, true);
                      $recentPhotoPath = is_array($decoded) && count($decoded) > 0 ? $decoded[array_key_first($decoded)] : (is_string($decoded) ? $decoded : $recent->photo);
                      $recentPhotoPath = trim($recentPhotoPath, '"'');
                      $recentPhotoPath = empty($recentPhotoPath) ? 'placeholder.png' : $recentPhotoPath;
                  @endphp
                  <div class="entry-thumb"><a href="{{route('front.blog.details',$recent->slug)}}"><img src="{{ asset('assets/images/' . $recentPhotoPath) }}" alt="Post"></a></div>
                  <div class="entry-content">
                    <h4 class="entry-title"><a href="{{route('front.blog.details',$recent->slug)}}">
                      {{ strlen(strip_tags($recent->title)) > 55 ? substr(strip_tags($recent->title), 0, 55) . '...' : strip_tags($recent->title) }}

                  </a></h4><span class="entry-meta">{{__('by')}} {{__('Admin')}}</span>
                  </div>
                </div>
                 @endforeach
                </section>
                <!-- Widget Tags-->
                <section class="widget widget-featured-posts card rounded p-4">
                  <h3 class="widget-title">{{__('Popular Tags')}}</h3>
                 <div>
                  @foreach ($tags as $tag)
                  <a class="tag" href="{{route('front.blog').'?tag='.$tag}}">{{$tag}}</a>
                  @endforeach
                 </div>
                </section>
              </aside>
            </div>

          </div>
    </div>

@endsection
