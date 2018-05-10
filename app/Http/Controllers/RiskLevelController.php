<?php

namespace App\Http\Controllers;

use App\RiskLevel;
use App\Services\RiskLevelService;
use Illuminate\Http\Request;
use App\Http\Requests\RiskLevelRequest;

class RiskLevelController extends Controller
{
    public function __construct(RiskLevelService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        return parent::_index($request);
    }

    public function store(RiskLevelRequest $request)
    {
        return parent::_store($request);
    }

    public function show(Request $request, RiskLevel $riskLevel)
    {
        return parent::_show($request, $riskLevel);
    }

    public function update(RiskLevelRequest $request, RiskLevel $riskLevel)
    {
        return parent::_update($request, $riskLevel);
    }

    public function destroy(RiskLevel $riskLevel)
    {
        return parent::_destroy($riskLevel);
    }
}
