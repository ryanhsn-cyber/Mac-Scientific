@php
    $trackingSettings = \App\Models\TrackingSetting::getAllSettings();
    $customClientEvents = \App\Models\CustomTrackingEvent::active()->clientSide()->get();

    $enableGtm = ($trackingSettings['enable_gtm'] ?? '0') == '1' && !empty($trackingSettings['gtm_container_id']);
    $gtmContainerId = $trackingSettings['gtm_container_id'] ?? '';

    $enableGa4Direct = ($trackingSettings['enable_ga4_direct'] ?? '0') == '1' && !empty($trackingSettings['ga4_measurement_id']);
    $ga4MeasurementId = $trackingSettings['ga4_measurement_id'] ?? '';

    $gadsId = $trackingSettings['gads_conversion_id'] ?? '';

    $enableMetaPixel = ($trackingSettings['enable_meta_pixel'] ?? '0') == '1' && !empty($trackingSettings['meta_pixel_id']);
    $metaPixelId = $trackingSettings['meta_pixel_id'] ?? '';

    $trackBrowserPageView = ($trackingSettings['track_browser_pageview'] ?? '1') == '1';
    $pageViewEventId = \App\Services\Tracking\TrackingManager::generateEventId('PageView');
@endphp

{{-- 1. Google Tag Manager (Head) --}}
@if($enableGtm)
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{{ $gtmContainerId }}');</script>
<!-- End Google Tag Manager -->
@endif

{{-- 2. Direct GA4 (Fallback) & Google Ads --}}
@if($enableGa4Direct)
<!-- Google Analytics 4 (Direct) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $ga4MeasurementId }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ $ga4MeasurementId }}', {
    'send_page_view': true
  });
  @if(!empty($gadsId))
  gtag('config', '{{ $gadsId }}');
  @endif
</script>
<!-- End Google Analytics 4 -->
@endif

{{-- 3. Meta (Facebook) Pixel --}}
@if($enableMetaPixel)
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '{{ $metaPixelId }}');
@if($trackBrowserPageView)
fbq('track', 'PageView', {}, { eventID: '{{ $pageViewEventId }}' });
@endif
</script>
<noscript>
  <img height="1" width="1" style="display:none" 
       src="https://www.facebook.com/tr?id={{ $metaPixelId }}&ev=PageView&noscript=1"/>
</noscript>
<!-- End Meta Pixel Code -->
@endif

{{-- 4. Dynamic Client-Side Rules from Event Builder --}}
@if($customClientEvents->count() > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    var customRules = {!! json_encode($customClientEvents) !!};

    customRules.forEach(function(rule) {
        var destinations = rule.destinations || [];
        var eventName = rule.event_name;
        var eventId = 'clt_' + Math.random().toString(36).substr(2, 9) + '_' + Date.now();

        // Helper to dispatch event to destinations
        function triggerCustomEvent(payload) {
            payload = payload || {};

            // Meta Pixel
            if (destinations.indexOf('meta_capi') !== -1 && typeof fbq === 'function') {
                fbq('trackCustom', eventName, payload, { eventID: eventId });
            }

            // GA4 Direct
            if (destinations.indexOf('ga4') !== -1 && typeof gtag === 'function') {
                gtag('event', eventName, Object.assign({}, payload, { event_id: eventId }));
            }

            // GTM DataLayer
            if (destinations.indexOf('gtm') !== -1 && window.dataLayer) {
                window.dataLayer.push(Object.assign({
                    'event': eventName,
                    'event_id': eventId
                }, payload));
            }
        }

        // Build static payload mapping if defined
        var mappedPayload = {};
        if (rule.payload_schema && Array.isArray(rule.payload_schema)) {
            rule.payload_schema.forEach(function(item) {
                if (item.key && item.source) {
                    mappedPayload[item.key] = item.source;
                }
            });
        }

        // A. CSS Click Trigger
        if (rule.trigger_type === 'client_click' && rule.trigger_target) {
            var targets = document.querySelectorAll(rule.trigger_target);
            targets.forEach(function(el) {
                el.addEventListener('click', function() {
                    triggerCustomEvent(mappedPayload);
                });
            });
        }

        // B. URL Match Trigger
        if (rule.trigger_type === 'url_match' && rule.trigger_target) {
            if (window.location.href.indexOf(rule.trigger_target) !== -1 || window.location.pathname.indexOf(rule.trigger_target) !== -1) {
                triggerCustomEvent(mappedPayload);
            }
        }

        // C. Custom JS Window Event Dispatcher
        if (rule.trigger_type === 'js_dispatch' && rule.trigger_target) {
            window.addEventListener(rule.trigger_target, function(e) {
                var extraData = (e.detail && typeof e.detail === 'object') ? e.detail : {};
                triggerCustomEvent(Object.assign({}, mappedPayload, extraData));
            });
        }
    });
});
</script>
@endif
