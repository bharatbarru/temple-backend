<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHallOrderAPIRequest;
use App\Http\Requests\API\UpdateHallOrderAPIRequest;
use App\Models\HallOrder;
use App\Repositories\HallOrderRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\HallOrderResource;
use App\Mail\AdminChangeHallMail;
use App\Mail\AdminCancelHallMail;   
use App\Mail\AdminHallOrderMail;
use App\Mail\UserCancelOrderMail;
use App\Mail\UserChangeOrderMail;
use App\Mail\UserHallOrderMail;
use App\Models\FrontendUser;
use App\Models\HallOrderAddonList;
use App\Models\HallOrderList;
use App\Models\OrderStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Class HallOrderController
 */

class HallOrderAPIController extends AppBaseController
{
    /** @var  HallOrderRepository */
    private $hallOrderRepository;

    public function __construct(HallOrderRepository $hallOrderRepo)
    {
        $this->hallOrderRepository = $hallOrderRepo;
    }

    /**
     * @OA\Get(
     *      path="/hallOrders",
     *      summary="getHallOrderList",
     *      tags={"HallOrder"},
     *      description="Get all HallOrders",
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
     *                  @OA\Items(ref="#/components/schemas/HallOrder")
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
        $hallOrders = $this->hallOrderRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(HallOrderResource::collection($hallOrders), 'Hall Orders retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/hallOrders",
     *      summary="createHallOrder",
     *      tags={"HallOrder"},
     *      description="Create HallOrder",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/HallOrder")
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
     *                  ref="#/components/schemas/HallOrder"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateHallOrderAPIRequest $request): JsonResponse
    {
        $input = $request->all();
        $cartItems = $input['selected_halls'] ?? [];
         // Array of selected halls and addons
        if($request->end_date_of_event){
            $startDate = Carbon::parse($request->date_of_event);
            $endDate = Carbon::parse($request->end_date_of_event);
            $input['number_of_days'] = $endDate->diffInDays($startDate) + 1;
            $input['end_date_of_event'] = Carbon::parse($request->end_date_of_event);
        } else {
            $input['number_of_days'] = 1;
        }
        
        DB::beginTransaction();

        try {
            // Check if user already exists based on email or mobile
            
            $randomPassword = Str::random(8); // Generate a random 8-character password

                // Create a new user
                $user = FrontendUser::create([
                    'community_name' => $input['community_name'] ?? null, // Add community_name to FrontendUser
                    'first_name' => $input['first_name'],
                    'last_name' => $input['last_name'] ?? null, // Set last_name to null if not present
                    'email' => $input['email'],
                    'mobile' => $input['mobile'],
                    'address' => $input['address'] ?? null,
                    'country' => $input['country'] ?? null,
                    'state' => $input['state'] ?? null,
                    'city' => $input['city'] ?? null,
                    'pincode' => $input['pincode'] ?? null,
                    'password' => bcrypt($randomPassword), // Store the random password (hashed)
                ]);

            // Add user_id to request data for HallOrder
            $input['user_id'] = $user->id;
            
            // Generate hall_request_id
            $date = Carbon::now()->format('Ymd');
            $lastOrder = HallOrder::whereDate('created_at', Carbon::today())->latest()->first();
            $sequenceNumber = $lastOrder ? intval(substr($lastOrder->hall_request_id, -4)) + 1 : 1385;
            $input['hall_request_id'] = $date . 'SH' . str_pad($sequenceNumber, 4, '0', STR_PAD_LEFT);
            
            // Create Hall Order with community_name
            $hallOrder = $this->hallOrderRepository->create($input);

            $totalAmount = 0;

            // Store Hall Order Details (Cart Items: halls and add-ons)
            foreach ($cartItems as $item) {
                // Store Hall in HallOrderList with no_of_hours
                HallOrderList::create([
                    'hall_order_id' => $hallOrder->id,
                    'hall_id' => $item['hall_id'],
                    'hall_cost' => $item['hall_cost'],
                    'no_of_hours' => $item['hours'] ?? null, // Default to 1 if hours not provided
                ]);

                // Store Hall Addon in HallOrderAddonList with no_of_hours
                foreach ($item['addons'] as $addon) {
                    HallOrderAddonList::create([
                        'hall_order_id' => $hallOrder->id,
                        'hall_id' => $item['hall_id'],
                        'hall_addon_id' => $addon['addon_id'],
                        'addon_cost' => $addon['addon_cost'],
                        'no_of_hours' => $addon['hours'] ?? null, // Default to 1 if hours not provided
                    ]);
                }

                // Calculate total amount (sum of hall cost and add-on costs)
                $totalAmount += $item['hall_cost'] ?? 0;
                foreach ($item['addons'] as $addon) {
                    $totalAmount += $addon['addon_cost'] ?? 0;
                }
            }

            // Update Total Amount in Hall Order
            $hallOrder->update(['total_amount' => $totalAmount]);

            // Create Hall Order Status
            OrderStatus::create([
                'hall_order_id' => $hallOrder->id,
                'status' => NEW_REQUEST,
            ]);

            // Fetch halls and addons for email
            $halls = HallOrderList::where('hall_order_id', $hallOrder->id)
                ->join('halls', 'hall_order_lists.hall_id', '=', 'halls.id')
                ->select('halls.id', 'halls.name', 'hall_order_lists.no_of_hours', 'hall_order_lists.hall_cost')
                ->get()
                ->map(function ($hall) use ($hallOrder) {
                    // Fetch related addons for the hall
                    $hallAddons = HallOrderAddonList::where('hall_order_id', $hallOrder->id)
                        ->where('hall_id', $hall->id) // Match the hall ID
                        ->join('hall_addons', 'hall_order_addons_list.hall_addon_id', '=', 'hall_addons.id')
                        ->select('hall_addons.id', 'hall_addons.name', 'hall_order_addons_list.no_of_hours', 'hall_order_addons_list.addon_cost')
                        ->get();

                    // Attach addons to hall
                    $hall->addons = $hallAddons;

                    return $hall;
                });

            // Send Emails
            if (app()->environment('production')) {
                Mail::to(applicationSettings('socialhall-booking-email'))->send(new AdminHallOrderMail($hallOrder, $halls));
                Mail::to($hallOrder->user->email)->send(new UserHallOrderMail($hallOrder, $halls));
            }

            DB::commit();

            // Prepare response data
            $data = [
                'hall_request_id' => $hallOrder->hall_request_id,
            ];

            return $this->sendResponse($data, 'Hall Order saved successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }


    /**
     * @OA\Get(
     *      path="/hallOrders/{id}",
     *      summary="getHallOrderItem",
     *      tags={"HallOrder"},
     *      description="Get HallOrder",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of HallOrder",
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
     *                  ref="#/components/schemas/HallOrder"
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
        /** @var HallOrder $hallOrder */
        $hallOrder = $this->hallOrderRepository->find($id);

