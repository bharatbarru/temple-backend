<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFaqCategoryAPIRequest;
use App\Http\Requests\API\UpdateFaqCategoryAPIRequest;
use App\Models\FaqCategory;
use App\Repositories\FaqCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FaqCategoryResource;

/**
 * Class FaqCategoryController
 */

class FaqCategoryAPIController extends AppBaseController
{
    /** @var  FaqCategoryRepository */
    private $faqCategoryRepository;

    public function __construct(FaqCategoryRepository $faqCategoryRepo)
    {
        $this->faqCategoryRepository = $faqCategoryRepo;
    }

    /**
     * @OA\Get(
     *      path="/faq-categories",
     *      summary="getFaqCategoryList",
     *      tags={"FaqCategory"},
     *      description="Get all FaqCategories",
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
     *                  @OA\Items(ref="#/components/schemas/FaqCategory")
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
        $faqCategories = $this->faqCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(FaqCategoryResource::collection($faqCategories), 'Faq Categories retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/faq-categories",
     *      summary="createFaqCategory",
     *      tags={"FaqCategory"},
     *      description="Create FaqCategory",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/FaqCategory")
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
     *                  ref="#/components/schemas/FaqCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFaqCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $faqCategory = $this->faqCategoryRepository->create($input);

        return $this->sendResponse(new FaqCategoryResource($faqCategory), 'Faq Category saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/faq-categories/{id}",
     *      summary="getFaqCategoryItem",
     *      tags={"FaqCategory"},
     *      description="Get FaqCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of FaqCategory",
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
     *                  ref="#/components/schemas/FaqCategory"
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
        /** @var FaqCategory $faqCategory */
        $faqCategory = $this->faqCategoryRepository->find($id);

        if (empty($faqCategory)) {
            return $this->sendError('Faq Category not found');
        }

        return $this->sendResponse(new FaqCategoryResource($faqCategory), 'Faq Category retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/faq-categories/{id}",
     *      summary="updateFaqCategory",
     *      tags={"FaqCategory"},
     *      description="Update FaqCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of FaqCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/FaqCategory")
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
     *                  ref="#/components/schemas/FaqCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFaqCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var FaqCategory $faqCategory */
        $faqCategory = $this->faqCategoryRepository->find($id);

        if (empty($faqCategory)) {
            return $this->sendError('Faq Category not found');
        }

        $faqCategory = $this->faqCategoryRepository->update($input, $id);

        return $this->sendResponse(new FaqCategoryResource($faqCategory), 'FaqCategory updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/faq-categories/{id}",
     *      summary="deleteFaqCategory",
     *      tags={"FaqCategory"},
     *      description="Delete FaqCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of FaqCategory",
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
        /** @var FaqCategory $faqCategory */
        $faqCategory = $this->faqCategoryRepository->find($id);

        if (empty($faqCategory)) {
            return $this->sendError('Faq Category not found');
        }

        $faqCategory->delete();

        return $this->sendSuccess('Faq Category deleted successfully');
    }
}
