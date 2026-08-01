<?php

namespace Tests\Repositories;

use App\Models\ApplicationSettingCategory;
use App\Repositories\ApplicationSettingCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ApplicationSettingCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected ApplicationSettingCategoryRepository $applicationSettingCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->applicationSettingCategoryRepo = app(ApplicationSettingCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_application_setting_category()
    {
        $applicationSettingCategory = ApplicationSettingCategory::factory()->make()->toArray();

        $createdApplicationSettingCategory = $this->applicationSettingCategoryRepo->create($applicationSettingCategory);

        $createdApplicationSettingCategory = $createdApplicationSettingCategory->toArray();
        $this->assertArrayHasKey('id', $createdApplicationSettingCategory);
        $this->assertNotNull($createdApplicationSettingCategory['id'], 'Created ApplicationSettingCategory must have id specified');
        $this->assertNotNull(ApplicationSettingCategory::find($createdApplicationSettingCategory['id']), 'ApplicationSettingCategory with given id must be in DB');
        $this->assertModelData($applicationSettingCategory, $createdApplicationSettingCategory);
    }

    /**
     * @test read
     */
    public function test_read_application_setting_category()
    {
        $applicationSettingCategory = ApplicationSettingCategory::factory()->create();

        $dbApplicationSettingCategory = $this->applicationSettingCategoryRepo->find($applicationSettingCategory->id);

        $dbApplicationSettingCategory = $dbApplicationSettingCategory->toArray();
        $this->assertModelData($applicationSettingCategory->toArray(), $dbApplicationSettingCategory);
    }

    /**
     * @test update
     */
    public function test_update_application_setting_category()
    {
        $applicationSettingCategory = ApplicationSettingCategory::factory()->create();
        $fakeApplicationSettingCategory = ApplicationSettingCategory::factory()->make()->toArray();

        $updatedApplicationSettingCategory = $this->applicationSettingCategoryRepo->update($fakeApplicationSettingCategory, $applicationSettingCategory->id);

        $this->assertModelData($fakeApplicationSettingCategory, $updatedApplicationSettingCategory->toArray());
        $dbApplicationSettingCategory = $this->applicationSettingCategoryRepo->find($applicationSettingCategory->id);
        $this->assertModelData($fakeApplicationSettingCategory, $dbApplicationSettingCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_application_setting_category()
    {
        $applicationSettingCategory = ApplicationSettingCategory::factory()->create();

        $resp = $this->applicationSettingCategoryRepo->delete($applicationSettingCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(ApplicationSettingCategory::find($applicationSettingCategory->id), 'ApplicationSettingCategory should not exist in DB');
    }
}
