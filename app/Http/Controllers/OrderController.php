<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Controllers\AppBaseController;
use App\Mail\OrderAcceptUserMail;
use App\Mail\OrderDeclineUserMail;
use App\Models\Order;
use App\Models\RoyaltyPoint;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Flash;

class OrderController extends AppBaseController
{
    /** @var OrderRepository $orderRepository*/
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
        $this->middleware('role_or_permission:add-orders', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-orders', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-orders', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-orders', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Order.
     */
    public function index(Request $request)
    {
        return view('orders.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $order)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Name' => $order->name,
                'Email' => $order->email,
                'Mobile' => $order->mobile
            ])
            ->log('Orders - ' . $description);
    }

    /**
     * Show the form for creating a new Order.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created Order in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

        // Log Activity
        $this->activityLog('New Order Created.', $order);

        Flash::success('Order saved successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified Order.
     */
    public function show($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified Order.
     */
    public function edit($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.edit')->with('order', $order);
    }

    /**
     * Update the specified Order in storage.
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $order = $this->orderRepository->update($request->all(), $id);

        // Log Activity
        $this->activityLog('Order details updated.', $order);

        Flash::success('Order updated successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        try {
            RoyaltyPoint::where('order_id', $order->id)->delete();
            $order->orderProducts()->delete();
            $this->orderRepository->delete($id);

            // Log Activity
            $this->activityLog('Order details removed.', $order);

            Flash::success('Order deleted successfully.');

            return redirect(route('orders.index'));
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'orders.index');
        }
    }

    public function acceptOrder($id)
    {
        $order = Order::find($id);
        $order->order_status = 'accepted';
        $order->save();

        // Check if environment is not localhost
        if (!app()->environment('local')) {
            $userEmail = $order->customer ? $order->customer->email : $order->guest_email;
            Mail::to($userEmail)->send(new OrderAcceptUserMail($order));
        }

        return redirect()->back();
    }

    public function declineOrder($id)
    {
        $order = Order::find($id);
        return view('orders.decline', compact('order'));
    }

    public function declineOrderSubmission(Request $request)
    {
        $order = Order::find($request->id);
        $order->order_status = 'declined';
        $order->reason_for_cancellation = $request->reason_for_cancellation;
        $order->save();

        // Check if environment is not localhost
        if (!app()->environment('local')) {
            $userEmail = $order->customer ? $order->customer->email : $order->guest_email;
            Mail::to($userEmail)->send(new OrderDeclineUserMail($order));
        }

        return redirect()->back();
    }

    public function completeOrder($id)
    {
        $order = Order::find($id);
        $order->order_status = 'completed';
        $order->save();

        // Calculate Royalty Points
        $this->calculateRoyaltyPoints($order);

        return redirect()->back();
    }

    protected function calculateRoyaltyPoints($order)
    {
        // Only proceed if the order has a customer_id (registered user)
        if (!empty($order->customer_id)) {
            // Retrieve the royalty points percentage from application settings
            $percentage = (float) applicationSettings('royalty-points-percentage');

            // If the percentage is invalid (not a number or less than 0), default to 0
            if ($percentage <= 0 || !is_numeric($percentage)) {
                $percentage = 0.00;
            }

            // Calculate the royalty points (percentage of the total amount)
            $points = ($order->total_amount * $percentage) / 100;

            if ($points > 0) {
                // Store the royalty points in the RoyaltyPoint table
                RoyaltyPoint::create([
                    'customer_id' => $order->customer_id,
                    'order_id' => $order->id,
                    'points' => $points
                ]);
            }
        }
    }
}
