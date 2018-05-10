<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\InvestmentType;

class InvestmentTypeTest extends TestCase
{
    use WithFaker;

    protected $url = '/api/investmentType';

    public function testInvestmentTypeOk()
    {
        $f = factory(InvestmentType::class, 5)->create();
        $response = $this->get($this->url);
        $response->assertStatus(200);

        $response->assertJsonFragment($f[0]->toArray());
    }

    public function testInvestmentTypeSortedPaginatedOk()
    {
        $f = factory(InvestmentType::class, 5)->create();
        $per_page = 2;
        $response = $this->get($this->url.'?sort=id%7Casc&per_page='.$per_page);
        $response->assertStatus(200);
        $response->assertJsonCount($per_page, 'data');
        $response->assertJsonFragment($f[0]->toArray());
        $response->assertJsonMissing(['id' => $f[2]->id]);
    }

    public function testShowOk()
    {
        $f = factory(InvestmentType::class)->create();
        $response = $this->get($this->url.'/'.$f->id);
        $response->assertStatus(200);
        $response->assertJsonFragment($f->toArray());
    }

    public function testShowNotFound()
    {
        $f = factory(InvestmentType::class)->create();
        $response = $this->get($this->url.'/'.($f->id+1));
        $response->assertStatus(404);

        $response->assertJsonMissing($f->toArray());
    }

    public function testStoreOk()
    {
        $params = [
            'name' => $this->faker()->word,
        ];
        
        $response = $this->post($this->url, $params);

        $response->assertStatus(201);
        $response->assertJsonFragment($params);
    }

    public function testStoreMissingParameter()
    {
        $response = $this->json('POST', $this->url, []);
        $response->assertStatus(422);
    }

    public function testUpdateOk()
    {
        $f = factory(InvestmentType::class)->create();
        $params = [
            'name' => $this->faker()->word,
        ];
        
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);

        $response->assertStatus(200);
        $response->assertJsonFragment($params);
    }

    public function testUpdateNotFound()
    {
        $f = factory(InvestmentType::class)->create();
        $params = [
            'name' => $this->faker()->word,
        ];
        
        $response = $this->json('PUT', $this->url.'/'.($f->id+1), $params);

        $response->assertStatus(404);
    }

    public function testUpdateMissingParameter()
    {
        $f = factory(InvestmentType::class)->create();

        $response = $this->json('PUT', $this->url.'/'.$f->id, []);
        $response->assertStatus(422);
    }

    public function testDestroyOk()
    {
        $f = factory(InvestmentType::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.$f->id);
        $response->assertStatus(204);
        $this->assertSoftDeleted(app(InvestmentType::class)->getTable(), ['id' => $f->id]);
    }

    public function testDestroyNotFound()
    {
        $f = factory(InvestmentType::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.($f->id+1));
        $response->assertStatus(404);
    }
}
