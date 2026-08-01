<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHallEventTypeAPIRequest;
use App\Http\Requests\API\UpdateHallEventTypeAPIRequest;
use App\Models\HallEventType;
use App\Repositories\HallEventTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\HallEventTypeResource;

/**
 * Class HallEventTypeController
 */

class HallEventTypeAPIController extends AppBaseController
{
    /** @var  HallEventTypeRepository */
    private $hallEventTypeRepository;

    public function __construct(HallEventTypeRepository $hallEventTypeRepo)
    {
        $this->hallEventTypeRepository = $hallEventTypeRepo;
    }

    /**
     * @OA\Get(
     *      path="/hallEventTypes",
     *      summary="getHallEventTypeList",
     *      tags={"HallEventType"},
     *      description="Get all HallEventTypes",
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
     *                  @OA\Items(ref="#/components/schemas/HallEventType")
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
        $hallEventTypes = HallEventType::where('publish', 1)
                                ->orderBy('sort')
                                ->select('id', 'name')
                                ->get();

        return $this->sendResponse($hallEventTypes->toArray(), 'Hall Event Types retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/hallEventTypes",
     *      summary="createHallEventType",
     *      tags={"HallEventType"},
     *      description="Create HallEventType",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/HallEventType")
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
     *                  ref="#/components/schemas/HallEventType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateHallEventTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $hallEventType = $this->hallEventTypeRepository->create($input);

        return $this->sendResponse(new HallEventTypeResource($hallEventType), 'Hall Event Type saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/hallEventTypes/{id}",
     *      summary="getHallEventTypeItem",
     *      tags={"HallEventType"},
     *      description="Get HallEventType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of HallEventType",
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
     *                  ref="#/components/schemas/HallEventType"
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
        /** @var HallEventType $hallEventType */
        $hallEventType = $this->hallEventTypeRepository->find($id);

        if (empty($hallEventType)) {
            return $this->sendError('Hall Event Type not found');
        }

        return $this->sendResponse(new HallEventTypeResource($hallEventType), 'Hall Event Type retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/hallEventTypes/{id}",
     *      summary="updateHallEventType",
     *      tags={"HallEventType"},
     *      description="Update HallEventType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of HallEventType",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/HallEventType")
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
     *                  ref="#/components/schemas/HallEventType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateHallEventTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var HallEventType $hallEventType */
        $hallEventType = $this->hallEventTypeRepository->find($id);

        if (empty($hallEventType)) {
            return $this->sendError('Hall Event Type not found');
        }

        $hallEventType = $this->hallEventTypeRepository->update($input, $id);

        return $this->sendResponse(new HallEventTypeResource($hallEventType), 'HallEventType updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/hallEventTypes/{id}",
     *      summary="deleteHallEventType",
     *      tags={"HallEventType"},
     *      description="Delete HallEventType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of HallEventType",
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
        /** @var HallEventType $hallEventType */
        $hallEventType = $this->hallEventTypeRepository->find($id);

        if (empty($hallEventType)) {
            return $this->sendError('Hall Event Type not found');
        }

        $hallEventType->delete();

        return $this->sendSuccess('Hall Event Type deleted successfully');
    }
}
