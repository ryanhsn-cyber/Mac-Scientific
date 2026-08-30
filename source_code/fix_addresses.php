<?php

$file = 'core/resources/views/user/order/print.blade.php';
$content = file_get_contents($file);

// Replace <br> with </div> and wrap each line in <div>
$content = preg_replace('/\{\{\s*\$bill\[\'bill_address1\'\]\s*\}\}<br>/', '<div>{{ $bill[\'bill_address1\'] }}</div>', $content);
$content = preg_replace('/\{\{\s*\$bill\[\'bill_address2\'\]\s*\}\}<br>/', '<div>{{ $bill[\'bill_address2\'] }}</div>', $content);
$content = preg_replace('/\{\{\s*\$bill\[\'bill_city\'\]\s*\}\}(.*?)<br>/', '<div>{{ $bill[\'bill_city\'] }}$1</div>', $content);
$content = preg_replace('/\{\{\s*\$bill\[\'bill_country\'\]\s*\}\}<br>/', '<div>{{ $bill[\'bill_country\'] }}</div>', $content);
$content = preg_replace('/\{\{\s*\$bill\[\'bill_email\'\]\s*\}\}<br>/', '<div>{{ $bill[\'bill_email\'] }}</div>', $content);
$content = preg_replace('/\{\{\s*\$bill\[\'bill_phone\'\]\s*\}\}<br>/', '<div>{{ $bill[\'bill_phone\'] }}</div>', $content);

$content = preg_replace('/\{\{\s*\$ship\[\'ship_address1\'\]\s*\}\}<br>/', '<div>{{ $ship[\'ship_address1\'] }}</div>', $content);
$content = preg_replace('/\{\{\s*\$ship\[\'ship_address2\'\]\s*\}\}<br>/', '<div>{{ $ship[\'ship_address2\'] }}</div>', $content);
$content = preg_replace('/\{\{\s*\$ship\[\'ship_city\'\]\s*\}\}(.*?)<br>/', '<div>{{ $ship[\'ship_city\'] }}$1</div>', $content);
$content = preg_replace('/\{\{\s*\$ship\[\'ship_country\'\]\s*\}\}<br>/', '<div>{{ $ship[\'ship_country\'] }}</div>', $content);
$content = preg_replace('/\{\{\s*\$ship\[\'ship_email\'\]\s*\}\}<br>/', '<div>{{ $ship[\'ship_email\'] }}</div>', $content);
$content = preg_replace('/\{\{\s*\$ship\[\'ship_phone\'\]\s*\}\}<br>/', '<div>{{ $ship[\'ship_phone\'] }}</div>', $content);

file_put_contents($file, $content);
echo "Fixed addresses.\n";
