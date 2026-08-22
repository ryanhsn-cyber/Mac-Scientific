@extends('master.front')

@section('title')
    {{$page->title}}
@endsection

@section('meta')
<meta name="keywords" content="{{$page->meta_keywords ?: $page->title}}">
<meta name="description" content="{{$page->meta_descriptions ?: strip_tags(substr($page->details, 0, 160))}}">
<meta property="og:title" content="{{ $page->title }} | {{ $setting->title }}">
<meta property="og:description" content="{{ $page->meta_descriptions ?: strip_tags(substr($page->details, 0, 160)) }}">
<meta property="og:url" content="{{ route('front.page', $page->slug) }}">
<meta property="og:type" content="website">
<meta property="og:image" content="{{ asset('assets/images/'.$setting->logo) }}">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $page->title }} | {{ $setting->title }}">
<meta name="twitter:description" content="{{ $page->meta_descriptions ?: strip_tags(substr($page->details, 0, 160)) }}">
@endsection

@section('content')
    <!-- Page Title-->
<div class="page-title mb-0">
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ul class="breadcrumbs">
                <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
                <li class="separator">&nbsp;</li>
                <li>{{$page->title}}</li>
              </ul>
        </div>
    </div>
  </div>
</div>
<!-- Page Content-->
<div class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4 mt-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body px-4 py-5">
                        <div class="d-page-content">
                            <h1 class="d-block text-center mb-4" style="font-size: 26px; font-weight: 700; color: #1a1a1a;">{{$page->title}}</h1>
                            {!! $page->details !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
</div>

@endsection
