<?php

namespace Tests\Repositories;

use App\Models\HallAddon;
use App\Repositories\HallAddonRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class HallAddonRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected HallAddonRepository $hallAddonRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->hallAddonRepo = app(HallAddonRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_hall_addon()
    {
        $hallAddon = HallAddon::factory()->make()->toArray();

        $createdHallAddon = $this->hallAddonRepo->create($hallAddon);

        $createdHallAddon = $createdHallAddon->toArray();
        $this->assertArrayHasKey('id', $createdHallAddon);
        $this->assertNotNull($createdHallAddon['id'], 'Created HallAddon must have id specified');
        $this->assertNotNull(HallAddon::find($createdHallAddon['id']), 'HallAddon with given id must be in DB');
        $this->assertModelData($hallAddon, $createdHallAddon);
    }

    /**
     * @test read
     */
    public function test_read_hall_addon()
    {
        $hallAddon = HallAddon::factory()->create();

        $dbHallAddon = $this->hallAddonRepo->find($hallAddon->id);

        $dbHallAddon = $dbHallAddon->toArray();
        $this->assertModelData($hallAddon->toArray(), $dbHallAddon);
    }

    /**
     * @test update
     */
    public function test_update_hall_addon()
    {
        $hallAddon = HallAddon::factory()->create();
        $fakeHallAddon = HallAddon::factory()->make()->toArray();

        $updatedHallAddon = $this->hallAddonRepo->update($fakeHallAddon, $hallAddon->id);

        $this->assertModelData($fakeHallAddon, $updatedHallAddon->toArray());
        $dbHallAddon = $this->hallAddonRepo->find($hallAddon->id);
        $this->assertModelData($fakeHallAddon, $dbHallAddon->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_hall_addon()
    {
        $hallAddon = HallAddon::factory()->create();

        $resp = $this->hallAddonRepo->delete($hallAddon->id);

        $this->assertTrue($resp);
        $this->assertNull(HallAddon::find($hallAddon->id), 'HallAddon should not exist in DB');
    }
}
