<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyFormRequest;
use App\Services\CompanyServiceInterface;
use App\Services\MailServiceInterface;
use App\Services\StockServiceInterface;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @var CompanyServiceInterface
     */
    private $companyService;
    /**
     * @var StockServiceInterface
     */
    private $stockService;
    /**
     * @var MailServiceInterface
     */
    private $mailService;

    public function __construct(CompanyServiceInterface $companyService, StockServiceInterface $stockService, MailServiceInterface $mailService)
    {
        $this->companyService = $companyService;
        $this->stockService = $stockService;
        $this->mailService = $mailService;
    }

    /**
     * This function use to display company form view.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('company.index');
    }

    /**
     * This function use to get company details like stocks(historical-data) and send mail at submitted email-address.
     * @param CompanyFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompanyDetail(CompanyFormRequest $request)
    {
        $resp = $this->stockService->getCompanyHistoricalData($request->input('company_symbol'));
        $this->mailService->sendCompanyInfo($request->all());
        return response()->json($resp,200);
    }

    /**
     * This function use to get all company's symbol data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompanySymbol()
    {
        $data = $this->companyService->getSymbolData();
        return response()->json($data,200);
    }
}
