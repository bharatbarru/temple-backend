<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\FrontendUser;

class FrontendUserApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_frontend_user()
    {
        $frontendUser = FrontendUser::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/frontendUsers', $frontendUser
        );

        $this->assertApiResponse($frontendUser);
    }

    /**
     * @test
     */
    public function test_read_frontend_user()
    {
        $frontendUser = FrontendUser::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/frontendUsers/'.$frontendUser->id
        );

        $this->assertApiResponse($frontendUser->toArray());
    }

    /**
     * @test
     */
    public function test_update_frontend_user()
    {
        $frontendUser = FrontendUser::factory()->create();
        $editedFrontendUser = FrontendUser::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/frontendUsers/'.$frontendUser->id,
            $editedFrontendUser
        );

        $this->assertApiResponse($editedFrontendUser);
    }

    /**
     * @test
     */
    public function test_delete_frontend_user()
    {
        $frontendUser = FrontendUser::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/frontendUsers/'.$frontendUser->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/frontendUsers/'.$frontendUser->id
        );

        $this->response->assertStatus(404);
    }
}
