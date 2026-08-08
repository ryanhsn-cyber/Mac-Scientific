<?php
$secret = 'mac-scientific-deploy-token';
if (!isset($_GET['token']) || $_GET['token'] !== $secret) {
    header('HTTP/1.0 403 Forbidden');
    die('Forbidden: Invalid token');
}
require __DIR__.'/core/vendor/autoload.php';
$app = require_once __DIR__.'/core/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$kernel->handle($request);

try {
    $sqlFile = __DIR__ . '/../dermatol_shop.sql';

    if (file_exists($sqlFile)) {
        $sql = file_get_contents($sqlFile);
        // Remove UTF-8 BOM if present
        $sql = preg_replace('/^\xEF\xBB\xBF/', '', $sql);
        \Illuminate\Support\Facades\Artisan::call('db:wipe', ['--force' => true]);
        \Illuminate\Support\Facades\DB::unprepared($sql);
        echo "Database imported successfully from " . basename($sqlFile) . "!";
    } else {
        echo "Error: Could not find any SQL file to import.";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
