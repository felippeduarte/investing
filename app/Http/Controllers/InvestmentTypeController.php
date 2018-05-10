<?php

namespace App\Http\Controllers;

use App\InvestmentType;
use App\Services\InvestmentTypeService;
use Illuminate\Http\Request;
use App\Http\Requests\InvestmentTypeRequest;

class InvestmentTypeController extends Controller
{
    public function __construct(InvestmentTypeService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        return parent::_index($request);
    }

    public function store(InvestmentTypeRequest $request)
    {
        return parent::_store($request);
    }

    public function show(Request $request, InvestmentType $investmentType)
    {
        return parent::_show($request, $investmentType);
    }

    public function update(InvestmentTypeRequest $request, InvestmentType $investmentType)
    {
        return parent::_update($request, $investmentType);
    }

    public function destroy(InvestmentType $investmentType)
    {
        return parent::_destroy($investmentType);
    }
}
