<?php

namespace App\Services;

use App\Mail\CompanyInfo;
use Exception;
use Illuminate\Support\Facades\Mail;

class MailService implements MailServiceInterface
{
    public function __construct()
    {

    }

    /**
     * This function use to send mail about company information which submitted.
     * @param $data
     * @return void
     */
    public function sendCompanyInfo(array $data)
    {
        try{
            Mail::to($data['email'])->send(new CompanyInfo($data));
        }catch (Exception $e){
             report($e);
        }
    }
}
