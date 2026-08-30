<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$destDir = base_path('../assets/images');
$pngPath = $destDir . '/featured-banner.png';
$webpPath = $destDir . '/featured-banner.webp';

try {
    $img = \Image::make($pngPath);
    echo "Image loaded successfully.\n";
    $img->encode('webp', 90);
    echo "Image encoded to WebP successfully.\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
