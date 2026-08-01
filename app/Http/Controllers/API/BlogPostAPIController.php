<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBlogPostAPIRequest;
use App\Http\Requests\API\UpdateBlogPostAPIRequest;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\BlogPostResource;

/**
 * Class BlogPostController
 */

class BlogPostAPIController extends AppBaseController
{
    /** @var  BlogPostRepository */
    private $blogPostRepository;

    public function __construct(BlogPostRepository $blogPostRepo)
    {
        $this->blogPostRepository = $blogPostRepo;
    }

    /**
     * @OA\Get(
     *      path="/blog-posts",
     *      summary="getBlogPostList",
     *      tags={"BlogPost"},
     *      description="Get all BlogPosts",
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
     *                  @OA\Items(ref="#/components/schemas/BlogPost")
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
        $blogPosts = $this->blogPostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(BlogPostResource::collection($blogPosts), 'Blog Posts retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/blog-posts",
     *      summary="createBlogPost",
     *      tags={"BlogPost"},
     *      description="Create BlogPost",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/BlogPost")
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
     *                  ref="#/components/schemas/BlogPost"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBlogPostAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $blogPost = $this->blogPostRepository->create($input);

        return $this->sendResponse(new BlogPostResource($blogPost), 'Blog Post saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/blog-posts/{id}",
     *      summary="getBlogPostItem",
     *      tags={"BlogPost"},
     *      description="Get BlogPost",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of BlogPost",
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
     *                  ref="#/components/schemas/BlogPost"
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
        /** @var BlogPost $blogPost */
        $blogPost = $this->blogPostRepository->find($id);

        if (empty($blogPost)) {
            return $this->sendError('Blog Post not found');
        }

        return $this->sendResponse(new BlogPostResource($blogPost), 'Blog Post retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/blog-posts/{id}",
     *      summary="updateBlogPost",
     *      tags={"BlogPost"},
     *      description="Update BlogPost",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of BlogPost",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/BlogPost")
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
     *                  ref="#/components/schemas/BlogPost"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBlogPostAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var BlogPost $blogPost */
        $blogPost = $this->blogPostRepository->find($id);

        if (empty($blogPost)) {
            return $this->sendError('Blog Post not found');
        }

        $blogPost = $this->blogPostRepository->update($input, $id);

        return $this->sendResponse(new BlogPostResource($blogPost), 'BlogPost updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/blog-posts/{id}",
     *      summary="deleteBlogPost",
     *      tags={"BlogPost"},
     *      description="Delete BlogPost",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of BlogPost",
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
        /** @var BlogPost $blogPost */
        $blogPost = $this->blogPostRepository->find($id);

        if (empty($blogPost)) {
            return $this->sendError('Blog Post not found');
        }
    try{
        $blogPost->delete();
    }
    catch (\Illuminate\Database\QueryException $e) {
        return $this->sendError('Cannot delete record because it has related records in another table.');
    }
        return $this->sendSuccess('Blog Post deleted successfully');
    }
}
