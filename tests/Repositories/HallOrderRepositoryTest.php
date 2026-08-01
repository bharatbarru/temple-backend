<?php

namespace Tests\Repositories;

use App\Models\HallOrder;
use App\Repositories\HallOrderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class HallOrderRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected HallOrderRepository $hallOrderRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->hallOrderRepo = app(HallOrderRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_hall_order()
    {
        $hallOrder = HallOrder::factory()->make()->toArray();

        $createdHallOrder = $this->hallOrderRepo->create($hallOrder);

        $createdHallOrder = $createdHallOrder->toArray();
        $this->assertArrayHasKey('id', $createdHallOrder);
        $this->assertNotNull($createdHallOrder['id'], 'Created HallOrder must have id specified');
        $this->assertNotNull(HallOrder::find($createdHallOrder['id']), 'HallOrder with given id must be in DB');
        $this->assertModelData($hallOrder, $createdHallOrder);
    }

    /**
     * @test read
     */
    public function test_read_hall_order()
    {
        $hallOrder = HallOrder::factory()->create();

        $dbHallOrder = $this->hallOrderRepo->find($hallOrder->id);

        $dbHallOrder = $dbHallOrder->toArray();
        $this->assertModelData($hallOrder->toArray(), $dbHallOrder);
    }

    /**
     * @test update
     */
    public function test_update_hall_order()
    {
        $hallOrder = HallOrder::factory()->create();
        $fakeHallOrder = HallOrder::factory()->make()->toArray();

        $updatedHallOrder = $this->hallOrderRepo->update($fakeHallOrder, $hallOrder->id);

        $this->assertModelData($fakeHallOrder, $updatedHallOrder->toArray());
        $dbHallOrder = $this->hallOrderRepo->find($hallOrder->id);
        $this->assertModelData($fakeHallOrder, $dbHallOrder->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_hall_order()
    {
        $hallOrder = HallOrder::factory()->create();

        $resp = $this->hallOrderRepo->delete($hallOrder->id);

        $this->assertTrue($resp);
        $this->assertNull(HallOrder::find($hallOrder->id), 'HallOrder should not exist in DB');
    }
}
