<?php
function makeHttpRequest($url, $method = 'GET', $requestData = null, $headers = []) {
    $curlHandle = curl_init($url);
    
    // Базовые настройки cURL
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlHandle, CURLOPT_HEADER, false);
    curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false); // Для тестов
    
    // Настройка метода запроса
    if ($method === 'POST') {
        curl_setopt($curlHandle, CURLOPT_POST, true);
    } elseif (in_array($method, ['PUT', 'DELETE'])) {
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, $method);
    }

    // Обработка данных запроса
    if ($requestData !== null) {
        if (is_array($requestData)) {
            $requestData = json_encode($requestData);
            $headers[] = 'Content-Type: application/json';
        }
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $requestData);
    }

    // Добавление кастомных заголовков
    if (!empty($headers)) {
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $headers);
    }

    // Выполнение запроса
    $response = curl_exec($curlHandle);
    $error = curl_error($curlHandle);
    $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
    
    curl_close($curlHandle);
    
    return [
        'response' => $response,
        'error' => $error,
        'http_code' => $httpCode
    ];
}

function processRequest($url, $method = 'GET', $data = null, $headers = []) {
    $result = makeHttpRequest($url, $method, $data, $headers);
    
    if ($result['error']) {
        echo "Ошибка запроса: {$result['error']}\n";
    } elseif ($result['http_code'] >= 400) {
        echo "HTTP ошибка {$result['http_code']}\nОтвет:\n{$result['response']}\n";
    } else {
        echo "Успешно (HTTP {$result['http_code']})\n";
        $decodedData = json_decode($result['response'], true);
        print_r($decodedData);
    }
    
    echo "\n\n";
}

// Примеры использования
echo "Успешный GET:\n";
processRequest('https://jsonplaceholder.typicode.com/posts/1');

echo "Ошибка 404:\n";
processRequest('https://jsonplaceholder.typicode.com/posts/999999');

echo "Ошибка curl:\n";
processRequest('https://bad.domain.test');