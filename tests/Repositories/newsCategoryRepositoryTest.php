<?php

namespace Tests\Repositories;

use App\Models\newsCategory;
use App\Repositories\newsCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class newsCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected newsCategoryRepository $newsCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->newsCategoryRepo = app(newsCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_news_category()
    {
        $newsCategory = newsCategory::factory()->make()->toArray();

        $creatednewsCategory = $this->newsCategoryRepo->create($newsCategory);

        $creatednewsCategory = $creatednewsCategory->toArray();
        $this->assertArrayHasKey('id', $creatednewsCategory);
        $this->assertNotNull($creatednewsCategory['id'], 'Created newsCategory must have id specified');
        $this->assertNotNull(newsCategory::find($creatednewsCategory['id']), 'newsCategory with given id must be in DB');
        $this->assertModelData($newsCategory, $creatednewsCategory);
    }

    /**
     * @test read
     */
    public function test_read_news_category()
    {
        $newsCategory = newsCategory::factory()->create();

        $dbnewsCategory = $this->newsCategoryRepo->find($newsCategory->id);

        $dbnewsCategory = $dbnewsCategory->toArray();
        $this->assertModelData($newsCategory->toArray(), $dbnewsCategory);
    }

    /**
     * @test update
     */
    public function test_update_news_category()
    {
        $newsCategory = newsCategory::factory()->create();
        $fakenewsCategory = newsCategory::factory()->make()->toArray();

        $updatednewsCategory = $this->newsCategoryRepo->update($fakenewsCategory, $newsCategory->id);

        $this->assertModelData($fakenewsCategory, $updatednewsCategory->toArray());
        $dbnewsCategory = $this->newsCategoryRepo->find($newsCategory->id);
        $this->assertModelData($fakenewsCategory, $dbnewsCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_news_category()
    {
        $newsCategory = newsCategory::factory()->create();

        $resp = $this->newsCategoryRepo->delete($newsCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(newsCategory::find($newsCategory->id), 'newsCategory should not exist in DB');
    }
}
