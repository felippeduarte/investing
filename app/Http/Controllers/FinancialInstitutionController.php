<?php

namespace App\Http\Controllers;

use App\FinancialInstitution;
use App\Services\FinancialInstitutionService;
use Illuminate\Http\Request;
use App\Http\Requests\FinancialInstitutionRequest;

class FinancialInstitutionController extends Controller
{
    public function __construct(FinancialInstitutionService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return parent::_index($request);
    }

    public function store(FinancialInstitutionRequest $request)
    {
        return parent::_store($request);
    }

    public function show(Request $request, FinancialInstitution $financialInstitution)
    {
        return parent::_show($request, $financialInstitution);
    }

    public function update(FinancialInstitutionRequest $request, FinancialInstitution $financialInstitution)
    {
        return parent::_update($request, $financialInstitution);
    }

    public function destroy(FinancialInstitution $financialInstitution)
    {
        return parent::_destroy($financialInstitution);
    }
}
