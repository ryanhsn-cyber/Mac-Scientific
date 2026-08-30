<?php

$print_path = 'core/resources/views/user/order/print.blade.php';
$admin_invoice_path = 'core/resources/views/back/order/invoice.blade.php';
$user_invoice_path = 'core/resources/views/user/order/invoice.blade.php';

$print_content = file_get_contents($print_path);

// Extract CSS
preg_match('/<style>(.*?)<\/style>/s', $print_content, $css_matches);
$css = $css_matches[1];

// Namespace the CSS to avoid breaking admin/user panels
$css = str_replace('table {', '.invoice-wrapper table {', $css);
$css = str_replace('td, th {', '.invoice-wrapper td, .invoice-wrapper th {', $css);
$css = str_replace('@media print', '@media print /*', $css);
$css .= ' */ '; // close the comment for print block

// Extract the invoice body and PHP block
preg_match('/(@php.*?@endphp)\s*<div class="invoice-wrapper">(.*?)<\/div>\s*<\/body>/s', $print_content, $body_matches);
$php_block = $body_matches[1];
$invoice_body = '<div class="invoice-wrapper">' . $body_matches[2] . '</div>';

$html_to_inject = $php_block . "\n<style>\n" . $css . "\n</style>\n" . $invoice_body;

// --- Update Admin Invoice ---
$admin_content = file_get_contents($admin_invoice_path);
// Remove everything after @php $state ... @endphp and replace with the new invoice body
$admin_content = preg_replace(
    '/(@php\s*if\(\$order->state\).*?@endphp).*?<\/div>\s*<\/div>\s*<\/div>\s*<\/div>\s*<\/div>\s*@endsection/s',
    "$1\n\n        <div class=\"row\">\n            <div class=\"col-lg-12\">\n                <div class=\"card\">\n                    <div class=\"card-body\">\n" . $html_to_inject . "\n                    </div>\n                </div>\n            </div>\n        </div>\n\n</div>\n\n@endsection",
    $admin_content
);
file_put_contents($admin_invoice_path, $admin_content);


// --- Update User Invoice ---
$user_content = file_get_contents($user_invoice_path);
// Remove everything after card-body p-5
$user_content = preg_replace(
    '/(<div class="card card-body p-5">).*?@endsection/s',
    "$1\n" . $html_to_inject . "\n    </div>\n</div>\n@endsection",
    $user_content
);
file_put_contents($user_invoice_path, $user_content);

echo "Invoices updated.\n";
