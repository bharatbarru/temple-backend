<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateHallOrderRequest;
use App\Http\Requests\UpdateHallOrderRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\HallOrderAddonList;
use App\Models\Hall;
use App\Models\HallAddon;
use App\Models\HallAddonCost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\HallOrderList;
use App\Models\HallEventType;
use App\Models\OrderStatus;
use App\Models\HallOrder;

use App\Repositories\HallOrderRepository;
use Illuminate\Http\Request;
use Flash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\FrontendUser;

class HallOrderController extends AppBaseController
{
    /** @var HallOrderRepository $hallOrderRepository*/
    private $hallOrderRepository;

    public function __construct(HallOrderRepository $hallOrderRepo)
    {
        $this->hallOrderRepository = $hallOrderRepo;
        $this->middleware('role_or_permission:add-hall-orders', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-hall-orders', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-hall-orders', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-hall-orders', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the HallOrder.
     */
    public function index(Request $request)
    {
        return view('hall_orders.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $hallOrder)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Name' => $hallOrder->hall_request_id,
                'Type of Event' => $hallOrder->type_of_event,
            ])
            ->log('Hall Management / Hall Orders - ' . $description);
    }

    /**
     * Show the form for creating a new HallOrder.
     */
    public function create()
    {
        $mainHalls = Hall::where('publish', 1)->get();
        $hallAddons = HallAddon::where('publish', 1)->get();
        $hallEventTypes = HallEventType::pluck('name', 'id');

        $hallsWithAddonsAndCosts = [];
        foreach ($mainHalls as $hall) {
            $hallData = $hall->toArray();
            $hallData['addons'] = [];
            foreach ($hallAddons as $addon) {
                $addonCost = HallAddonCost::where('hall_id', $hall->id)
                                          ->where('hall_addon_id', $addon->id)
                                          ->first();

                $addonData = $addon->toArray();
                $addonData['monday_cost'] = $addonCost->monday_cost ?? 0;
                $addonData['tuesday_cost'] = $addonCost->tuesday_cost ?? 0;
                $addonData['wednesday_cost'] = $addonCost->wednesday_cost ?? 0;
                $addonData['thursday_cost'] = $addonCost->thursday_cost ?? 0;
                $addonData['friday_cost'] = $addonCost->friday_cost ?? 0;
                $addonData['saturday_cost'] = $addonCost->saturday_cost ?? 0;
                $addonData['sunday_cost'] = $addonCost->sunday_cost ?? 0;

                $hallData['addons'][] = $addonData;
            }
            $hallsWithAddonsAndCosts[] = $hallData;
        }

        return view('hall_orders.create', compact('hallEventTypes', 'hallsWithAddonsAndCosts'));
    }

    /**
     * Store a newly created HallOrder in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        dd($input);
       
        // Format dates to YYYY-MM-DD
        if($request->date_of_event) {
            $input['date_of_event'] = Carbon::parse($request->date_of_event)->format('Y-m-d');
        }
        if($request->end_date_of_event) {
            $input['end_date_of_event'] = Carbon::parse($request->end_date_of_event)->format('Y-m-d');
        }
        if($request->alternate_date_of_event) {
            $input['alternate_date_of_event'] = Carbon::parse($request->alternate_date_of_event)->format('Y-m-d');
        }

        $selectedHalls = $input['selected_halls'] ?? []; 
        $selectedAddons = $input['selected_addons'] ?? [];
        $hallCosts = $input['hall_costs'] ?? [];
        $addonCosts = $input['addon_costs'] ?? [];

        if($request->end_date_of_event){
            $startDate = Carbon::parse($input['date_of_event']);
            $endDate = Carbon::parse($input['end_date_of_event']);
            $input['number_of_days'] = $endDate->diffInDays($startDate) + 1; // Adding 1 to include both start and end dates
        }else{
            $input['number_of_days'] = 1;
        }
        
        DB::beginTransaction();

        try {
            // Check if user already exists based on email or mobile
            $randomPassword = Str::random(8); // Generate a random 8-character password

            // Create a new user
            $user = FrontendUser::create([
                'community_name' => $input['community_name'] ?? null,
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'] ?? null,
                'email' => $input['email'],
                'mobile' => $input['mobile'],
                'address' => $input['address'] ?? null,
                'country' => $input['country'] ?? null,
                'state' => $input['state'] ?? null,
                'city' => $input['city'] ?? null,
                'pincode' => $input['pincode'] ?? null,
                'password' => bcrypt($randomPassword),
            ]);

            // Add user_id to request data for HallOrder
            $input['user_id'] = $user->id;
            
            // Generate hall_request_id
            $date = Carbon::now()->format('Ymd');
            $lastOrder = HallOrder::whereDate('created_at', Carbon::today())->latest()->first();
            $sequenceNumber = $lastOrder ? intval(substr($lastOrder->hall_request_id, -4)) + 1 : 1385;
            $input['hall_request_id'] = $date . 'SH' . str_pad($sequenceNumber, 4, '0', STR_PAD_LEFT);
            
            // Create Hall Order
            $hallOrder = $this->hallOrderRepository->create($input);

            $totalAmount = 0;

            // Store Hall Order Details
            foreach ($selectedHalls as $hallId) {
                $hall = Hall::find($hallId);
                if (!$hall) continue;

                // Get the hall cost from the frontend
                $hallCost = floatval($hallCosts[$hallId] ?? 0);

                // Store Hall in HallOrderList
                HallOrderList::create([
                    'hall_order_id' => $hallOrder->id,
                    'hall_id' => $hallId,
                    'hall_cost' => $hallCost,
                    'no_of_hours' => $input['duration'] ?? null,
                ]);

                // Store Hall Addon in HallOrderAddonList
                if (isset($selectedAddons[$hallId])) {
                    foreach ($selectedAddons[$hallId] as $addonId) {
                        // Get the addon cost from the frontend
                        $addonCostValue = floatval($addonCosts[$hallId][$addonId] ?? 0);

                        // Log the addon cost for debugging
                        Log::info('Addon Cost Details', [
                            'hall_id' => $hallId,
                            'addon_id' => $addonId,
                            'cost' => $addonCostValue,
                            'raw_cost' => $addonCosts[$hallId][$addonId] ?? 0
                        ]);

                        HallOrderAddonList::create([
                            'hall_order_id' => $hallOrder->id,
                            'hall_id' => $hallId,
                            'hall_addon_id' => $addonId,
                            'addon_cost' => $addonCostValue,
                            'no_of_hours' => $input['duration'] ?? null,
                        ]);
                        $totalAmount += $addonCostValue;
                    }
                }

                $totalAmount += $hallCost;
            }

            // Update Total Amount in Hall Order
            $hallOrder->update(['total_amount' => $totalAmount]);

            // Create Hall Order Status
            OrderStatus::create([
                'hall_order_id' => $hallOrder->id,
                'status' => NEW_REQUEST,
            ]);

            DB::commit();

            // Prepare response data
            $data = [
                'hall_request_id' => $hallOrder->hall_request_id,
            ];

            Flash::success('Hall Order created successfully.');

            return redirect()->route('hallOrders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating Hall Order: ' . $e->getMessage());
            Log::error($e);
            Flash::error('Error creating Hall Order: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified HallOrder.
     */
    public function show($id)
    {
        $hallOrder = $this->hallOrderRepository->find($id);

        if (empty($hallOrder)) {
            Flash::error('Hall Order not found');

            return redirect()->back();
        }

        return view('hall_orders.show')->with('hallOrder', $hallOrder);
    }

    /**
     * Show the form for editing the specified HallOrder.
     */
    public function edit($id)
    {
        session()->put('previous_url', url()->previous());
        return redirect()->back();
        // $hallOrder = $this->hallOrderRepository->find($id);

        // if (empty($hallOrder)) {
        //     Flash::error('Hall Order not found');

        //     return redirect()->back();
        // }

        // return view('hall_orders.edit')->with('hallOrder', $hallOrder);
    }

    /**
     * Update the specified HallOrder in storage.
     */
    public function update($id, UpdateHallOrderRequest $request)
    {
        $hallOrder = $this->hallOrderRepository->find($id);

        if (empty($hallOrder)) {
            Flash::error('Hall Order not found');

            return redirect()->back();
        }

        $hallOrder = $this->hallOrderRepository->update($request->all(), $id);

        // Log Activity
        $this->activityLog('Hall Order details updated.', $hallOrder);

        Flash::success('Hall Order updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('hallOrders.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified HallOrder from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $hallOrder = $this->hallOrderRepository->find($id);

        if (empty($hallOrder)) {
            Flash::error('Hall Order not found');

            return redirect()->back();
        }

        try {
            HallOrderAddonList::where('hall_order_id', $id)->delete();
            HallOrderList::where('hall_order_id', $id)->delete();
            OrderStatus::where('hall_order_id', $id)->delete();
            
            $this->hallOrderRepository->delete($id);

            // Log Activity
            $this->activityLog('Hall Order details removed.', $hallOrder);

            Flash::success('Hall Order deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'hallOrders.index');
        }
    }
}