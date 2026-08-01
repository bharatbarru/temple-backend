<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreatePujaOrderRequest;
use App\Http\Requests\UpdatePujaOrderRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\OrderStatus;
use App\Models\PujaOrderList;
use App\Repositories\PujaOrderRepository;
use Illuminate\Http\Request;
use Flash;

class PujaOrderController extends AppBaseController
{
    /** @var PujaOrderRepository $pujaOrderRepository*/
    private $pujaOrderRepository;

    public function __construct(PujaOrderRepository $pujaOrderRepo)
    {
        $this->pujaOrderRepository = $pujaOrderRepo;
        $this->middleware('role_or_permission:add-puja-orders', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-puja-orders', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-puja-orders', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-puja-orders', ['only' => ['index', 'show']]);
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $pujaOrder)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Puja Request Id' => $pujaOrder->puja_request_id,
                'First Name' => $pujaOrder->user->first_name ?? '',
                'Last Name' => $pujaOrder->user->last_name ?? '',
            ])
            ->log('Puja Orders - ' . $description);
    }

    /**
     * Display a listing of the PujaOrder.
     */
    public function index(Request $request)
    {
        return view('puja_orders.index');
    }

    /**
     * Show the form for creating a new PujaOrder.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        // return view('puja_orders.create');
        return redirect()->back();
    }

    /**
     * Store a newly created PujaOrder in storage.
     */
    public function store(CreatePujaOrderRequest $request)
    {
        $input = $request->all();

        $pujaOrder = $this->pujaOrderRepository->create($input);

        // Log Activity
        $this->activityLog('New Puja Order Created.', $pujaOrder);

        Flash::success('Puja Order saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('pujaOrders.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified PujaOrder.
     */
    public function show($id)
    {
        $pujaOrder = $this->pujaOrderRepository->find($id);

        if (empty($pujaOrder)) {
            Flash::error('Puja Order not found');

            return redirect()->back();
        }

        return view('puja_orders.show')->with('pujaOrder', $pujaOrder);
    }

    /**
     * Show the form for editing the specified PujaOrder.
     */
    public function edit($id)
    {
        // $pujaOrder = $this->pujaOrderRepository->find($id);

        // if (empty($pujaOrder)) {
        //     Flash::error('Puja Order not found');

        //     return redirect()->back();
        // }
        // return view('puja_orders.edit')->with('pujaOrder', $pujaOrder);

        session()->put('previous_url', url()->previous());
        return redirect()->back();
    }

    /**
     * Update the specified PujaOrder in storage.
     */
    public function update($id, UpdatePujaOrderRequest $request)
    {
        $pujaOrder = $this->pujaOrderRepository->find($id);

        if (empty($pujaOrder)) {
            Flash::error('Puja Order not found');

            return redirect()->back();
        }

        $pujaOrder = $this->pujaOrderRepository->update($request->all(), $id);

        // Log Activity
        $this->activityLog('Puja Order details updated.', $pujaOrder);

        Flash::success('Puja Order updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('pujaOrders.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified PujaOrder from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pujaOrder = $this->pujaOrderRepository->find($id);

        if (empty($pujaOrder)) {
            Flash::error('Puja Order not found');

            return redirect()->back();
        }

        try {
            OrderStatus::where('puja_order_id', $pujaOrder->id)->delete();
            PujaOrderList::where('puja_order_id', $pujaOrder->id)->delete();
            $this->pujaOrderRepository->delete($id);

            // Log Activity
            $this->activityLog('Puja Order details removed.', $pujaOrder);

            Flash::success('Puja Order deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'pujaOrders.index');
        }
    }
}
