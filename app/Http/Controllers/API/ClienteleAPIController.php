<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClienteleAPIRequest;
use App\Http\Requests\API\UpdateClienteleAPIRequest;
use App\Models\Clientele;
use App\Repositories\ClienteleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ClienteleResource;
use App\Models\ClienteleCategory;

/**
 * Class ClienteleController
 */

class ClienteleAPIController extends AppBaseController
{
    /** @var  ClienteleRepository */
    private $clienteleRepository;

    public function __construct(ClienteleRepository $clienteleRepo)
    {
        $this->clienteleRepository = $clienteleRepo;
    }

    /**
     * @OA\Get(
     *      path="/clienteles",
     *      summary="getClienteleList",
     *      tags={"Clientele"},
     *      description="Get all Clienteles",
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
     *                  @OA\Items(ref="#/components/schemas/Clientele")
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
        $clienteles = $this->clienteleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ClienteleResource::collection($clienteles), 'Clienteles retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/clienteles",
     *      summary="createClientele",
     *      tags={"Clientele"},
     *      description="Create Clientele",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Clientele")
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
     *                  ref="#/components/schemas/Clientele"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateClienteleAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $clientele = $this->clienteleRepository->create($input);
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['image' => $clientele->image])
            ->log('Clientele - New Clientele created.');

        return $this->sendResponse(new ClienteleResource($clientele), 'Clientele saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/clienteles/{id}",
     *      summary="getClienteleItem",
     *      tags={"Clientele"},
     *      description="Get Clientele",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Clientele",
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
     *                  ref="#/components/schemas/Clientele"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($slug): JsonResponse
    {
        /** @var ClienteleCategory $clientCategory */
        $clientCategory = ClienteleCategory::where('type', $slug)->first();
    
        if (empty($clientCategory)) {
            return $this->sendError('Clientele category not found');
        }
    
        $clienteles = Clientele::where('clientele_category_id', $clientCategory->id)
                                ->where('publish', 1)
                                ->select('image', 'image_alt_text', 'title', 'sub_title', 'url', 'new_window')
                                ->orderBy('sort')
                                ->get();
    
        foreach ($clienteles as $clientele) {
            if (!empty($clientele->image)) {
                $clientele->image = url(CLIENTELE_IMAGE_PATH . $clientele->image);
            }
        }
    
        return $this->sendResponse($clienteles->toArray(), 'Clienteles retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/clienteles/{id}",
     *      summary="updateClientele",
     *      tags={"Clientele"},
     *      description="Update Clientele",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Clientele",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Clientele")
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
     *                  ref="#/components/schemas/Clientele"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateClienteleAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Clientele $clientele */
        $clientele = $this->clienteleRepository->find($id);

        if (empty($clientele)) {
            return $this->sendError('Clientele not found');
        }

        $clientele = $this->clienteleRepository->update($input, $id);

        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['image' => $clientele->image])
            ->log('Clientele -  Clientele name updated.');

        return $this->sendResponse(new ClienteleResource($clientele), 'Clientele updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/clienteles/{id}",
     *      summary="deleteClientele",
     *      tags={"Clientele"},
     *      description="Delete Clientele",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Clientele",
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
        /** @var Clientele $clientele */
        $clientele = $this->clienteleRepository->find($id);

        if (empty($clientele)) {
            return $this->sendError('Clientele not found');
        }

        try {
            $clientele->delete();

            activity()
                ->performedOn(getAPIUser())
                ->withProperties(['image' => $clientele->image])
                ->log('Clientele - Clientele removed.');

            return $this->sendSuccess('Clientele deleted successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendError('Cannot delete record because it has related records in another table.');
        }
    }
}
