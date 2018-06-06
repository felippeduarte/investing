<?php

namespace Tests\Feature;

use Tests\AdminTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\FinancialInstitutionType;

class FinancialInstitutionTypeTest extends AdminTestCase
{
    use WithFaker;

    protected $url = '/admin/financialInstitutionType';

    public function testIndexOk()
    {
        $f = factory(FinancialInstitutionType::class, 5)->create();
        $response = $this->get($this->url);
        $response->assertStatus(200);

        $response->assertJsonFragment($f[0]->toArray());
    }

    public function testIndexSortedPaginatedOk()
    {
        $f = factory(FinancialInstitutionType::class, 5)->create();
        $per_page = 2;
        $response = $this->get($this->url.'?sort=id%7Casc&per_page='.$per_page);
        $response->assertStatus(200);
        $response->assertJsonCount($per_page, 'data');
        $response->assertJsonFragment($f[0]->toArray());
        $response->assertJsonMissing(['id' => $f[2]->id]);
    }

    public function testShowOk()
    {
        $f = factory(FinancialInstitutionType::class)->create();
        $response = $this->get($this->url.'/'.$f->id);
        $response->assertStatus(200);
        $response->assertJsonFragment($f->toArray());
    }

    public function testShowNotFound()
    {
        $f = factory(FinancialInstitutionType::class)->create();
        $response = $this->get($this->url.'/'.($f->id+1));
        $response->assertStatus(404);

        $response->assertJsonMissing($f->toArray());
    }

    public function testStoreOk()
    {
        $params = [
            'description' => $this->faker()->word,
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
        $f = factory(FinancialInstitutionType::class)->create();
        $params = [
            'description' => $this->faker()->word,
        ];

        $response = $this->json('PUT', $this->url.'/'.$f->id, $params);

        $response->assertStatus(200);
        $response->assertJsonFragment($params);
    }

    public function testUpdateNotFound()
    {
        $f = factory(FinancialInstitutionType::class)->create();
        $params = [
            'description' => $this->faker()->word,
        ];

        $response = $this->json('PUT', $this->url.'/'.($f->id+1), $params);

        $response->assertStatus(404);
    }

    public function testUpdateMissingParameter()
    {
        $f = factory(FinancialInstitutionType::class)->create();

        $response = $this->json('PUT', $this->url.'/'.$f->id, []);
        $response->assertStatus(422);
    }

    public function testDestroyOk()
    {
        $f = factory(FinancialInstitutionType::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.$f->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing(app(FinancialInstitutionType::class)->getTable(), ['id' => $f->id]);
    }

    public function testDestroyNotFound()
    {
        $f = factory(FinancialInstitutionType::class)->create();
        $response = $this->json('DELETE', $this->url.'/'.($f->id+1));
        $response->assertStatus(404);
    }
}
