<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Services\ApiData\CryptoApiService;


class CoinsController extends BaseController
{
    protected $apiService;
 
    public function __construct(CryptoApiService $apiService)
    {
        $this->apiService = $apiService;
    }
 
    public function getTrendingCoins()
    {
        $response = $this->apiService->fetchTrendingCoins();
 
        // Process the API response and return the desired result
    }

    public function getCoinByID()
    {
        $response = $this->apiService->fetchTrendingCoins($currency = "usd")();
 
        // Process the API response and return the desired result
    }

    public function getHistoricalData()
    {
        $response = $this->apiService->fetchHistoricalData($id, $currency ="usd", $days );
 
        // Process the API response and return the desired result
    }

    public function getAllCoinsData()
    {
        $response = $this->apiService->fetchAllCoins();
 
        // Process the API response and return the desired result
    }
}
