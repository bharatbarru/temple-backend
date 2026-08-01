<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Statistics;

class StatisticsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_statistics()
    {
        $statistics = Statistics::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/statistics', $statistics
        );

        $this->assertApiResponse($statistics);
    }

    /**
     * @test
     */
    public function test_read_statistics()
    {
        $statistics = Statistics::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/statistics/'.$statistics->id
        );

        $this->assertApiResponse($statistics->toArray());
    }

    /**
     * @test
     */
    public function test_update_statistics()
    {
        $statistics = Statistics::factory()->create();
        $editedStatistics = Statistics::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/statistics/'.$statistics->id,
            $editedStatistics
        );

        $this->assertApiResponse($editedStatistics);
    }

    /**
     * @test
     */
    public function test_delete_statistics()
    {
        $statistics = Statistics::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/statistics/'.$statistics->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/statistics/'.$statistics->id
        );

        $this->response->assertStatus(404);
    }
}
