<?php

namespace Tests\Repositories;

use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BlogPostRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected BlogPostRepository $blogPostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->blogPostRepo = app(BlogPostRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_blog_post()
    {
        $blogPost = BlogPost::factory()->make()->toArray();

        $createdBlogPost = $this->blogPostRepo->create($blogPost);

        $createdBlogPost = $createdBlogPost->toArray();
        $this->assertArrayHasKey('id', $createdBlogPost);
        $this->assertNotNull($createdBlogPost['id'], 'Created BlogPost must have id specified');
        $this->assertNotNull(BlogPost::find($createdBlogPost['id']), 'BlogPost with given id must be in DB');
        $this->assertModelData($blogPost, $createdBlogPost);
    }

    /**
     * @test read
     */
    public function test_read_blog_post()
    {
        $blogPost = BlogPost::factory()->create();

        $dbBlogPost = $this->blogPostRepo->find($blogPost->id);

        $dbBlogPost = $dbBlogPost->toArray();
        $this->assertModelData($blogPost->toArray(), $dbBlogPost);
    }

    /**
     * @test update
     */
    public function test_update_blog_post()
    {
        $blogPost = BlogPost::factory()->create();
        $fakeBlogPost = BlogPost::factory()->make()->toArray();

        $updatedBlogPost = $this->blogPostRepo->update($fakeBlogPost, $blogPost->id);

        $this->assertModelData($fakeBlogPost, $updatedBlogPost->toArray());
        $dbBlogPost = $this->blogPostRepo->find($blogPost->id);
        $this->assertModelData($fakeBlogPost, $dbBlogPost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_blog_post()
    {
        $blogPost = BlogPost::factory()->create();

        $resp = $this->blogPostRepo->delete($blogPost->id);

        $this->assertTrue($resp);
        $this->assertNull(BlogPost::find($blogPost->id), 'BlogPost should not exist in DB');
    }
}
