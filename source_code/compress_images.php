<?php
$dirs = ['assets/images', 'assets/images/galleries'];
$maxSize = 500 * 1024; // 500KB
$compressedCount = 0;

foreach ($dirs as $dir) {
    if (!is_dir($dir)) continue;
    $files = scandir($dir);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        if (is_file($path) && filesize($path) > $maxSize) {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if ($ext === 'jpg' || $ext === 'jpeg' || $ext === 'png') {
                compressImage($path, $path, 60);
                $compressedCount++;
                echo "Compressed: $path<br>";
            }
        }
    }
}

echo "Total compressed: $compressedCount";

function compressImage($source, $destination, $quality) {
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
        // Convert to true color to allow jpeg compression or use png compression
        // Actually for maximum compression let's just compress it as high quality JPEG but keep extension if we have to, 
        // wait, we can just save it as webp if webp is supported.
        if (function_exists('imagewebp')) {
            imagewebp($image, $destination, $quality);
            imagedestroy($image);
            return;
        }
    } else {
        return;
    }

    if ($info['mime'] == 'image/png') {
        imagepng($image, $destination, 6); // 0-9 for png
    } else {
        imagejpeg($image, $destination, $quality);
    }
    imagedestroy($image);
}
