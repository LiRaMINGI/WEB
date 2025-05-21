<?php

function getRequestWithHeaders(string $url, array $headers = []): string|false
{
    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPGET => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HTTPHEADER => $headers,
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Ошибка cURL: ' . curl_error($ch);
        curl_close($ch);
        return false;
    }

    curl_close($ch);
    return $response;
}

function postJsonData(string $url, array $data, array $headers = []): string|false
{
    $jsonData = json_encode($data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Content-Length: ' . strlen($jsonData);

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => $headers,
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Ошибка cURL: ' . curl_error($ch);
        curl_close($ch);
        return false;
    }

    curl_close($ch);
    return $response;
}

function getRequestWithParams(string $baseUrl, array $params): string|false
{
    $query = http_build_query($params);
    $urlWithParams = $baseUrl . '?' . $query;

    return getRequestWithHeaders($urlWithParams);
}


//Пример 1
$response1 = getRequestWithHeaders('https://jsonplaceholder.typicode.com/posts', [
    'Accept: application/json',
    'User-Agent: MyCustomClient/1.0',
]);

$data = json_decode($response1, true);
$limitedData = array_slice($data, 0, 3); // ← включено по твоей просьбе

foreach ($limitedData as $item) {
    echo "ID: {$item['id']}, Title: " . mb_substr($item['title'], 0, 20) . ", Body: " . mb_substr($item['body'], 0, 30) . "\n";
}


//Пример 2:
$response2 = postJsonData('https://jsonplaceholder.typicode.com/posts', [
    'title' => 'foo',
    'body' => 'bar',
    'userId' => 1
]);

print_r(json_decode($response2, true));


//Пример 3
$response3 = getRequestWithParams('https://jsonplaceholder.typicode.com/posts', [
    'userId' => 1
]);

$data3 = json_decode($response3, true);
$limitedData3 = array_slice($data3, 0, 3);

foreach ($limitedData3 as $item) {
    echo "ID: {$item['id']}, Title: " . mb_substr($item['title'], 0, 20) . ", Body: " . mb_substr($item['body'], 0, 30) . "\n";
}
