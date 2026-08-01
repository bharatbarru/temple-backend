<?php

namespace Tests\Repositories;

use App\Models\ServiceCategory;
use App\Repositories\ServiceCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ServiceCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected ServiceCategoryRepository $serviceCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->serviceCategoryRepo = app(ServiceCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_service_category()
    {
        $serviceCategory = ServiceCategory::factory()->make()->toArray();

        $createdServiceCategory = $this->serviceCategoryRepo->create($serviceCategory);

        $createdServiceCategory = $createdServiceCategory->toArray();
        $this->assertArrayHasKey('id', $createdServiceCategory);
        $this->assertNotNull($createdServiceCategory['id'], 'Created ServiceCategory must have id specified');
        $this->assertNotNull(ServiceCategory::find($createdServiceCategory['id']), 'ServiceCategory with given id must be in DB');
        $this->assertModelData($serviceCategory, $createdServiceCategory);
    }

    /**
     * @test read
     */
    public function test_read_service_category()
    {
        $serviceCategory = ServiceCategory::factory()->create();

        $dbServiceCategory = $this->serviceCategoryRepo->find($serviceCategory->id);

        $dbServiceCategory = $dbServiceCategory->toArray();
        $this->assertModelData($serviceCategory->toArray(), $dbServiceCategory);
    }

    /**
     * @test update
     */
    public function test_update_service_category()
    {
        $serviceCategory = ServiceCategory::factory()->create();
        $fakeServiceCategory = ServiceCategory::factory()->make()->toArray();

        $updatedServiceCategory = $this->serviceCategoryRepo->update($fakeServiceCategory, $serviceCategory->id);

        $this->assertModelData($fakeServiceCategory, $updatedServiceCategory->toArray());
        $dbServiceCategory = $this->serviceCategoryRepo->find($serviceCategory->id);
        $this->assertModelData($fakeServiceCategory, $dbServiceCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_service_category()
    {
        $serviceCategory = ServiceCategory::factory()->create();

        $resp = $this->serviceCategoryRepo->delete($serviceCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(ServiceCategory::find($serviceCategory->id), 'ServiceCategory should not exist in DB');
    }
}
