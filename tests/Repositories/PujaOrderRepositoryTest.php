<?php

namespace Tests\Repositories;

use App\Models\PujaOrder;
use App\Repositories\PujaOrderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PujaOrderRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected PujaOrderRepository $pujaOrderRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pujaOrderRepo = app(PujaOrderRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_puja_order()
    {
        $pujaOrder = PujaOrder::factory()->make()->toArray();

        $createdPujaOrder = $this->pujaOrderRepo->create($pujaOrder);

        $createdPujaOrder = $createdPujaOrder->toArray();
        $this->assertArrayHasKey('id', $createdPujaOrder);
        $this->assertNotNull($createdPujaOrder['id'], 'Created PujaOrder must have id specified');
        $this->assertNotNull(PujaOrder::find($createdPujaOrder['id']), 'PujaOrder with given id must be in DB');
        $this->assertModelData($pujaOrder, $createdPujaOrder);
    }

    /**
     * @test read
     */
    public function test_read_puja_order()
    {
        $pujaOrder = PujaOrder::factory()->create();

        $dbPujaOrder = $this->pujaOrderRepo->find($pujaOrder->id);

        $dbPujaOrder = $dbPujaOrder->toArray();
        $this->assertModelData($pujaOrder->toArray(), $dbPujaOrder);
    }

    /**
     * @test update
     */
    public function test_update_puja_order()
    {
        $pujaOrder = PujaOrder::factory()->create();
        $fakePujaOrder = PujaOrder::factory()->make()->toArray();

        $updatedPujaOrder = $this->pujaOrderRepo->update($fakePujaOrder, $pujaOrder->id);

        $this->assertModelData($fakePujaOrder, $updatedPujaOrder->toArray());
        $dbPujaOrder = $this->pujaOrderRepo->find($pujaOrder->id);
        $this->assertModelData($fakePujaOrder, $dbPujaOrder->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_puja_order()
    {
        $pujaOrder = PujaOrder::factory()->create();

        $resp = $this->pujaOrderRepo->delete($pujaOrder->id);

        $this->assertTrue($resp);
        $this->assertNull(PujaOrder::find($pujaOrder->id), 'PujaOrder should not exist in DB');
    }
}
