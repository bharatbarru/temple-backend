<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\EventCategory;

class EventCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_event_category()
    {
        $eventCategory = EventCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/eventCategories', $eventCategory
        );

        $this->assertApiResponse($eventCategory);
    }

    /**
     * @test
     */
    public function test_read_event_category()
    {
        $eventCategory = EventCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/eventCategories/'.$eventCategory->id
        );

        $this->assertApiResponse($eventCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_event_category()
    {
        $eventCategory = EventCategory::factory()->create();
        $editedEventCategory = EventCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/eventCategories/'.$eventCategory->id,
            $editedEventCategory
        );

        $this->assertApiResponse($editedEventCategory);
    }

    /**
     * @test
     */
    public function test_delete_event_category()
    {
        $eventCategory = EventCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/eventCategories/'.$eventCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/eventCategories/'.$eventCategory->id
        );

        $this->response->assertStatus(404);
    }
}
