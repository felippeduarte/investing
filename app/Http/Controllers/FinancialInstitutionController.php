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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return parent::_index($request);
    }

    public function store(FinancialInstitutionRequest $request)
    {
        return parent::_store($request);
    }

    public function show(FinancialInstitution $financialInstitution)
    {
        //
    }

    public function update(FinancialInstitutionRequest $request, FinancialInstitution $financialInstitution)
    {
        //
    }

    public function destroy(FinancialInstitution $financialInstitution)
    {
        //
    }
}
