<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateServiceCategoryAPIRequest;
use App\Http\Requests\API\UpdateServiceCategoryAPIRequest;
use App\Models\ServiceCategory;
use App\Repositories\ServiceCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ServiceCategoryResource;

/**
 * Class ServiceCategoryController
 */

class ServiceCategoryAPIController extends AppBaseController
{
    /** @var  ServiceCategoryRepository */
    private $serviceCategoryRepository;

    public function __construct(ServiceCategoryRepository $serviceCategoryRepo)
    {
        $this->serviceCategoryRepository = $serviceCategoryRepo;
    }

    /**
     * @OA\Get(
     *      path="/serviceCategories",
     *      summary="getServiceCategoryList",
     *      tags={"ServiceCategory"},
     *      description="Get all ServiceCategories",
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
     *                  @OA\Items(ref="#/components/schemas/ServiceCategory")
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
        $serviceCategories = $this->serviceCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ServiceCategoryResource::collection($serviceCategories), 'Service Categories retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/serviceCategories",
     *      summary="createServiceCategory",
     *      tags={"ServiceCategory"},
     *      description="Create ServiceCategory",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ServiceCategory")
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
     *                  ref="#/components/schemas/ServiceCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateServiceCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $serviceCategory = $this->serviceCategoryRepository->create($input);

        return $this->sendResponse(new ServiceCategoryResource($serviceCategory), 'Service Category saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/serviceCategories/{id}",
     *      summary="getServiceCategoryItem",
     *      tags={"ServiceCategory"},
     *      description="Get ServiceCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServiceCategory",
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
     *                  ref="#/components/schemas/ServiceCategory"
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
        /** @var ServiceCategory $serviceCategory */
        $serviceCategory = $this->serviceCategoryRepository->find($id);

        if (empty($serviceCategory)) {
            return $this->sendError('Service Category not found');
        }

        return $this->sendResponse(new ServiceCategoryResource($serviceCategory), 'Service Category retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/serviceCategories/{id}",
     *      summary="updateServiceCategory",
     *      tags={"ServiceCategory"},
     *      description="Update ServiceCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServiceCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ServiceCategory")
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
     *                  ref="#/components/schemas/ServiceCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateServiceCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ServiceCategory $serviceCategory */
        $serviceCategory = $this->serviceCategoryRepository->find($id);

        if (empty($serviceCategory)) {
            return $this->sendError('Service Category not found');
        }

        $serviceCategory = $this->serviceCategoryRepository->update($input, $id);

        return $this->sendResponse(new ServiceCategoryResource($serviceCategory), 'ServiceCategory updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/serviceCategories/{id}",
     *      summary="deleteServiceCategory",
     *      tags={"ServiceCategory"},
     *      description="Delete ServiceCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServiceCategory",
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
        /** @var ServiceCategory $serviceCategory */
        $serviceCategory = $this->serviceCategoryRepository->find($id);

        if (empty($serviceCategory)) {
            return $this->sendError('Service Category not found');
        }

        $serviceCategory->delete();

        return $this->sendSuccess('Service Category deleted successfully');
    }
}
