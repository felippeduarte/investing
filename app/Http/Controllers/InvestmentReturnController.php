<?php

namespace App\Http\Controllers;

use App\InvestmentReturn;
use App\Services\InvestmentReturnService;
use Illuminate\Http\Request;
use App\Http\Requests\InvestmentReturnRequest;

class InvestmentReturnController extends Controller
{
    public function __construct(InvestmentReturnService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return parent::_index($request);
    }

    public function store(InvestmentReturnRequest $request)
    {
        return parent::_store($request);
    }

    public function show(Request $request, InvestmentReturn $investmentReturn)
    {
        return parent::_show($request, $investmentReturn);
    }

    public function update(InvestmentReturnRequest $request, InvestmentReturn $investmentReturn)
    {
        return parent::_update($request, $investmentReturn);
    }

    public function destroy(InvestmentReturn $investmentReturn)
    {
        return parent::_destroy($investmentReturn);
    }
}
