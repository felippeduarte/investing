<?php

namespace App\Http\Controllers;

use App\InvestmentProduct;
use App\Services\InvestmentProductService;
use Illuminate\Http\Request;
use App\Http\Requests\InvestmentProductRequest;

class InvestmentProductController extends Controller
{
    public function __construct(InvestmentProductService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return parent::_index($request);
    }

    public function store(InvestmentProductRequest $request)
    {
        return parent::_store($request);
    }

    public function show(Request $request, InvestmentProduct $investmentProduct)
    {
        return parent::_show($request, $investmentProduct);
    }

    public function update(InvestmentProductRequest $request, InvestmentProduct $investmentProduct)
    {
        return parent::_update($request, $investmentProduct);
    }

    public function destroy(InvestmentProduct $investmentProduct)
    {
        return parent::_destroy($investmentProduct);
    }
}
