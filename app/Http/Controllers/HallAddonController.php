<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateHallAddonRequest;
use App\Http\Requests\UpdateHallAddonRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Hall;
use App\Models\HallAddonCost;
use App\Repositories\HallAddonRepository;
use Illuminate\Http\Request;
use Flash;

class HallAddonController extends AppBaseController
{
    /** @var HallAddonRepository $hallAddonRepository*/
    private $hallAddonRepository;

    public function __construct(HallAddonRepository $hallAddonRepo)
    {
        $this->hallAddonRepository = $hallAddonRepo;
        $this->middleware('role_or_permission:add-hall-addons', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-hall-addons', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-hall-addons', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-hall-addons', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the HallAddon.
     */
    public function index(Request $request)
    {
        return view('hall_addons.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $puja)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Name' => $puja->name,
                'Home Amount' => $puja->home_amount,
                'Temple Amount' => $puja->temple_amount
            ])
            ->log('Hall Management / Hall Addons - ' . $description);
    }

    /**
     * Show the form for creating a new HallAddon.
     */
    public function create()
    {
        $halls = Hall::all();
        session()->put('previous_url', url()->previous());
        return view('hall_addons.create', compact('halls'));
    }

    /**
     * Store a newly created HallAddon in storage.
     */
    public function store(CreateHallAddonRequest $request)
    {
        $input = $request->all();

        $hallAddon = $this->hallAddonRepository->create($input);

        if ($request->hasfile('image')) {
            $hallAddon->image = uploadImage($request->file('image'), HALL_ADDON_IMAGE_PATH);
            $hallAddon->save();
        }

        // Store Hall Addon Costs
        if (!empty($request->costs)) {
            foreach ($request->costs as $hallId => $costData) {
                HallAddonCost::create([
                    'hall_id' => $hallId,
                    'hall_addon_id' => $hallAddon->id,
                    'monday_cost' => $costData['monday'] ?? 0,
                    'tuesday_cost' => $costData['tuesday'] ?? 0,
                    'wednesday_cost' => $costData['wednesday'] ?? 0,
                    'thursday_cost' => $costData['thursday'] ?? 0,
                    'friday_cost' => $costData['friday'] ?? 0,
                    'saturday_cost' => $costData['saturday'] ?? 0,
                    'sunday_cost' => $costData['sunday'] ?? 0,
                ]);
            }
        }

        // Log Activity
        $this->activityLog('New Hall Addon Created.', $hallAddon);

        Flash::success('Hall Addon saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('hallAddons.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified HallAddon.
     */
    public function show($id)
    {
        $hallAddon = $this->hallAddonRepository->find($id);

        if (empty($hallAddon)) {
            Flash::error('Hall Addon not found');

            return redirect()->back();
        }

        return view('hall_addons.show')->with('hallAddon', $hallAddon);
    }

    /**
     * Show the form for editing the specified HallAddon.
     */
    public function edit($id)
    {
        $hallAddon = $this->hallAddonRepository->find($id);

        if (empty($hallAddon)) {
            Flash::error('Hall Addon not found');

            return redirect()->back();
        }

        $halls = Hall::all();

        session()->put('previous_url', url()->previous());
        return view('hall_addons.edit', compact('halls', 'hallAddon'));
    }

    /**
     * Update the specified HallAddon in storage.
     */
    public function update($id, UpdateHallAddonRequest $request)
    {
        $hallAddon = $this->hallAddonRepository->find($id);

        if (empty($hallAddon)) {
            Flash::error('Hall Addon not found');

            return redirect()->back();
        }

        if ($request->hasfile('image')) {
            removeImage($hallAddon->image, HALL_ADDON_IMAGE_PATH);
        }

        $hallAddon = $this->hallAddonRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $hallAddon->image = uploadImage($request->file('image'), HALL_ADDON_IMAGE_PATH);
            $hallAddon->save();
        }

        // Update Hall Addon Costs
        if (!empty($request->costs)) {
            foreach ($request->costs as $hallId => $costData) {
                HallAddonCost::updateOrCreate(
                    [
                        'hall_id' => $hallId,
                        'hall_addon_id' => $hallAddon->id
                    ],
                    [
                        'monday_cost' => $costData['monday'] ?? 0,
                        'tuesday_cost' => $costData['tuesday'] ?? 0,
                        'wednesday_cost' => $costData['wednesday'] ?? 0,
                        'thursday_cost' => $costData['thursday'] ?? 0,
                        'friday_cost' => $costData['friday'] ?? 0,
                        'saturday_cost' => $costData['saturday'] ?? 0,
                        'sunday_cost' => $costData['sunday'] ?? 0,
                    ]
                );
            }
        }

        // Log Activity
        $this->activityLog('Hall Addon details updated.', $hallAddon);

        Flash::success('Hall Addon updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('hallAddons.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified HallAddon from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $hallAddon = $this->hallAddonRepository->find($id);

        if (empty($hallAddon)) {
            Flash::error('Hall Addon not found');

            return redirect()->back();
        }

        try {
            if ($hallAddon->image) {
                removeImage($hallAddon->image, HALL_ADDON_IMAGE_PATH);
            }

            // Delete Hall Addon Costs
            HallAddonCost::where('hall_addon_id', $id)->delete();
            $this->hallAddonRepository->delete($id);

            // Log Activity
            $this->activityLog('Hall Addon details removed.', $hallAddon);

            Flash::success('Hall Addon deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'hallAddons.index');
        }
    }
}
