<?php

namespace Tests\Repositories;

use App\Models\Cms;
use App\Repositories\CmsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CmsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected CmsRepository $cmsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cmsRepo = app(CmsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cms()
    {
        $cms = Cms::factory()->make()->toArray();

        $createdCms = $this->cmsRepo->create($cms);

        $createdCms = $createdCms->toArray();
        $this->assertArrayHasKey('id', $createdCms);
        $this->assertNotNull($createdCms['id'], 'Created Cms must have id specified');
        $this->assertNotNull(Cms::find($createdCms['id']), 'Cms with given id must be in DB');
        $this->assertModelData($cms, $createdCms);
    }

    /**
     * @test read
     */
    public function test_read_cms()
    {
        $cms = Cms::factory()->create();

        $dbCms = $this->cmsRepo->find($cms->id);

        $dbCms = $dbCms->toArray();
        $this->assertModelData($cms->toArray(), $dbCms);
    }

    /**
     * @test update
     */
    public function test_update_cms()
    {
        $cms = Cms::factory()->create();
        $fakeCms = Cms::factory()->make()->toArray();

        $updatedCms = $this->cmsRepo->update($fakeCms, $cms->id);

        $this->assertModelData($fakeCms, $updatedCms->toArray());
        $dbCms = $this->cmsRepo->find($cms->id);
        $this->assertModelData($fakeCms, $dbCms->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cms()
    {
        $cms = Cms::factory()->create();

        $resp = $this->cmsRepo->delete($cms->id);

        $this->assertTrue($resp);
        $this->assertNull(Cms::find($cms->id), 'Cms should not exist in DB');
    }
}
