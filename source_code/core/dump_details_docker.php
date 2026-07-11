<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$details = \Illuminate\Support\Facades\DB::table('items')->where('slug', 'prpacdgelbiotin-12ml-rkYml')->value('details');
echo $details;
