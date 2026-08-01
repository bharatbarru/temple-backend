<?php

namespace App\Http\Controllers\API\ApplicationSettings;

use App\Http\Requests\API\CreateApplicationSettingCategoryAPIRequest;
use App\Http\Requests\API\UpdateApplicationSettingCategoryAPIRequest;
use App\Models\ApplicationSettingCategory;
use App\Repositories\ApplicationSettingCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ApplicationSettingCategoryController
 */

class ApplicationSettingCategoryAPIController extends AppBaseController
{
    private ApplicationSettingCategoryRepository $applicationSettingCategoryRepository;

    public function __construct(ApplicationSettingCategoryRepository $applicationSettingCategoryRepo)
    {
        $this->applicationSettingCategoryRepository = $applicationSettingCategoryRepo;
    }

    /**
     * @OA\Get(
     *      path="/applicationSettingCategories",
     *      summary="getApplicationSettingCategoryList",
     *      tags={"ApplicationSettingCategory"},
     *      description="Get all ApplicationSettingCategories",
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
     *                  @OA\Items(ref="#/components/schemas/ApplicationSettingCategory")
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
        $applicationSettingCategories = $this->applicationSettingCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($applicationSettingCategories->toArray(), 'Application Setting Categories retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/applicationSettingCategories",
     *      summary="createApplicationSettingCategory",
     *      tags={"ApplicationSettingCategory"},
     *      description="Create ApplicationSettingCategory",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ApplicationSettingCategory")
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
     *                  ref="#/components/schemas/ApplicationSettingCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateApplicationSettingCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $applicationSettingCategory = $this->applicationSettingCategoryRepository->create($input);

        // Log Activity
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['name' => $request->name])
            ->log('API / Application Settings / Categories - New category created.');

        return $this->sendResponse($applicationSettingCategory->toArray(), 'Application Setting Category saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/applicationSettingCategories/{id}",
     *      summary="getApplicationSettingCategoryItem",
     *      tags={"ApplicationSettingCategory"},
     *      description="Get ApplicationSettingCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ApplicationSettingCategory",
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
     *                  ref="#/components/schemas/ApplicationSettingCategory"
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
        /** @var ApplicationSettingCategory $applicationSettingCategory */
        $applicationSettingCategory = $this->applicationSettingCategoryRepository->find($id);

        if (empty($applicationSettingCategory)) {
            return $this->sendError('Application Setting Category not found');
        }

        return $this->sendResponse($applicationSettingCategory->toArray(), 'Application Setting Category retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/applicationSettingCategories/{id}",
     *      summary="updateApplicationSettingCategory",
     *      tags={"ApplicationSettingCategory"},
     *      description="Update ApplicationSettingCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ApplicationSettingCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ApplicationSettingCategory")
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
     *                  ref="#/components/schemas/ApplicationSettingCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateApplicationSettingCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ApplicationSettingCategory $applicationSettingCategory */
        $applicationSettingCategory = $this->applicationSettingCategoryRepository->find($id);

        if (empty($applicationSettingCategory)) {
            return $this->sendError('Application Setting Category not found');
        }

        $applicationSettingCategory = $this->applicationSettingCategoryRepository->update($input, $id);

        // Log Activity
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['name' => $request->name])
            ->log('API / Application Settings / Categories - Category details updated.');

        return $this->sendResponse($applicationSettingCategory->toArray(), 'ApplicationSettingCategory updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/applicationSettingCategories/{id}",
     *      summary="deleteApplicationSettingCategory",
     *      tags={"ApplicationSettingCategory"},
     *      description="Delete ApplicationSettingCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ApplicationSettingCategory",
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
        /** @var ApplicationSettingCategory $applicationSettingCategory */
        $applicationSettingCategory = $this->applicationSettingCategoryRepository->find($id);

        if (empty($applicationSettingCategory)) {
            return $this->sendError('Application Setting Category not found');
        }

        try {
            $applicationSettingCategory->delete();

            // Log Activity
            activity()
                ->performedOn(getAPIUser())
                ->withProperties(['name' => $applicationSettingCategory->name])
                ->log('API / Application Settings / Categories - category details removed.');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendError('Cannot delete record because it has related records in another table.');
        }

        return $this->sendSuccess('Application Setting Category deleted successfully');
    }
}
