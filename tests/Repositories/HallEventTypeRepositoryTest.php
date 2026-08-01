<?php

namespace Tests\Repositories;

use App\Models\HallEventType;
use App\Repositories\HallEventTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class HallEventTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected HallEventTypeRepository $hallEventTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->hallEventTypeRepo = app(HallEventTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_hall_event_type()
    {
        $hallEventType = HallEventType::factory()->make()->toArray();

        $createdHallEventType = $this->hallEventTypeRepo->create($hallEventType);

        $createdHallEventType = $createdHallEventType->toArray();
        $this->assertArrayHasKey('id', $createdHallEventType);
        $this->assertNotNull($createdHallEventType['id'], 'Created HallEventType must have id specified');
        $this->assertNotNull(HallEventType::find($createdHallEventType['id']), 'HallEventType with given id must be in DB');
        $this->assertModelData($hallEventType, $createdHallEventType);
    }

    /**
     * @test read
     */
    public function test_read_hall_event_type()
    {
        $hallEventType = HallEventType::factory()->create();

        $dbHallEventType = $this->hallEventTypeRepo->find($hallEventType->id);

        $dbHallEventType = $dbHallEventType->toArray();
        $this->assertModelData($hallEventType->toArray(), $dbHallEventType);
    }

    /**
     * @test update
     */
    public function test_update_hall_event_type()
    {
        $hallEventType = HallEventType::factory()->create();
        $fakeHallEventType = HallEventType::factory()->make()->toArray();

        $updatedHallEventType = $this->hallEventTypeRepo->update($fakeHallEventType, $hallEventType->id);

        $this->assertModelData($fakeHallEventType, $updatedHallEventType->toArray());
        $dbHallEventType = $this->hallEventTypeRepo->find($hallEventType->id);
        $this->assertModelData($fakeHallEventType, $dbHallEventType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_hall_event_type()
    {
        $hallEventType = HallEventType::factory()->create();

        $resp = $this->hallEventTypeRepo->delete($hallEventType->id);

        $this->assertTrue($resp);
        $this->assertNull(HallEventType::find($hallEventType->id), 'HallEventType should not exist in DB');
    }
}