        if (empty($hallOrder)) {
            return $this->sendError('Hall Order not found');
        }

        return $this->sendResponse(new HallOrderResource($hallOrder), 'Hall Order retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/hallOrders/{id}",
     *      summary="updateHallOrder",
     *      tags={"HallOrder"},
     *      description="Update HallOrder",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of HallOrder",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/HallOrder")
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
     *                  ref="#/components/schemas/HallOrder"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateHallOrderAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var HallOrder $hallOrder */
        $hallOrder = $this->hallOrderRepository->find($id);

        if (empty($hallOrder)) {
            return $this->sendError('Hall Order not found');
        }

        $hallOrder = $this->hallOrderRepository->update($input, $id);

        return $this->sendResponse(new HallOrderResource($hallOrder), 'HallOrder updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/hallOrders/{id}",
     *      summary="deleteHallOrder",
     *      tags={"HallOrder"},
     *      description="Delete HallOrder",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of HallOrder",
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
        /** @var HallOrder $hallOrder */
        $hallOrder = $this->hallOrderRepository->find($id);

        if (empty($hallOrder)) {
            return $this->sendError('Hall Order not found');
        }

        $hallOrder->delete();

        return $this->sendSuccess('Hall Order deleted successfully');
    }

    public function check(Request $request)
    {
        $request->validate([
            'request_id' => 'required|string',
            'email' => 'required|email',
        ]);

        
        $hallOrder = HallOrder::where('hall_request_id', $request->request_id)->first();
      
        if($hallOrder->type_of_event === "community"){
            $request->first_name = rtrim($request->name);  // Remove trailing space
            $hallOrder = HallOrder::where('hall_request_id', $request->request_id)
                ->whereHas('user', function ($query) use ($request) {
                    $query->where('email', $request->email)
                          ->where('first_name', $request->name);
                })
                ->first();

            
            }else{
                $hallOrder = HallOrder::where('hall_request_id', $request->request_id)
                    ->whereHas('user', function ($query) use ($request) {
                    $query->where('email', $request->email)
                        ->whereRaw("CONCAT(first_name, ' ', last_name) = ?", [$request->name]);
                })
                ->first();
            }

        if(!$hallOrder){
            return response()->json([
                'success' => false,
                'message' => 'No Hall Order Found.',
            ], 200);
        }
        

        $statuses = $hallOrder ? $hallOrder->orderStatuses->pluck('status')->toArray() : [];


        if (!$hallOrder || in_array(CANCEL_REQUEST, $statuses)) {
            return response()->json([
                'success' => false,
                'message' => 'No request found with the given details.',
            ], 200);
        }

        // Fetch selected halls with their addons and costs
        $halls = HallOrderList::where('hall_order_id', $hallOrder->id)
            ->join('halls', 'hall_order_lists.hall_id', '=', 'halls.id')
            ->select('halls.id', 'halls.name', 'hall_order_lists.no_of_hours', 'hall_order_lists.hall_cost')
            ->get()
            ->map(function ($hall) use ($hallOrder) {
                // Fetch related addons for the hall
                $hallAddons = HallOrderAddonList::where('hall_order_id', $hallOrder->id)
                    ->where('hall_id', $hall->id) // Match the hall ID
                    ->join('hall_addons', 'hall_order_addons_list.hall_addon_id', '=', 'hall_addons.id')
                    ->select('hall_addons.id', 'hall_addons.name', 'hall_order_addons_list.no_of_hours', 'hall_order_addons_list.addon_cost')
                    ->get();

                // Attach addons to hall
                $hall->addons = $hallAddons;

                return $hall;
            });

        // Format dates
        $formattedDateOfEvent = formatDate($hallOrder->date_of_event);
        $formattedAlternateDateOfEvent = formatDate($hallOrder->alternate_date_of_event);

        return response()->json([
            'success' => true,
            'message' => 'Hall booking found.',
            'data' => [
                'hall_request_id' => $hallOrder->hall_request_id ?? '',
                'name' => $hallOrder->type_of_event === "community" 
                    ? ($hallOrder->user->first_name ?? '')
                    : ($hallOrder->user->first_name ?? '') . ' ' . ($hallOrder->user->last_name ?? ''),
                'email' => $hallOrder->user->email ?? '',
                'date_of_event' => $formattedDateOfEvent,
                'alternate_date_of_event' => $formattedAlternateDateOfEvent,
                'selected_halls' => $halls->map(function ($hall) {
                    $hall->name = $hall->name . ($hall->no_of_hours ? " (For {$hall->no_of_hours} hours)" : '');
                    $hall->addons = $hall->addons->map(function ($addon) {
                        $addon->name = $addon->name . ($addon->no_of_hours ? " (For {$addon->no_of_hours} hours)" : '');
                        return $addon;
                    });
                    return $hall;
                }),
            ],
        ]);
    }


