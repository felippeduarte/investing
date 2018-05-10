<?php

namespace App\Http\Controllers;

use App\IndexRate;
use App\Services\IndexRateService;
use Illuminate\Http\Request;
use App\Http\Requests\IndexRateRequest;

class IndexRateController extends Controller
{
    public function __construct(IndexRateService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        return parent::_index($request);
    }

    public function store(IndexRateRequest $request)
    {
        return parent::_store($request);
    }

    public function show(Request $request, IndexRate $indexRate)
    {
        return parent::_show($request, $indexRate);
    }

    public function update(IndexRateRequest $request, IndexRate $indexRate)
    {
        return parent::_update($request, $indexRate);
    }

    public function destroy(IndexRate $indexRate)
    {
        return parent::_destroy($indexRate);
    }
}
