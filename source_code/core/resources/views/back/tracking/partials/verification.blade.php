<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
        <h5 class="mb-0 font-weight-bold text-dark"><i class="fas fa-stethoscope text-primary mr-2"></i> {{ __('Connection Verification & Health Checks') }}</h5>
        <span class="text-muted small">{{ __('Live API ping diagnostic engine') }}</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-items-center mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 25%;">{{ __('Channel') }}</th>
                        <th style="width: 15%;">{{ __('Status') }}</th>
                        <th style="width: 15%;">{{ __('Latency') }}</th>
                        <th style="width: 20%;">{{ __('Last Tested') }}</th>
                        <th style="width: 25%; text-align: right;">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Meta CAPI Check --}}
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fab fa-facebook text-primary mr-2 fa-lg"></i>
                                <div>
                                    <span class="font-weight-bold d-block">{{ __('Meta CAPI') }}</span>
                                    <small class="text-muted">{{ __('Graph API v19.0+ Server-Side') }}</small>
                                </div>
                            </div>
                        </td>
                        <td id="meta-test-status">
                            @if($platformStatuses['meta_capi']['active'])
                                <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> {{ __('CONFIGURED') }}</span>
                            @else
                                <span class="badge badge-secondary px-2 py-1">{{ __('UNCONFIGURED') }}</span>
                            @endif
                        </td>
                        <td id="meta-test-latency">
                            <span class="text-muted">--</span>
                        </td>
                        <td id="meta-test-time">
                            <span class="text-muted small">{{ __('Not tested yet') }}</span>
                        </td>
                        <td style="text-align: right;">
                            <button type="button" class="btn btn-sm btn-outline-primary" id="btn-test-meta" onclick="runMetaTest()">
                                <i class="fas fa-paper-plane mr-1"></i> {{ __('Send Test Event') }}
                            </button>
                        </td>
                    </tr>

                    {{-- GA4 MP Check --}}
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fab fa-google text-danger mr-2 fa-lg"></i>
                                <div>
                                    <span class="font-weight-bold d-block">{{ __('GA4 Measurement API') }}</span>
                                    <small class="text-muted">{{ __('Measurement Protocol v2') }}</small>
                                </div>
                            </div>
                        </td>
                        <td id="ga4-test-status">
                            @if(!empty($settings['ga4_measurement_id']) && !empty($settings['ga4_api_secret']))
                                <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> {{ __('CONFIGURED') }}</span>
                            @else
                                <span class="badge badge-secondary px-2 py-1">{{ __('UNCONFIGURED') }}</span>
                            @endif
                        </td>
                        <td id="ga4-test-latency">
                            <span class="text-muted">--</span>
                        </td>
                        <td id="ga4-test-time">
                            <span class="text-muted small">{{ __('Not tested yet') }}</span>
                        </td>
                        <td style="text-align: right;">
                            <button type="button" class="btn btn-sm btn-outline-danger" id="btn-test-ga4" onclick="runGA4Test()">
                                <i class="fas fa-paper-plane mr-1"></i> {{ __('Send Test Event') }}
                            </button>
                        </td>
                    </tr>

                    {{-- GTM Container Check --}}
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-tags text-warning mr-2 fa-lg"></i>
                                <div>
                                    <span class="font-weight-bold d-block">{{ __('GTM Container') }}</span>
                                    <small class="text-muted">{{ __('Frontend Head/Body Snippet') }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($platformStatuses['gtm']['active'])
                                <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> {{ __('FOUND') }} ({{ $settings['gtm_container_id'] ?? '' }})</span>
                            @else
                                <span class="badge badge-secondary px-2 py-1">{{ __('DISABLED') }}</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-muted">--</span>
                        </td>
                        <td>
                            <span class="text-muted small">{{ __('Checked on page load') }}</span>
                        </td>
                        <td style="text-align: right;">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#gtmInspectModal">
                                <i class="fas fa-code mr-1"></i> {{ __('Inspect Snippet') }}
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- GTM Snippet Modal --}}
<div class="modal fade" id="gtmInspectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-code text-warning mr-2"></i> {{ __('Google Tag Manager Head & Body Snippet Preview') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="font-weight-bold text-dark">{{ __('Head Injection:') }}</h6>
                <pre class="bg-dark text-light p-3 rounded small" style="overflow-x: auto;">&lt;!-- Google Tag Manager --&gt;
&lt;script&gt;(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&amp;l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{{ $settings['gtm_container_id'] ?? 'GTM-XXXXXXX' }}');&lt;/script&gt;
&lt;!-- End Google Tag Manager --&gt;</pre>

                <h6 class="font-weight-bold text-dark mt-3">{{ __('Body (NoScript) Fallback:') }}</h6>
                <pre class="bg-dark text-light p-3 rounded small" style="overflow-x: auto;">&lt;!-- Google Tag Manager (noscript) --&gt;
&lt;noscript&gt;&lt;iframe src="https://www.googletagmanager.com/ns.html?id={{ $settings['gtm_container_id'] ?? 'GTM-XXXXXXX' }}"
height="0" width="0" style="display:none;visibility:hidden"&gt;&lt;/iframe&gt;&lt;/noscript&gt;
&lt;!-- End Google Tag Manager (noscript) --&gt;</pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
