<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\FinancialInstitution;

class FinancialInstititutionTest extends TestCase
{
    public function testIndex()
    {
        $f = factory(FinancialInstitution::class, 5)->create();
        $response = $this->get('/api/financialInstitution');
        $response->assertStatus(200);

        $response->assertJsonFragment($f[0]->toArray());
    }

    public function testIndexSortedPaginated()
    {
        $f = factory(FinancialInstitution::class, 5)->create();
        $per_page = 2;
        $response = $this->get('/api/financialInstitution?sort=id%7Casc&per_page='.$per_page);
        $response->assertStatus(200);
        $response->assertJsonCount($per_page, 'data');
        $response->assertJsonFragment($f[0]->toArray());
        $response->assertJsonMissing(['id' => $f[2]->id]);
    }
}
