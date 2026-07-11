<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$item = \App\Models\Item::where('slug', 'PRP-Tube--ACD---Gel---Biotin--12ml')->first();
if ($item) {
    echo $item->details;
} else {
    echo "Item not found";
}
