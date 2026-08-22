@extends('master.front')

@section('title')
    {{ __('404 - Page Not Found') }}
@endsection

@section('content')
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                    <li class="separator"></li>
                    <li>{{ __('404 Not Found') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container padding-top-3x padding-bottom-3x text-center my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div style="font-size: 96px; font-weight: 800; color: #0d47a1; line-height: 1; margin-bottom: 15px;">404</div>
            <h1 class="h3 font-weight-bold mb-3" style="color: #1a1a1a;">{{ __('Page Not Found') }}</h1>
            <p class="text-muted mb-4" style="font-size: 16px;">
                {{ __('Oops! The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.') }}
            </p>

            <div class="mb-4">
                <form action="{{ route('front.catalog') }}" method="GET" class="input-group" style="max-width: 450px; margin: 0 auto;">
                    <input type="text" name="search" class="form-control" placeholder="{{ __('Search products...') }}" required style="height: 48px; border-radius: 24px 0 0 24px;">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" style="height: 48px; border-radius: 0 24px 24px 0; padding: 0 20px;">
                            <i class="icon-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="d-flex justify-content-center flex-wrap" style="gap: 12px;">
                <a href="{{ route('front.index') }}" class="btn btn-primary" style="border-radius: 6px; padding: 10px 24px;">
                    <i class="icon-home mr-2"></i> {{ __('Back to Home') }}
                </a>
                <a href="{{ route('front.catalog') }}" class="btn btn-outline-primary" style="border-radius: 6px; padding: 10px 24px;">
                    <i class="icon-grid mr-2"></i> {{ __('Browse All Products') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
