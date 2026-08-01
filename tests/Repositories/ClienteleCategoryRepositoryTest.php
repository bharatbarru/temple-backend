<?php

namespace Tests\Repositories;

use App\Models\ClienteleCategory;
use App\Repositories\ClienteleCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ClienteleCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected ClienteleCategoryRepository $clienteleCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->clienteleCategoryRepo = app(ClienteleCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_clientele_category()
    {
        $clienteleCategory = ClienteleCategory::factory()->make()->toArray();

        $createdClienteleCategory = $this->clienteleCategoryRepo->create($clienteleCategory);

        $createdClienteleCategory = $createdClienteleCategory->toArray();
        $this->assertArrayHasKey('id', $createdClienteleCategory);
        $this->assertNotNull($createdClienteleCategory['id'], 'Created ClienteleCategory must have id specified');
        $this->assertNotNull(ClienteleCategory::find($createdClienteleCategory['id']), 'ClienteleCategory with given id must be in DB');
        $this->assertModelData($clienteleCategory, $createdClienteleCategory);
    }

    /**
     * @test read
     */
    public function test_read_clientele_category()
    {
        $clienteleCategory = ClienteleCategory::factory()->create();

        $dbClienteleCategory = $this->clienteleCategoryRepo->find($clienteleCategory->id);

        $dbClienteleCategory = $dbClienteleCategory->toArray();
        $this->assertModelData($clienteleCategory->toArray(), $dbClienteleCategory);
    }

    /**
     * @test update
     */
    public function test_update_clientele_category()
    {
        $clienteleCategory = ClienteleCategory::factory()->create();
        $fakeClienteleCategory = ClienteleCategory::factory()->make()->toArray();

        $updatedClienteleCategory = $this->clienteleCategoryRepo->update($fakeClienteleCategory, $clienteleCategory->id);

        $this->assertModelData($fakeClienteleCategory, $updatedClienteleCategory->toArray());
        $dbClienteleCategory = $this->clienteleCategoryRepo->find($clienteleCategory->id);
        $this->assertModelData($fakeClienteleCategory, $dbClienteleCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_clientele_category()
    {
        $clienteleCategory = ClienteleCategory::factory()->create();

        $resp = $this->clienteleCategoryRepo->delete($clienteleCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(ClienteleCategory::find($clienteleCategory->id), 'ClienteleCategory should not exist in DB');
    }
}
