<?php

namespace Tests\Repositories;

use App\Models\TeamCategory;
use App\Repositories\TeamCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TeamCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected TeamCategoryRepository $teamCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->teamCategoryRepo = app(TeamCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_team_category()
    {
        $teamCategory = TeamCategory::factory()->make()->toArray();

        $createdTeamCategory = $this->teamCategoryRepo->create($teamCategory);

        $createdTeamCategory = $createdTeamCategory->toArray();
        $this->assertArrayHasKey('id', $createdTeamCategory);
        $this->assertNotNull($createdTeamCategory['id'], 'Created TeamCategory must have id specified');
        $this->assertNotNull(TeamCategory::find($createdTeamCategory['id']), 'TeamCategory with given id must be in DB');
        $this->assertModelData($teamCategory, $createdTeamCategory);
    }

    /**
     * @test read
     */
    public function test_read_team_category()
    {
        $teamCategory = TeamCategory::factory()->create();

        $dbTeamCategory = $this->teamCategoryRepo->find($teamCategory->id);

        $dbTeamCategory = $dbTeamCategory->toArray();
        $this->assertModelData($teamCategory->toArray(), $dbTeamCategory);
    }

    /**
     * @test update
     */
    public function test_update_team_category()
    {
        $teamCategory = TeamCategory::factory()->create();
        $fakeTeamCategory = TeamCategory::factory()->make()->toArray();

        $updatedTeamCategory = $this->teamCategoryRepo->update($fakeTeamCategory, $teamCategory->id);

        $this->assertModelData($fakeTeamCategory, $updatedTeamCategory->toArray());
        $dbTeamCategory = $this->teamCategoryRepo->find($teamCategory->id);
        $this->assertModelData($fakeTeamCategory, $dbTeamCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_team_category()
    {
        $teamCategory = TeamCategory::factory()->create();

        $resp = $this->teamCategoryRepo->delete($teamCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(TeamCategory::find($teamCategory->id), 'TeamCategory should not exist in DB');
    }
}