    /**
     * Change hall booking request.
     */
    public function change(Request $request)
    {
        $request->validate([
            'request_id' => 'required|string|exists:hall_orders,hall_request_id',
            'email' => 'required|email',
            'name' => 'required|string',
            'new_event_date' => 'required|date',
            'time_of_event' => 'required|string',
            'comments' => 'nullable|string',
        ]);

        $hallOrder = HallOrder::where('hall_request_id', $request->request_id)
            ->whereHas('user', function ($query) use ($request) {
                $query->where('email', $request->email);
            })
            ->first();

        if (!$hallOrder) {
            return response()->json([
                'success' => false,
                'message' => 'No request found with the given details.',
            ], 404);
        }

        // Update hall booking details
        $hallOrder->update([
            'changed_by' => $request->name,
            'date_of_event' => $request->new_event_date,
            'start_time' => $request->time_of_event,
            'changed_comments' => $request->comments,
            'payment_status' => 'change_requested',
        ]);

        OrderStatus::create([
            'hall_order_id' => $hallOrder->id,
            'status' => RESCHEDULE_REQUEST,
        ]);

        $halls = HallOrderList::where('hall_order_id', $hallOrder->id)
        ->join('halls', 'hall_order_lists.hall_id', '=', 'halls.id')
        ->select('halls.id', 'halls.name', 'hall_order_lists.no_of_hours', 'hall_order_lists.hall_cost')
        ->get()
        ->map(function ($hall) use ($hallOrder) {
            // Fetch related addons for the hall
            $hallAddons = HallOrderAddonList::where('hall_order_id', $hallOrder->id)
                ->where('hall_id', $hall->id) // Match the hall ID
                ->join('hall_addons', 'hall_order_addons_list.hall_addon_id', '=', 'hall_addons.id')
                ->select('hall_addons.id', 'hall_addons.name', 'hall_order_addons_list.no_of_hours', 'hall_order_addons_list.addon_cost')
                ->get();

            // Attach addons to hall
            $hall->addons = $hallAddons;

            return $hall;
        });

        if (app()->environment('production')) {
            Mail::to(applicationSettings('socialhall-booking-email'))->send(new AdminChangeHallMail($hallOrder,$halls));
            Mail::to($hallOrder->user->email)->send(new UserChangeOrderMail($hallOrder,$halls));
        }

      

        return response()->json([
            'success' => true,
            'message' => 'Change hall request successfully placed.',
            'data' => $hallOrder,
        ]);

        Log::info("Hall Order is",$hallOrder);

      
    }


