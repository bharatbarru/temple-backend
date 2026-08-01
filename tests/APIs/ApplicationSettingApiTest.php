<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ApplicationSetting;

class ApplicationSettingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_application_setting()
    {
        $applicationSetting = ApplicationSetting::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/applicationSettings',
            $applicationSetting
        );

        $this->assertApiResponse($applicationSetting);
    }

    /**
     * @test
     */
    public function test_read_application_setting()
    {
        $applicationSetting = ApplicationSetting::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/applicationSettings/' . $applicationSetting->id
        );

        $this->assertApiResponse($applicationSetting->toArray());
    }

    /**
     * @test
     */
    public function test_update_application_setting()
    {
        $applicationSetting = ApplicationSetting::factory()->create();
        $editedApplicationSetting = ApplicationSetting::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/applicationSettings/' . $applicationSetting->id,
            $editedApplicationSetting
        );

        $this->assertApiResponse($editedApplicationSetting);
    }

    /**
     * @test
     */
    public function test_delete_application_setting()
    {
        $applicationSetting = ApplicationSetting::factory()->create();

        $this->response = $this->json(
            'DELETE',
            '/api/applicationSettings/' . $applicationSetting->id
        );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/applicationSettings/' . $applicationSetting->id
        );

        $this->response->assertStatus(404);
    }
}
