<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePujaOrderAPIRequest;
use App\Http\Requests\API\UpdatePujaOrderAPIRequest;
use App\Models\PujaOrder;
use App\Repositories\PujaOrderRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PujaOrderResource;
use App\Mail\AdminChangePujaMail;
use App\Mail\AdminCancelPujaMail;
use App\Mail\AdminHallOrderMail;
use App\Mail\AdminPujaOrderMail;
use App\Mail\UserChangeOrderMail;
use App\Mail\UserChangePujaMail;
use App\Mail\UserCancelPujaMail;
use App\Mail\UserPujaOrderMail;
use App\Models\FrontendUser;
use App\Models\OrderStatus;
use App\Models\PujaOrderList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Class PujaOrderController
 */

class PujaOrderAPIController extends AppBaseController
{
    /** @var  PujaOrderRepository */
    private $pujaOrderRepository;

    public function __construct(PujaOrderRepository $pujaOrderRepo)
    {
        $this->pujaOrderRepository = $pujaOrderRepo;
    }

    /**
     * @OA\Get(
     *      path="/pujaOrders",
     *      summary="getPujaOrderList",
     *      tags={"PujaOrder"},
     *      description="Get all PujaOrders",
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
     *                  @OA\Items(ref="#/components/schemas/PujaOrder")
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
        $pujaOrders = $this->pujaOrderRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(PujaOrderResource::collection($pujaOrders), 'Puja Orders retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/pujaOrders",
     *      summary="createPujaOrder",
     *      tags={"PujaOrder"},
     *      description="Create PujaOrder",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/PujaOrder")
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
     *                  ref="#/components/schemas/PujaOrder"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePujaOrderAPIRequest $request): JsonResponse
    {
        $input = $request->all();
        $cartItems = $input['cart'] ?? [];

        DB::beginTransaction();

        try {
            // Check if user already exists

            $randomPassword = Str::random(8); // Generate a random 8-character password

      
                // Create a new user
                $user = FrontendUser::create([
                    'first_name' => $input['first_name'],
                    'last_name' => $input['last_name'],
                    'email' => $input['email'],
                    'mobile' => $input['mobile'],
                    'address' => $input['address'],
                    'country' => $input['country'],
                    'state' => $input['state'],
                    'city' => $input['city'],
                    'pincode' => $input['pincode'],
                    'password' => bcrypt($randomPassword), // Store the random password (hashed)
                ]);

            // Add user_id to request data
            $input['user_id'] = $user->id;
            $input['puja_location'] = $input['location'];

            // Create Puja Order
            $pujaOrder = $this->pujaOrderRepository->create($input);

            $totalAmount = 0;

            // Store Cart Details
            foreach ($cartItems as $item) {
                $pujaCost = $input['puja_location'] === 'temple'
                    ? $item['temple_amount']
                    : $item['home_amount'];

                PujaOrderList::create([
                    'puja_order_id' => $pujaOrder->id,
                    'puja_id' => $item['id'],
                    'puja_cost' => $pujaCost
                ]);

                $totalAmount += $pujaCost;
            }   

            // Update Total Amount in Puja Order
            $pujaOrder->update(['total_amount' => $totalAmount]);

            // Create Order Status
            OrderStatus::create([
                'puja_order_id' => $pujaOrder->id,
                'status' => NEW_REQUEST,
            ]);

            $halls = PujaOrderList::where('puja_order_id', $pujaOrder->id)
            ->join('pujas', 'puja_order_lists.puja_id', '=', 'pujas.id')
            ->select('pujas.id', 'pujas.name', 'puja_order_lists.puja_cost')
            ->get();


            // Send Emails
            if (app()->environment('production')) {
                Mail::to(applicationSettings('puja-request-email'))->send(new AdminPujaOrderMail($pujaOrder,$halls));
                Mail::to($pujaOrder->user->email)->send(new UserPujaOrderMail($pujaOrder,$halls));
            }

            DB::commit();

            $data = [
                'puja_request_id' => $pujaOrder->puja_request_id,
            ];

            return $this->sendResponse($data, 'Puja Order saved successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['error' => 'Something went wrong' . $e], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/pujaOrders/{id}",
     *      summary="getPujaOrderItem",
     *      tags={"PujaOrder"},
     *      description="Get PujaOrder",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PujaOrder",
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
     *                  ref="#/components/schemas/PujaOrder"
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
        /** @var PujaOrder $pujaOrder */
        $pujaOrder = $this->pujaOrderRepository->find($id);

        if (empty($pujaOrder)) {
            return $this->sendError('Puja Order not found');
        }

        return $this->sendResponse(new PujaOrderResource($pujaOrder), 'Puja Order retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/pujaOrders/{id}",
     *      summary="updatePujaOrder",
     *      tags={"PujaOrder"},
     *      description="Update PujaOrder",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PujaOrder",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/PujaOrder")
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
     *                  ref="#/components/schemas/PujaOrder"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePujaOrderAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var PujaOrder $pujaOrder */
        $pujaOrder = $this->pujaOrderRepository->find($id);

        if (empty($pujaOrder)) {
            return $this->sendError('Puja Order not found');
        }

        $pujaOrder = $this->pujaOrderRepository->update($input, $id);

        return $this->sendResponse(new PujaOrderResource($pujaOrder), 'PujaOrder updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/pujaOrders/{id}",
     *      summary="deletePujaOrder",
     *      tags={"PujaOrder"},
     *      description="Delete PujaOrder",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PujaOrder",
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
        /** @var PujaOrder $pujaOrder */
        $pujaOrder = $this->pujaOrderRepository->find($id);

        if (empty($pujaOrder)) {
            return $this->sendError('Puja Order not found');
        }

        $pujaOrder->delete();

        return $this->sendSuccess('Puja Order deleted successfully');
    }

