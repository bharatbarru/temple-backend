<?php

namespace Tests\Repositories;

use App\Models\ApplicationSetting;
use App\Repositories\ApplicationSettingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ApplicationSettingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected ApplicationSettingRepository $applicationSettingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->applicationSettingRepo = app(ApplicationSettingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_application_setting()
    {
        $applicationSetting = ApplicationSetting::factory()->make()->toArray();

        $createdApplicationSetting = $this->applicationSettingRepo->create($applicationSetting);

        $createdApplicationSetting = $createdApplicationSetting->toArray();
        $this->assertArrayHasKey('id', $createdApplicationSetting);
        $this->assertNotNull($createdApplicationSetting['id'], 'Created ApplicationSetting must have id specified');
        $this->assertNotNull(ApplicationSetting::find($createdApplicationSetting['id']), 'ApplicationSetting with given id must be in DB');
        $this->assertModelData($applicationSetting, $createdApplicationSetting);
    }

    /**
     * @test read
     */
    public function test_read_application_setting()
    {
        $applicationSetting = ApplicationSetting::factory()->create();

        $dbApplicationSetting = $this->applicationSettingRepo->find($applicationSetting->id);

        $dbApplicationSetting = $dbApplicationSetting->toArray();
        $this->assertModelData($applicationSetting->toArray(), $dbApplicationSetting);
    }

    /**
     * @test update
     */
    public function test_update_application_setting()
    {
        $applicationSetting = ApplicationSetting::factory()->create();
        $fakeApplicationSetting = ApplicationSetting::factory()->make()->toArray();

        $updatedApplicationSetting = $this->applicationSettingRepo->update($fakeApplicationSetting, $applicationSetting->id);

        $this->assertModelData($fakeApplicationSetting, $updatedApplicationSetting->toArray());
        $dbApplicationSetting = $this->applicationSettingRepo->find($applicationSetting->id);
        $this->assertModelData($fakeApplicationSetting, $dbApplicationSetting->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_application_setting()
    {
        $applicationSetting = ApplicationSetting::factory()->create();

        $resp = $this->applicationSettingRepo->delete($applicationSetting->id);

        $this->assertTrue($resp);
        $this->assertNull(ApplicationSetting::find($applicationSetting->id), 'ApplicationSetting should not exist in DB');
    }
}
