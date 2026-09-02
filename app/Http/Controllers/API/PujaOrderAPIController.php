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
use App\Models\PaymentTransaction;
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

        $data = $this->savePujaOrder($input, $cartItems, true, false);

        return $this->sendResponse($data, 'Puja Order saved successfully');
    }

    public function storePublic(CreatePujaOrderAPIRequest $request): JsonResponse
    {
        $input = $request->all();
        $cartItems = $input['cart'] ?? [];

        // No mail here: the public booking is paid for right after it is created
        // and `paypalSuccess()` sends the single confirmation mail that carries
        // the transaction details.
        $data = $this->savePujaOrder($input, $cartItems, false, true);

        return $this->sendResponse($data, 'Puja Order saved successfully');
    }

    public function paypalSuccess(Request $request): JsonResponse
    {
        $request->validate([
            'puja_request_id' => 'required|string|exists:puja_orders,puja_request_id',
            'email' => 'required|email',
            'paypal_order_id' => 'nullable|string',
            'paypal_capture_id' => 'nullable|string',
            'paypal_status' => 'nullable|string',
            'paypal_paid' => 'nullable|boolean',
            'paypal_amount' => 'nullable|numeric',
            'paypal_currency' => 'nullable|string',
            'paypal_payer_email' => 'nullable|email',
            'paypal_payer_id' => 'nullable|string',
            'paypal_create_time' => 'nullable|string',
            'paypal_update_time' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'card_brand' => 'nullable|string',
            'card_type' => 'nullable|string',
            'card_last_digits' => 'nullable|string|max:8',
            'card_holder_name' => 'nullable|string',
        ]);

        $pujaOrder = PujaOrder::where('puja_request_id', $request->puja_request_id)->first();

        if (!$pujaOrder) {
            return $this->sendError('Puja order not found', 404);
        }

        $userEmail = $pujaOrder->user?->email;
        if ($userEmail && strtolower($userEmail) !== strtolower($request->email)) {
            return $this->sendError('Email does not match the registered user', 422);
        }

        // The frontend can retry this call (page reload, double submit, PayPal
        // returning twice). Reuse the transaction already recorded for the same
        // PayPal payment so the booking is never charged - or mailed - twice.
        $existingTransaction = $this->findExistingTransaction($pujaOrder, $request);

        if ($existingTransaction) {
            return $this->sendResponse(
                $this->paymentResponsePayload($pujaOrder, $existingTransaction, $userEmail),
                'Payment already recorded for this puja order'
            );
        }

        $paymentStatus = ($request->boolean('paypal_paid', false) || strtoupper((string) $request->input('paypal_status', '')) === 'COMPLETED')
            ? 'completed'
            : 'pending';

        $pujaOrder->update([
            'payment_status' => $paymentStatus,
        ]);

        $rawResponse = $request->input('paypal_raw', []);
        $paymentSource = PaymentTransaction::extractPaymentSource($rawResponse);

        $paymentTransaction = PaymentTransaction::create([
            'transaction_type' => PaymentTransaction::TYPE_PUJA_ORDER,
            'frontend_user_id' => $pujaOrder->user_id,
            'puja_order_id' => $pujaOrder->id,
            'puja_request_id' => $pujaOrder->puja_request_id,
            'reference_id' => $pujaOrder->puja_request_id,
            'paypal_order_id' => $request->input('paypal_order_id'),
            'paypal_capture_id' => $request->input('paypal_capture_id'),
            'paypal_status' => $request->input('paypal_status'),
            'paypal_paid' => $request->boolean('paypal_paid', false),
            'paypal_amount' => $request->input('paypal_amount'),
            'paypal_currency' => $request->input('paypal_currency'),
            // Values sent explicitly by the frontend win over the ones parsed
            // out of the raw PayPal response.
            'paypal_payer_email' => $request->input('paypal_payer_email')
                ?? $paymentSource['paypal_payer_email']
                ?? $request->email,
            'paypal_payer_id' => $request->input('paypal_payer_id') ?? $paymentSource['paypal_payer_id'],
            'payment_method' => $request->input('payment_method') ?? $paymentSource['payment_method'],
            'card_brand' => $request->input('card_brand') ?? $paymentSource['card_brand'],
            'card_type' => $request->input('card_type') ?? $paymentSource['card_type'],
            'card_last_digits' => $request->input('card_last_digits') ?? $paymentSource['card_last_digits'],
            'card_holder_name' => $request->input('card_holder_name') ?? $paymentSource['card_holder_name'],
            'paypal_create_time' => $request->input('paypal_create_time'),
            'paypal_update_time' => $request->input('paypal_update_time'),
            'paypal_raw' => $rawResponse,
        ]);

        $halls = PujaOrderList::where('puja_order_id', $pujaOrder->id)
            ->join('pujas', 'puja_order_lists.puja_id', '=', 'pujas.id')
            ->select('pujas.id', 'pujas.name', 'puja_order_lists.puja_cost')
            ->get();

        $pujaOrder->load('paymentTransactions');

        // One mail to the admin and one mail to the user - both carrying the
        // transaction details of the payment recorded above.
        $adminEmail = applicationSettings('puja-request-email');
        if ($adminEmail) {
            $this->sendMailSafely($adminEmail, new AdminPujaOrderMail($pujaOrder, $halls));
        }

        if ($userEmail) {
            $this->sendMailSafely($userEmail, new UserPujaOrderMail($pujaOrder, $halls));
        }

        return $this->sendResponse(
            $this->paymentResponsePayload($pujaOrder, $paymentTransaction, $userEmail),
            'Payment completed successfully'
        );
    }

    /**
     * Locate the transaction already stored for the same PayPal payment.
     */
    private function findExistingTransaction(PujaOrder $pujaOrder, Request $request): ?PaymentTransaction
    {
        $captureId = $request->input('paypal_capture_id');
        $orderId = $request->input('paypal_order_id');

        if (!$captureId && !$orderId) {
            return null;
        }

        return PaymentTransaction::where('puja_order_id', $pujaOrder->id)
            ->where(function ($query) use ($captureId, $orderId) {
                if ($captureId) {
                    $query->orWhere('paypal_capture_id', $captureId);
                }

                if ($orderId) {
                    $query->orWhere('paypal_order_id', $orderId);
                }
            })
            ->first();
    }

    /**
     * @return array<string, mixed>
     */
    private function paymentResponsePayload(PujaOrder $pujaOrder, PaymentTransaction $transaction, ?string $userEmail): array
    {
        return [
            'puja_request_id' => $pujaOrder->puja_request_id,
            'email' => $userEmail,
            'payment_status' => $pujaOrder->payment_status,
            // Shared across puja bookings and donations.
            'transaction_id' => $transaction->reference,
            'transaction_type' => $transaction->transaction_type,
            'paypal_order_id' => $transaction->paypal_order_id,
            'paypal_capture_id' => $transaction->paypal_capture_id,
            'paypal_status' => $transaction->paypal_status,
            'paypal_paid' => $transaction->paypal_paid,
            'paypal_amount' => $transaction->paypal_amount,
            'paypal_currency' => $transaction->paypal_currency,
            'paypal_payer_email' => $transaction->paypal_payer_email,
            'paypal_payer_id' => $transaction->paypal_payer_id,
            'payment_method' => $transaction->payment_method_label,
            'payment_source' => $transaction->payment_source_label,
        ];
    }

    /**
     * A failing mail server must not fail an already captured payment.
     */
    private function sendMailSafely(string $to, $mailable): void
    {
        try {
            Mail::to($to)->send($mailable);
        } catch (\Throwable $e) {
            Log::error('Failed to send puja order mail to ' . $to, ['exception' => $e]);
        }
    }

    private function savePujaOrder(array $input, array $cartItems, bool $sendEmails = true, bool $publicRoute = false): array
    {
        DB::beginTransaction();

        try {
            $randomPassword = Str::random(8); // Generate a random 8-character password

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
                'password' => bcrypt($randomPassword),
            ]);

            $input['user_id'] = $user->id;
            $input['puja_location'] = $input['location'];

            $pujaOrder = $this->pujaOrderRepository->create($input);

            if ($publicRoute) {
                $publicSequence = PujaOrder::whereRaw('puja_request_id LIKE ?', ['PR-%'])->count() + 1;
                $pujaOrder->forceFill([
                    'puja_request_id' => 'PR-' . str_pad((string) $publicSequence, 4, '0', STR_PAD_LEFT),
                ])->save();
            }

            $totalAmount = 0;

            foreach ($cartItems as $item) {
                $pujaCost = $input['puja_location'] === 'temple'
                    ? $item['temple_amount']
                    : $item['home_amount'];

                PujaOrderList::create([
                    'puja_order_id' => $pujaOrder->id,
                    'puja_id' => $item['id'],
                    'puja_cost' => $pujaCost,
                ]);

                $totalAmount += $pujaCost;
            }

            $pujaOrder->update(['total_amount' => $totalAmount]);

            OrderStatus::create([
                'puja_order_id' => $pujaOrder->id,
                'status' => NEW_REQUEST,
            ]);

            $halls = PujaOrderList::where('puja_order_id', $pujaOrder->id)
                ->join('pujas', 'puja_order_lists.puja_id', '=', 'pujas.id')
                ->select('pujas.id', 'pujas.name', 'puja_order_lists.puja_cost')
                ->get();

            if ($sendEmails && app()->environment('production')) {
                Mail::to(applicationSettings('puja-request-email'))->send(new AdminPujaOrderMail($pujaOrder, $halls));
                Mail::to($pujaOrder->user->email)->send(new UserPujaOrderMail($pujaOrder, $halls));
            }

            DB::commit();

            return [
                'puja_request_id' => $pujaOrder->puja_request_id,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
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
