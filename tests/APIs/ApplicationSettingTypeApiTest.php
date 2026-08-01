<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ApplicationSettingType;

class ApplicationSettingTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_application_setting_type()
    {
        $applicationSettingType = ApplicationSettingType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/applicationSettingTypes',
            $applicationSettingType
        );

        $this->assertApiResponse($applicationSettingType);
    }

    /**
     * @test
     */
    public function test_read_application_setting_type()
    {
        $applicationSettingType = ApplicationSettingType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/applicationSettingTypes/' . $applicationSettingType->id
        );

        $this->assertApiResponse($applicationSettingType->toArray());
    }

    /**
     * @test
     */
    public function test_update_application_setting_type()
    {
        $applicationSettingType = ApplicationSettingType::factory()->create();
        $editedApplicationSettingType = ApplicationSettingType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/applicationSettingTypes/' . $applicationSettingType->id,
            $editedApplicationSettingType
        );

        $this->assertApiResponse($editedApplicationSettingType);
    }

    /**
     * @test
     */
    public function test_delete_application_setting_type()
    {
        $applicationSettingType = ApplicationSettingType::factory()->create();

        $this->response = $this->json(
            'DELETE',
            '/api/applicationSettingTypes/' . $applicationSettingType->id
        );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/applicationSettingTypes/' . $applicationSettingType->id
        );

        $this->response->assertStatus(404);
    }
}
