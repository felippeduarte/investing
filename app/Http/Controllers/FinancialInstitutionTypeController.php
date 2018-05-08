<?php

namespace App\Http\Controllers;

use App\FinancialInstitutionType;
use App\Services\FinancialInstitutionTypeService;
use Illuminate\Http\Request;
use App\Http\Requests\FinancialInstitutionTypeRequest;

class FinancialInstitutionTypeController extends Controller
{
    public function __construct(FinancialInstitutionTypeService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        return parent::_index($request);
    }

    public function store(FinancialInstitutionTypeRequest $request)
    {
        return parent::_store($request);
    }

    public function show(Request $request, FinancialInstitutionType $financialInstitutionType)
    {
        return parent::_show($request, $financialInstitutionType);
    }

    public function update(FinancialInstitutionTypeRequest $request, FinancialInstitutionType $financialInstitutionType)
    {
        return parent::_update($request, $financialInstitutionType);
    }

    public function destroy(FinancialInstitutionType $financialInstitutionType)
    {
        return parent::_destroy($financialInstitutionType);
    }
}
