<?php

namespace App\Http\Controllers;

use App\Index;
use App\Services\IndexService;
use Illuminate\Http\Request;
use App\Http\Requests\IndexRequest;

class IndexController extends Controller
{
    public function __construct(IndexService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        return parent::_index($request);
    }

    public function store(IndexRequest $request)
    {
        return parent::_store($request);
    }

    public function show(Request $request, Index $index)
    {
        return parent::_show($request, $index);
    }

    public function update(IndexRequest $request, Index $index)
    {
        return parent::_update($request, $index);
    }

    public function destroy(Index $index)
    {
        return parent::_destroy($index);
    }
}
