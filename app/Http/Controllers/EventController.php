<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\EventCategory;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use Flash;

class EventController extends AppBaseController
{
    /** @var EventRepository $eventRepository*/
    private $eventRepository;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepository = $eventRepo;
        $this->middleware('role_or_permission:add-events', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-events', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-events', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-events', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Event.
     */
    public function index(Request $request)
    {
        return view('events.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $event)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Title' => $event->title,
                'Slug' => $event->slug,
                'Start Date Time' => $event->start_date_time,
                'End Date Time' => $event->end_date_time,
            ])
            ->log('Events - ' . $description);
    }

    /**
     * Show the form for creating a new Event.
     */
    public function create()
    {
        $eventCategories = EventCategory::all()->pluck('name', 'id');
        session()->put('previous_url', url()->previous());
        return view('events.create', compact('eventCategories'));
    }

    /**
     * Store a newly created Event in storage.
     */
    public function store(CreateEventRequest $request)
    {
        $input = $request->all();

        $event = $this->eventRepository->create($input);

        if ($request->hasfile('image')) {
            $event->image = uploadImage($request->file('image'), EVENT_IMAGE_PATH);
            $event->save();
        }

        // Log Activity
        $this->activityLog('New Event Created.', $event);

        Flash::success('Event saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('events.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified Event.
     */
    public function show($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect()->back();
        }

        return view('events.show')->with('event', $event);
    }

    /**
     * Show the form for editing the specified Event.
     */
    public function edit($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect()->back();
        }

        $eventCategories = EventCategory::all()->pluck('name', 'id');
        session()->put('previous_url', url()->previous());
        return view('events.edit', compact('event', 'eventCategories'));
    }

    /**
     * Update the specified Event in storage.
     */
    public function update($id, UpdateEventRequest $request)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect()->back();
        }

        if ($request->hasfile('image')) {
            removeImage($event->image, EVENT_IMAGE_PATH);
        }

        $event = $this->eventRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $event->image = uploadImage($request->file('image'), EVENT_IMAGE_PATH);
            $event->save();
        }

        // Log Activity
        $this->activityLog('Event details updated.', $event);

        Flash::success('Event updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('events.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified Event from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect()->back();
        }

        try {
            if ($event->image) {
                removeImage($event->image, EVENT_IMAGE_PATH);
            }
            $this->eventRepository->delete($id);

            // Log Activity
            $this->activityLog('Event details removed.', $event);

            Flash::success('Event deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'events.index');
        }
    }
}
