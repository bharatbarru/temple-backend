<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ClienteleCategory;

class ClienteleCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_clientele_category()
    {
        $clienteleCategory = ClienteleCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/clienteleCategories',
            $clienteleCategory
        );

        $this->assertApiResponse($clienteleCategory);
    }

    /**
     * @test
     */
    public function test_read_clientele_category()
    {
        $clienteleCategory = ClienteleCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/clienteleCategories/' . $clienteleCategory->id
        );

        $this->assertApiResponse($clienteleCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_clientele_category()
    {
        $clienteleCategory = ClienteleCategory::factory()->create();
        $editedClienteleCategory = ClienteleCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/clienteleCategories/' . $clienteleCategory->id,
            $editedClienteleCategory
        );

        $this->assertApiResponse($editedClienteleCategory);
    }

    /**
     * @test
     */
    public function test_delete_clientele_category()
    {
        $clienteleCategory = ClienteleCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
            '/api/clienteleCategories/' . $clienteleCategory->id
        );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/clienteleCategories/' . $clienteleCategory->id
        );

        $this->response->assertStatus(404);
    }
}
