<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\FaqCategory;

class FaqCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_faq_category()
    {
        $faqCategory = FaqCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/faq-categories', $faqCategory
        );

        $this->assertApiResponse($faqCategory);
    }

    /**
     * @test
     */
    public function test_read_faq_category()
    {
        $faqCategory = FaqCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/faq-categories/'.$faqCategory->id
        );

        $this->assertApiResponse($faqCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_faq_category()
    {
        $faqCategory = FaqCategory::factory()->create();
        $editedFaqCategory = FaqCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/faq-categories/'.$faqCategory->id,
            $editedFaqCategory
        );

        $this->assertApiResponse($editedFaqCategory);
    }

    /**
     * @test
     */
    public function test_delete_faq_category()
    {
        $faqCategory = FaqCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/faq-categories/'.$faqCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/faq-categories/'.$faqCategory->id
        );

        $this->response->assertStatus(404);
    }
}
