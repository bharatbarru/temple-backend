<?php

namespace Tests\Repositories;

use App\Models\EventCategory;
use App\Repositories\EventCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EventCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected EventCategoryRepository $eventCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->eventCategoryRepo = app(EventCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_event_category()
    {
        $eventCategory = EventCategory::factory()->make()->toArray();

        $createdEventCategory = $this->eventCategoryRepo->create($eventCategory);

        $createdEventCategory = $createdEventCategory->toArray();
        $this->assertArrayHasKey('id', $createdEventCategory);
        $this->assertNotNull($createdEventCategory['id'], 'Created EventCategory must have id specified');
        $this->assertNotNull(EventCategory::find($createdEventCategory['id']), 'EventCategory with given id must be in DB');
        $this->assertModelData($eventCategory, $createdEventCategory);
    }

    /**
     * @test read
     */
    public function test_read_event_category()
    {
        $eventCategory = EventCategory::factory()->create();

        $dbEventCategory = $this->eventCategoryRepo->find($eventCategory->id);

        $dbEventCategory = $dbEventCategory->toArray();
        $this->assertModelData($eventCategory->toArray(), $dbEventCategory);
    }

    /**
     * @test update
     */
    public function test_update_event_category()
    {
        $eventCategory = EventCategory::factory()->create();
        $fakeEventCategory = EventCategory::factory()->make()->toArray();

        $updatedEventCategory = $this->eventCategoryRepo->update($fakeEventCategory, $eventCategory->id);

        $this->assertModelData($fakeEventCategory, $updatedEventCategory->toArray());
        $dbEventCategory = $this->eventCategoryRepo->find($eventCategory->id);
        $this->assertModelData($fakeEventCategory, $dbEventCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_event_category()
    {
        $eventCategory = EventCategory::factory()->create();

        $resp = $this->eventCategoryRepo->delete($eventCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(EventCategory::find($eventCategory->id), 'EventCategory should not exist in DB');
    }
}
