<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ms-bd.com/admin/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
$response = curl_exec($ch);
preg_match('/name="_token" value="(.*?)"/', $response, $matches);
$token = $matches[1];
preg_match('/laravel_session=(.*?);/', $response, $session_matches);
$cookie = 'laravel_session=' . $session_matches[1];

curl_setopt($ch, CURLOPT_URL, 'https://ms-bd.com/admin/login/submit');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    '_token' => $token,
    'login_email' => 'admin@macscientific.com',
    'login_password' => '12345678'
]));
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
$response = curl_exec($ch);

// Follow redirect if there is one to get the new session cookie
preg_match('/laravel_session=(.*?);/', $response, $session_matches);
if (isset($session_matches[1])) {
    $cookie = 'laravel_session=' . $session_matches[1];
}

// Now get home page
curl_setopt($ch, CURLOPT_URL, 'https://ms-bd.com/admin/home-page');
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
$response = curl_exec($ch);
preg_match('/name="_token" value="(.*?)"/', $response, $matches);
$token = $matches[1];

if (empty($token)) {
    echo "Login failed. Could not get token from home-page.\n";
    exit(1);
}

// Make a fake png
file_put_contents('test.png', base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg=='));

$cfile = new CURLFile(realpath('test.png'), 'image/png', 'test.png');
$data = array('_token' => $token, 'highlight_banner' => $cfile);

curl_setopt($ch, CURLOPT_URL, 'https://ms-bd.com/admin/home-page/highlight/banner/update');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
$response = curl_exec($ch);

// print only the div with alert
if (preg_match_all('/<div class="alert[^>]*>(.*?)<\/div>/s', $response, $alerts)) {
    print_r($alerts[1]);
} else {
    echo "No alerts found.\n";
}
?>
