<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YaxApiService
{
    public function __construct(
        protected string $baseUrl = '',
        protected string $apiToken = ''
    ) {
        $this->setBaseUrl($baseUrl);
        $this->setApiToken($apiToken);
    }

    /**
     * @param array $query - query parameters see: https://integrations.yaxint.com/docs/#fetching-products
     * @return object|null - object containing products | null if error occurs
     */
    public function getProducts(array $query = []): ?object
    {
        $query['api_token'] = $this->getApiToken();
        $products = Http::get($this->getBaseUrl() . 'products', $query);

        if ($products->ok()) {
            return $products->object();
        }
        else {
            return null;
        }
    }

    /**
     * @return string
     */
    protected function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    protected function setBaseUrl(string $baseUrl): void
    {
        if ($baseUrl === '') {
            $this->baseUrl = config('yax.api_base_url');
        }
        else {
            $this->baseUrl = $baseUrl;
        }
    }

    /**
     * @return string
     */
    protected function getApiToken(): string
    {
        return $this->apiToken;
    }

    /**
     * @param string $apiToken
     */
    protected function setApiToken(string $apiToken): void
    {
        if ($apiToken === '') {
            $this->apiToken = config('yax.api_token');
        }
        else {
            $this->apiToken = $apiToken;
        }
    }
}