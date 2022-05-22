<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[Controllers\CompanyController::class,'index']);
Route::get('/get-company-detail',[Controllers\CompanyController::class,'getCompanyDetail'])->name("get.company.detail");
Route::get('/get-company-symbol',[Controllers\CompanyController::class,'getCompanySymbol'])->name("get.company.symbol");
