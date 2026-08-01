<?php

namespace Tests\Repositories;

use App\Models\Puja;
use App\Repositories\PujaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PujaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected PujaRepository $pujaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pujaRepo = app(PujaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_puja()
    {
        $puja = Puja::factory()->make()->toArray();

        $createdPuja = $this->pujaRepo->create($puja);

        $createdPuja = $createdPuja->toArray();
        $this->assertArrayHasKey('id', $createdPuja);
        $this->assertNotNull($createdPuja['id'], 'Created Puja must have id specified');
        $this->assertNotNull(Puja::find($createdPuja['id']), 'Puja with given id must be in DB');
        $this->assertModelData($puja, $createdPuja);
    }

    /**
     * @test read
     */
    public function test_read_puja()
    {
        $puja = Puja::factory()->create();

        $dbPuja = $this->pujaRepo->find($puja->id);

        $dbPuja = $dbPuja->toArray();
        $this->assertModelData($puja->toArray(), $dbPuja);
    }

    /**
     * @test update
     */
    public function test_update_puja()
    {
        $puja = Puja::factory()->create();
        $fakePuja = Puja::factory()->make()->toArray();

        $updatedPuja = $this->pujaRepo->update($fakePuja, $puja->id);

        $this->assertModelData($fakePuja, $updatedPuja->toArray());
        $dbPuja = $this->pujaRepo->find($puja->id);
        $this->assertModelData($fakePuja, $dbPuja->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_puja()
    {
        $puja = Puja::factory()->create();

        $resp = $this->pujaRepo->delete($puja->id);

        $this->assertTrue($resp);
        $this->assertNull(Puja::find($puja->id), 'Puja should not exist in DB');
    }
}
