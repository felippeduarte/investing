<?php

namespace App\Http\Controllers;

use App\Period;
use App\Services\PeriodService;
use Illuminate\Http\Request;
use App\Http\Requests\PeriodRequest;

class PeriodController extends Controller
{
    public function __construct(PeriodService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        return parent::_index($request);
    }

    public function store(PeriodRequest $request)
    {
        return parent::_store($request);
    }

    public function show(Request $request, Period $period)
    {
        return parent::_show($request, $period);
    }

    public function update(PeriodRequest $request, Period $period)
    {
        return parent::_update($request, $period);
    }

    public function destroy(Period $period)
    {
        return parent::_destroy($period);
    }
}
