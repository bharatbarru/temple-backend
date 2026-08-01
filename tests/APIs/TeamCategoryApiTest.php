<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TeamCategory;

class TeamCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_team_category()
    {
        $teamCategory = TeamCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/team-categories', $teamCategory
        );

        $this->assertApiResponse($teamCategory);
    }

    /**
     * @test
     */
    public function test_read_team_category()
    {
        $teamCategory = TeamCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/team-categories/'.$teamCategory->id
        );

        $this->assertApiResponse($teamCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_team_category()
    {
        $teamCategory = TeamCategory::factory()->create();
        $editedTeamCategory = TeamCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/team-categories/'.$teamCategory->id,
            $editedTeamCategory
        );

        $this->assertApiResponse($editedTeamCategory);
    }

    /**
     * @test
     */
    public function test_delete_team_category()
    {
        $teamCategory = TeamCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/team-categories/'.$teamCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/team-categories/'.$teamCategory->id
        );

        $this->response->assertStatus(404);
    }
}
