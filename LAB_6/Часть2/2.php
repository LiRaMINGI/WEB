<?php
function makeHttpRequest($url, $method = 'GET', $requestData = null, $headers = []) {
    $curlHandle = curl_init($url);
    
    //cURL
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
    
    //запрос
    if ($method === 'POST') {
        curl_setopt($curlHandle, CURLOPT_POST, true);
    } elseif (in_array($method, ['PUT', 'DELETE', 'PATCH'])) {
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, $method);
    }

    //Обработка данных
    if ($requestData !== null) {
        if (is_array($requestData)) {
            $requestData = json_encode($requestData);
            $headers[] = 'Content-Type: application/json';
        }
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $requestData);
    }

    //кастомные заголовки
    if (!empty($headers)) {
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $headers);
    }

    //обработка ошибок
    $response = curl_exec($curlHandle);
    
    if ($response === false) {
        $response = 'Curl error: ' . curl_error($curlHandle);
    }
    
    curl_close($curlHandle);
    return $response;
}

//кастомные заголовки
echo "Custom Headers:\n";
echo makeHttpRequest('https://jsonplaceholder.typicode.com/posts/1', 'GET', null, [
    'X-Custom-Header: HelloWorld',
    'User-Agent: MySimpleClient'
]) . "\n\n";

//JSON данные (POST)
echo "Send JSON:\n";
echo makeHttpRequest('https://jsonplaceholder.typicode.com/posts', 'POST', [
    'title' => 'IT IS JSOOON',
    'body' => 'WIP JSON',
    'userId' => 15
]) . "\n\n";

//параметрs в URL
$params = http_build_query(['userId' => 1]);
echo "GET with URL Params:\n";
echo makeHttpRequest("https://jsonplaceholder.typicode.com/posts?$params") . "\n\n";