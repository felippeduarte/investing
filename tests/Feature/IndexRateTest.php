<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\IndexRate;

class IndexRateTest extends TestCase
{
    use WithFaker;

    protected $url = '/api/indexRate';

    public function testIndexOk()
    {
        $f = factory(IndexRate::class, 5)->create();
        $response = $this->get($this->url);
        $response->assertStatus(200);

        $index = $f[0]->toArray();
        $index['value'] = number_format($index['value'], 2);
        $response->assertJsonFragment($index);
    }

    public function testIndexSortedPaginatedOk()
    {
        $f = factory(IndexRate::class, 5)->create();
        $index = $f[0]->toArray();
        $index['value'] = number_format($index['value'], 2);

        $per_page = 2;
        $response = $this->get($this->url.'?sort=id%7Casc&per_page='.$per_page);
        $response->assertStatus(200);
        $response->assertJsonCount($per_page, 'data');
        $response->assertJsonFragment($index);
        $response->assertJsonMissing(['id' => $f[2]->id]);
    }

    public function testShowOk()
    {
        $f = factory(IndexRate::class)->create();
        $f->value = number_format($f->value, 2);
        $response = $this->get($this->url.'/'.$f->id);
        $response->assertStatus(200);
        $response->assertJsonFragment($f->toArray());
    }

    public function testShowNotFound()
    {
        $f = factory(IndexRate::class)->create();
        $response = $this->get($this->url.'/'.($f->id+1));
        $response->assertStatus(404);

        $response->assertJsonMissing($f->toArray());
    }

    public function testStoreOk()
    {
        $params = [
            'index_id' => factory(\App\Index::class)->create()->id,
            'period_id' => factory(\App\Period::class)->create()->id,
            'value' => $this->faker()->randomFloat(2),
        ];
        
        $response = $this->post($this->url, $params);

        $response->assertStatus(201);
        $response->assertJsonFragment($params);
    }

    public function testStoreMissingParameter()
    {
        $baseParams = [
            'index_id' => factory(\App\Index::class)->create()->id,
            'period_id' => factory(\App\Period::class)->create()->id,
            'value' => $this->faker()->randomFloat(2),
        ];
        
        $params = $baseParams;
        unset($params['index_id']);
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
        $f = factory(IndexRate::class)->create();
        $params = [
            'index_id' => factory(\App\Index::class)->create()->id,
            'period_id' => factory(\App\Period::class)->create()->id,
            'value' => $this->faker()->randomFloat(2),
        ];
        
        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);

        $response->assertStatus(200);
        $response->assertJsonFragment($params);
    }

    public function testUpdateNotFound()
    {
        $f = factory(IndexRate::class)->create();
        $params = [
            'index_id' => factory(\App\Index::class)->create()->id,
            'period_id' => factory(\App\Period::class)->create()->id,
            'value' => $this->faker()->randomFloat(2),
        ];
        
        $response = $this->json('PUT', $this->url.'/'.($f->id+1), $params);

        $response->assertStatus(404);
    }

    public function testUpdateMissingParameter()
    {
        $f = factory(IndexRate::class)->create();
        $baseParams = [
            'index_id' => factory(\App\Index::class)->create()->id,
            'period_id' => factory(\App\Period::class)->create()->id,
            'value' => $this->faker()->randomFloat(2),
        ];
        
        $params = $baseParams;
        unset($params['index_id']);
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
        $f = factory(IndexRate::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.$f->id);
        $response->assertStatus(204);
        $this->assertSoftDeleted(app(IndexRate::class)->getTable(), ['id' => $f->id]);
    }

    public function testDestroyNotFound()
    {
        $f = factory(IndexRate::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.($f->id+1));
        $response->assertStatus(404);
    }
}
