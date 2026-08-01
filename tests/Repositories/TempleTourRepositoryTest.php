<?php

namespace Tests\Repositories;

use App\Models\TempleTour;
use App\Repositories\TempleTourRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TempleTourRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected TempleTourRepository $templeTourRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->templeTourRepo = app(TempleTourRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_temple_tour()
    {
        $templeTour = TempleTour::factory()->make()->toArray();

        $createdTempleTour = $this->templeTourRepo->create($templeTour);

        $createdTempleTour = $createdTempleTour->toArray();
        $this->assertArrayHasKey('id', $createdTempleTour);
        $this->assertNotNull($createdTempleTour['id'], 'Created TempleTour must have id specified');
        $this->assertNotNull(TempleTour::find($createdTempleTour['id']), 'TempleTour with given id must be in DB');
        $this->assertModelData($templeTour, $createdTempleTour);
    }

    /**
     * @test read
     */
    public function test_read_temple_tour()
    {
        $templeTour = TempleTour::factory()->create();

        $dbTempleTour = $this->templeTourRepo->find($templeTour->id);

        $dbTempleTour = $dbTempleTour->toArray();
        $this->assertModelData($templeTour->toArray(), $dbTempleTour);
    }

    /**
     * @test update
     */
    public function test_update_temple_tour()
    {
        $templeTour = TempleTour::factory()->create();
        $fakeTempleTour = TempleTour::factory()->make()->toArray();

        $updatedTempleTour = $this->templeTourRepo->update($fakeTempleTour, $templeTour->id);

        $this->assertModelData($fakeTempleTour, $updatedTempleTour->toArray());
        $dbTempleTour = $this->templeTourRepo->find($templeTour->id);
        $this->assertModelData($fakeTempleTour, $dbTempleTour->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_temple_tour()
    {
        $templeTour = TempleTour::factory()->create();

        $resp = $this->templeTourRepo->delete($templeTour->id);

        $this->assertTrue($resp);
        $this->assertNull(TempleTour::find($templeTour->id), 'TempleTour should not exist in DB');
    }
}
