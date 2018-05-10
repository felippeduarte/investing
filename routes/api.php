<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('financialInstitution', 'FinancialInstitutionController');
Route::resource('financialInstitutionType', 'FinancialInstitutionTypeController');
Route::resource('index', 'IndexController');
Route::resource('indexRate', 'IndexRateController');
Route::resource('period', 'PeriodController');
Route::resource('riskLevel', 'RiskLevelController');