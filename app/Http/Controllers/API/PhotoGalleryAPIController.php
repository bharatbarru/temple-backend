<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePhotoGalleryAPIRequest;
use App\Http\Requests\API\UpdatePhotoGalleryAPIRequest;
use App\Models\PhotoGallery;
use App\Repositories\PhotoGalleryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PhotoGalleryResource;
use App\Models\PhotoGalleryCategory;

/**
 * Class PhotoGalleryController
 */

class PhotoGalleryAPIController extends AppBaseController
{
    /** @var  PhotoGalleryRepository */
    private $photoGalleryRepository;

    public function __construct(PhotoGalleryRepository $photoGalleryRepo)
    {
        $this->photoGalleryRepository = $photoGalleryRepo;
    }

    /**
     * @OA\Get(
     *      path="/photo-galleries",
     *      summary="getPhotoGalleryList",
     *      tags={"PhotoGallery"},
     *      description="Get all PhotoGalleries",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/PhotoGallery")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $photoGalleryCategory = PhotoGalleryCategory::where('type', 'homepage')->first();
        $photoGalleries = null;

        if ($photoGalleryCategory) {
            $photoGalleries = PhotoGallery::where('photo_category_id', $photoGalleryCategory->id)
                ->select('title', 'image_gallery', 'image_alt_text')
                ->first();

            if ($photoGalleries && !empty($photoGalleries->image_gallery)) {
                // Decode the JSON string into an array
                $imageGallery = json_decode($photoGalleries->image_gallery, true);

                // Update each image path to include the full URL
                foreach ($imageGallery as &$image) {
                    if (!empty($image['path'])) {
                        $image['path'] = url(PHOTO_GALLERY_IMAGE_PATH . $image['path']);
                    }
                }

                // Encode the updated array back to JSON
                $photoGalleries->image_gallery = json_encode($imageGallery);
            }
        }

        return $this->sendResponse(
            $photoGalleries ? $photoGalleries->toArray() : [],
            'Photo Galleries retrieved successfully'
        );
    }


    /**
     * @OA\Post(
     *      path="/photo-galleries",
     *      summary="createPhotoGallery",
     *      tags={"PhotoGallery"},
     *      description="Create PhotoGallery",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/PhotoGallery")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/PhotoGallery"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePhotoGalleryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $photoGallery = $this->photoGalleryRepository->create($input);

        return $this->sendResponse(new PhotoGalleryResource($photoGallery), 'Photo Gallery saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/photo-galleries/{id}",
     *      summary="getPhotoGalleryItem",
     *      tags={"PhotoGallery"},
     *      description="Get PhotoGallery",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PhotoGallery",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/PhotoGallery"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id): JsonResponse
    {
        /** @var PhotoGallery $photoGalleries */
        $photoGalleries = PhotoGallery::where('photo_category_id', $id)
                            ->select('title', 'description', 'image_gallery')
                            ->get();

        if ($photoGalleries->isEmpty()) {
            return $this->sendError('Photo Gallery not found');
        }

        // Loop through each photo gallery and update the image gallery paths
        foreach ($photoGalleries as &$photoGallery) {
            if (!empty($photoGallery->image_gallery)) {
                // Decode the JSON string into an array
                $imageGallery = json_decode($photoGallery->image_gallery, true);

                // Update each image path to include the full URL
                foreach ($imageGallery as &$image) {
                    if (!empty($image['path'])) {
                        $image['path'] = url(PHOTO_GALLERY_IMAGE_PATH . $image['path']);
                    }
                }

                // Encode the updated array back to JSON
                $photoGallery->image_gallery = json_encode($imageGallery);
            }
        }

        return $this->sendResponse($photoGalleries->toArray(), 'Photo Gallery retrieved successfully');
    }


    /**
     * @OA\Put(
     *      path="/photo-galleries/{id}",
     *      summary="updatePhotoGallery",
     *      tags={"PhotoGallery"},
     *      description="Update PhotoGallery",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PhotoGallery",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/PhotoGallery")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/PhotoGallery"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePhotoGalleryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var PhotoGallery $photoGallery */
        $photoGallery = $this->photoGalleryRepository->find($id);

        if (empty($photoGallery)) {
            return $this->sendError('Photo Gallery not found');
        }

        $photoGallery = $this->photoGalleryRepository->update($input, $id);

        return $this->sendResponse(new PhotoGalleryResource($photoGallery), 'PhotoGallery updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/photo-galleries/{id}",
     *      summary="deletePhotoGallery",
     *      tags={"PhotoGallery"},
     *      description="Delete PhotoGallery",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PhotoGallery",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id): JsonResponse
    {
        /** @var PhotoGallery $photoGallery */
        $photoGallery = $this->photoGalleryRepository->find($id);

        if (empty($photoGallery)) {
            return $this->sendError('Photo Gallery not found');
        }

        $photoGallery->delete();

        return $this->sendSuccess('Photo Gallery deleted successfully');
    }
}
