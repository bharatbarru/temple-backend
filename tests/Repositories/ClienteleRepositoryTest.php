<?php

namespace Tests\Repositories;

use App\Models\Clientele;
use App\Repositories\ClienteleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ClienteleRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected ClienteleRepository $clienteleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->clienteleRepo = app(ClienteleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_clientele()
    {
        $clientele = Clientele::factory()->make()->toArray();

        $createdClientele = $this->clienteleRepo->create($clientele);

        $createdClientele = $createdClientele->toArray();
        $this->assertArrayHasKey('id', $createdClientele);
        $this->assertNotNull($createdClientele['id'], 'Created Clientele must have id specified');
        $this->assertNotNull(Clientele::find($createdClientele['id']), 'Clientele with given id must be in DB');
        $this->assertModelData($clientele, $createdClientele);
    }

    /**
     * @test read
     */
    public function test_read_clientele()
    {
        $clientele = Clientele::factory()->create();

        $dbClientele = $this->clienteleRepo->find($clientele->id);

        $dbClientele = $dbClientele->toArray();
        $this->assertModelData($clientele->toArray(), $dbClientele);
    }

    /**
     * @test update
     */
    public function test_update_clientele()
    {
        $clientele = Clientele::factory()->create();
        $fakeClientele = Clientele::factory()->make()->toArray();

        $updatedClientele = $this->clienteleRepo->update($fakeClientele, $clientele->id);

        $this->assertModelData($fakeClientele, $updatedClientele->toArray());
        $dbClientele = $this->clienteleRepo->find($clientele->id);
        $this->assertModelData($fakeClientele, $dbClientele->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_clientele()
    {
        $clientele = Clientele::factory()->create();

        $resp = $this->clienteleRepo->delete($clientele->id);

        $this->assertTrue($resp);
        $this->assertNull(Clientele::find($clientele->id), 'Clientele should not exist in DB');
    }
}
