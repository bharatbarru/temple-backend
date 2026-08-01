<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatenewsAPIRequest;
use App\Http\Requests\API\UpdatenewsAPIRequest;
use App\Models\news;
use App\Repositories\newsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\newsResource;

/**
 * Class newsController
 */

class newsAPIController extends AppBaseController
{
    /** @var  newsRepository */
    private $newsRepository;

    public function __construct(newsRepository $newsRepo)
    {
        $this->newsRepository = $newsRepo;
    }

    /**
     * @OA\Get(
     *      path="/news",
     *      summary="getnewsList",
     *      tags={"news"},
     *      description="Get all news",
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
     *                  @OA\Items(ref="#/components/schemas/news")
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
        $news = $this->newsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(newsResource::collection($news), 'News retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/news",
     *      summary="createnews",
     *      tags={"news"},
     *      description="Create news",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/news")
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
     *                  ref="#/components/schemas/news"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatenewsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $news = $this->newsRepository->create($input);

        return $this->sendResponse(new newsResource($news), 'News saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/news/{id}",
     *      summary="getnewsItem",
     *      tags={"news"},
     *      description="Get news",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of news",
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
     *                  ref="#/components/schemas/news"
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
        /** @var news $news */
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            return $this->sendError('News not found');
        }

        return $this->sendResponse(new newsResource($news), 'News retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/news/{id}",
     *      summary="updatenews",
     *      tags={"news"},
     *      description="Update news",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of news",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/news")
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
     *                  ref="#/components/schemas/news"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatenewsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var news $news */
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            return $this->sendError('News not found');
        }

        $news = $this->newsRepository->update($input, $id);

        return $this->sendResponse(new newsResource($news), 'news updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/news/{id}",
     *      summary="deletenews",
     *      tags={"news"},
     *      description="Delete news",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of news",
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
        /** @var news $news */
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            return $this->sendError('News not found');
        }

        $news->delete();

        return $this->sendSuccess('News deleted successfully');
    }
}
