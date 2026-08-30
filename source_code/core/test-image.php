<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$destDir = base_path('../assets/images');
$pngPath = $destDir . '/featured-banner-test.png';

$file = new \Illuminate\Http\UploadedFile(
    base_path('../assets/images/featured-banner.png'),
    'featured-banner.png',
    'image/png',
    null,
    true
);

try {
    $img = \Image::make($file);
    $img->encode('png')->save($pngPath);
    echo "Success!\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
