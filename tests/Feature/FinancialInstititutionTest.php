<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\FinancialInstitution;

class FinancialInstititutionTest extends TestCase
{
    use WithFaker;

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

    public function testStore()
    {
        $params = [
            'full_name' => $this->faker()->company,
            'short_name' => $this->faker()->word,
            'financial_institution_type_id' => factory(\App\FinancialInstitutionType::class)->create()->id,
        ];
        
        $response = $this->post('/api/financialInstitution', $params);

        $response->assertStatus(201);
        $response->assertJsonFragment($params);
    }

    public function testStoreMissingParameter()
    {
        $baseParams = [
            'full_name' => $this->faker()->company,
            'short_name' => $this->faker()->word,
            'financial_institution_type_id' => factory(\App\FinancialInstitutionType::class)->create()->id,
        ];
        
        $params = $baseParams;
        unset($params['full_name']);
        $response = $this->json('POST', '/api/financialInstitution', $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['short_name']);
        $response = $this->json('POST', '/api/financialInstitution', $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['financial_institution_type_id']);
        $response = $this->json('POST', '/api/financialInstitution', $params);
        $response->assertStatus(422);
    }
}
