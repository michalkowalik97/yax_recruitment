<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YaxApiService
{
    public function __construct(
        private string $baseUrl = '',
        private string $apiToken = ''
    ) {
        $this->setBaseUrl($baseUrl);
        $this->setApiToken($apiToken);
    }

    public function getProducts(array $query = []): ?object
    {
        $products = Http::get($this->getBaseUrl() . 'products', $query);

        if ($products->ok()){
            return $products->object();
        }else{
            return null;
        }
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl(string $baseUrl): void
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
    public function getApiToken(): string
    {
        return 'api_token=' . $this->apiToken;
    }

    /**
     * @param string $apiToken
     */
    public function setApiToken(string $apiToken): void
    {
        if ($apiToken === '') {
            $this->apiToken = config('yax.api_token');
        }
        else {
            $this->apiToken = $apiToken;
        }
    }

}