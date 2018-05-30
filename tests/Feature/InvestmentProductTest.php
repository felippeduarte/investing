<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\InvestmentProduct;

class InvestmentProductTest extends TestCase
{
    use WithFaker;

    protected $url = '/api/investmentProduct';

    public function testIndexOk()
    {
        $f = factory(InvestmentProduct::class, 5)->create();
        $response = $this->get($this->url);
        $response->assertStatus(200);

        $investment = $f[0]->toArray();
        $response->assertJsonFragment($investment);
    }

    public function testIndexSortedPaginatedOk()
    {
        $f = factory(InvestmentProduct::class, 5)->create();
        $investment = $f[0]->toArray();

        $per_page = 2;
        $response = $this->get($this->url.'?sort=id%7Casc&per_page='.$per_page);
        $response->assertStatus(200);
        $response->assertJsonCount($per_page, 'data');
        $response->assertJsonFragment($investment);
        $response->assertJsonMissing(['id' => $f[2]->id]);
    }

    public function testShowOk()
    {
        $f = factory(InvestmentProduct::class)->create();
        $response = $this->get($this->url.'/'.$f->id);
        $response->assertStatus(200);
        $response->assertJsonFragment($f->toArray());
    }

    public function testShowNotFound()
    {
        $f = factory(InvestmentProduct::class)->create();
        $response = $this->get($this->url.'/'.($f->id+1));
        $response->assertStatus(404);

        $response->assertJsonMissing($f->toArray());
    }

    public function testStoreOk()
    {
        $params = [
            'name' => $this->faker()->name,
            'financial_institution_id' => factory(\App\FinancialInstitution::class)->create()->id,
            'investment_type_id' => factory(\App\InvestmentType::class)->create()->id,
            'risk_level_id' => factory(\App\RiskLevel::class)->create()->id,
        ];

        $response = $this->post($this->url, $params);

        $response->assertStatus(201);
        $response->assertJsonFragment($params);
    }

    public function testStoreMissingParameter()
    {
        $baseParams = [
            'name' => $this->faker()->name,
            'financial_institution_id' => factory(\App\FinancialInstitution::class)->create()->id,
            'investment_type_id' => factory(\App\InvestmentType::class)->create()->id,
            'risk_level_id' => factory(\App\RiskLevel::class)->create()->id,
        ];

        $params = $baseParams;
        unset($params['name']);
        $response = $this->json('POST', $this->url, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['financial_institution_id']);
        $response = $this->json('POST', $this->url, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['investment_type_id']);
        $response = $this->json('POST', $this->url, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['risk_level_id']);
        $response = $this->json('POST', $this->url, $params);
        $response->assertStatus(422);
    }

    public function testUpdateOk()
    {
        $f = factory(InvestmentProduct::class)->create();
        $params = [
            'name' => $this->faker()->name,
            'financial_institution_id' => factory(\App\FinancialInstitution::class)->create()->id,
            'investment_type_id' => factory(\App\InvestmentType::class)->create()->id,
            'risk_level_id' => factory(\App\RiskLevel::class)->create()->id,
        ];

        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);

        $response->assertStatus(200);
        $response->assertJsonFragment($params);
    }

    public function testUpdateNotFound()
    {
        $f = factory(InvestmentProduct::class)->create();
        $params = [
            'name' => $this->faker()->name,
            'financial_institution_id' => factory(\App\FinancialInstitution::class)->create()->id,
            'investment_type_id' => factory(\App\InvestmentType::class)->create()->id,
            'risk_level_id' => factory(\App\RiskLevel::class)->create()->id,
        ];

        $response = $this->json('PUT', $this->url.'/'.($f->id+1), $params);

        $response->assertStatus(404);
    }

    public function testUpdateMissingParameter()
    {
        $f = factory(InvestmentProduct::class)->create();
        $baseParams = [
            'name' => $this->faker()->name,
            'financial_institution_id' => factory(\App\FinancialInstitution::class)->create()->id,
            'investment_type_id' => factory(\App\InvestmentType::class)->create()->id,
            'risk_level_id' => factory(\App\RiskLevel::class)->create()->id,
        ];

        $params = $baseParams;
        unset($params['name']);
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['financial_institution_id']);
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['investment_type_id']);
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['risk_level_id']);
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);
        $response->assertStatus(422);
    }

    public function testDestroyOk()
    {
        $f = factory(InvestmentProduct::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.$f->id);
        $response->assertStatus(204);
        $this->assertSoftDeleted(app(InvestmentProduct::class)->getTable(), ['id' => $f->id]);
    }

    public function testDestroyNotFound()
    {
        $f = factory(InvestmentProduct::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.($f->id+1));
        $response->assertStatus(404);
    }
}
