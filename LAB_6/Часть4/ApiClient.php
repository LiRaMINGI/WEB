<?php
declare(strict_types=1);

class ApiClient {
    private string $baseUrl;
    private array $defaultHeaders = [];
    private array $curlOptions = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FAILONERROR => false,
        CURLOPT_TIMEOUT => 30,
    ];

    public function __construct(string $baseUrl, array $options = []) {
        $this->baseUrl = rtrim($baseUrl, '/');
        
        if (isset($options['auth_basic'])) {
            $this->setBasicAuth($options['auth_basic']['username'], $options['auth_basic']['password']);
        }
        
        if (isset($options['auth_token'])) {
            $this->setTokenAuth($options['auth_token']);
        }
        
        $this->defaultHeaders['Content-Type'] = 'application/json';
        $this->defaultHeaders['Accept'] = 'application/json';
    }

    public function setBasicAuth(string $username, string $password): void {
        $credentials = base64_encode("{$username}:{$password}");
        $this->defaultHeaders['Authorization'] = "Basic {$credentials}";
    }

    public function setTokenAuth(string $token): void {
        $this->defaultHeaders['Authorization'] = "Bearer {$token}";
    }

    public function setHeader(string $key, string $value): void {
        $this->defaultHeaders[$key] = $value;
    }

    public function setCurlOption(int $option, $value): void {
        $this->curlOptions[$option] = $value;
    }

    public function get(string $endpoint, array $queryParams = []): array {
        $url = $this->buildUrl($endpoint, $queryParams);
        return $this->request('GET', $url);
    }

    public function post(string $endpoint, array $data = [], array $queryParams = []): array {
        $url = $this->buildUrl($endpoint, $queryParams);
        return $this->request('POST', $url, $data);
    }

    public function put(string $endpoint, array $data = [], array $queryParams = []): array {
        $url = $this->buildUrl($endpoint, $queryParams);
        return $this->request('PUT', $url, $data);
    }

    public function patch(string $endpoint, array $data = [], array $queryParams = []): array {
        $url = $this->buildUrl($endpoint, $queryParams);
        return $this->request('PATCH', $url, $data);
    }

    public function delete(string $endpoint, array $queryParams = []): array {
        $url = $this->buildUrl($endpoint, $queryParams);
        return $this->request('DELETE', $url);
    }

    private function buildUrl(string $endpoint, array $queryParams = []): string {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        
        if (!empty($queryParams)) {
            $url .= '?' . http_build_query($queryParams);
        }
        
        return $url;
    }

    private function request(string $method, string $url, ?array $data = null): array {
        $ch = curl_init($url);

        $headers = [];
        foreach ($this->defaultHeaders as $key => $value) {
            $headers[] = "{$key}: {$value}";
        }

        $options = $this->curlOptions + [
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_HTTPHEADER => $headers,
        ];

        if ($data !== null) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) {
            throw new ApiClientException("cURL error: {$error}");
        }

        $decodedResponse = json_decode($response, true) ?? $response;

        return [
            'status' => $statusCode,
            'data' => $decodedResponse,
            'headers' => [], // Можно добавить извлечение заголовков ответа
        ];
    }
}

class ApiClientException extends \RuntimeException {}
?>