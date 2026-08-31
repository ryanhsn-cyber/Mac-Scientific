<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
ini_set('display_errors', '1');

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\TrackingSetting;
use App\Models\CustomTrackingEvent;
use App\Models\TrackingLog;
use App\Services\Tracking\TrackingManager;
use App\Services\Tracking\DataLayerBuilder;
use App\Services\Tracking\MetaCapiService;
use App\Services\Tracking\GA4MeasurementProtocolService;
use App\Jobs\SendMetaCapiJob;
use App\Jobs\SendGA4MeasurementJob;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

$totalTests = 0;
$passedTests = 0;
$failedTests = 0;

function assertTest($name, $condition, $details = '') {
    global $totalTests, $passedTests, $failedTests;
    $totalTests++;
    if ($condition) {
        $passedTests++;
        echo "  [PASS] {$name}\n";
    } else {
        $failedTests++;
        echo "  [FAIL] {$name} - {$details}\n";
    }
}

echo "================================================================\n";
echo "       TRACKING & INTEGRATIONS VERIFICATION TEST RUNNER         \n";
echo "================================================================\n\n";

// 1. Check Routes Registration
echo "1. Checking Route Registrations...\n";
assertTest('Route: back.tracking.index exists', Route::has('back.tracking.index'));
assertTest('Route: back.tracking.settings.update exists', Route::has('back.tracking.settings.update'));
assertTest('Route: back.tracking.custom_event.save exists', Route::has('back.tracking.custom_event.save'));
assertTest('Route: back.tracking.test.meta exists', Route::has('back.tracking.test.meta'));
assertTest('Route: back.tracking.test.ga4 exists', Route::has('back.tracking.test.ga4'));
assertTest('Route: back.tracking.logs exists', Route::has('back.tracking.logs'));
assertTest('Route: back.tracking.logs.show exists', Route::has('back.tracking.logs.show'));
assertTest('Route: back.tracking.logs.retry exists', Route::has('back.tracking.logs.retry'));
assertTest('Route: back.tracking.logs.prune exists', Route::has('back.tracking.logs.prune'));
echo "\n";

// 2. Test Deduplication Key Generation in TrackingManager
echo "2. Testing Deduplication Key Generation (TrackingManager)...\n";
$pvKey = TrackingManager::generateEventId('PageView');
assertTest('PageView key format: starts with pv_', strpos($pvKey, 'pv_') === 0, "Got: {$pvKey}");

$vcKey = TrackingManager::generateEventId('ViewContent', 101);
assertTest('ViewContent key format: contains item id 101', strpos($vcKey, 'vc_101_') === 0, "Got: {$vcKey}");

$atcKey = TrackingManager::generateEventId('AddToCart', 55);
assertTest('AddToCart key format: contains item id 55', strpos($atcKey, 'atc_55_') === 0, "Got: {$atcKey}");

$icKey = TrackingManager::generateEventId('InitiateCheckout', 'cart_999');
assertTest('InitiateCheckout key format: contains cart id', $icKey === 'ic_cart_999', "Got: {$icKey}");

$purKey = TrackingManager::generateEventId('Purchase', 'ord_888');
assertTest('Purchase key format: contains order id', $purKey === 'pur_ord_888', "Got: {$purKey}");

$leadKey = TrackingManager::generateEventId('Lead', 'contact_1');
assertTest('Lead key format: starts with lead_', strpos($leadKey, 'lead_contact_1_') === 0, "Got: {$leadKey}");

$platformStatuses = TrackingManager::getPlatformStatuses();
assertTest('Platform Statuses: contains GTM status array', isset($platformStatuses['gtm']['active']));
assertTest('Platform Statuses: contains Meta Pixel status array', isset($platformStatuses['meta_pixel']['active']));
assertTest('Platform Statuses: contains Meta CAPI status array', isset($platformStatuses['meta_capi']['active']));
echo "\n";

// 3. Test Meta CAPI Advanced Matching & User Data Normalization
echo "3. Testing Meta CAPI Advanced Matching & SHA-256 Hashing...\n";
$rawUser = [
    'em' => ' John.Doe@Example.COM ',
    'ph' => '+1 (555) 123-4567',
    'fn' => 'John',
    'ln' => 'Doe',
    'ct' => 'New York',
    'zp' => '10001'
];

$formatted = MetaCapiService::formatUserData($rawUser);
$expectedEmailHash = hash('sha256', 'john.doe@example.com');
$expectedPhoneHash = hash('sha256', '15551234567');

assertTest('Meta CAPI: Email normalized and hashed with SHA-256', isset($formatted['em']) && $formatted['em'] === $expectedEmailHash, "Got: " . ($formatted['em'] ?? 'null'));
assertTest('Meta CAPI: Phone stripped of non-digits and hashed with SHA-256', isset($formatted['ph']) && $formatted['ph'] === $expectedPhoneHash, "Got: " . ($formatted['ph'] ?? 'null'));
assertTest('Meta CAPI: First name hashed with SHA-256', isset($formatted['fn']) && $formatted['fn'] === hash('sha256', 'john'));
assertTest('Meta CAPI: Last name hashed with SHA-256', isset($formatted['ln']) && $formatted['ln'] === hash('sha256', 'doe'));

