<?php

namespace Tests\App\Service;

use App\Mail\CompanyInfo;
use App\Services\MailServiceInterface;
use Tests\TestCase;
use Mockery;


class MailServiceTest extends TestCase {

    protected function setUp(): void
    {
        parent::setUp();
        $this->mailService = $this->app->make(MailServiceInterface::class);
    }

    public function testSendCompanyInfoSuccess(){
        $data['company_name'] = 'test.com';
        $data['email'] = 'test@test.com';
        $data['start_date'] = '2022-04-21';
        $data['end_date'] = '2022-05-22';

        $mailable = new CompanyInfo($data);
        $mailable->to($data['email']);
        $mailable->subject($data['company_name']);
        $mailable->assertSeeInHtml($data['start_date']);
        $mailable->assertSeeInText($data['end_date']);
    }
}
