<?php
namespace App\Services;

interface StockServiceInterface {
    public function getCompanyHistoricalData(string $symbol):array;
}
