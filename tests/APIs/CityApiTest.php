<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MasterCity;

class CityApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_city()
    {
        $city = MasterCity::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/master_cities', $city
        );

        $this->assertApiResponse($city);
    }

    /**
     * @test
     */
    public function test_read_city()
    {
        $city = MasterCity::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/master_cities/'.$city->id
        );

        $this->assertApiResponse($city->toArray());
    }

    /**
     * @test
     */
    public function test_update_city()
    {
        $city = MasterCity::factory()->create();
        $editedCity = MasterCity::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/master_cities/'.$city->id,
            $editedCity
        );

        $this->assertApiResponse($editedCity);
    }

    /**
     * @test
     */
    public function test_delete_city()
    {
        $city = MasterCity::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/master_cities/'.$city->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/master_cities/'.$city->id
        );

        $this->response->assertStatus(404);
    }
}
