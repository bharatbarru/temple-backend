<?php

namespace Tests\Repositories;

use App\Models\FrontendUser;
use App\Repositories\FrontendUserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FrontendUserRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected FrontendUserRepository $frontendUserRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->frontendUserRepo = app(FrontendUserRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_frontend_user()
    {
        $frontendUser = FrontendUser::factory()->make()->toArray();

        $createdFrontendUser = $this->frontendUserRepo->create($frontendUser);

        $createdFrontendUser = $createdFrontendUser->toArray();
        $this->assertArrayHasKey('id', $createdFrontendUser);
        $this->assertNotNull($createdFrontendUser['id'], 'Created FrontendUser must have id specified');
        $this->assertNotNull(FrontendUser::find($createdFrontendUser['id']), 'FrontendUser with given id must be in DB');
        $this->assertModelData($frontendUser, $createdFrontendUser);
    }

    /**
     * @test read
     */
    public function test_read_frontend_user()
    {
        $frontendUser = FrontendUser::factory()->create();

        $dbFrontendUser = $this->frontendUserRepo->find($frontendUser->id);

        $dbFrontendUser = $dbFrontendUser->toArray();
        $this->assertModelData($frontendUser->toArray(), $dbFrontendUser);
    }

    /**
     * @test update
     */
    public function test_update_frontend_user()
    {
        $frontendUser = FrontendUser::factory()->create();
        $fakeFrontendUser = FrontendUser::factory()->make()->toArray();

        $updatedFrontendUser = $this->frontendUserRepo->update($fakeFrontendUser, $frontendUser->id);

        $this->assertModelData($fakeFrontendUser, $updatedFrontendUser->toArray());
        $dbFrontendUser = $this->frontendUserRepo->find($frontendUser->id);
        $this->assertModelData($fakeFrontendUser, $dbFrontendUser->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_frontend_user()
    {
        $frontendUser = FrontendUser::factory()->create();

        $resp = $this->frontendUserRepo->delete($frontendUser->id);

        $this->assertTrue($resp);
        $this->assertNull(FrontendUser::find($frontendUser->id), 'FrontendUser should not exist in DB');
    }
}
