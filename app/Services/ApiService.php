<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;

class ApiService
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config(env('API_BASE_URL'));
    }

    protected function getHeaders()
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        if (Session::has('api_token')) {
            $headers['Authorization'] = 'Bearer ' . Session::get('api_token');
        }

        return $headers;
    }

    public function login($credentials)
    {
        try {
            $response = $this->client->post($this->baseUrl . '/login', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $credentials
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return [
                'success' => false,
                'message' => 'Login failed: ' . $e->getMessage()
            ];
        }
    }

    public function get($endpoint)
    {
        try {
            $response = $this->client->get($this->baseUrl . $endpoint, [
                'headers' => $this->getHeaders()
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return [
                'success' => false,
                'message' => 'Request failed: ' . $e->getMessage()
            ];
        }
    }

    public function post($endpoint, $data)
    {
        try {
            $response = $this->client->post($this->baseUrl . $endpoint, [
                'headers' => $this->getHeaders(),
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return [
                'success' => false,
                'message' => 'Request failed: ' . $e->getMessage()
            ];
        }
    }

    public function put($endpoint, $data)
    {
        try {
            $response = $this->client->put($this->baseUrl . $endpoint, [
                'headers' => $this->getHeaders(),
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return [
                'success' => false,
                'message' => 'Request failed: ' . $e->getMessage()
            ];
        }
    }

    public function delete($endpoint)
    {
        try {
            $response = $this->client->delete($this->baseUrl . $endpoint, [
                'headers' => $this->getHeaders()
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return [
                'success' => false,
                'message' => 'Request failed: ' . $e->getMessage()
            ];
        }
    }
}
