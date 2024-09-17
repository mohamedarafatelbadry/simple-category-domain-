<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\;

class ApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_()
    {
        $ = ::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/', $
        );

        $this->assertApiResponse($);
    }

    /**
     * @test
     */
    public function test_read_()
    {
        $ = ::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin//'.$->id
        );

        $this->assertApiResponse($->toArray());
    }

    /**
     * @test
     */
    public function test_update_()
    {
        $ = ::factory()->create();
        $edited = ::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin//'.$->id,
            $edited
        );

        $this->assertApiResponse($edited);
    }

    /**
     * @test
     */
    public function test_delete_()
    {
        $ = ::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin//'.$->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin//'.$->id
        );

        $this->response->assertStatus(404);
    }
}
