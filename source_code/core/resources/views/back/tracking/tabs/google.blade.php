<form action="{{ route('back.tracking.settings.update') }}" method="POST">
    @csrf
    <input type="hidden" name="form_source" value="google">

    <div class="row">
        {{-- Left Column: Google Tag Manager & Direct GA4 --}}
        <div class="col-lg-7">
            {{-- GTM Settings Card --}}
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 font-weight-bold text-dark"><i class="fas fa-tags text-warning mr-2"></i> {{ __('Google Tag Manager (GTM) Integration') }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label class="switch-primary d-flex align-items-center">
                            <input type="checkbox" class="switch switch-bootstrap status" name="enable_gtm" value="1" {{ ($settings['enable_gtm'] ?? 0) == 1 ? 'checked' : '' }}>
                            <span class="switch-body mr-2"></span>
                            <span class="switch-text font-weight-bold">{{ __('Enable GTM Container Injection') }}</span>
                        </label>
                        <small class="form-text text-muted">{{ __('Injects standard GTM scripts globally across the frontend in <head> and <body>.') }}</small>
                    </div>

                    <div class="form-group">
                        <label for="gtm_container_id" class="font-weight-bold">{{ __('GTM Container ID') }}</label>
                        <input type="text" name="gtm_container_id" id="gtm_container_id" class="form-control" placeholder="GTM-XXXXXXX" value="{{ $settings['gtm_container_id'] ?? '' }}">
                        <small class="form-text text-muted">{{ __('Found in your Google Tag Manager workspace top navigation bar.') }}</small>
                    </div>

                    <div class="form-group">
                        <label for="gtm_server_url" class="font-weight-bold">{{ __('GTM Server Container URL (Optional)') }}</label>
                        <input type="url" name="gtm_server_url" id="gtm_server_url" class="form-control" placeholder="https://sgtm.yourdomain.com" value="{{ $settings['gtm_server_url'] ?? '' }}">
                        <small class="form-text text-muted">{{ __('For Server-Side GTM container routing (sGTM / Cloud Run).') }}</small>
                    </div>
                </div>
            </div>

            {{-- GA4 Direct & Server API Card --}}
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 font-weight-bold text-dark"><i class="fab fa-google text-danger mr-2"></i> {{ __('Google Analytics 4 (GA4) Direct & Server-Side') }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label class="switch-primary d-flex align-items-center">
                            <input type="checkbox" class="switch switch-bootstrap status" name="enable_ga4_direct" value="1" {{ ($settings['enable_ga4_direct'] ?? 0) == 1 ? 'checked' : '' }}>
                            <span class="switch-body mr-2"></span>
                            <span class="switch-text font-weight-bold">{{ __('Enable Direct GA4 Snippet Injection (Fallback)') }}</span>
                        </label>
                        <small class="form-text text-muted">{{ __('Direct gtag.js injection on frontend if GTM is not used.') }}</small>
                    </div>

                    <div class="form-group">
                        <label for="ga4_measurement_id" class="font-weight-bold">{{ __('GA4 Measurement ID') }}</label>
                        <input type="text" name="ga4_measurement_id" id="ga4_measurement_id" class="form-control" placeholder="G-XXXXXXXXXX" value="{{ $settings['ga4_measurement_id'] ?? '' }}">
                        <small class="form-text text-muted">{{ __('Found in Google Analytics Admin > Data Streams.') }}</small>
                    </div>

                    <div class="form-group">
                        <label for="ga4_api_secret" class="font-weight-bold">{{ __('GA4 Server API Secret') }}</label>
                        <div class="input-group">
                            <input type="password" name="ga4_api_secret" id="ga4_api_secret" class="form-control" placeholder="{{ __('Measurement Protocol API Secret') }}" value="{{ $settings['ga4_api_secret'] ?? '' }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#ga4_api_secret">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <small class="form-text text-muted">{{ __('Measurement Protocol API secret for direct Laravel-to-Google server tracking.') }}</small>
                    </div>

                    <hr>

                    {{-- Google Ads Conversions --}}
                    <h6 class="font-weight-bold text-dark mt-3"><i class="fas fa-bullhorn text-primary mr-2"></i> {{ __('Google Ads Conversion Tracking') }}</h6>

                    <div class="form-group">
                        <label for="gads_conversion_id" class="font-weight-bold">{{ __('Google Ads Conversion ID') }}</label>
                        <input type="text" name="gads_conversion_id" id="gads_conversion_id" class="form-control" placeholder="AW-XXXXXXXXX" value="{{ $settings['gads_conversion_id'] ?? '' }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gads_purchase_label" class="font-weight-bold">{{ __('Purchase Conversion Label') }}</label>
                                <input type="text" name="gads_purchase_label" id="gads_purchase_label" class="form-control" placeholder="e.g. AbCdEfGhIjKlMnOpQr" value="{{ $settings['gads_purchase_label'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gads_add_to_cart_label" class="font-weight-bold">{{ __('Add to Cart Conversion Label') }}</label>
                                <input type="text" name="gads_add_to_cart_label" id="gads_add_to_cart_label" class="form-control" placeholder="e.g. XyZ123AbC456" value="{{ $settings['gads_add_to_cart_label'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Direct Data Layer Builder Switch & Architecture Guide --}}
        <div class="col-lg-5">
            {{-- Data Layer Settings Card --}}
            <div class="card mb-4 border-0 shadow-sm border-left-primary">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 font-weight-bold text-dark"><i class="fas fa-layer-group text-primary mr-2"></i> {{ __('Direct Data Layer Builder') }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="switch-primary d-flex align-items-center">
                            <input type="checkbox" class="switch switch-bootstrap status" name="auto_push_datalayer" value="1" {{ ($settings['auto_push_datalayer'] ?? 1) == 1 ? 'checked' : '' }}>
                            <span class="switch-body mr-2"></span>
                            <span class="switch-text font-weight-bold">{{ __('Auto-Push Ecommerce Data Layer to Window') }}</span>
                        </label>
                        <small class="form-text text-muted">
                            {{ __('When enabled, Laravel automatically injects standardized window.dataLayer.push({ event: "purchase", ecommerce: { ... } }) on relevant Blade views so GTM triggers without manual scripting.') }}
                        </small>
                    </div>

                    <div class="alert alert-light border p-3 rounded small mb-0">
                        <h6 class="font-weight-bold mb-2 text-primary"><i class="fas fa-info-circle mr-1"></i> {{ __('Supported Standard Events:') }}</h6>
                        <ul class="pl-3 mb-0 text-muted">
                            <li><code>view_item</code> - Product details page</li>
                            <li><code>add_to_cart</code> - Dynamic AJAX cart additions</li>
                            <li><code>begin_checkout</code> - Billing & checkout view</li>
                            <li><code>purchase</code> - Order success confirmation view</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Save Changes Floating Card --}}
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body text-center py-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm">
                        <i class="fas fa-save mr-2"></i> {{ __('Save Google Suite Settings') }}
                    </button>
                    <small class="text-muted mt-2 d-block">{{ __('Changes take effect immediately across all storefront pages.') }}</small>
                </div>
            </div>
        </div>
    </div>
</form>
