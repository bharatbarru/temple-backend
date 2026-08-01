<?php

namespace Tests\Repositories;

use App\Models\TestimonialCategory;
use App\Repositories\TestimonialCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TestimonialCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected TestimonialCategoryRepository $testimonialCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->testimonialCategoryRepo = app(TestimonialCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_testimonial_category()
    {
        $testimonialCategory = TestimonialCategory::factory()->make()->toArray();

        $createdTestimonialCategory = $this->testimonialCategoryRepo->create($testimonialCategory);

        $createdTestimonialCategory = $createdTestimonialCategory->toArray();
        $this->assertArrayHasKey('id', $createdTestimonialCategory);
        $this->assertNotNull($createdTestimonialCategory['id'], 'Created TestimonialCategory must have id specified');
        $this->assertNotNull(TestimonialCategory::find($createdTestimonialCategory['id']), 'TestimonialCategory with given id must be in DB');
        $this->assertModelData($testimonialCategory, $createdTestimonialCategory);
    }

    /**
     * @test read
     */
    public function test_read_testimonial_category()
    {
        $testimonialCategory = TestimonialCategory::factory()->create();

        $dbTestimonialCategory = $this->testimonialCategoryRepo->find($testimonialCategory->id);

        $dbTestimonialCategory = $dbTestimonialCategory->toArray();
        $this->assertModelData($testimonialCategory->toArray(), $dbTestimonialCategory);
    }

    /**
     * @test update
     */
    public function test_update_testimonial_category()
    {
        $testimonialCategory = TestimonialCategory::factory()->create();
        $fakeTestimonialCategory = TestimonialCategory::factory()->make()->toArray();

        $updatedTestimonialCategory = $this->testimonialCategoryRepo->update($fakeTestimonialCategory, $testimonialCategory->id);

        $this->assertModelData($fakeTestimonialCategory, $updatedTestimonialCategory->toArray());
        $dbTestimonialCategory = $this->testimonialCategoryRepo->find($testimonialCategory->id);
        $this->assertModelData($fakeTestimonialCategory, $dbTestimonialCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_testimonial_category()
    {
        $testimonialCategory = TestimonialCategory::factory()->create();

        $resp = $this->testimonialCategoryRepo->delete($testimonialCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(TestimonialCategory::find($testimonialCategory->id), 'TestimonialCategory should not exist in DB');
    }
}
