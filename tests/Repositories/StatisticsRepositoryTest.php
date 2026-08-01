<?php

namespace Tests\Repositories;

use App\Models\Statistics;
use App\Repositories\StatisticsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StatisticsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected StatisticsRepository $statisticsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->statisticsRepo = app(StatisticsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_statistics()
    {
        $statistics = Statistics::factory()->make()->toArray();

        $createdStatistics = $this->statisticsRepo->create($statistics);

        $createdStatistics = $createdStatistics->toArray();
        $this->assertArrayHasKey('id', $createdStatistics);
        $this->assertNotNull($createdStatistics['id'], 'Created Statistics must have id specified');
        $this->assertNotNull(Statistics::find($createdStatistics['id']), 'Statistics with given id must be in DB');
        $this->assertModelData($statistics, $createdStatistics);
    }

    /**
     * @test read
     */
    public function test_read_statistics()
    {
        $statistics = Statistics::factory()->create();

        $dbStatistics = $this->statisticsRepo->find($statistics->id);

        $dbStatistics = $dbStatistics->toArray();
        $this->assertModelData($statistics->toArray(), $dbStatistics);
    }

    /**
     * @test update
     */
    public function test_update_statistics()
    {
        $statistics = Statistics::factory()->create();
        $fakeStatistics = Statistics::factory()->make()->toArray();

        $updatedStatistics = $this->statisticsRepo->update($fakeStatistics, $statistics->id);

        $this->assertModelData($fakeStatistics, $updatedStatistics->toArray());
        $dbStatistics = $this->statisticsRepo->find($statistics->id);
        $this->assertModelData($fakeStatistics, $dbStatistics->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_statistics()
    {
        $statistics = Statistics::factory()->create();

        $resp = $this->statisticsRepo->delete($statistics->id);

        $this->assertTrue($resp);
        $this->assertNull(Statistics::find($statistics->id), 'Statistics should not exist in DB');
    }
}
