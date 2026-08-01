<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TempleTour;

class TempleTourApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_temple_tour()
    {
        $templeTour = TempleTour::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/templeTours', $templeTour
        );

        $this->assertApiResponse($templeTour);
    }

    /**
     * @test
     */
    public function test_read_temple_tour()
    {
        $templeTour = TempleTour::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/templeTours/'.$templeTour->id
        );

        $this->assertApiResponse($templeTour->toArray());
    }

    /**
     * @test
     */
    public function test_update_temple_tour()
    {
        $templeTour = TempleTour::factory()->create();
        $editedTempleTour = TempleTour::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/templeTours/'.$templeTour->id,
            $editedTempleTour
        );

        $this->assertApiResponse($editedTempleTour);
    }

    /**
     * @test
     */
    public function test_delete_temple_tour()
    {
        $templeTour = TempleTour::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/templeTours/'.$templeTour->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/templeTours/'.$templeTour->id
        );

        $this->response->assertStatus(404);
    }
}
