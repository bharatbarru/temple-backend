<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFrontendUserAPIRequest;
use App\Http\Requests\API\UpdateFrontendUserAPIRequest;
use App\Models\FrontendUser;
use App\Repositories\FrontendUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FrontendUserResource;

/**
 * Class FrontendUserController
 */

class FrontendUserAPIController extends AppBaseController
{
    /** @var  FrontendUserRepository */
    private $frontendUserRepository;

    public function __construct(FrontendUserRepository $frontendUserRepo)
    {
        $this->frontendUserRepository = $frontendUserRepo;
    }

    /**
     * @OA\Get(
     *      path="/frontendUsers",
     *      summary="getFrontendUserList",
     *      tags={"FrontendUser"},
     *      description="Get all FrontendUsers",
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
     *                  @OA\Items(ref="#/components/schemas/FrontendUser")
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
        $frontendUsers = $this->frontendUserRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(FrontendUserResource::collection($frontendUsers), 'Frontend Users retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/frontendUsers",
     *      summary="createFrontendUser",
     *      tags={"FrontendUser"},
     *      description="Create FrontendUser",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/FrontendUser")
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
     *                  ref="#/components/schemas/FrontendUser"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFrontendUserAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $frontendUser = $this->frontendUserRepository->create($input);

        return $this->sendResponse(new FrontendUserResource($frontendUser), 'Frontend User saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/frontendUsers/{id}",
     *      summary="getFrontendUserItem",
     *      tags={"FrontendUser"},
     *      description="Get FrontendUser",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of FrontendUser",
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
     *                  ref="#/components/schemas/FrontendUser"
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
        /** @var FrontendUser $frontendUser */
        $frontendUser = $this->frontendUserRepository->find($id);

        if (empty($frontendUser)) {
            return $this->sendError('Frontend User not found');
        }

        return $this->sendResponse(new FrontendUserResource($frontendUser), 'Frontend User retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/frontendUsers/{id}",
     *      summary="updateFrontendUser",
     *      tags={"FrontendUser"},
     *      description="Update FrontendUser",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of FrontendUser",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/FrontendUser")
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
     *                  ref="#/components/schemas/FrontendUser"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFrontendUserAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var FrontendUser $frontendUser */
        $frontendUser = $this->frontendUserRepository->find($id);

        if (empty($frontendUser)) {
            return $this->sendError('Frontend User not found');
        }

        $frontendUser = $this->frontendUserRepository->update($input, $id);

        return $this->sendResponse(new FrontendUserResource($frontendUser), 'FrontendUser updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/frontendUsers/{id}",
     *      summary="deleteFrontendUser",
     *      tags={"FrontendUser"},
     *      description="Delete FrontendUser",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of FrontendUser",
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
        /** @var FrontendUser $frontendUser */
        $frontendUser = $this->frontendUserRepository->find($id);

        if (empty($frontendUser)) {
            return $this->sendError('Frontend User not found');
        }

        $frontendUser->delete();

        return $this->sendSuccess('Frontend User deleted successfully');
    }
}
