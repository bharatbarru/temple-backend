<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PhotoGalleryCategory;

class PhotoGalleryCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_photo_gallery_category()
    {
        $photoGalleryCategory = PhotoGalleryCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/photo-gallery-categories', $photoGalleryCategory
        );

        $this->assertApiResponse($photoGalleryCategory);
    }

    /**
     * @test
     */
    public function test_read_photo_gallery_category()
    {
        $photoGalleryCategory = PhotoGalleryCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/photo-gallery-categories/'.$photoGalleryCategory->id
        );

        $this->assertApiResponse($photoGalleryCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_photo_gallery_category()
    {
        $photoGalleryCategory = PhotoGalleryCategory::factory()->create();
        $editedPhotoGalleryCategory = PhotoGalleryCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/photo-gallery-categories/'.$photoGalleryCategory->id,
            $editedPhotoGalleryCategory
        );

        $this->assertApiResponse($editedPhotoGalleryCategory);
    }

    /**
     * @test
     */
    public function test_delete_photo_gallery_category()
    {
        $photoGalleryCategory = PhotoGalleryCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/photo-gallery-categories/'.$photoGalleryCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/photo-gallery-categories/'.$photoGalleryCategory->id
        );

        $this->response->assertStatus(404);
    }
}
