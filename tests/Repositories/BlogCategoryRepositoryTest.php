<?php

namespace Tests\Repositories;

use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BlogCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected BlogCategoryRepository $blogCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->blogCategoryRepo = app(BlogCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_blog_category()
    {
        $blogCategory = BlogCategory::factory()->make()->toArray();

        $createdBlogCategory = $this->blogCategoryRepo->create($blogCategory);

        $createdBlogCategory = $createdBlogCategory->toArray();
        $this->assertArrayHasKey('id', $createdBlogCategory);
        $this->assertNotNull($createdBlogCategory['id'], 'Created BlogCategory must have id specified');
        $this->assertNotNull(BlogCategory::find($createdBlogCategory['id']), 'BlogCategory with given id must be in DB');
        $this->assertModelData($blogCategory, $createdBlogCategory);
    }

    /**
     * @test read
     */
    public function test_read_blog_category()
    {
        $blogCategory = BlogCategory::factory()->create();

        $dbBlogCategory = $this->blogCategoryRepo->find($blogCategory->id);

        $dbBlogCategory = $dbBlogCategory->toArray();
        $this->assertModelData($blogCategory->toArray(), $dbBlogCategory);
    }

    /**
     * @test update
     */
    public function test_update_blog_category()
    {
        $blogCategory = BlogCategory::factory()->create();
        $fakeBlogCategory = BlogCategory::factory()->make()->toArray();

        $updatedBlogCategory = $this->blogCategoryRepo->update($fakeBlogCategory, $blogCategory->id);

        $this->assertModelData($fakeBlogCategory, $updatedBlogCategory->toArray());
        $dbBlogCategory = $this->blogCategoryRepo->find($blogCategory->id);
        $this->assertModelData($fakeBlogCategory, $dbBlogCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_blog_category()
    {
        $blogCategory = BlogCategory::factory()->create();

        $resp = $this->blogCategoryRepo->delete($blogCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(BlogCategory::find($blogCategory->id), 'BlogCategory should not exist in DB');
    }
}
