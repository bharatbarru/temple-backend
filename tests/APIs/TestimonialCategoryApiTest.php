<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TestimonialCategory;

class TestimonialCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_testimonial_category()
    {
        $testimonialCategory = TestimonialCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/testimonial-categories', $testimonialCategory
        );

        $this->assertApiResponse($testimonialCategory);
    }

    /**
     * @test
     */
    public function test_read_testimonial_category()
    {
        $testimonialCategory = TestimonialCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/testimonial-categories/'.$testimonialCategory->id
        );

        $this->assertApiResponse($testimonialCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_testimonial_category()
    {
        $testimonialCategory = TestimonialCategory::factory()->create();
        $editedTestimonialCategory = TestimonialCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/testimonial-categories/'.$testimonialCategory->id,
            $editedTestimonialCategory
        );

        $this->assertApiResponse($editedTestimonialCategory);
    }

    /**
     * @test
     */
    public function test_delete_testimonial_category()
    {
        $testimonialCategory = TestimonialCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/testimonial-categories/'.$testimonialCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/testimonial-categories/'.$testimonialCategory->id
        );

        $this->response->assertStatus(404);
    }
}
