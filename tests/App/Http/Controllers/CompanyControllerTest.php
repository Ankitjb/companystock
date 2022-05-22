<?php

namespace Tests\App\Http\Controllers;

use App\Mail\CompanyInfo;
use App\Services\CompanyServiceInterface;
use App\Services\MailServiceInterface;
use App\Services\StockServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Mockery;

class CompanyControllerTest extends TestCase
{
    protected function setUpMock()
    {
        $mock = Mockery::mock(CompanyServiceInterface::class);
        $this->app->instance(CompanyServiceInterface::class, $mock);
        $mock = Mockery::mock(StockServiceInterface::class);
        $this->app->instance(StockServiceInterface::class, $mock);
        $mock = Mockery::mock(MailServiceInterface::class);
        $this->app->instance(MailServiceInterface::class, $mock);
        return $mock;
    }

    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertSee("Company Stock");
        $response->assertStatus(200);
    }

    public function testCompanyFormSendEmpty()
    {
        $response = $this->get('/get-company-detail');
        $response->assertInvalid([
            'company_symbol' => 'The company symbol field is required.',
            'start_date' => 'The start date field is required.',
            'end_date' => 'The end date field is required.',
            'email' => 'The email field is required.',
        ]);
    }

    public function testCompanyFormSendInvalidCompanySymbol()
    {
        $startDate = carbon::now()->subDay(1)->format('Y-m-d');
        $endDate = carbon::now()->format('Y-m-d');
        $response = $this->get('/get-company-detail?company_symbol=AN23&start_date=' . $startDate . '&end_date=' . $endDate . '&email=test@test.com');
        $response->assertInvalid([
            'company_symbol' => 'The company symbol must only contain letters.'
        ]);
    }

    public function testCompanyFormSendInvalidEmail()
    {
        $startDate = carbon::now()->subDay(1)->format('Y-m-d');
        $endDate = carbon::now()->format('Y-m-d');
        $response = $this->get('/get-company-detail?company_symbol=ANA&start_date=' . $startDate . '&end_date=' . $endDate . '&email=test');
        $response->assertInvalid([
            'email' => 'The email must be a valid email address.'
        ]);
    }

    public function testCompanyFormSendStartDateGreaterThanEndDate()
    {
        $startDate = carbon::now()->format('Y-m-d');
        $endDate = carbon::now()->subDay(1)->format('Y-m-d');
        $response = $this->get('/get-company-detail?company_symbol=ANA&start_date=' . $startDate . '&end_date=' . $endDate . '&email=test@test.com');
        $response->assertInvalid([
            'end_date' => 'The end date must be a date after or equal to start date.'
        ]);
    }

    public function testCompanyFormSendEndDateGreaterThanCurrentDate()
    {
        $startDate = carbon::now()->format('Y-m-d');
        $endDate = carbon::now()->addDay(1)->format('Y-m-d');
        $response = $this->get('/get-company-detail?company_symbol=ANA&start_date=' . $startDate . '&end_date=' . $endDate . '&email=test@test.com');
        $response->assertInvalid([
            'end_date' => 'The end date must be a date before tomorrow.'
        ]);
    }

    public function testCompanyFormSendValidDataSuccess()
    {
        Mail::fake();
        $startDate = carbon::now()->format('Y-m-d');
        $endDate = carbon::now()->format('Y-m-d');
        $response = $this->get('/get-company-detail?company_name=ANAL-Co.&company_symbol=TEST&start_date=' . $startDate . '&end_date=' . $endDate . '&email=test@test.com');
        $response->assertOk();
    }

    public function testGetSymbolDataSuccess()
    {
        $response = $this->get("/get-company-symbol");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            [
                'Company Name',
                'Financial Status',
                'Market Category',
                "Round Lot Size",
                "Security Name",
                'Symbol',
                "Test Issue"
            ]
        ]);
    }
}
