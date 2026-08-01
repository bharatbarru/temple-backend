<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEventCategoryAPIRequest;
use App\Http\Requests\API\UpdateEventCategoryAPIRequest;
use App\Models\EventCategory;
use App\Repositories\EventCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\EventCategoryResource;

/**
 * Class EventCategoryController
 */

class EventCategoryAPIController extends AppBaseController
{
    /** @var  EventCategoryRepository */
    private $eventCategoryRepository;

    public function __construct(EventCategoryRepository $eventCategoryRepo)
    {
        $this->eventCategoryRepository = $eventCategoryRepo;
    }

    /**
     * @OA\Get(
     *      path="/eventCategories",
     *      summary="getEventCategoryList",
     *      tags={"EventCategory"},
     *      description="Get all EventCategories",
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
     *                  @OA\Items(ref="#/components/schemas/EventCategory")
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
        $eventCategories = EventCategory::whereHas('events', function ($query) {
            $query->where('event_categories.publish', 1); // Fetch only categories that have published events
        })->with(['events' => function ($query) {
            $query->where('events.publish', 1)->orderBy('events.start_date_time'); // Fetch only published events and sort them
        }])->orderBy('sort')->get();

        foreach ($eventCategories as $eventCategory) {
            if (!empty($eventCategory->image)) {
                $eventCategory->image = url(EVENT_CATEGORY_IMAGE_PATH . $eventCategory->image);
            }
            $eventCategory->makeHidden(['created_at', 'updated_at', 'sort']);

            foreach ($eventCategory->events as $event) {
                if (!empty($event->image)) {
                    $event->image = url(EVENT_IMAGE_PATH . $event->image);
                }
                $event->makeHidden(['id', 'event_category_id', 'created_at', 'updated_at', 'sort']);
            }
        }

        return $this->sendResponse($eventCategories->toArray(), 'Event Categories with Published Events retrieved successfully');
    }


    /**
     * @OA\Post(
     *      path="/eventCategories",
     *      summary="createEventCategory",
     *      tags={"EventCategory"},
     *      description="Create EventCategory",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/EventCategory")
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
     *                  ref="#/components/schemas/EventCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEventCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $eventCategory = $this->eventCategoryRepository->create($input);

        return $this->sendResponse(new EventCategoryResource($eventCategory), 'Event Category saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/eventCategories/{id}",
     *      summary="getEventCategoryItem",
     *      tags={"EventCategory"},
     *      description="Get EventCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of EventCategory",
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
     *                  ref="#/components/schemas/EventCategory"
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
        /** @var EventCategory $eventCategory */
        $eventCategory = $this->eventCategoryRepository->find($id);

        if (empty($eventCategory)) {
            return $this->sendError('Event Category not found');
        }

        return $this->sendResponse(new EventCategoryResource($eventCategory), 'Event Category retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/eventCategories/{id}",
     *      summary="updateEventCategory",
     *      tags={"EventCategory"},
     *      description="Update EventCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of EventCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/EventCategory")
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
     *                  ref="#/components/schemas/EventCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEventCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var EventCategory $eventCategory */
        $eventCategory = $this->eventCategoryRepository->find($id);

        if (empty($eventCategory)) {
            return $this->sendError('Event Category not found');
        }

        $eventCategory = $this->eventCategoryRepository->update($input, $id);

        return $this->sendResponse(new EventCategoryResource($eventCategory), 'EventCategory updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/eventCategories/{id}",
     *      summary="deleteEventCategory",
     *      tags={"EventCategory"},
     *      description="Delete EventCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of EventCategory",
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
        /** @var EventCategory $eventCategory */
        $eventCategory = $this->eventCategoryRepository->find($id);

        if (empty($eventCategory)) {
            return $this->sendError('Event Category not found');
        }

        $eventCategory->delete();

        return $this->sendSuccess('Event Category deleted successfully');
    }
}
