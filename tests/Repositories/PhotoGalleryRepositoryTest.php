<?php

namespace Tests\Repositories;

use App\Models\PhotoGallery;
use App\Repositories\PhotoGalleryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PhotoGalleryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected PhotoGalleryRepository $photoGalleryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->photoGalleryRepo = app(PhotoGalleryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_photo_gallery()
    {
        $photoGallery = PhotoGallery::factory()->make()->toArray();

        $createdPhotoGallery = $this->photoGalleryRepo->create($photoGallery);

        $createdPhotoGallery = $createdPhotoGallery->toArray();
        $this->assertArrayHasKey('id', $createdPhotoGallery);
        $this->assertNotNull($createdPhotoGallery['id'], 'Created PhotoGallery must have id specified');
        $this->assertNotNull(PhotoGallery::find($createdPhotoGallery['id']), 'PhotoGallery with given id must be in DB');
        $this->assertModelData($photoGallery, $createdPhotoGallery);
    }

    /**
     * @test read
     */
    public function test_read_photo_gallery()
    {
        $photoGallery = PhotoGallery::factory()->create();

        $dbPhotoGallery = $this->photoGalleryRepo->find($photoGallery->id);

        $dbPhotoGallery = $dbPhotoGallery->toArray();
        $this->assertModelData($photoGallery->toArray(), $dbPhotoGallery);
    }

    /**
     * @test update
     */
    public function test_update_photo_gallery()
    {
        $photoGallery = PhotoGallery::factory()->create();
        $fakePhotoGallery = PhotoGallery::factory()->make()->toArray();

        $updatedPhotoGallery = $this->photoGalleryRepo->update($fakePhotoGallery, $photoGallery->id);

        $this->assertModelData($fakePhotoGallery, $updatedPhotoGallery->toArray());
        $dbPhotoGallery = $this->photoGalleryRepo->find($photoGallery->id);
        $this->assertModelData($fakePhotoGallery, $dbPhotoGallery->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_photo_gallery()
    {
        $photoGallery = PhotoGallery::factory()->create();

        $resp = $this->photoGalleryRepo->delete($photoGallery->id);

        $this->assertTrue($resp);
        $this->assertNull(PhotoGallery::find($photoGallery->id), 'PhotoGallery should not exist in DB');
    }
}
