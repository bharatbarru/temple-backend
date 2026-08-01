<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateEventCategoryRequest;
use App\Http\Requests\UpdateEventCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\EventCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class EventCategoryController extends AppBaseController
{
    /** @var EventCategoryRepository $eventCategoryRepository*/
    private $eventCategoryRepository;

    public function __construct(EventCategoryRepository $eventCategoryRepo)
    {
        $this->eventCategoryRepository = $eventCategoryRepo;
        $this->middleware('role_or_permission:add-event-categories', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-event-categories', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-event-categories', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-event-categories', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the EventCategory.
     */
    public function index(Request $request)
    {
        return view('event_categories.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $eventCategory)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Name' => $eventCategory->name,
                'Slug' => $eventCategory->slug,
                'Display Name' => $eventCategory->display_name
            ])
            ->log('Event Categories - ' . $description);
    }

    /**
     * Show the form for creating a new EventCategory.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('event_categories.create');
    }

    /**
     * Store a newly created EventCategory in storage.
     */
    public function store(CreateEventCategoryRequest $request)
    {
        $input = $request->all();

        $eventCategory = $this->eventCategoryRepository->create($input);

        if ($request->hasfile('image')) {
            $eventCategory->image = uploadImage($request->file('image'), EVENT_CATEGORY_IMAGE_PATH);
            $eventCategory->save();
        }

        // Log Activity
        $this->activityLog('New Event Category Created.', $eventCategory);

        Flash::success('Event Category saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('eventCategories.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified EventCategory.
     */
    public function show($id)
    {
        $eventCategory = $this->eventCategoryRepository->find($id);

        if (empty($eventCategory)) {
            Flash::error('Event Category not found');

            return redirect()->back();
        }

        return view('event_categories.show')->with('eventCategory', $eventCategory);
    }

    /**
     * Show the form for editing the specified EventCategory.
     */
    public function edit($id)
    {
        $eventCategory = $this->eventCategoryRepository->find($id);

        if (empty($eventCategory)) {
            Flash::error('Event Category not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('event_categories.edit')->with('eventCategory', $eventCategory);
    }

    /**
     * Update the specified EventCategory in storage.
     */
    public function update($id, UpdateEventCategoryRequest $request)
    {
        $eventCategory = $this->eventCategoryRepository->find($id);

        if (empty($eventCategory)) {
            Flash::error('Event Category not found');

            return redirect()->back();
        }

        if ($request->hasfile('image')) {
            removeImage($eventCategory->image, EVENT_CATEGORY_IMAGE_PATH);
        }

        $eventCategory = $this->eventCategoryRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $eventCategory->image = uploadImage($request->file('image'), EVENT_CATEGORY_IMAGE_PATH);
            $eventCategory->save();
        }

        // Log Activity
        $this->activityLog('Event Category details updated.', $eventCategory);

        Flash::success('Event Category updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('eventCategories.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified EventCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $eventCategory = $this->eventCategoryRepository->find($id);

        if (empty($eventCategory)) {
            Flash::error('Event Category not found');

            return redirect()->back();
        }

        try {
            if ($eventCategory->image) {
                removeImage($eventCategory->image, EVENT_CATEGORY_IMAGE_PATH);
            }
            $this->eventCategoryRepository->delete($id);

            // Log Activity
            $this->activityLog('Event Category details removed.', $eventCategory);

            Flash::success('Event Category deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'eventCategories.index');
        }
    }
}
