<?php

namespace App\Services\ApiData;

use GuzzleHttp\Client;

class CryptoApiService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchTrendingCoins($currency = "usd")
    {
        $response = $this->client->get("https://api.coingecko.com/api/v3/coins/markets?vs_currency=#{currency}&order=gecko_desc&per_page=10&page=1&sparkline=false&price_change_percentage=24h");
 
        return $response->getBody()->getContents();
    }

    public function fetchAllCoins($currency = "usd")
    {
        $response = $this->client->get("https://api.coingecko.com/api/v3/coins/markets?vs_currency=#{currency}&order=market_cap_desc&per_page=100&page=1&sparkline=false");
 
        return $response->getBody()->getContents();
    }


    public function fetchHistoricalData($id, $currency ="usd", $days )
    {
        $response = $this->client->get("https://api.coingecko.com/api/v3/coins/{$id}/market_chart?vs_currency={$currency}&days={$days}");
 
        return $response->getBody()->getContents();
    }

    public function fetchSingleCoin($id)
    {
        $response = $this->client->get("https://api.coingecko.com/api/v3/coins/{$id}");
 
        return $response->getBody()->getContents();
    }
}
