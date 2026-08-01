<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePhotoGalleryCategoryAPIRequest;
use App\Http\Requests\API\UpdatePhotoGalleryCategoryAPIRequest;
use App\Models\PhotoGalleryCategory;
use App\Repositories\PhotoGalleryCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PhotoGalleryCategoryResource;

/**
 * Class PhotoGalleryCategoryController
 */

class PhotoGalleryCategoryAPIController extends AppBaseController
{
    /** @var  PhotoGalleryCategoryRepository */
    private $photoGalleryCategoryRepository;

    public function __construct(PhotoGalleryCategoryRepository $photoGalleryCategoryRepo)
    {
        $this->photoGalleryCategoryRepository = $photoGalleryCategoryRepo;
    }

    /**
     * @OA\Get(
     *      path="/photo-gallery-categories",
     *      summary="getPhotoGalleryCategoryList",
     *      tags={"PhotoGalleryCategory"},
     *      description="Get all PhotoGalleryCategories",
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
     *                  @OA\Items(ref="#/components/schemas/PhotoGalleryCategory")
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
        $photoGalleryCategories = $this->photoGalleryCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        )->where('type', 'gallery');

        return $this->sendResponse(PhotoGalleryCategoryResource::collection($photoGalleryCategories), 'Photo Gallery Categories retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/photo-gallery-categories",
     *      summary="createPhotoGalleryCategory",
     *      tags={"PhotoGalleryCategory"},
     *      description="Create PhotoGalleryCategory",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/PhotoGalleryCategory")
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
     *                  ref="#/components/schemas/PhotoGalleryCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePhotoGalleryCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $photoGalleryCategory = $this->photoGalleryCategoryRepository->create($input);

        return $this->sendResponse(new PhotoGalleryCategoryResource($photoGalleryCategory), 'Photo Gallery Category saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/photo-gallery-categories/{id}",
     *      summary="getPhotoGalleryCategoryItem",
     *      tags={"PhotoGalleryCategory"},
     *      description="Get PhotoGalleryCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PhotoGalleryCategory",
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
     *                  ref="#/components/schemas/PhotoGalleryCategory"
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
        /** @var PhotoGalleryCategory $photoGalleryCategory */
        $photoGalleryCategory = $this->photoGalleryCategoryRepository->find($id);

        if (empty($photoGalleryCategory)) {
            return $this->sendError('Photo Gallery Category not found');
        }

        return $this->sendResponse(new PhotoGalleryCategoryResource($photoGalleryCategory), 'Photo Gallery Category retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/photo-gallery-categories/{id}",
     *      summary="updatePhotoGalleryCategory",
     *      tags={"PhotoGalleryCategory"},
     *      description="Update PhotoGalleryCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PhotoGalleryCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/PhotoGalleryCategory")
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
     *                  ref="#/components/schemas/PhotoGalleryCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePhotoGalleryCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var PhotoGalleryCategory $photoGalleryCategory */
        $photoGalleryCategory = $this->photoGalleryCategoryRepository->find($id);

        if (empty($photoGalleryCategory)) {
            return $this->sendError('Photo Gallery Category not found');
        }

        $photoGalleryCategory = $this->photoGalleryCategoryRepository->update($input, $id);

        return $this->sendResponse(new PhotoGalleryCategoryResource($photoGalleryCategory), 'PhotoGalleryCategory updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/photo-gallery-categories/{id}",
     *      summary="deletePhotoGalleryCategory",
     *      tags={"PhotoGalleryCategory"},
     *      description="Delete PhotoGalleryCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PhotoGalleryCategory",
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
        /** @var PhotoGalleryCategory $photoGalleryCategory */
        $photoGalleryCategory = $this->photoGalleryCategoryRepository->find($id);

        if (empty($photoGalleryCategory)) {
            return $this->sendError('Photo Gallery Category not found');
        }

        $photoGalleryCategory->delete();

        return $this->sendSuccess('Photo Gallery Category deleted successfully');
    }
}
