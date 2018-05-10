<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\FinancialInstitution;

class FinancialInstitutionTest extends TestCase
{
    use WithFaker;

    protected $url = '/api/financialInstitution';

    public function testIndexOk()
    {
        $f = factory(FinancialInstitution::class, 5)->create();
        $response = $this->get($this->url);
        $response->assertStatus(200);

        $response->assertJsonFragment($f[0]->toArray());
    }

    public function testIndexSortedPaginatedOk()
    {
        $f = factory(FinancialInstitution::class, 5)->create();
        $per_page = 2;
        $response = $this->get($this->url.'?sort=id%7Casc&per_page='.$per_page);
        $response->assertStatus(200);
        $response->assertJsonCount($per_page, 'data');
        $response->assertJsonFragment($f[0]->toArray());
        $response->assertJsonMissing(['id' => $f[2]->id]);
    }

    public function testShowOk()
    {
        $f = factory(FinancialInstitution::class)->create();
        $response = $this->get($this->url.'/'.$f->id);
        $response->assertStatus(200);
        $response->assertJsonFragment($f->toArray());
    }

    public function testShowNotFound()
    {
        $f = factory(FinancialInstitution::class)->create();
        $response = $this->get($this->url.'/'.($f->id+1));
        $response->assertStatus(404);

        $response->assertJsonMissing($f->toArray());
    }

    public function testStoreOk()
    {
        $params = [
            'full_name' => $this->faker()->company,
            'short_name' => $this->faker()->word,
            'financial_institution_type_id' => factory(\App\FinancialInstitutionType::class)->create()->id,
        ];
        
        $response = $this->post($this->url, $params);

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
        $response = $this->json('POST', $this->url, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['short_name']);
        $response = $this->json('POST', $this->url, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['financial_institution_type_id']);
        $response = $this->json('POST', $this->url, $params);
        $response->assertStatus(422);
    }

    public function testUpdateOk()
    {
        $f = factory(FinancialInstitution::class)->create();
        $params = [
            'full_name' => $this->faker()->company,
            'short_name' => $this->faker()->word,
            'financial_institution_type_id' => factory(\App\FinancialInstitutionType::class)->create()->id,
        ];
        
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);

        $response->assertStatus(200);
        $response->assertJsonFragment($params);
    }

    public function testUpdateNotFound()
    {
        $f = factory(FinancialInstitution::class)->create();
        $params = [
            'full_name' => $this->faker()->company,
            'short_name' => $this->faker()->word,
            'financial_institution_type_id' => factory(\App\FinancialInstitutionType::class)->create()->id,
        ];
        
        $response = $this->json('PUT', $this->url.'/'.($f->id+1), $params);

        $response->assertStatus(404);
    }

    public function testUpdateMissingParameter()
    {
        $f = factory(FinancialInstitution::class)->create();
        $baseParams = [
            'full_name' => $this->faker()->company,
            'short_name' => $this->faker()->word,
            'financial_institution_type_id' => factory(\App\FinancialInstitutionType::class)->create()->id,
        ];
        
        $params = $baseParams;
        unset($params['full_name']);
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['short_name']);
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['financial_institution_type_id']);
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);
        $response->assertStatus(422);
    }

    public function testDestroyOk()
    {
        $f = factory(FinancialInstitution::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.$f->id);
        $response->assertStatus(204);
        $this->assertSoftDeleted(app(FinancialInstitution::class)->getTable(), ['id' => $f->id]);
    }

    public function testDestroyNotFound()
    {
        $f = factory(FinancialInstitution::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.($f->id+1));
        $response->assertStatus(404);
    }
}
