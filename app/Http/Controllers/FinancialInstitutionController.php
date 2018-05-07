<?php

namespace App\Http\Controllers;

use App\FinancialInstitution;
use App\Services\FinancialInstitutionService;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinancialInstitution  $financialInstitution
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialInstitution $financialInstitution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FinancialInstitution  $financialInstitution
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialInstitution $financialInstitution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FinancialInstitution  $financialInstitution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinancialInstitution $financialInstitution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinancialInstitution  $financialInstitution
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialInstitution $financialInstitution)
    {
        //
    }
}
