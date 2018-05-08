<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\FinancialInstitution;

class FinancialInstititutionTest extends TestCase
{
    public function testIndex()
    {
        $numElements = 3;
        $f = factory(FinancialInstitution::class, $numElements)->create();
        $service = app('App\Services\FinancialInstitutionService');
        $request = app('Illuminate\Http\Request');
        $actual = $service->index($request);
        $this->assertEquals($actual->count(), $numElements);
    }

    public function testIndexSortedPaginated()
    {
        $numElements = 3;
        $f = factory(FinancialInstitution::class, $numElements)->create();
        $service = app('App\Services\FinancialInstitutionService');
        $request = app('Illuminate\Http\Request');
        $params = [
            'sort' => 'id|asc',
            'per_page' => $numElements-1,
        ];
        $request->replace($params);
        $actual = $service->index($request);
        
        $this->assertEquals($actual->count(), $numElements-1);
        $this->assertEquals($actual[0]->id, $f[0]->id);
    }
}
