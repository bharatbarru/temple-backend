<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PhotoGallery;

class PhotoGalleryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_photo_gallery()
    {
        $photoGallery = PhotoGallery::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/photo-galleries', $photoGallery
        );

        $this->assertApiResponse($photoGallery);
    }

    /**
     * @test
     */
    public function test_read_photo_gallery()
    {
        $photoGallery = PhotoGallery::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/photo-galleries/'.$photoGallery->id
        );

        $this->assertApiResponse($photoGallery->toArray());
    }

    /**
     * @test
     */
    public function test_update_photo_gallery()
    {
        $photoGallery = PhotoGallery::factory()->create();
        $editedPhotoGallery = PhotoGallery::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/photo-galleries/'.$photoGallery->id,
            $editedPhotoGallery
        );

        $this->assertApiResponse($editedPhotoGallery);
    }

    /**
     * @test
     */
    public function test_delete_photo_gallery()
    {
        $photoGallery = PhotoGallery::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/photo-galleries/'.$photoGallery->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/photo-galleries/'.$photoGallery->id
        );

        $this->response->assertStatus(404);
    }
}
