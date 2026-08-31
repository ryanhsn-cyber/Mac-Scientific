@php
    $trackingSettings = \App\Models\TrackingSetting::getAllSettings();
    $orderTotal = (float)(\App\Helpers\PriceHelper::OrderTotal($order, true));
    $currency = \App\Helpers\PriceHelper::setCurrencyName();
    $eventId = $eventId ?? ('pur_' . ($order->transaction_number ?? $order->id));

    $contentIds = [];
    if (isset($cart) && is_array($cart)) {
        foreach ($cart as $k => $cItem) {
            $contentIds[] = (string)($cItem['id'] ?? $k);
        }
    }

    $gadsId = $trackingSettings['gads_conversion_id'] ?? '';
    $gadsLabel = $trackingSettings['gads_purchase_label'] ?? '';
@endphp

{{-- 1. Standard E-commerce DataLayer Push --}}
@if(($trackingSettings['auto_push_datalayer'] ?? 1) == 1 && isset($cart))
{!! \App\Services\Tracking\DataLayerBuilder::renderScript(\App\Services\Tracking\DataLayerBuilder::buildPurchase($order, $cart, $eventId)) !!}
@endif

{{-- 2. Meta Pixel Purchase with Deduplication Event ID --}}
@if(($trackingSettings['enable_meta_pixel'] ?? 0) == 1 && ($trackingSettings['track_browser_purchase'] ?? 1) == 1)
<script>
    if (typeof fbq === 'function') {
        fbq('track', 'Purchase', {
            content_ids: {!! json_encode($contentIds) !!},
            content_type: 'product',
            value: {{ $orderTotal }},
            currency: '{{ $currency }}',
            num_items: {{ isset($cart) ? count($cart) : 1 }}
        }, { eventID: '{{ $eventId }}' });
    }
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