    public function check(Request $request)
    {
        $request->validate([
            'request_id' => 'required|string',
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

      

        $pujaOrder = PujaOrder::where('puja_request_id', $request->request_id)
            ->whereHas('user', function ($query) use ($request) {
                $query->where('email', $request->email)
                    ->whereRaw("CONCAT(first_name, ' ', last_name) = ?", [$request->name]);
            })
            ->first();


        $statuses = $pujaOrder ? $pujaOrder->orderStatuses->pluck('status')->toArray() : [];

        if (!$pujaOrder || in_array(CANCEL_REQUEST, $statuses)) {
            return response()->json([
                'success' => false,
                'message' => 'No request found with the given details.',
            ], 200);
        }

        // Fetch selected halls with their addons and costs
        $halls = PujaOrderList::where('puja_order_id', $pujaOrder->id)
            ->join('pujas', 'puja_order_lists.puja_id', '=', 'pujas.id')
            ->select('pujas.id', 'pujas.name', 'puja_order_lists.puja_cost')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Puja booking found.',
            'data' => [
                'puja_request_id' => $pujaOrder->puja_request_id ?? '',
                'name' => ($pujaOrder->user->first_name ?? '') . ' ' . ($pujaOrder->user->last_name ?? ''),
                'email' => $pujaOrder->user->email ?? '',
                'date_of_puja' => $pujaOrder->date_of_puja,
                'time_of_puja' => $pujaOrder->time_of_puja,
                'alternate_date_of_puja1' => $pujaOrder->alternate_date_of_puja1,
                'created_at' => $pujaOrder->created_at,
                'selected_pujas' => $halls,
            ],
        ]);
    }

    public function change(Request $request)
    {
        $request->validate([
            'request_id' => 'required|string|exists:puja_orders,puja_request_id',
            'email' => 'required|email',
            'name' => 'required|string',
            'new_event_date' => 'required|date',
            'time_of_event' => 'required|string',
            'comments' => 'nullable|string',
        ]);

        $pujaOrder = PujaOrder::where('puja_request_id', $request->request_id)
            ->whereHas('user', function ($query) use ($request) {
                $query->where('email', $request->email);
            })
            ->first();

        if (!$pujaOrder) {
            return response()->json([
                'success' => false,
                'message' => 'No request found with the given details.',
            ], 404);
        }

        // Update hall booking details
        $pujaOrder->update([
            'changed_by' => $request->name,
            'date_of_puja' => $request->new_event_date,
            'time_of_puja' => $request->time_of_event,
            'changed_comments' => $request->comments,
            'payment_status' => 'change_requested',
        ]);


        $halls = PujaOrderList::where('puja_order_id', $pujaOrder->id)
        ->join('pujas', 'puja_order_lists.puja_id', '=', 'pujas.id')
        ->select('pujas.id', 'pujas.name', 'puja_order_lists.puja_cost')
        ->get();


        OrderStatus::create([
            'puja_order_id' => $pujaOrder->id,
            'status' => RESCHEDULE_REQUEST,
        ]);

        if (app()->environment('production')) {
            Mail::to(applicationSettings('puja-request-email'))->send(new AdminChangePujaMail($pujaOrder,$halls));
            Mail::to($pujaOrder->user->email)->send(new UserChangePujaMail($pujaOrder,$halls));
        }

     

        return response()->json([
            'success' => true,
            'message' => 'Change Puja request successfully placed.',
            'data' => $pujaOrder,
        ]);

        Log::info("Hall Order is",$pujaOrder);

      
    }

    public function cancel(Request $request)
    {
        $request->validate([
            'request_id' => 'required|string|exists:puja_orders,puja_request_id',
            'name' => 'required|string',
            'email' => 'required|email',
            'comments' => 'nullable|string',
        ]);

       
        $pujaOrder = PujaOrder::where('puja_request_id', $request->request_id)
        // ->where('payment_status', '!=', 'cancel_requested')
        ->whereHas('user', function ($query) use ($request) {
            $query->where('email', $request->email);
        })
        ->first();

        if (!$pujaOrder) {
            return response()->json([
                'success' => false,
                'message' => 'No request found with the given details.',
            ], 404);
        }

        // Update hall booking details
        $pujaOrder->update([
            'cancelled_by' => $request->name,
            'cancelled_comments' => $request->comments,
            'payment_status' => 'cancel_requested',
        ]);
        
        OrderStatus::create([
            'puja_order_id' => $pujaOrder->id,
            'status' => CANCEL_REQUEST,
        ]);

        $halls = PujaOrderList::where('puja_order_id', $pujaOrder->id)
            ->join('pujas', 'puja_order_lists.puja_id', '=', 'pujas.id')
            ->select('pujas.id', 'pujas.name', 'puja_order_lists.puja_cost')
            ->get();

        if (app()->environment('production')) {
            Mail::to(applicationSettings('puja-request-email'))->send(new AdminCancelPujaMail($pujaOrder,$halls));
            Mail::to($pujaOrder->user->email)->send(new UserCancelPujaMail($pujaOrder,$halls));
        }

        return response()->json([
            'success' => true,
            'message' => 'Cancel Puja request successfully placed.',
            'data' => $pujaOrder,
        ]);

       

        Log::info("Hall Order is",$pujaOrder);

      
    }
}
