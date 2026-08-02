<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePujaAPIRequest;
use App\Http\Requests\API\UpdatePujaAPIRequest;
use App\Models\Puja;
use App\Repositories\PujaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PujaResource;

/**
 * Class PujaController
 */

class PujaAPIController extends AppBaseController
{
    /** @var  PujaRepository */
    private $pujaRepository;

    public function __construct(PujaRepository $pujaRepo)
    {
        $this->pujaRepository = $pujaRepo;
    }

    /**
     * @OA\Get(
     *      path="/pujas",
     *      summary="getPujaList",
     *      tags={"Puja"},
     *      description="Get all Pujas",
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
     *                  @OA\Items(ref="#/components/schemas/Puja")
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
        $pujas = Puja::where('publish', 1)
                    ->orderBy('sort')
                    ->select('id', 'name', 'temple_amount', 'home_amount')
                    ->get();

        return $this->sendResponse($pujas->toArray(), 'Pujas retrieved successfully');
    }

    public function publicIndex(Request $request): JsonResponse
    {
       $pujas = Puja::query()
        ->where('publish', 1)
        ->where('temple_amount', '>', 0)
        ->orderBy('sort')
        ->orderBy('id')
        ->get();

        return $this->sendResponse($pujas->toArray(), 'Published pujas retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/pujas",
     *      summary="createPuja",
     *      tags={"Puja"},
     *      description="Create Puja",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Puja")
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
     *                  ref="#/components/schemas/Puja"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePujaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $puja = $this->pujaRepository->create($input);

        return $this->sendResponse(new PujaResource($puja), 'Puja saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/pujas/{id}",
     *      summary="getPujaItem",
     *      tags={"Puja"},
     *      description="Get Puja",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Puja",
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
     *                  ref="#/components/schemas/Puja"
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
        /** @var Puja $puja */
        $puja = $this->pujaRepository->find($id);

        if (empty($puja)) {
            return $this->sendError('Puja not found');
        }

        return $this->sendResponse(new PujaResource($puja), 'Puja retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/pujas/{id}",
     *      summary="updatePuja",
     *      tags={"Puja"},
     *      description="Update Puja",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Puja",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Puja")
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
     *                  ref="#/components/schemas/Puja"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePujaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Puja $puja */
        $puja = $this->pujaRepository->find($id);

        if (empty($puja)) {
            return $this->sendError('Puja not found');
        }

        $puja = $this->pujaRepository->update($input, $id);

        return $this->sendResponse(new PujaResource($puja), 'Puja updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/pujas/{id}",
     *      summary="deletePuja",
     *      tags={"Puja"},
     *      description="Delete Puja",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Puja",
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
        /** @var Puja $puja */
        $puja = $this->pujaRepository->find($id);

        if (empty($puja)) {
            return $this->sendError('Puja not found');
        }

        $puja->delete();

        return $this->sendSuccess('Puja deleted successfully');
    }
}
