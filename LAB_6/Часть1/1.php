<?php
function makeHttpRequest($url, $method = 'GET', $requestData = null) {
    $curlHandle = curl_init($url);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false); // Отключаем проверку SSL для тестов
    
    if ($method === 'POST') {
        curl_setopt($curlHandle, CURLOPT_POST, true);
    } elseif (in_array($method, ['PUT', 'DELETE'])) {
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, $method);
    }

    if ($requestData !== null) {
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, json_encode($requestData));
    }

    $response = curl_exec($curlHandle);
    
    if ($response === false) {
        $response = 'Curl error: ' . curl_error($curlHandle);
    }
    
    curl_close($curlHandle);
    return $response;
}

// Тестовые запросы
echo "GET:\n" . makeHttpRequest('https://jsonplaceholder.typicode.com/posts/1') . "\n\n";
echo "POST:\n" . makeHttpRequest('https://jsonplaceholder.typicode.com/posts', 'POST', ['title' => 'BOB', 'body' => 'TEACHER', 'userId' => 1]) . "\n\n";
echo "PUT:\n" . makeHttpRequest('https://jsonplaceholder.typicode.com/posts/1', 'PUT', ['id' => 1, 'title' => 'MARY', 'DRIVER' => '', 'userId' => 1]) . "\n\n";
echo "DELETE:\n" . makeHttpRequest('https://jsonplaceholder.typicode.com/posts/1', 'DELETE') . "\n\n";
?>