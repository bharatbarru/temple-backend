<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTestimonialCategoryAPIRequest;
use App\Http\Requests\API\UpdateTestimonialCategoryAPIRequest;
use App\Models\TestimonialCategory;
use App\Repositories\TestimonialCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TestimonialCategoryResource;

/**
 * Class TestimonialCategoryController
 */

class TestimonialCategoryAPIController extends AppBaseController
{
    /** @var  TestimonialCategoryRepository */
    private $testimonialCategoryRepository;

    public function __construct(TestimonialCategoryRepository $testimonialCategoryRepo)
    {
        $this->testimonialCategoryRepository = $testimonialCategoryRepo;
    }

    /**
     * @OA\Get(
     *      path="/testimonial-categories",
     *      summary="getTestimonialCategoryList",
     *      tags={"TestimonialCategory"},
     *      description="Get all TestimonialCategories",
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
     *                  @OA\Items(ref="#/components/schemas/TestimonialCategory")
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
        $testimonialCategories = $this->testimonialCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TestimonialCategoryResource::collection($testimonialCategories), 'Testimonial Categories retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/testimonial-categories",
     *      summary="createTestimonialCategory",
     *      tags={"TestimonialCategory"},
     *      description="Create TestimonialCategory",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/TestimonialCategory")
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
     *                  ref="#/components/schemas/TestimonialCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTestimonialCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $testimonialCategory = $this->testimonialCategoryRepository->create($input);

        return $this->sendResponse(new TestimonialCategoryResource($testimonialCategory), 'Testimonial Category saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/testimonial-categories/{id}",
     *      summary="getTestimonialCategoryItem",
     *      tags={"TestimonialCategory"},
     *      description="Get TestimonialCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TestimonialCategory",
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
     *                  ref="#/components/schemas/TestimonialCategory"
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
        /** @var TestimonialCategory $testimonialCategory */
        $testimonialCategory = $this->testimonialCategoryRepository->find($id);

        if (empty($testimonialCategory)) {
            return $this->sendError('Testimonial Category not found');
        }

        return $this->sendResponse(new TestimonialCategoryResource($testimonialCategory), 'Testimonial Category retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/testimonial-categories/{id}",
     *      summary="updateTestimonialCategory",
     *      tags={"TestimonialCategory"},
     *      description="Update TestimonialCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TestimonialCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/TestimonialCategory")
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
     *                  ref="#/components/schemas/TestimonialCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTestimonialCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var TestimonialCategory $testimonialCategory */
        $testimonialCategory = $this->testimonialCategoryRepository->find($id);

        if (empty($testimonialCategory)) {
            return $this->sendError('Testimonial Category not found');
        }

        $testimonialCategory = $this->testimonialCategoryRepository->update($input, $id);

        return $this->sendResponse(new TestimonialCategoryResource($testimonialCategory), 'TestimonialCategory updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/testimonial-categories/{id}",
     *      summary="deleteTestimonialCategory",
     *      tags={"TestimonialCategory"},
     *      description="Delete TestimonialCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TestimonialCategory",
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
        /** @var TestimonialCategory $testimonialCategory */
        $testimonialCategory = $this->testimonialCategoryRepository->find($id);

        if (empty($testimonialCategory)) {
            return $this->sendError('Testimonial Category not found');
        }
    try{
        $testimonialCategory->delete();
    }
    catch (\Illuminate\Database\QueryException $e) {
        return $this->sendError('Cannot delete record because it has related records in another table.');
    }
        return $this->sendSuccess('Testimonial Category deleted successfully');
    }
}
