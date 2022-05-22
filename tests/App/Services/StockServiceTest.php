<?php

namespace Tests\App\Service;

use App\Services\StockServiceInterface;
use GuzzleHttp\Client;
use Tests\TestCase;
use Mockery;


class StockServiceTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->stockService = $this->app->make(StockServiceInterface::class);
        $this->client = new Client([
            'verify' => false,
            'follow_redirects' => TRUE
        ]);
    }

    public function testGetCompanyHistoricalDataSuccess()
    {
        $response = $this->stockService->getCompanyHistoricalData("TEST");
        $this->assertIsArray($response);
        $this->assertArrayHasKey('isPending', $response);
    }
}
