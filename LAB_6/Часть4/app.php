<?php
require_once 'ApiClient.php';

try {
    // Создаем клиент с Basic Auth (SSL проверка отключена для тестов)
    $client = new ApiClient('https://httpbin.org', [
        'auth_basic' => [
            'username' => 'user',
            'password' => 'pass'
        ],
        'verify_ssl' => false // Только для тестирования!
    ]);

    // Тестируем GET запрос с Basic Auth
    echo "Testing Basic Auth GET:\n";
    $response = $client->get('/basic-auth/user/pass');
    print_r($response);

    // Тестируем POST запрос
    echo "\nTesting POST with data:\n";
    $response = $client->post('/anything', [
        'title' => 'Hello',
        'body' => 'World'
    ]);
    print_r($response);

    // Тестируем GET с query параметрами
    echo "\nTesting GET with query params:\n";
    $response = $client->get('/get', ['param1' => 'value1', 'param2' => 'value2']);
    print_r($response);

} catch (ApiClientException $e) {
    echo "API Error: " . $e->getMessage();
}
?>