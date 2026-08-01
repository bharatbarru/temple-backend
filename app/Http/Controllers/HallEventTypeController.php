<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateHallEventTypeRequest;
use App\Http\Requests\UpdateHallEventTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\HallEventTypeRepository;
use Illuminate\Http\Request;
use Flash;

class HallEventTypeController extends AppBaseController
{
    /** @var HallEventTypeRepository $hallEventTypeRepository*/
    private $hallEventTypeRepository;

    public function __construct(HallEventTypeRepository $hallEventTypeRepo)
    {
        $this->hallEventTypeRepository = $hallEventTypeRepo;
        $this->middleware('role_or_permission:add-hall-event-types', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-hall-event-types', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-hall-event-types', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-hall-event-types', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the HallEventType.
     */
    public function index(Request $request)
    {
        return view('hall_event_types.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $hallEventType)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Name' => $hallEventType->name,
            ])
            ->log('Hall Management / Hall Event Types - ' . $description);
    }

    /**
     * Show the form for creating a new HallEventType.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('hall_event_types.create');
    }

    /**
     * Store a newly created HallEventType in storage.
     */
    public function store(CreateHallEventTypeRequest $request)
    {
        $input = $request->all();

        $hallEventType = $this->hallEventTypeRepository->create($input);

        // Log Activity
        $this->activityLog('New Hall Event Type Created.', $hallEventType);

        Flash::success('Hall Event Type saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('hallEventTypes.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified HallEventType.
     */
    public function show($id)
    {
        $hallEventType = $this->hallEventTypeRepository->find($id);

        if (empty($hallEventType)) {
            Flash::error('Hall Event Type not found');

            return redirect()->back();
        }

        return view('hall_event_types.show')->with('hallEventType', $hallEventType);
    }

    /**
     * Show the form for editing the specified HallEventType.
     */
    public function edit($id)
    {
        $hallEventType = $this->hallEventTypeRepository->find($id);

        if (empty($hallEventType)) {
            Flash::error('Hall Event Type not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('hall_event_types.edit')->with('hallEventType', $hallEventType);
    }

    /**
     * Update the specified HallEventType in storage.
     */
    public function update($id, UpdateHallEventTypeRequest $request)
    {
        $hallEventType = $this->hallEventTypeRepository->find($id);

        if (empty($hallEventType)) {
            Flash::error('Hall Event Type not found');

            return redirect()->back();
        }

        $hallEventType = $this->hallEventTypeRepository->update($request->all(), $id);

        // Log Activity
        $this->activityLog('Hall Event Type details updated.', $hallEventType);

        Flash::success('Hall Event Type updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('hallEventTypes.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified HallEventType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $hallEventType = $this->hallEventTypeRepository->find($id);

        if (empty($hallEventType)) {
            Flash::error('Hall Event Type not found');

            return redirect()->back();
        }

        try {
            $this->hallEventTypeRepository->delete($id);

            // Log Activity
            $this->activityLog('Hall Event Type details removed.', $hallEventType);

            Flash::success('Hall Event Type deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'hallEventTypes.index');
        }
    }
}
