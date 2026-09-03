@php
    $trackingSettings = \App\Models\TrackingSetting::getAllSettings();
    $cart = Session::has('cart') ? Session::get('cart') : [];
    $totalAmount = $total ?? (Session::has('cart') ? \App\Helpers\PriceHelper::cartTotal($cart, 2) : 0);
    $eventId = $eventId ?? \App\Services\Tracking\TrackingManager::generateEventId('InitiateCheckout');
    $currency = \App\Helpers\PriceHelper::setCurrencyName();

    $contentIds = [];
    foreach ($cart as $k => $cItem) {
        $contentIds[] = (string)($cItem['id'] ?? $k);
    }
@endphp

@if(($trackingSettings['auto_push_datalayer'] ?? 1) == 1)
{!! \App\Services\Tracking\DataLayerBuilder::renderScript(\App\Services\Tracking\DataLayerBuilder::buildBeginCheckout($cart, (float)$totalAmount, $eventId)) !!}
@endif

@if((($trackingSettings['enable_meta_pixel'] ?? 0) == 1 && ($trackingSettings['track_browser_initiate_checkout'] ?? 1) == 1) || (($trackingSettings['enable_gtm'] ?? 0) == 1))
<script>
    (function() {
        var icFired = false;
        function triggerPixelIC() {
            if (icFired) return;
            if (typeof fbq === 'function') {
                icFired = true;
                fbq('track', 'InitiateCheckout', {
                    content_ids: {!! json_encode($contentIds) !!},
                    content_type: 'product',
                    value: {{ (float)$totalAmount }},
                    currency: '{{ $currency }}',
                    num_items: {{ count($cart) }}
                }, { eventID: '{{ $eventId }}' });
            }
        }
        triggerPixelIC();
        if (!icFired) {
            var attempts = 0;
            var timer = setInterval(function() {
                attempts++;
                triggerPixelIC();
                if (icFired || attempts >= 30) clearInterval(timer);
            }, 100);
        }
    })();
</script>
@endif
