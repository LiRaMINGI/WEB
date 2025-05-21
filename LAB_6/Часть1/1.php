<?php
function request($url, $method = 'GET', $data = null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
    } elseif (in_array($method, ['PUT', 'DELETE'])) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    }

    if ($data !== null) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if ($response === false) {
        echo "cURL Error: " . curl_error($ch);
        return null;
    }

    curl_close($ch);
    return json_decode($response, true); // Возвращает массив
}

// Примеры запросов
echo "GET:\n";
print_r(request('https://jsonplaceholder.typicode.com/posts/1'));

echo "\nPOST:\n";
print_r(request('https://jsonplaceholder.typicode.com/posts', 'POST', [
    'title' => 'Welcome!',
    'body' => 'Nice to see you',
    'userId' => 1
]));

echo "\nPUT:\n";
print_r(request('https://jsonplaceholder.typicode.com/posts/1', 'PUT', [
    'id' => 1,
    'title' => 'New update',
    'body' => 'It was edited',
    'userId' => 1
]));

echo "\nDELETE:\n";
print_r(request('https://jsonplaceholder.typicode.com/posts/1', 'DELETE'));
?>