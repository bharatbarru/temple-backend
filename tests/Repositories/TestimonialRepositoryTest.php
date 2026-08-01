<?php

namespace Tests\Repositories;

use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TestimonialRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected TestimonialRepository $testimonialRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->testimonialRepo = app(TestimonialRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_testimonial()
    {
        $testimonial = Testimonial::factory()->make()->toArray();

        $createdTestimonial = $this->testimonialRepo->create($testimonial);

        $createdTestimonial = $createdTestimonial->toArray();
        $this->assertArrayHasKey('id', $createdTestimonial);
        $this->assertNotNull($createdTestimonial['id'], 'Created Testimonial must have id specified');
        $this->assertNotNull(Testimonial::find($createdTestimonial['id']), 'Testimonial with given id must be in DB');
        $this->assertModelData($testimonial, $createdTestimonial);
    }

    /**
     * @test read
     */
    public function test_read_testimonial()
    {
        $testimonial = Testimonial::factory()->create();

        $dbTestimonial = $this->testimonialRepo->find($testimonial->id);

        $dbTestimonial = $dbTestimonial->toArray();
        $this->assertModelData($testimonial->toArray(), $dbTestimonial);
    }

    /**
     * @test update
     */
    public function test_update_testimonial()
    {
        $testimonial = Testimonial::factory()->create();
        $fakeTestimonial = Testimonial::factory()->make()->toArray();

        $updatedTestimonial = $this->testimonialRepo->update($fakeTestimonial, $testimonial->id);

        $this->assertModelData($fakeTestimonial, $updatedTestimonial->toArray());
        $dbTestimonial = $this->testimonialRepo->find($testimonial->id);
        $this->assertModelData($fakeTestimonial, $dbTestimonial->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_testimonial()
    {
        $testimonial = Testimonial::factory()->create();

        $resp = $this->testimonialRepo->delete($testimonial->id);

        $this->assertTrue($resp);
        $this->assertNull(Testimonial::find($testimonial->id), 'Testimonial should not exist in DB');
    }
}
