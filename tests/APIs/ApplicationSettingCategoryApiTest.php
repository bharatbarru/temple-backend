<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ApplicationSettingCategory;

class ApplicationSettingCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_application_setting_category()
    {
        $applicationSettingCategory = ApplicationSettingCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/applicationSettingCategories',
            $applicationSettingCategory
        );

        $this->assertApiResponse($applicationSettingCategory);
    }

    /**
     * @test
     */
    public function test_read_application_setting_category()
    {
        $applicationSettingCategory = ApplicationSettingCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/applicationSettingCategories/' . $applicationSettingCategory->id
        );

        $this->assertApiResponse($applicationSettingCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_application_setting_category()
    {
        $applicationSettingCategory = ApplicationSettingCategory::factory()->create();
        $editedApplicationSettingCategory = ApplicationSettingCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/applicationSettingCategories/' . $applicationSettingCategory->id,
            $editedApplicationSettingCategory
        );

        $this->assertApiResponse($editedApplicationSettingCategory);
    }

    /**
     * @test
     */
    public function test_delete_application_setting_category()
    {
        $applicationSettingCategory = ApplicationSettingCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
            '/api/applicationSettingCategories/' . $applicationSettingCategory->id
        );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/applicationSettingCategories/' . $applicationSettingCategory->id
        );

        $this->response->assertStatus(404);
    }
}