// Test double-hashing prevention
$alreadyHashed = ['em' => $expectedEmailHash];
$formattedDouble = MetaCapiService::formatUserData($alreadyHashed);
assertTest('Meta CAPI: Prevents double-hashing of pre-hashed strings', $formattedDouble['em'] === $expectedEmailHash);
echo "\n";

// 4. Test DataLayer Builder Schema Conformance
echo "4. Testing DataLayerBuilder Schemas...\n";
$mockItem = (object)[
    'id' => 12,
    'name' => 'Premium Bio-Gel 50ml',
    'discount_price' => 150.00,
    'previous_price' => 200.00,
    'category' => (object)['name' => 'Dermalfiller']
];

$dlView = DataLayerBuilder::buildViewItem($mockItem, 'test_vc_12');
assertTest('DataLayer: view_item event schema conforms', $dlView['event'] === 'view_item' && $dlView['ecommerce']['items'][0]['item_id'] === '12');

$dlCart = DataLayerBuilder::buildAddToCart($mockItem, 2, 'test_atc_12');
assertTest('DataLayer: add_to_cart value equals price * qty', $dlCart['ecommerce']['value'] === 300.00 && $dlCart['ecommerce']['items'][0]['quantity'] === 2);

$mockCart = [
    12 => ['id' => 12, 'name' => 'Premium Bio-Gel 50ml', 'main_price' => 150.00, 'qty' => 2]
];
$dlCheckout = DataLayerBuilder::buildBeginCheckout($mockCart, 300.00, 'test_ic_cart1');
assertTest('DataLayer: begin_checkout event contains cart items', $dlCheckout['event'] === 'begin_checkout' && count($dlCheckout['ecommerce']['items']) === 1);

$mockOrder = (object)[
    'id' => 10482,
    'total_amount' => 325.00,
    'transaction_number' => 'MS-10482',
    'tax' => 10.00,
    'shipping_cost' => 15.00,
    'currency_value' => 1.0,
    'cart' => json_encode($mockCart),
];
$dlPurchase = DataLayerBuilder::buildPurchase($mockOrder, $mockCart, 'pur_MS-10482');
assertTest('DataLayer: purchase event contains transaction_id', $dlPurchase['event'] === 'purchase' && $dlPurchase['ecommerce']['transaction_id'] === 'MS-10482');

$scriptTag = DataLayerBuilder::renderScript($dlView);
assertTest('DataLayer: renderScript returns window.dataLayer.push tag', strpos($scriptTag, 'window.dataLayer.push(') !== false);
echo "\n";

// 5. Test GA4 Event Normalization & Ping Schema
echo "5. Testing GA4 Measurement Protocol Service...\n";
$reflector = new ReflectionClass(GA4MeasurementProtocolService::class);
$method = $reflector->getMethod('normalizeEventName');
$method->setAccessible(true);

assertTest('GA4: Normalizes ViewContent -> view_item', $method->invoke(null, 'ViewContent') === 'view_item');
assertTest('GA4: Normalizes AddToCart -> add_to_cart', $method->invoke(null, 'AddToCart') === 'add_to_cart');
assertTest('GA4: Normalizes InitiateCheckout -> begin_checkout', $method->invoke(null, 'InitiateCheckout') === 'begin_checkout');
assertTest('GA4: Normalizes Purchase -> purchase', $method->invoke(null, 'Purchase') === 'purchase');
assertTest('GA4: Normalizes Lead -> generate_lead', $method->invoke(null, 'Lead') === 'generate_lead');
echo "\n";

// 6. Test Queued Job Instantiation
echo "6. Testing Async Queued Jobs...\n";
$metaJob = new SendMetaCapiJob('Purchase', 'pur_123', ['value' => 100], ['em' => 'test@test.com']);
assertTest('SendMetaCapiJob: Correctly initialized', $metaJob->eventName === 'Purchase' && $metaJob->eventId === 'pur_123');

$ga4Job = new SendGA4MeasurementJob('Purchase', 'pur_123', ['value' => 100], 'client_abc');
assertTest('SendGA4MeasurementJob: Correctly initialized', $ga4Job->eventName === 'Purchase' && $ga4Job->clientId === 'client_abc');
echo "\n";

// 7. Test Blade Views Compilation
echo "7. Testing Blade Views Compilation...\n";
$viewsToTest = [
    'back.tracking.partials.verification',
    'back.tracking.tabs.google',
    'back.tracking.tabs.meta',
    'back.tracking.tabs.event_builder',
    'back.tracking.tabs.logs',
    'back.tracking.partials.log_rows',
    'front.tracking.scripts',
    'front.tracking.events.view_content',
    'front.tracking.events.checkout',
    'front.tracking.events.purchase',
];

foreach ($viewsToTest as $viewName) {
    try {
        assertTest("Blade View [{$viewName}] exists", View::exists($viewName));
    } catch (\Exception $e) {
        assertTest("Blade View [{$viewName}] compilation error", false, $e->getMessage());
    }
}

echo "\n================================================================\n";
echo "                      VERIFICATION SUMMARY                      \n";
echo "================================================================\n";
echo "Total Tests Run: {$totalTests}\n";
echo "Passed Tests:    {$passedTests}\n";
echo "Failed Tests:    {$failedTests}\n";

if ($failedTests === 0) {
    echo "\n>>> ALL VERIFICATION TESTS PASSED SUCCESSFULLY! <<<\n";
    exit(0);
} else {
    echo "\n>>> SOME TESTS FAILED! <<<\n";
    exit(1);
}
