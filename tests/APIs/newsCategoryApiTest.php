<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\newsCategory;

class newsCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_news_category()
    {
        $newsCategory = newsCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/news-categories', $newsCategory
        );

        $this->assertApiResponse($newsCategory);
    }

    /**
     * @test
     */
    public function test_read_news_category()
    {
        $newsCategory = newsCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/news-categories/'.$newsCategory->id
        );

        $this->assertApiResponse($newsCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_news_category()
    {
        $newsCategory = newsCategory::factory()->create();
        $editednewsCategory = newsCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/news-categories/'.$newsCategory->id,
            $editednewsCategory
        );

        $this->assertApiResponse($editednewsCategory);
    }

    /**
     * @test
     */
    public function test_delete_news_category()
    {
        $newsCategory = newsCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/news-categories/'.$newsCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/news-categories/'.$newsCategory->id
        );

        $this->response->assertStatus(404);
    }
}
