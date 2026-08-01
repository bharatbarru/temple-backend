<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\HallAddon;

class HallAddonApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_hall_addon()
    {
        $hallAddon = HallAddon::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/hallAddons', $hallAddon
        );

        $this->assertApiResponse($hallAddon);
    }

    /**
     * @test
     */
    public function test_read_hall_addon()
    {
        $hallAddon = HallAddon::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/hallAddons/'.$hallAddon->id
        );

        $this->assertApiResponse($hallAddon->toArray());
    }

    /**
     * @test
     */
    public function test_update_hall_addon()
    {
        $hallAddon = HallAddon::factory()->create();
        $editedHallAddon = HallAddon::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/hallAddons/'.$hallAddon->id,
            $editedHallAddon
        );

        $this->assertApiResponse($editedHallAddon);
    }

    /**
     * @test
     */
    public function test_delete_hall_addon()
    {
        $hallAddon = HallAddon::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/hallAddons/'.$hallAddon->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/hallAddons/'.$hallAddon->id
        );

        $this->response->assertStatus(404);
    }
}
