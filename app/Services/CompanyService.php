<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class CompanyService implements CompanyServiceInterface
{
    const COMPANY_SYMBOL_URL = "https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json";

    /**
     * @property Client $client
     */

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false,
            'follow_redirects' => TRUE
        ]);
    }

    /**
     * This function use to get all company's symbol data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSymbolData(): array
    {
        try {
            $response = $this->client->request("GET", self::COMPANY_SYMBOL_URL);
            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }
        } catch (ClientException $e) {
            report($e);
        }
        return [];
    }
}
