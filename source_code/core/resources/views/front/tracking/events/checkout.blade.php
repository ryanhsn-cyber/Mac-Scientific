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

@if(($trackingSettings['enable_meta_pixel'] ?? 0) == 1 && ($trackingSettings['track_browser_initiate_checkout'] ?? 1) == 1)
<script>
    if (typeof fbq === 'function') {
        fbq('track', 'InitiateCheckout', {
            content_ids: {!! json_encode($contentIds) !!},
            content_type: 'product',
            value: {{ (float)$totalAmount }},
            currency: '{{ $currency }}',
            num_items: {{ count($cart) }}
        }, { eventID: '{{ $eventId }}' });
    }
</script>
@endif
