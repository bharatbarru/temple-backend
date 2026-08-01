<?php

namespace Tests\Repositories;

use App\Models\PhotoGalleryCategory;
use App\Repositories\PhotoGalleryCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PhotoGalleryCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected PhotoGalleryCategoryRepository $photoGalleryCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->photoGalleryCategoryRepo = app(PhotoGalleryCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_photo_gallery_category()
    {
        $photoGalleryCategory = PhotoGalleryCategory::factory()->make()->toArray();

        $createdPhotoGalleryCategory = $this->photoGalleryCategoryRepo->create($photoGalleryCategory);

        $createdPhotoGalleryCategory = $createdPhotoGalleryCategory->toArray();
        $this->assertArrayHasKey('id', $createdPhotoGalleryCategory);
        $this->assertNotNull($createdPhotoGalleryCategory['id'], 'Created PhotoGalleryCategory must have id specified');
        $this->assertNotNull(PhotoGalleryCategory::find($createdPhotoGalleryCategory['id']), 'PhotoGalleryCategory with given id must be in DB');
        $this->assertModelData($photoGalleryCategory, $createdPhotoGalleryCategory);
    }

    /**
     * @test read
     */
    public function test_read_photo_gallery_category()
    {
        $photoGalleryCategory = PhotoGalleryCategory::factory()->create();

        $dbPhotoGalleryCategory = $this->photoGalleryCategoryRepo->find($photoGalleryCategory->id);

        $dbPhotoGalleryCategory = $dbPhotoGalleryCategory->toArray();
        $this->assertModelData($photoGalleryCategory->toArray(), $dbPhotoGalleryCategory);
    }

    /**
     * @test update
     */
    public function test_update_photo_gallery_category()
    {
        $photoGalleryCategory = PhotoGalleryCategory::factory()->create();
        $fakePhotoGalleryCategory = PhotoGalleryCategory::factory()->make()->toArray();

        $updatedPhotoGalleryCategory = $this->photoGalleryCategoryRepo->update($fakePhotoGalleryCategory, $photoGalleryCategory->id);

        $this->assertModelData($fakePhotoGalleryCategory, $updatedPhotoGalleryCategory->toArray());
        $dbPhotoGalleryCategory = $this->photoGalleryCategoryRepo->find($photoGalleryCategory->id);
        $this->assertModelData($fakePhotoGalleryCategory, $dbPhotoGalleryCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_photo_gallery_category()
    {
        $photoGalleryCategory = PhotoGalleryCategory::factory()->create();

        $resp = $this->photoGalleryCategoryRepo->delete($photoGalleryCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(PhotoGalleryCategory::find($photoGalleryCategory->id), 'PhotoGalleryCategory should not exist in DB');
    }
}