    public function cancel(Request $request)
    {
        $request->validate([
            'request_id' => 'required|string|exists:hall_orders,hall_request_id',
            'name' => 'required|string',
            'email' => 'required|email',
            'comments' => 'nullable|string',
        ]);

        $hallOrder = HallOrder::where('hall_request_id', $request->request_id)
            ->whereHas('user', function ($query) use ($request) {
                $query->where('email', $request->email);
            })
            ->first();

        if (!$hallOrder) {
            return response()->json([
                'success' => false,
                'message' => 'No request found with the given details.',
            ], 404);
        }

        // Update hall booking details
        $hallOrder->update([
            'cancelled_by' => $request->name,
            'cancelled_comments' => $request->comments,
            'payment_status' => 'cancel_requested',
        ]);
        
        OrderStatus::create([
            'hall_order_id' => $hallOrder->id,
            'status' => CANCEL_REQUEST,
        ]);
        
        $halls = HallOrderList::where('hall_order_id', $hallOrder->id)
        ->join('halls', 'hall_order_lists.hall_id', '=', 'halls.id')
        ->select('halls.id', 'halls.name', 'hall_order_lists.no_of_hours', 'hall_order_lists.hall_cost')
        ->get()
        ->map(function ($hall) use ($hallOrder) {
            // Fetch related addons for the hall
            $hallAddons = HallOrderAddonList::where('hall_order_id', $hallOrder->id)
                ->where('hall_id', $hall->id) // Match the hall ID
                ->join('hall_addons', 'hall_order_addons_list.hall_addon_id', '=', 'hall_addons.id')
                ->select('hall_addons.id', 'hall_addons.name', 'hall_order_addons_list.no_of_hours', 'hall_order_addons_list.addon_cost')
                ->get();

            // Attach addons to hall
            $hall->addons = $hallAddons;

            return $hall;
        });

        if (app()->environment('production')) {
            Mail::to(applicationSettings('socialhall-booking-email'))->send(new AdminCancelHallMail($hallOrder,$halls));
            Mail::to($hallOrder->user->email)->send(new UserCancelOrderMail($hallOrder,$halls));
        }
        return response()->json([
            'success' => true,
            'message' => 'Cancel Hall request successfully placed.',
            'data' => $hallOrder,
        ]);
        Log::info("Hall Order is",$hallOrder);

      
    }
}
