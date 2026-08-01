<?php

namespace Tests\Repositories;

use App\Models\ApplicationSettingType;
use App\Repositories\ApplicationSettingTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ApplicationSettingTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected ApplicationSettingTypeRepository $applicationSettingTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->applicationSettingTypeRepo = app(ApplicationSettingTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_application_setting_type()
    {
        $applicationSettingType = ApplicationSettingType::factory()->make()->toArray();

        $createdApplicationSettingType = $this->applicationSettingTypeRepo->create($applicationSettingType);

        $createdApplicationSettingType = $createdApplicationSettingType->toArray();
        $this->assertArrayHasKey('id', $createdApplicationSettingType);
        $this->assertNotNull($createdApplicationSettingType['id'], 'Created ApplicationSettingType must have id specified');
        $this->assertNotNull(ApplicationSettingType::find($createdApplicationSettingType['id']), 'ApplicationSettingType with given id must be in DB');
        $this->assertModelData($applicationSettingType, $createdApplicationSettingType);
    }

    /**
     * @test read
     */
    public function test_read_application_setting_type()
    {
        $applicationSettingType = ApplicationSettingType::factory()->create();

        $dbApplicationSettingType = $this->applicationSettingTypeRepo->find($applicationSettingType->id);

        $dbApplicationSettingType = $dbApplicationSettingType->toArray();
        $this->assertModelData($applicationSettingType->toArray(), $dbApplicationSettingType);
    }

    /**
     * @test update
     */
    public function test_update_application_setting_type()
    {
        $applicationSettingType = ApplicationSettingType::factory()->create();
        $fakeApplicationSettingType = ApplicationSettingType::factory()->make()->toArray();

        $updatedApplicationSettingType = $this->applicationSettingTypeRepo->update($fakeApplicationSettingType, $applicationSettingType->id);

        $this->assertModelData($fakeApplicationSettingType, $updatedApplicationSettingType->toArray());
        $dbApplicationSettingType = $this->applicationSettingTypeRepo->find($applicationSettingType->id);
        $this->assertModelData($fakeApplicationSettingType, $dbApplicationSettingType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_application_setting_type()
    {
        $applicationSettingType = ApplicationSettingType::factory()->create();

        $resp = $this->applicationSettingTypeRepo->delete($applicationSettingType->id);

        $this->assertTrue($resp);
        $this->assertNull(ApplicationSettingType::find($applicationSettingType->id), 'ApplicationSettingType should not exist in DB');
    }
}
