@php
    $trackingSettings = \App\Models\TrackingSetting::getAllSettings();
    $eventId = $eventId ?? \App\Services\Tracking\TrackingManager::generateEventId('ViewContent', $item->id ?? null);
    $price = (float)($item->discount_price ?? $item->previous_price ?? 0);
    $currency = \App\Helpers\PriceHelper::setCurrencyName();
@endphp

@if(($trackingSettings['auto_push_datalayer'] ?? 1) == 1)
{!! \App\Services\Tracking\DataLayerBuilder::renderScript(\App\Services\Tracking\DataLayerBuilder::buildViewItem($item, $eventId)) !!}
@endif

@if(($trackingSettings['enable_meta_pixel'] ?? 0) == 1 && ($trackingSettings['track_browser_view_content'] ?? 1) == 1)
<script>
    if (typeof fbq === 'function') {
        fbq('track', 'ViewContent', {
            content_name: '{{ addslashes($item->name) }}',
            content_category: '{{ addslashes($item->category->name ?? '') }}',
            content_ids: ['{{ $item->id }}'],
            content_type: 'product',
            value: {{ $price }},
            currency: '{{ $currency }}'
        }, { eventID: '{{ $eventId }}' });
    }
</script>
@endif
