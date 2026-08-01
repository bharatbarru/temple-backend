<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\BlogCategory;

class BlogCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_blog_category()
    {
        $blogCategory = BlogCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/blog-categories', $blogCategory
        );

        $this->assertApiResponse($blogCategory);
    }

    /**
     * @test
     */
    public function test_read_blog_category()
    {
        $blogCategory = BlogCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/blog-categories/'.$blogCategory->id
        );

        $this->assertApiResponse($blogCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_blog_category()
    {
        $blogCategory = BlogCategory::factory()->create();
        $editedBlogCategory = BlogCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/blog-categories/'.$blogCategory->id,
            $editedBlogCategory
        );

        $this->assertApiResponse($editedBlogCategory);
    }

    /**
     * @test
     */
    public function test_delete_blog_category()
    {
        $blogCategory = BlogCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/blog-categories/'.$blogCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/blog-categories/'.$blogCategory->id
        );

        $this->response->assertStatus(404);
    }
}
