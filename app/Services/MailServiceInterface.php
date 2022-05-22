<?php
namespace App\Services;

interface MailServiceInterface {
    public function sendCompanyInfo(array $data);
}
