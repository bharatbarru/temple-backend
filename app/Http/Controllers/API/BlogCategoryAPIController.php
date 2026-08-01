<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBlogCategoryAPIRequest;
use App\Http\Requests\API\UpdateBlogCategoryAPIRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\BlogCategoryResource;

/**
 * Class BlogCategoryController
 */

class BlogCategoryAPIController extends AppBaseController
{
    /** @var  BlogCategoryRepository */
    private $blogCategoryRepository;

    public function __construct(BlogCategoryRepository $blogCategoryRepo)
    {
        $this->blogCategoryRepository = $blogCategoryRepo;
    }

    /**
     * @OA\Get(
     *      path="/blog-categories",
     *      summary="getBlogCategoryList",
     *      tags={"BlogCategory"},
     *      description="Get all BlogCategories",
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
     *                  @OA\Items(ref="#/components/schemas/BlogCategory")
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
        $blogCategories = $this->blogCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(BlogCategoryResource::collection($blogCategories), 'Blog Categories retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/blog-categories",
     *      summary="createBlogCategory",
     *      tags={"BlogCategory"},
     *      description="Create BlogCategory",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/BlogCategory")
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
     *                  ref="#/components/schemas/BlogCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBlogCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $blogCategory = $this->blogCategoryRepository->create($input);

        return $this->sendResponse(new BlogCategoryResource($blogCategory), 'Blog Category saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/blog-categories/{id}",
     *      summary="getBlogCategoryItem",
     *      tags={"BlogCategory"},
     *      description="Get BlogCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of BlogCategory",
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
     *                  ref="#/components/schemas/BlogCategory"
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
        /** @var BlogCategory $blogCategory */
        $blogCategory = $this->blogCategoryRepository->find($id);

        if (empty($blogCategory)) {
            return $this->sendError('Blog Category not found');
        }

        return $this->sendResponse(new BlogCategoryResource($blogCategory), 'Blog Category retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/blog-categories/{id}",
     *      summary="updateBlogCategory",
     *      tags={"BlogCategory"},
     *      description="Update BlogCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of BlogCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/BlogCategory")
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
     *                  ref="#/components/schemas/BlogCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBlogCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var BlogCategory $blogCategory */
        $blogCategory = $this->blogCategoryRepository->find($id);

        if (empty($blogCategory)) {
            return $this->sendError('Blog Category not found');
        }

        $blogCategory = $this->blogCategoryRepository->update($input, $id);

        return $this->sendResponse(new BlogCategoryResource($blogCategory), 'BlogCategory updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/blog-categories/{id}",
     *      summary="deleteBlogCategory",
     *      tags={"BlogCategory"},
     *      description="Delete BlogCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of BlogCategory",
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
        /** @var BlogCategory $blogCategory */
        $blogCategory = $this->blogCategoryRepository->find($id);

        if (empty($blogCategory)) {
            return $this->sendError('Blog Category not found');
        }
    try{
        $blogCategory->delete();
    }
    catch (\Illuminate\Database\QueryException $e) {
        return $this->sendError('Cannot delete record because it has related records in another table.');
    }


        return $this->sendSuccess('Blog Category deleted successfully');
    }
}
