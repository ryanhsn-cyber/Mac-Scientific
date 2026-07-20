<?php
// Security token to prevent unauthorized access
$secret = 'mac-scientific-deploy-token';

// Verify the token
if (!isset($_GET['token']) || $_GET['token'] !== $secret) {
    header('HTTP/1.0 403 Forbidden');
    die('Forbidden: Invalid token');
}

// Ensure exec() is allowed on the server
if (!function_exists('exec')) {
    die('Error: exec() function is disabled on this server. Deployment failed.');
}

$output = [];
$output[] = "Starting Deployment...";

// 1. Pull latest code from GitHub into the cPanel repository
exec('cd /home/dermatol/Mac-Scientific && git pull origin main 2>&1', $output);

// 2. Copy the updated files into the live public_html folder
exec('/bin/cp -af /home/dermatol/Mac-Scientific/source_code/. /home/dermatol/public_html/ 2>&1', $output);

// 3. Automatically run database migrations (just in case new tables/columns were added)
exec('cd /home/dermatol/public_html/core && php artisan migrate --force 2>&1', $output);

// Print the result logs
echo "<pre>";
print_r($output);
echo "</pre>";
echo "<h3>Deployment Finished!</h3>";
?>
