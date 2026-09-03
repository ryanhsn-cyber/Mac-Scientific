<form action="{{ route('back.tracking.settings.update') }}" method="POST">
    @csrf
    <input type="hidden" name="form_source" value="meta">

    <div class="row">
        {{-- Section A: Credentials & Connection Setup --}}
        <div class="col-lg-6">
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 font-weight-bold text-dark"><i class="fab fa-facebook text-primary mr-2"></i> {{ __('Credentials & Connection Setup') }}</h5>
                </div>
                <div class="card-body">
                    {{-- Master Toggles --}}
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-2">
                            <label class="switch-primary d-flex align-items-center">
                                <input type="checkbox" class="switch switch-bootstrap status" name="enable_meta_pixel" value="1" {{ ($settings['enable_meta_pixel'] ?? 0) == 1 ? 'checked' : '' }}>
                                <span class="switch-body mr-2"></span>
                                <span class="switch-text font-weight-bold">{{ __('Enable Meta Pixel (Browser)') }}</span>
                            </label>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label class="switch-primary d-flex align-items-center">
                                <input type="checkbox" class="switch switch-bootstrap status" name="enable_meta_capi" value="1" {{ ($settings['enable_meta_capi'] ?? 0) == 1 ? 'checked' : '' }}>
                                <span class="switch-body mr-2"></span>
                                <span class="switch-text font-weight-bold">{{ __('Enable Conversions API (Server)') }}</span>
                            </label>
                        </div>
                    </div>

                    <hr>

                    {{-- Pixel ID --}}
                    <div class="form-group">
                        <label for="meta_pixel_id" class="font-weight-bold">{{ __('Meta Pixel ID') }} <span class="text-danger">*</span></label>
                        <input type="text" name="meta_pixel_id" id="meta_pixel_id" class="form-control" placeholder="{{ __('e.g. 123456789012345') }}" value="{{ $settings['meta_pixel_id'] ?? '' }}">
                        <small class="form-text text-muted">{{ __('Found in Meta Events Manager > Data Sources.') }}</small>
                    </div>

                    {{-- CAPI Access Token --}}
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="meta_capi_token" class="font-weight-bold mb-0">{{ __('Conversions API Access Token') }} <span class="text-danger">*</span></label>
                            <button type="button" class="btn btn-xs btn-outline-primary py-0" onclick="runMetaTest()">
                                <i class="fas fa-plug mr-1"></i> {{ __('Test Token') }}
                            </button>
                        </div>
                        <div class="input-group">
                            <input type="password" name="meta_capi_token" id="meta_capi_token" class="form-control" placeholder="{{ __('EAAB...') }}" value="{{ $settings['meta_capi_token'] ?? '' }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#meta_capi_token">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <small class="form-text text-muted">{{ __('Generate a System User token with ads_management & events permissions in Events Manager.') }}</small>
                    </div>

                    {{-- Test Event Code --}}
                    <div class="form-group">
                        <label for="meta_capi_test_code" class="font-weight-bold">{{ __('Test Event Code (Optional)') }}</label>
                        <input type="text" name="meta_capi_test_code" id="meta_capi_test_code" class="form-control" placeholder="TESTXXXXX" value="{{ $settings['meta_capi_test_code'] ?? '' }}">
                        <small class="form-text text-muted">{{ __('Used for live debugging directly in Meta Events Manager > Test Events tab. Leave blank in production.') }}</small>
                    </div>

                    <hr>

                    {{-- Advanced Matching --}}
                    <h6 class="font-weight-bold text-dark mb-2"><i class="fas fa-user-shield text-success mr-2"></i> {{ __('Advanced Matching (Automatic SHA-256 Hashing)') }}</h6>
                    <p class="text-muted small mb-3">{{ __('Select customer parameters to automatically normalize, SHA-256 hash, and securely transmit from backend to maximize Meta Event Match Quality (EMQ).') }}</p>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="adv_em" name="meta_advanced_matching_em" value="1" {{ ($settings['meta_advanced_matching_em'] ?? 1) == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold" for="adv_em"><code>em</code> Email Address</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="adv_ph" name="meta_advanced_matching_ph" value="1" {{ ($settings['meta_advanced_matching_ph'] ?? 1) == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold" for="adv_ph"><code>ph</code> Phone Number</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="adv_fn" name="meta_advanced_matching_fn" value="1" {{ ($settings['meta_advanced_matching_fn'] ?? 1) == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold" for="adv_fn"><code>fn</code> First Name</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="adv_ln" name="meta_advanced_matching_ln" value="1" {{ ($settings['meta_advanced_matching_ln'] ?? 1) == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold" for="adv_ln"><code>ln</code> Last Name</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="adv_ct" name="meta_advanced_matching_ct" value="1" {{ ($settings['meta_advanced_matching_ct'] ?? 1) == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold" for="adv_ct"><code>ct</code> City</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="adv_zp" name="meta_advanced_matching_zp" value="1" {{ ($settings['meta_advanced_matching_zp'] ?? 1) == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold" for="adv_zp"><code>zp</code> Postal / Zip Code</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section B: Standard E-commerce Event Toggles Matrix --}}
        <div class="col-lg-6">
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 font-weight-bold text-dark"><i class="fas fa-tasks text-info mr-2"></i> {{ __('Standard E-commerce Event Matrix') }}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ __('Event') }}</th>
                                    <th class="text-center">{{ __('Browser (Pixel)') }}</th>
                                    <th class="text-center">{{ __('Server (CAPI)') }}</th>
                                    <th>{{ __('Deduplication Key (event_id)') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- PageView --}}
                                <tr>
                                    <td>
                                        <span class="font-weight-bold text-dark">PageView</span>
                                        <small class="d-block text-muted">Global Storefront</small>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_browser_pageview" value="1" {{ ($settings['track_browser_pageview'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_server_pageview" value="1" {{ ($settings['track_server_pageview'] ?? 0) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td><code>pv_{session}_{time}</code></td>
                                </tr>

                                {{-- ViewContent --}}
                                <tr>
                                    <td>
                                        <span class="font-weight-bold text-dark">ViewContent</span>
                                        <small class="d-block text-muted">Product Detail View</small>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_browser_view_content" value="1" {{ ($settings['track_browser_view_content'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_server_view_content" value="1" {{ ($settings['track_server_view_content'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td><code>vc_{item_id}_{session}</code></td>
                                </tr>

                                {{-- AddToCart --}}
                                <tr>
                                    <td>
                                        <span class="font-weight-bold text-dark">AddToCart</span>
                                        <small class="d-block text-muted">AJAX Cart Button</small>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_browser_add_to_cart" value="1" {{ ($settings['track_browser_add_to_cart'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_server_add_to_cart" value="1" {{ ($settings['track_server_add_to_cart'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td><code>atc_{item_id}_{time}</code></td>
                                </tr>

                                {{-- InitiateCheckout --}}
                                <tr>
                                    <td>
                                        <span class="font-weight-bold text-dark">InitiateCheckout</span>
                                        <small class="d-block text-muted">Checkout Page Load</small>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_browser_initiate_checkout" value="1" {{ ($settings['track_browser_initiate_checkout'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_server_initiate_checkout" value="1" {{ ($settings['track_server_initiate_checkout'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td><code>ic_{cart_id}</code></td>
                                </tr>

                                {{-- AddPaymentInfo --}}
                                <tr>
                                    <td>
                                        <span class="font-weight-bold text-dark">AddPaymentInfo</span>
                                        <small class="d-block text-muted">Payment Step Submit</small>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_browser_add_payment_info" value="1" {{ ($settings['track_browser_add_payment_info'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_server_add_payment_info" value="1" {{ ($settings['track_server_add_payment_info'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td><code>api_{order_id}</code></td>
                                </tr>

                                {{-- Purchase --}}
                                <tr>
                                    <td>
                                        <span class="font-weight-bold text-dark">Purchase</span>
                                        <small class="d-block text-muted">Order Confirmation</small>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_browser_purchase" value="1" {{ ($settings['track_browser_purchase'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_server_purchase" value="1" {{ ($settings['track_server_purchase'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td><code>pur_{order_id}</code></td>
                                </tr>

                                {{-- Lead / Contact --}}
                                <tr>
                                    <td>
                                        <span class="font-weight-bold text-dark">Lead</span>
                                        <small class="d-block text-muted">Contact / Ticket Form</small>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_browser_lead" value="1" {{ ($settings['track_browser_lead'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="track_server_lead" value="1" {{ ($settings['track_server_lead'] ?? 1) == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td><code>lead_{form_id}_{time}</code></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Save Changes Button --}}
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body text-center py-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm">
                        <i class="fas fa-save mr-2"></i> {{ __('Save Meta (Facebook) Settings') }}
                    </button>
                    <small class="text-muted mt-2 d-block">{{ __('Deduplication keys guarantee zero double-counting within 48h.') }}</small>
                </div>
            </div>
        </div>
    </div>
</form>
