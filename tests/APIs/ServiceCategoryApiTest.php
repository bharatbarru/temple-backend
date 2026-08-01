<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ServiceCategory;

class ServiceCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_service_category()
    {
        $serviceCategory = ServiceCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/serviceCategories', $serviceCategory
        );

        $this->assertApiResponse($serviceCategory);
    }

    /**
     * @test
     */
    public function test_read_service_category()
    {
        $serviceCategory = ServiceCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/serviceCategories/'.$serviceCategory->id
        );

        $this->assertApiResponse($serviceCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_service_category()
    {
        $serviceCategory = ServiceCategory::factory()->create();
        $editedServiceCategory = ServiceCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/serviceCategories/'.$serviceCategory->id,
            $editedServiceCategory
        );

        $this->assertApiResponse($editedServiceCategory);
    }

    /**
     * @test
     */
    public function test_delete_service_category()
    {
        $serviceCategory = ServiceCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/serviceCategories/'.$serviceCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/serviceCategories/'.$serviceCategory->id
        );

        $this->response->assertStatus(404);
    }
}
