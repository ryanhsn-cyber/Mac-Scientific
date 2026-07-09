<?php
$productFile = 'source_code/core/resources/views/front/catalog/product.blade.php';
$productContent = file_get_contents($productFile);
$productContent = str_replace('{{ __(\'কার্টে যোগ করুন\') }}', '{{ __(\'Add to Cart\') }}', $productContent);
$productContent = str_replace('{{ __(\'এখুনি অর্ডার করুন\') }}', '{{ __(\'Order Now\') }}', $productContent);
file_put_contents($productFile, $productContent);

$billingFile = 'source_code/core/resources/views/front/checkout/billing.blade.php';
$billingContent = file_get_contents($billingFile);
$replacements = [
    '{{__(\'আপনার নামের প্রথম অংশ\')}}' => '{{__(\'First Name\')}}',
    '{{__(\'নামের শেষ অংশ\')}}' => '{{__(\'Last Name\')}}',
    '{{__(\'আপনার ইমেইল এর এড্রেস (ঐচ্ছিক)\')}}' => '{{__(\'Email Address (Optional)\')}}',
    '{{__(\'মোবাইল নাম্বার\')}}' => '{{__(\'Phone Number\')}}',
    '{{__(\'ঠিকানা\')}}' => '{{__(\'Address\')}}',
    '{{__(\'জিপ কোড\')}}' => '{{__(\'Zip Code\')}}',
    '{{__(\'শহর\')}}' => '{{__(\'City\')}}',
    '{{__(\'দেশ\')}}' => '{{__(\'Country\')}}',
    '{{ __(' . "'দেশ'" . ') }}' => '{{ __(\'Country\') }}',
    '{{__(\'দেশ সিলেক্ট করুন\')}}' => '{{__(\'Select Country\')}}',
    'এটাই আমার বিলিং ঠিকানা' => 'Same as Billing Address',
    '{{__(\'কেনাকাটায় ফিরে যান\')}}' => '{{__(\'Back to Cart\')}}',
    '{{__(\'সামনে অগ্রসর হউন\')}}' => '{{__(\'Continue\')}}',
];
foreach ($replacements as $old => $new) {
    $billingContent = str_replace($old, $new, $billingContent);
}
file_put_contents($billingFile, $billingContent);
echo "Language fixed\n";
