<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClienteleCategoryAPIRequest;
use App\Http\Requests\API\UpdateClienteleCategoryAPIRequest;
use App\Models\ClienteleCategory;
use App\Repositories\ClienteleCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ClienteleCategoryResource;

/**
 * Class ClienteleCategoryController
 */

class ClienteleCategoryAPIController extends AppBaseController
{
    /** @var  ClienteleCategoryRepository */
    private $clienteleCategoryRepository;

    public function __construct(ClienteleCategoryRepository $clienteleCategoryRepo)
    {
        $this->clienteleCategoryRepository = $clienteleCategoryRepo;
    }

    /**
     * @OA\Get(
     *      path="/clienteleCategories",
     *      summary="getClienteleCategoryList",
     *      tags={"ClienteleCategory"},
     *      description="Get all ClienteleCategories",
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
     *                  @OA\Items(ref="#/components/schemas/ClienteleCategory")
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
        $clienteleCategories = $this->clienteleCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ClienteleCategoryResource::collection($clienteleCategories), 'Clientele Categories retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/clienteleCategories",
     *      summary="createClienteleCategory",
     *      tags={"ClienteleCategory"},
     *      description="Create ClienteleCategory",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ClienteleCategory")
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
     *                  ref="#/components/schemas/ClienteleCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateClienteleCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $clienteleCategory = $this->clienteleCategoryRepository->create($input);

        return $this->sendResponse(new ClienteleCategoryResource($clienteleCategory), 'Clientele Category saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/clienteleCategories/{id}",
     *      summary="getClienteleCategoryItem",
     *      tags={"ClienteleCategory"},
     *      description="Get ClienteleCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ClienteleCategory",
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
     *                  ref="#/components/schemas/ClienteleCategory"
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
        /** @var ClienteleCategory $clienteleCategory */
        $clienteleCategory = $this->clienteleCategoryRepository->find($id);

        if (empty($clienteleCategory)) {
            return $this->sendError('Clientele Category not found');
        }

        return $this->sendResponse(new ClienteleCategoryResource($clienteleCategory), 'Clientele Category retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/clienteleCategories/{id}",
     *      summary="updateClienteleCategory",
     *      tags={"ClienteleCategory"},
     *      description="Update ClienteleCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ClienteleCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ClienteleCategory")
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
     *                  ref="#/components/schemas/ClienteleCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateClienteleCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ClienteleCategory $clienteleCategory */
        $clienteleCategory = $this->clienteleCategoryRepository->find($id);

        if (empty($clienteleCategory)) {
            return $this->sendError('Clientele Category not found');
        }

        $clienteleCategory = $this->clienteleCategoryRepository->update($input, $id);

        return $this->sendResponse(new ClienteleCategoryResource($clienteleCategory), 'ClienteleCategory updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/clienteleCategories/{id}",
     *      summary="deleteClienteleCategory",
     *      tags={"ClienteleCategory"},
     *      description="Delete ClienteleCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ClienteleCategory",
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
        /** @var ClienteleCategory $clienteleCategory */
        $clienteleCategory = $this->clienteleCategoryRepository->find($id);

        if (empty($clienteleCategory)) {
            return $this->sendError('Clientele Category not found');
        }

        try {
            $clienteleCategory->delete();

            return $this->sendSuccess('Clientele Category deleted successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendError('Cannot delete record because it has related records in another table.');
        }
    }
}
