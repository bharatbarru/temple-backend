<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHallAddonAPIRequest;
use App\Http\Requests\API\UpdateHallAddonAPIRequest;
use App\Models\HallAddon;
use App\Repositories\HallAddonRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\HallAddonResource;

/**
 * Class HallAddonController
 */

class HallAddonAPIController extends AppBaseController
{
    /** @var  HallAddonRepository */
    private $hallAddonRepository;

    public function __construct(HallAddonRepository $hallAddonRepo)
    {
        $this->hallAddonRepository = $hallAddonRepo;
    }

    /**
     * @OA\Get(
     *      path="/hallAddons",
     *      summary="getHallAddonList",
     *      tags={"HallAddon"},
     *      description="Get all HallAddons",
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
     *                  @OA\Items(ref="#/components/schemas/HallAddon")
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
        $hallAddons = $this->hallAddonRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(HallAddonResource::collection($hallAddons), 'Hall Addons retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/hallAddons",
     *      summary="createHallAddon",
     *      tags={"HallAddon"},
     *      description="Create HallAddon",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/HallAddon")
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
     *                  ref="#/components/schemas/HallAddon"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateHallAddonAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $hallAddon = $this->hallAddonRepository->create($input);

        return $this->sendResponse(new HallAddonResource($hallAddon), 'Hall Addon saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/hallAddons/{id}",
     *      summary="getHallAddonItem",
     *      tags={"HallAddon"},
     *      description="Get HallAddon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of HallAddon",
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
     *                  ref="#/components/schemas/HallAddon"
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
        /** @var HallAddon $hallAddon */
        $hallAddon = $this->hallAddonRepository->find($id);

        if (empty($hallAddon)) {
            return $this->sendError('Hall Addon not found');
        }

        return $this->sendResponse(new HallAddonResource($hallAddon), 'Hall Addon retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/hallAddons/{id}",
     *      summary="updateHallAddon",
     *      tags={"HallAddon"},
     *      description="Update HallAddon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of HallAddon",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/HallAddon")
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
     *                  ref="#/components/schemas/HallAddon"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateHallAddonAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var HallAddon $hallAddon */
        $hallAddon = $this->hallAddonRepository->find($id);

        if (empty($hallAddon)) {
            return $this->sendError('Hall Addon not found');
        }

        $hallAddon = $this->hallAddonRepository->update($input, $id);

        return $this->sendResponse(new HallAddonResource($hallAddon), 'HallAddon updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/hallAddons/{id}",
     *      summary="deleteHallAddon",
     *      tags={"HallAddon"},
     *      description="Delete HallAddon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of HallAddon",
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
        /** @var HallAddon $hallAddon */
        $hallAddon = $this->hallAddonRepository->find($id);

        if (empty($hallAddon)) {
            return $this->sendError('Hall Addon not found');
        }

        $hallAddon->delete();

        return $this->sendSuccess('Hall Addon deleted successfully');
    }
}
