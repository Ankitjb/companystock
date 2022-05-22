<?php

namespace Tests\App\Service;

use App\Services\CompanyServiceInterface;
use Tests\TestCase;
use Mockery;


class CompanyServiceTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->companyService = $this->app->make(CompanyServiceInterface::class);
    }

    public function testGetSymbolDataSuccess()
    {
        $response = $this->companyService->getSymbolData();
        $this->assertIsArray($response);
        $this->assertArrayHasKey('Symbol', $response[0]);
    }
}
