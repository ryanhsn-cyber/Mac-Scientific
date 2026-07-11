<?php
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$app->make("Illuminate\Contracts\Console\Kernel")->bootstrap();
$items = \App\Models\Item::orderBy("id", "desc")->take(3)->get(["id", "features"]);
foreach($items as $item) {
    echo $item->id . " => " . $item->features . "\n";
}
