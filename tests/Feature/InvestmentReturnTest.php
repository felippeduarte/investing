<?php

namespace Tests\Feature;

use Tests\AdminTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\InvestmentReturn;

class InvestmentReturnTest extends AdminTestCase
{
    use WithFaker;

    protected $url = '/admin/investmentReturn';

    public function testIndexOk()
    {
        $f = factory(InvestmentReturn::class, 5)->create();
        $response = $this->get($this->url);
        $response->assertStatus(200);

        $investmentReturn = $f[0]->toArray();
        $investmentReturn['value'] = number_format($investmentReturn['value'], 2, '.', ',');
        $response->assertJsonFragment($investmentReturn);
    }

    public function testIndexSortedPaginatedOk()
    {
        $f = factory(InvestmentReturn::class, 5)->create();
        $investmentReturn = $f[0]->toArray();
        $investmentReturn['value'] = number_format($investmentReturn['value'], 2, '.', ',');

        $per_page = 2;
        $response = $this->get($this->url.'?sort=id%7Casc&per_page='.$per_page);
        $response->assertStatus(200);
        $response->assertJsonCount($per_page, 'data');
        $response->assertJsonFragment($investmentReturn);
        $response->assertJsonMissing(['id' => $f[2]->id]);
    }

    public function testShowOk()
    {
        $f = factory(InvestmentReturn::class)->create();
        $f->value = number_format($f->value, 2, '.', ',');
        $response = $this->get($this->url.'/'.$f->id);
        $response->assertStatus(200);
        $response->assertJsonFragment($f->toArray());
    }

    public function testShowNotFound()
    {
        $f = factory(InvestmentReturn::class)->create();
        $response = $this->get($this->url.'/'.($f->id+1));
        $response->assertStatus(404);

        $response->assertJsonMissing($f->toArray());
    }

    public function testStoreOk()
    {
        $params = [
            'investment_product_id' => factory(\App\InvestmentProduct::class)->create()->id,
            'period_id' => factory(\App\Period::class)->create()->id,
            'value' => $this->faker()->randomFloat(2,0,99),
        ];

        $response = $this->post($this->url, $params);

        $response->assertStatus(201);
        $response->assertJsonFragment($params);
    }

    public function testStoreMissingParameter()
    {
        $baseParams = [
            'investment_product_id' => factory(\App\InvestmentProduct::class)->create()->id,
            'period_id' => factory(\App\Period::class)->create()->id,
            'value' => $this->faker()->randomFloat(2,0,99),
        ];

        $params = $baseParams;
        unset($params['investment_product_id']);
        $response = $this->json('POST', $this->url, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['period_id']);
        $response = $this->json('POST', $this->url, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['value']);
        $response = $this->json('POST', $this->url, $params);
        $response->assertStatus(422);
    }

    public function testUpdateOk()
    {
        $f = factory(InvestmentReturn::class)->create();
        $params = [
            'investment_product_id' => factory(\App\InvestmentProduct::class)->create()->id,
            'period_id' => factory(\App\Period::class)->create()->id,
            'value' => $this->faker()->randomFloat(2,0,99),
        ];

        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);

        $response->assertStatus(200);
        $response->assertJsonFragment($params);
    }

    public function testUpdateNotFound()
    {
        $f = factory(InvestmentReturn::class)->create();
        $params = [
            'investment_product_id' => factory(\App\InvestmentProduct::class)->create()->id,
            'period_id' => factory(\App\Period::class)->create()->id,
            'value' => $this->faker()->randomFloat(2,0,99),
        ];

        $response = $this->json('PUT', $this->url.'/'.($f->id+1), $params);

        $response->assertStatus(404);
    }

    public function testUpdateMissingParameter()
    {
        $f = factory(InvestmentReturn::class)->create();
        $baseParams = [
            'investment_product_id' => factory(\App\InvestmentProduct::class)->create()->id,
            'period_id' => factory(\App\Period::class)->create()->id,
            'value' => $this->faker()->randomFloat(2,0,99),
        ];

        $params = $baseParams;
        unset($params['investment_product_id']);
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['period_id']);
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);
        $response->assertStatus(422);

        $params = $baseParams;
        unset($params['value']);
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);
        $response->assertStatus(422);
    }

    public function testDestroyOk()
    {
        $f = factory(InvestmentReturn::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.$f->id);
        $response->assertStatus(204);
        $this->assertSoftDeleted(app(InvestmentReturn::class)->getTable(), ['id' => $f->id]);
    }

    public function testDestroyNotFound()
    {
        $f = factory(InvestmentReturn::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.($f->id+1));
        $response->assertStatus(404);
    }
}
