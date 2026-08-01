<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatenewsCategoryAPIRequest;
use App\Http\Requests\API\UpdatenewsCategoryAPIRequest;
use App\Models\newsCategory;
use App\Repositories\newsCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\newsCategoryResource;

/**
 * Class newsCategoryController
 */

class newsCategoryAPIController extends AppBaseController
{
    /** @var  newsCategoryRepository */
    private $newsCategoryRepository;

    public function __construct(newsCategoryRepository $newsCategoryRepo)
    {
        $this->newsCategoryRepository = $newsCategoryRepo;
    }

    /**
     * @OA\Get(
     *      path="/news-categories",
     *      summary="getnewsCategoryList",
     *      tags={"newsCategory"},
     *      description="Get all newsCategories",
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
     *                  @OA\Items(ref="#/components/schemas/newsCategory")
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
        $newsCategories = $this->newsCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(newsCategoryResource::collection($newsCategories), 'News Categories retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/news-categories",
     *      summary="createnewsCategory",
     *      tags={"newsCategory"},
     *      description="Create newsCategory",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/newsCategory")
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
     *                  ref="#/components/schemas/newsCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatenewsCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $newsCategory = $this->newsCategoryRepository->create($input);

        return $this->sendResponse(new newsCategoryResource($newsCategory), 'News Category saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/news-categories/{id}",
     *      summary="getnewsCategoryItem",
     *      tags={"newsCategory"},
     *      description="Get newsCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of newsCategory",
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
     *                  ref="#/components/schemas/newsCategory"
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
        /** @var newsCategory $newsCategory */
        $newsCategory = $this->newsCategoryRepository->find($id);

        if (empty($newsCategory)) {
            return $this->sendError('News Category not found');
        }

        return $this->sendResponse(new newsCategoryResource($newsCategory), 'News Category retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/news-categories/{id}",
     *      summary="updatenewsCategory",
     *      tags={"newsCategory"},
     *      description="Update newsCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of newsCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/newsCategory")
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
     *                  ref="#/components/schemas/newsCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatenewsCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var newsCategory $newsCategory */
        $newsCategory = $this->newsCategoryRepository->find($id);

        if (empty($newsCategory)) {
            return $this->sendError('News Category not found');
        }

        $newsCategory = $this->newsCategoryRepository->update($input, $id);

        return $this->sendResponse(new newsCategoryResource($newsCategory), 'newsCategory updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/news-categories/{id}",
     *      summary="deletenewsCategory",
     *      tags={"newsCategory"},
     *      description="Delete newsCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of newsCategory",
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
        /** @var newsCategory $newsCategory */
        $newsCategory = $this->newsCategoryRepository->find($id);

        if (empty($newsCategory)) {
            return $this->sendError('News Category not found');
        }

        $newsCategory->delete();

        return $this->sendSuccess('News Category deleted successfully');
    }
}
