<?php

namespace Tests\Repositories;

use App\Models\Hall;
use App\Repositories\HallRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class HallRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected HallRepository $hallRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->hallRepo = app(HallRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_hall()
    {
        $hall = Hall::factory()->make()->toArray();

        $createdHall = $this->hallRepo->create($hall);

        $createdHall = $createdHall->toArray();
        $this->assertArrayHasKey('id', $createdHall);
        $this->assertNotNull($createdHall['id'], 'Created Hall must have id specified');
        $this->assertNotNull(Hall::find($createdHall['id']), 'Hall with given id must be in DB');
        $this->assertModelData($hall, $createdHall);
    }

    /**
     * @test read
     */
    public function test_read_hall()
    {
        $hall = Hall::factory()->create();

        $dbHall = $this->hallRepo->find($hall->id);

        $dbHall = $dbHall->toArray();
        $this->assertModelData($hall->toArray(), $dbHall);
    }

    /**
     * @test update
     */
    public function test_update_hall()
    {
        $hall = Hall::factory()->create();
        $fakeHall = Hall::factory()->make()->toArray();

        $updatedHall = $this->hallRepo->update($fakeHall, $hall->id);

        $this->assertModelData($fakeHall, $updatedHall->toArray());
        $dbHall = $this->hallRepo->find($hall->id);
        $this->assertModelData($fakeHall, $dbHall->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_hall()
    {
        $hall = Hall::factory()->create();

        $resp = $this->hallRepo->delete($hall->id);

        $this->assertTrue($resp);
        $this->assertNull(Hall::find($hall->id), 'Hall should not exist in DB');
    }
}
