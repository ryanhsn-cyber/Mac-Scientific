@extends('master.back')
@section('content')
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Ads & Scripts Management') }}</b></h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('alerts.alerts')
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body">
                    <form class="admin-form" action="{{ route('back.setting.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label class="switch-primary">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_google_analytics"  value="1" {{ $setting->is_google_analytics == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                            <span class="switch-text">{{ __('Enable Google Analytics') }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label >{{ __('Google Analytics') }} *</label>
                                                            <textarea name="google_analytics" class="form-control" id="" placeholder="{{ __('Google Analytics') }}">{{ $setting->google_analytics }}</textarea>
                                                        </div>

                                                        <hr>

                                                        <div class="form-group">
                                                            <label class="switch-primary">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_google_adsense" value="1" {{ $setting->is_google_adsense == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                            <span class="switch-text">{{ __('Enable Google Adsense Code') }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label >{{ __('Google Adsense Code') }} *</label>
                                                            <textarea name="google_adsense" class="form-control" id="" placeholder="{{ __('Google Adsense Code') }}">{{$setting->google_adsense}}</textarea>
                                                        </div>


                                                        <hr>

                                                        <div class="form-group">
                                                            <label class="switch-primary">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="recaptcha" value="1" {{ $setting->recaptcha == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                            <span class="switch-text">{{ __('Display Google Recaptcha') }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="google_recaptcha_site_key">{{ __('Google Rechaptcha Site Key') }} *</label>
                                                            <input type="text" name="google_recaptcha_site_key" class="form-control" id="google_recaptcha_site_key"
                                                                placeholder="{{ __('Google Rechaptcha Site Key') }}" value="{{ $setting->google_recaptcha_site_key }}" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="google_recaptcha_secret_key">{{ __('Google Rechaptcha Secret Key') }}</label>
                                                            <input type="text" name="google_recaptcha_secret_key" class="form-control" id="google_recaptcha_secret_key"
                                                                placeholder="{{ __('Google Rechaptcha Secret Key') }}" value="{{ $setting->google_recaptcha_secret_key }}" >
                                                        </div>


                                                        <hr>



                                                        <div class="form-group">
                                                            <label class="switch-primary">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_facebook_pixel" value="1" {{ $setting->is_facebook_pixel == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                            <span class="switch-text">{{ __('Display Facebook Pixel') }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ __('Facebook Pixel Code') }} *</label>
                                                            <textarea name="facebook_pixel" class="form-control" id="" placeholder="{{ __('Facebook Pixel') }}">{{ $setting->facebook_pixel }}</textarea>
                                                        </div>

                                                        <hr>

                                                        <div class="form-group">
                                                            <label class="switch-primary">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_facebook_capi" value="1" {{ ($setting->is_facebook_capi ?? 0) == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                            <span class="switch-text">{{ __('Enable Facebook Conversions API (CAPI)') }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ __('Meta Pixel ID') }} *</label>
                                                            <input type="text" name="facebook_pixel_id" class="form-control" placeholder="{{ __('Meta Pixel ID') }}" value="{{ $setting->facebook_pixel_id ?? '' }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ __('CAPI Access Token') }} *</label>
                                                            <textarea name="facebook_capi_token" class="form-control" placeholder="{{ __('CAPI Access Token') }}">{{ $setting->facebook_capi_token ?? '' }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ __('Test Event Code (Optional)') }}</label>
                                                            <input type="text" name="facebook_capi_test_code" class="form-control" placeholder="{{ __('TESTXXXXX') }}" value="{{ $setting->facebook_capi_test_code ?? '' }}">
                                                        </div>
                                                        <hr>
                                                        <div class="form-group">
                                                            <label class="switch-primary">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_facebook_capi_view_content" value="1" {{ ($setting->is_facebook_capi_view_content ?? 0) == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                            <span class="switch-text">{{ __('Track ViewContent Event') }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="switch-primary">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_facebook_capi_add_to_cart" value="1" {{ ($setting->is_facebook_capi_add_to_cart ?? 0) == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                            <span class="switch-text">{{ __('Track AddToCart Event') }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="switch-primary">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_facebook_capi_purchase" value="1" {{ ($setting->is_facebook_capi_purchase ?? 0) == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                            <span class="switch-text">{{ __('Track Purchase Event') }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="switch-primary">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_facebook_capi_initiate_checkout" value="1" {{ ($setting->is_facebook_capi_initiate_checkout ?? 0) == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                            <span class="switch-text">{{ __('Track InitiateCheckout Event') }}</span>
                                                            </label>
                                                        </div>
                                                        <hr>

                                                        <div class="form-group">
                                                            <label class="switch-primary">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_facebook_messenger" value="1" {{ $setting->is_facebook_messenger == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                            <span class="switch-text">{{ __('Display Facebook Messenger') }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ __('Facebook Messenger') }} *</label>
                                                            <textarea name="facebook_messenger" class="form-control" id="" placeholder="{{ __('Facebook Messenger') }}">{{ $setting->facebook_messenger }}</textarea>
                                                        </div>


                                                        <hr>

                                                        <div class="form-group">
                                                            <label class="switch-primary">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_disqus" value="1" {{ $setting->is_disqus == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                            <span class="switch-text">{{ __('Display Disqus') }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ __('Disqus Script') }} *</label>
                                                            <textarea name="disqus" class="form-control" id="" placeholder="{{ __('Disqus Script') }}">{{ $setting->disqus }}</textarea>
                                                        </div>

                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
