@extends('master.front')
@section('title')
    {{$post->title}}
@endsection

@section('meta')
@php
    $decodedOg = json_decode($post->photo, true);
    if (is_array($decodedOg) && count($decodedOg) > 0) {
        $ogPhoto = $decodedOg[array_key_first($decodedOg)];
    } else {
        $ogPhoto = is_string($decodedOg) ? $decodedOg : $post->photo;
        $ogPhoto = str_replace(['"', "'", '[', ']'], '', $ogPhoto);
    }
    $ogPhotoUrl = asset('assets/images/' . (empty($ogPhoto) ? 'placeholder.png' : $ogPhoto));
@endphp
<meta name="keywords" content="{{$post->meta_keywords ?: $post->title}}">
<meta name="description" content="{{$post->meta_descriptions ?: strip_tags(substr($post->details, 0, 160))}}">

<meta property="og:title" content="{{ $post->title }} | {{ $setting->title }}">
<meta property="og:description" content="{{ $post->meta_descriptions ?: strip_tags(substr($post->details, 0, 160)) }}">
<meta property="og:url" content="{{ route('front.blog.details', $post->slug) }}">
<meta property="og:type" content="article">
<meta property="og:image" content="{{ $ogPhotoUrl }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $post->title }} | {{ $setting->title }}">
<meta name="twitter:description" content="{{ $post->meta_descriptions ?: strip_tags(substr($post->details, 0, 160)) }}">
<meta name="twitter:image" content="{{ $ogPhotoUrl }}">

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "{{ addslashes($post->title) }}",
  "image": [
    "{{ $ogPhotoUrl }}"
  ],
  "datePublished": "{{ date('Y-m-d\TH:i:sP', strtotime($post->created_at)) }}",
  "dateModified": "{{ date('Y-m-d\TH:i:sP', strtotime($post->updated_at ?? $post->created_at)) }}",
  "author": {
    "@type": "Organization",
    "name": "{{ addslashes($setting->title) }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{ addslashes($setting->title) }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('assets/images/'.$setting->logo) }}"
    }
  },
  "description": "{{ addslashes(strip_tags(substr($post->details, 0, 200))) }}"
}
</script>
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
                <li><a href="{{route('front.blog')}}">{{__('Blog')}}</a>
                </li>
                <li class="separator"></li>
                <li>{{$post->title}}</li>
              </ul>
          </div>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
  <div class="row">
          <!-- Content-->
          <div class="col-xl-9 col-lg-8 order-lg-2">
            <div class="card blog-details-box">
                <!-- Gallery-->
                <div class="blog-details-slider owl-carousel">

                    @php
                        $decoded = json_decode($post->photo, true);
                        if (is_array($decoded) && count($decoded) > 0) {
                            $photoArray = $decoded;
                        } else {
                            $photoStr = is_string($decoded) ? $decoded : $post->photo;
                            $photoStr = str_replace(['"', "'"], '', $photoStr);
                            $photoArray = empty($photoStr) ? ['placeholder.png'] : [$photoStr];
                        }
                    @endphp
                    @foreach ($photoArray as $photo)
                        <img src="{{asset('assets/images/'.$photo)}}" alt="{{ $post->title }}">
                    @endforeach
                </div>
                <div class="blog-details-main-content">
                    <h1 class="pt-4 b-d-title" style="font-size: 24px; font-weight: 700; color: #1a1a1a;">{{$post->title}}</h1>
                <ul class="post-meta mb-4">
                    <li><i class="icon-user"></i><a href="javascript:;}">{{__('Admin')}}</a></li>
                    <li><i class="icon-tag"></i><a href="{{route('front.blog').'?category='.$post->category->slug}}">{{$post->category->name}}</a></li>
                    <li><i class="icon-clock"></i><a href="javascript:;">{{ date('jS F, Y', strtotime($post->created_at)) }}</a></li>
                    </ul>
                <div class="blog-post-details">
                    {!! $post->details !!}
                </div>

                <!-- Post Tags + Share-->
                <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-4">

                    @if ($post->tags)
                    <div class="pb-2">
                        {{ __('Tags :') }}
                        @foreach (explode(',',$post->tags) as $tag)
                        @if($loop->last)
                        <a class="text-sm text-muted navi-link" href="{{route('front.blog').'?tag='.$tag}}">{{$tag}}</a>
                        @else
                        <a class="text-sm text-muted navi-link" href="{{route('front.blog').'?tag='.$tag}}">{{$tag}}</a>,
                        @endif
                        @endforeach
                    </div>
                    @endif
                    <div class="d-flex align-items-center flex-wrap mt-2">
                        <span class="text-muted mr-2 font-weight-bold">{{__('Share')}}: </span>
                        <div class="d-inline-flex align-items-center" style="gap: 8px;">
                            <a class="btn btn-sm btn-icon" style="background:#1877f2; color:#fff; width:32px; height:32px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; text-decoration:none;" 
                               href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank" rel="noopener noreferrer" 
                               onclick="window.open(this.href, 'share-dialog', 'width=600,height=450'); return false;" 
                               title="Share on Facebook">
                                <i class="fab fa-facebook-f" style="font-size:13px;"></i>
                            </a>
                            <a class="btn btn-sm btn-icon" style="background:#000000; color:#fff; width:32px; height:32px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; text-decoration:none;" 
                               href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}" 
                               target="_blank" rel="noopener noreferrer" 
                               onclick="window.open(this.href, 'share-dialog', 'width=600,height=450'); return false;" 
                               title="Share on X">
                                <i class="fab fa-twitter" style="font-size:13px;"></i>
                            </a>
                            <a class="btn btn-sm btn-icon" style="background:#0a66c2; color:#fff; width:32px; height:32px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; text-decoration:none;" 
                               href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
                               target="_blank" rel="noopener noreferrer" 
                               onclick="window.open(this.href, 'share-dialog', 'width=600,height=450'); return false;" 
                               title="Share on LinkedIn">
                                <i class="fab fa-linkedin-in" style="font-size:13px;"></i>
                            </a>
                            <a class="btn btn-sm btn-icon" style="background:#25d366; color:#fff; width:32px; height:32px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; text-decoration:none;" 
                               href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . url()->current()) }}" 
                               target="_blank" rel="noopener noreferrer" 
                               onclick="window.open(this.href, 'share-dialog', 'width=600,height=450'); return false;" 
                               title="Share on WhatsApp">
                                <i class="fab fa-whatsapp" style="font-size:14px;"></i>
                            </a>
                            <a class="btn btn-sm btn-icon" style="background:#bd081c; color:#fff; width:32px; height:32px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; text-decoration:none;" 
                               href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&description={{ urlencode($post->title) }}" 
                               target="_blank" rel="noopener noreferrer" 
                               onclick="window.open(this.href, 'share-dialog', 'width=600,height=450'); return false;" 
                               title="Share on Pinterest">
                                <i class="fab fa-pinterest-p" style="font-size:13px;"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-icon" style="background:#64748b; color:#fff; width:32px; height:32px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; border:none; cursor:pointer;" 
                               title="{{ __('Copy Link') }}" onclick="copyBlogLink(this)">
                                <i class="fas fa-link" style="font-size:12px;"></i>
                            </button>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            @if ($setting->is_disqus == 1)

                <div class="card mb-30">
                    <div class="card-body">
                      {!!$setting->disqus!!}
                    </div>
                </div>
            @endif
            @if($post->category->posts->where('id','!=',$post->id)->count() > 0)

                <div class="row">
                    <div class="col-lg-12 pb-2">
                        <div class="section-title">
                            <h2 class="h3">{{ __('You May Also Like') }}</h2>
                        </div>
                    </div>
                </div>
                <!-- Relevant Posts-->
                <div class="resent-blog-slider owl-carousel" >

                    @foreach ($post->category->posts->where('id','!=',$post->id) as $like_post)
                    <div class="widget widget-featured-posts">
                        <div class="entry">
                        @php
                            $decoded = json_decode($like_post->photo, true);
                            $likePhotoPath = is_array($decoded) && count($decoded) > 0 ? $decoded[array_key_first($decoded)] : (is_string($decoded) ? $decoded : $like_post->photo);
                            $likePhotoPath = str_replace(['"', "'"], '', $likePhotoPath);
                            $likePhotoPath = empty($likePhotoPath) ? 'placeholder.png' : $likePhotoPath;
                        @endphp
                        <div class="entry-thumb"><a href="{{route('front.blog.details',$like_post->slug)}}"><img src="{{asset('assets/images/' . $likePhotoPath)}}" alt="Post"></a></div>
                        <div class="entry-content">
                            <h4 class="entry-title"><a href="{{route('front.blog.details',$like_post->slug)}}">
                                {{ strlen(strip_tags($like_post->title)) > 75 ? substr(strip_tags($like_post->title), 0, 75) . '...' : strip_tags($like_post->title) }}
                            </a></h4><span class="entry-meta">{{__('by')}} {{__('Admin')}}</span>
                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

          </div>
          <!-- Sidebar          -->
          <div class="col-xl-3 col-lg-4 order-lg-1">
            <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
            <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i class="icon-x"></i></span>
              <!-- Widget Search-->
              <section class="widget mb-30">
                <form action="{{route('front.blog')}}" class="input-group form-group" method="get"><span class="input-group-btn">
                    <button type="submit"><i class="icon-search"></i></button></span>
                  <input class="form-control" name="search" type="text" placeholder="{{ __('Search blog') }}">
                </form>
              </section>
              <!-- Widget Categories-->
              <section class="widget widget-categories card rounded p-4 mt-n3  mb-30">
                <h3 class="widget-title">{{__('Blog Categories')}}</h3>
                <ul>
                  @foreach ($categories as $category)
                  <li><a href="{{route('front.blog').'?category='.$category->slug}}">{{$category->name}}</a><span>{{$category->posts_count}}</span></li>
                  @endforeach

                </ul>
              </section>
              <!-- Widget Featured Posts-->
              <section class="widget widget-featured-posts card rounded p-4 mb-30">
                <h3 class="widget-title">{{__('Most Recent Added Posts')}}</h3>
               @foreach ($posts as $recent)
               <div class="entry">
                @php
                    $decoded = json_decode($recent->photo, true);
                    $recentPhotoPath = is_array($decoded) && count($decoded) > 0 ? $decoded[array_key_first($decoded)] : (is_string($decoded) ? $decoded : $recent->photo);
                    $recentPhotoPath = str_replace(['"', "'"], '', $recentPhotoPath);
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
              <section class="widget widget-popular-tags card rounded p-4 mb-4" style="overflow: hidden; clear: both;">
                <h3 class="widget-title">{{__('Popular Tags')}}</h3>
                <div class="popular-tags-wrapper" style="display: flex; flex-wrap: wrap; gap: 6px;">
                  @foreach ($tags as $tag)
                  <a class="tag-pill" href="{{route('front.blog').'?tag='.$tag}}" style="display: inline-block; white-space: normal; word-break: break-word; max-width: 100%; height: auto; padding: 5px 12px; border-radius: 16px; background: #f1f5f9; color: #334155; font-size: 12px; line-height: 1.4; text-decoration: none; transition: all 0.2s ease;">{{$tag}}</a>
                  @endforeach
                </div>
              </section>
            </aside>
          </div>
        </div>
  </div>

<script>
function copyBlogLink(btn) {
    let url = window.location.href;
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(function() {
            let icon = btn.querySelector('i');
            icon.className = 'fas fa-check';
            setTimeout(() => icon.className = 'fas fa-link', 2000);
        });
    } else {
        let temp = document.createElement('input');
        document.body.appendChild(temp);
        temp.value = url;
        temp.select();
        document.execCommand('copy');
        document.body.removeChild(temp);
        let icon = btn.querySelector('i');
        icon.className = 'fas fa-check';
        setTimeout(() => icon.className = 'fas fa-link', 2000);
    }
}
</script>
@endsection

