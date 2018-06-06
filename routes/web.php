<?php

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

Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

$except = ['except' => ['create','edit']];
Route::resource('financialInstitution', 'FinancialInstitutionController', $except);
Route::prefix('admin')->middleware('auth')->group(function() use($except) {
    Route::resource('financialInstitution', 'FinancialInstitutionController', $except);
    Route::resource('financialInstitutionType', 'FinancialInstitutionTypeController', $except);
    Route::resource('index', 'IndexController', $except);
    Route::resource('indexRate', 'IndexRateController', $except);
    Route::resource('investmentProduct', 'InvestmentProductController', $except);
    Route::resource('investmentReturn', 'InvestmentReturnController', $except);
    Route::resource('investmentType', 'InvestmentTypeController', $except);
    Route::resource('period', 'PeriodController', $except);
    Route::resource('riskLevel', 'RiskLevelController', $except);
    Route::resource('user', 'UserController', $except);
});

Route::get('/{any}', 'HomeController@index')->where('any', '.*');