<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class StockService implements StockServiceInterface
{
    const REPID_API_VERSION = "v3";

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false,
            'follow_redirects' => TRUE
        ]);
    }

    /**
     * This function use to get company-stock's historical data from repid API.
     * @param string $symbol
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyHistoricalData(string $symbol = ""): array
    {
        if(empty($symbol)){
            return [];
        }

        try {
            $url = getenv('REPID_API_URL') ."/stock/". self::REPID_API_VERSION ."/get-historical-data?symbol=".$symbol."&region=".getenv('REGION');
            $response = $this->client->request("GET", $url, ['headers' => [
                    "X-RapidAPI-Host" => getenv("REPID_API_HOST"),
                    "X-RapidAPI-Key" => getenv("REPID_API_KEY")
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                return  json_decode($response->getBody(),true);
            }
        } catch (ClientException $e) {
            report($e);
        }
        return [];
    }
}
