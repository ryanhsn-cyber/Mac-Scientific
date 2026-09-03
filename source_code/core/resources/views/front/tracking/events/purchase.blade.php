@php
    $trackingSettings = \App\Models\TrackingSetting::getAllSettings();
    $orderTotal = (float)(\App\Helpers\PriceHelper::OrderTotal($order, true));
    $currency = \App\Helpers\PriceHelper::setCurrencyName();
    $eventId = $eventId ?? ('pur_' . ($order->transaction_number ?? $order->id));

    $cartItems = $cart ?? (isset($order->cart) ? $order->cart : []);
    if (is_string($cartItems)) {
        $cartItems = json_decode($cartItems, true) ?: [];
    }
    if (!is_array($cartItems)) {
        $cartItems = [];
    }

    $contentIds = [];
    foreach ($cartItems as $k => $cItem) {
        $rawId = $cItem['id'] ?? explode('-', (string)$k)[0];
        $contentIds[] = (string)$rawId;
    }

    $gadsId = $trackingSettings['gads_conversion_id'] ?? '';
    $gadsLabel = $trackingSettings['gads_purchase_label'] ?? '';
@endphp

{{-- 1. Standard E-commerce DataLayer Push (Supports GA4 & GTM Meta Pixel Tags) --}}
@if(($trackingSettings['auto_push_datalayer'] ?? 1) == 1)
{!! \App\Services\Tracking\DataLayerBuilder::renderScript(\App\Services\Tracking\DataLayerBuilder::buildPurchase($order, $cartItems, $eventId)) !!}
@endif

{{-- 2. Meta Pixel Purchase with Deduplication Event ID (Triggers whether initialized via backend or via GTM) --}}
@if((($trackingSettings['enable_meta_pixel'] ?? 0) == 1 && ($trackingSettings['track_browser_purchase'] ?? 1) == 1) || (($trackingSettings['enable_gtm'] ?? 0) == 1))
<script>
    (function() {
        var purchaseFired = false;
        function triggerPixelPurchase() {
            if (purchaseFired) return;
            if (typeof fbq === 'function') {
                purchaseFired = true;
                fbq('track', 'Purchase', {
                    content_ids: {!! json_encode($contentIds) !!},
                    content_type: 'product',
                    value: {{ $orderTotal }},
                    currency: '{{ $currency }}',
                    num_items: {{ count($contentIds) > 0 ? count($contentIds) : 1 }}
                }, { eventID: '{{ $eventId }}' });
            }
        }

        // 1. Try immediate execution if fbq is already defined
        triggerPixelPurchase();

        // 2. Poll every 100ms up to 30 times (3s) to catch GTM asynchronously injecting fbq
        if (!purchaseFired) {
            var attempts = 0;
            var timer = setInterval(function() {
                attempts++;
                triggerPixelPurchase();
                if (purchaseFired || attempts >= 30) {
                    clearInterval(timer);
                }
            }, 100);
        }
    })();
</script>
@endif

{{-- 3. Google Ads Conversion Tracking --}}
@if(!empty($gadsId) && !empty($gadsLabel))
<script>
    if (typeof gtag === 'function') {
        gtag('event', 'conversion', {
            'send_to': '{{ $gadsId }}/{{ $gadsLabel }}',
            'value': {{ $orderTotal }},
            'currency': '{{ $currency }}',
            'transaction_id': '{{ $order->transaction_number ?? $order->id }}'
        });
    }
</script>
@endif
