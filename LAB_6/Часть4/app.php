<?php
require_once 'ApiClient.php';

//Basic Auth
$basicAuthClient = new ApiClient('https://httpbin.org', [
    'auth_basic' => [
        'username' => 'user',
        'password' => 'pass'
    ]
]);

echo "Testing Basic Auth GET:\n";
$response = $basicAuthClient->get('/basic-auth/user/pass');
print_r($response);

echo "\nTesting POST with data:\n";
$response = $basicAuthClient->post('/anything', [
    'title' => 'Hello',
    'body' => 'World'
]);
print_r($response);

//Token Auth
$tokenAuthClient = new ApiClient('https://api.example.com', [
    'auth_token' => 'your-api-token-here'
]);

//Дополнительные параметры
$customClient = new ApiClient('https://api.example.com');
$customClient->setTokenAuth('custom-token');
$customClient->setHeader('X-Custom-Header', 'value');
$customClient->setCurlOption(CURLOPT_TIMEOUT, 60);

//query параметры
$response = $customClient->get('/search', ['q' => 'php', 'page' => 1]);
print_r($response);
?>