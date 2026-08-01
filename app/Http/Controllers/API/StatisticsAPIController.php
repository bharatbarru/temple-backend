<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStatisticsAPIRequest;
use App\Http\Requests\API\UpdateStatisticsAPIRequest;
use App\Models\Statistics;
use App\Repositories\StatisticsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\StatisticsResource;

/**
 * Class StatisticsController
 */

class StatisticsAPIController extends AppBaseController
{
    /** @var  StatisticsRepository */
    private $statisticsRepository;

    public function __construct(StatisticsRepository $statisticsRepo)
    {
        $this->statisticsRepository = $statisticsRepo;
    }

    /**
     * @OA\Get(
     *      path="/statistics",
     *      summary="getStatisticsList",
     *      tags={"Statistics"},
     *      description="Get all Statistics",
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
     *                  @OA\Items(ref="#/components/schemas/Statistics")
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
        $statistics = $this->statisticsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StatisticsResource::collection($statistics), 'Statistics retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/statistics",
     *      summary="createStatistics",
     *      tags={"Statistics"},
     *      description="Create Statistics",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Statistics")
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
     *                  ref="#/components/schemas/Statistics"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStatisticsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $statistics = $this->statisticsRepository->create($input);

        return $this->sendResponse(new StatisticsResource($statistics), 'Statistics saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/statistics/{id}",
     *      summary="getStatisticsItem",
     *      tags={"Statistics"},
     *      description="Get Statistics",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Statistics",
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
     *                  ref="#/components/schemas/Statistics"
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
        /** @var Statistics $statistics */
        $statistics = $this->statisticsRepository->find($id);

        if (empty($statistics)) {
            return $this->sendError('Statistics not found');
        }

        return $this->sendResponse(new StatisticsResource($statistics), 'Statistics retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/statistics/{id}",
     *      summary="updateStatistics",
     *      tags={"Statistics"},
     *      description="Update Statistics",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Statistics",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Statistics")
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
     *                  ref="#/components/schemas/Statistics"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStatisticsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Statistics $statistics */
        $statistics = $this->statisticsRepository->find($id);

        if (empty($statistics)) {
            return $this->sendError('Statistics not found');
        }

        $statistics = $this->statisticsRepository->update($input, $id);

        return $this->sendResponse(new StatisticsResource($statistics), 'Statistics updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/statistics/{id}",
     *      summary="deleteStatistics",
     *      tags={"Statistics"},
     *      description="Delete Statistics",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Statistics",
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
        /** @var Statistics $statistics */
        $statistics = $this->statisticsRepository->find($id);

        if (empty($statistics)) {
            return $this->sendError('Statistics not found');
        }

        $statistics->delete();

        return $this->sendSuccess('Statistics deleted successfully');
    }
}
