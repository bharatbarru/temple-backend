<?php

namespace Tests\Repositories;

use App\Models\news;
use App\Repositories\newsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class newsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected newsRepository $newsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->newsRepo = app(newsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_news()
    {
        $news = news::factory()->make()->toArray();

        $creatednews = $this->newsRepo->create($news);

        $creatednews = $creatednews->toArray();
        $this->assertArrayHasKey('id', $creatednews);
        $this->assertNotNull($creatednews['id'], 'Created news must have id specified');
        $this->assertNotNull(news::find($creatednews['id']), 'news with given id must be in DB');
        $this->assertModelData($news, $creatednews);
    }

    /**
     * @test read
     */
    public function test_read_news()
    {
        $news = news::factory()->create();

        $dbnews = $this->newsRepo->find($news->id);

        $dbnews = $dbnews->toArray();
        $this->assertModelData($news->toArray(), $dbnews);
    }

    /**
     * @test update
     */
    public function test_update_news()
    {
        $news = news::factory()->create();
        $fakenews = news::factory()->make()->toArray();

        $updatednews = $this->newsRepo->update($fakenews, $news->id);

        $this->assertModelData($fakenews, $updatednews->toArray());
        $dbnews = $this->newsRepo->find($news->id);
        $this->assertModelData($fakenews, $dbnews->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_news()
    {
        $news = news::factory()->create();

        $resp = $this->newsRepo->delete($news->id);

        $this->assertTrue($resp);
        $this->assertNull(news::find($news->id), 'news should not exist in DB');
    }
}
