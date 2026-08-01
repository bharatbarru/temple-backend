<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHallAPIRequest;
use App\Http\Requests\API\UpdateHallAPIRequest;
use App\Models\Hall;
use App\Repositories\HallRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\HallResource;
use App\Models\HallAddon;
use App\Models\HallAddonCost;

/**
 * Class HallController
 */

class HallAPIController extends AppBaseController
{
    /** @var  HallRepository */
    private $hallRepository;

    public function __construct(HallRepository $hallRepo)
    {
        $this->hallRepository = $hallRepo;
    }

    /**
     * @OA\Get(
     *      path="/halls",
     *      summary="getHallList",
     *      tags={"Hall"},
     *      description="Get all Halls",
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
     *                  @OA\Items(ref="#/components/schemas/Hall")
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
    // Fetch all halls with their costs in a single optimized query
    $halls = Hall::where('publish', 1)
        ->orderBy('sort')
        ->get()
        ->map(function ($hall) {
            // Process hall image URL
            $hall->image = !empty($hall->image) ? url(HALL_IMAGE_PATH . $hall->image) : null;
            $hall->makeHidden(['created_at', 'updated_at', 'sort', 'publish']);

            // Fetch related addons with their costs
            $hallAddons = HallAddon::whereIn('id', function ($query) use ($hall) {
                $query->select('hall_addon_id')
                    ->from('hall_addon_costs')
                    ->where('hall_id', $hall->id)
                    ->where('publish', 1); // Only published costs
            })
            ->where('publish', 1)
            ->orderBy('sort')
            ->get()
            ->map(function ($addon) use ($hall) {
                // Process addon image URL
                $addon->image = !empty($addon->image) ? url(HALL_ADDON_IMAGE_PATH . $addon->image) : null;
                $addon->makeHidden(['sort', 'publish', 'created_at', 'updated_at']);

                // Fetch costs for the specific hall-addon combination
                $costs = HallAddonCost::where('hall_id', $hall->id)
                    ->where('hall_addon_id', $addon->id)
                    ->where('publish', 1)
                    ->select([
                        'monday_cost',
                        'tuesday_cost',
                        'wednesday_cost',
                        'thursday_cost',
                        'friday_cost',
                        'saturday_cost',
                        'sunday_cost'
                    ])
                    ->first();

                // Skip addon if all costs are 0 or null
                if (!$costs || (
                    $costs->monday_cost == 0 &&
                    $costs->tuesday_cost == 0 &&
                    $costs->wednesday_cost == 0 &&
                    $costs->thursday_cost == 0 &&
                    $costs->friday_cost == 0 &&
                    $costs->saturday_cost == 0 &&
                    $costs->sunday_cost == 0
                )) {
                    return null;
                }

                $addon->costs = $costs;

                return $addon;
            })
            ->filter() // Remove null values from the collection
            ->values(); // Re-index the collection

            // Attach addons to hall
            $hall->addons = $hallAddons;

            return $hall;
        });

    return $this->sendResponse($halls->toArray(), 'Halls retrieved successfully');
}

    /**
     * @OA\Post(
     *      path="/halls",
     *      summary="createHall",
     *      tags={"Hall"},
     *      description="Create Hall",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Hall")
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
     *                  ref="#/components/schemas/Hall"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateHallAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $hall = $this->hallRepository->create($input);

        return $this->sendResponse(new HallResource($hall), 'Hall saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/halls/{id}",
     *      summary="getHallItem",
     *      tags={"Hall"},
     *      description="Get Hall",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Hall",
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
     *                  ref="#/components/schemas/Hall"
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
        /** @var Hall $hall */
        $hall = $this->hallRepository->find($id);

        if (empty($hall)) {
            return $this->sendError('Hall not found');
        }

        return $this->sendResponse(new HallResource($hall), 'Hall retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/halls/{id}",
     *      summary="updateHall",
     *      tags={"Hall"},
     *      description="Update Hall",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Hall",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Hall")
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
     *                  ref="#/components/schemas/Hall"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateHallAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Hall $hall */
        $hall = $this->hallRepository->find($id);

        if (empty($hall)) {
            return $this->sendError('Hall not found');
        }

        $hall = $this->hallRepository->update($input, $id);

        return $this->sendResponse(new HallResource($hall), 'Hall updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/halls/{id}",
     *      summary="deleteHall",
     *      tags={"Hall"},
     *      description="Delete Hall",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Hall",
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
        /** @var Hall $hall */
        $hall = $this->hallRepository->find($id);

        if (empty($hall)) {
            return $this->sendError('Hall not found');
        }

        $hall->delete();

        return $this->sendSuccess('Hall deleted successfully');
    }
}
