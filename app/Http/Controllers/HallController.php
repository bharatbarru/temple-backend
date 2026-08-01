<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateHallRequest;
use App\Http\Requests\UpdateHallRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\HallRepository;
use Illuminate\Http\Request;
use Flash;

class HallController extends AppBaseController
{
    /** @var HallRepository $hallRepository*/
    private $hallRepository;

    public function __construct(HallRepository $hallRepo)
    {
        $this->hallRepository = $hallRepo;
        $this->middleware('role_or_permission:add-halls', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-halls', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-halls', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-halls', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Hall.
     */
    public function index(Request $request)
    {
        return view('halls.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $hall)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Name' => $hall->name,
                'Description' => $hall->description,
            ])
            ->log('Hall Management / Halls - ' . $description);
    }

    /**
     * Show the form for creating a new Hall.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('halls.create');
    }

    /**
     * Store a newly created Hall in storage.
     */
    public function store(CreateHallRequest $request)
    {
        $input = $request->all();

        $hall = $this->hallRepository->create($input);

        if ($request->hasfile('image')) {
            $hall->image = uploadImage($request->file('image'), HALL_IMAGE_PATH);
            $hall->save();
        }

        // Log Activity
        $this->activityLog('New Hall Created.', $hall);

        Flash::success('Hall saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('halls.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified Hall.
     */
    public function show($id)
    {
        $hall = $this->hallRepository->find($id);

        if (empty($hall)) {
            Flash::error('Hall not found');

            return redirect()->back();
        }

        return view('halls.show')->with('hall', $hall);
    }

    /**
     * Show the form for editing the specified Hall.
     */
    public function edit($id)
    {
        $hall = $this->hallRepository->find($id);

        if (empty($hall)) {
            Flash::error('Hall not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('halls.edit')->with('hall', $hall);
    }

    /**
     * Update the specified Hall in storage.
     */
    public function update($id, UpdateHallRequest $request)
    {
        $hall = $this->hallRepository->find($id);

        if (empty($hall)) {
            Flash::error('Hall not found');

            return redirect()->back();
        }

        if ($request->hasfile('image')) {
            removeImage($hall->image, HALL_IMAGE_PATH);
        }

        $hall = $this->hallRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $hall->image = uploadImage($request->file('image'), HALL_IMAGE_PATH);
            $hall->save();
        }

        // Log Activity
        $this->activityLog('Hall details updated.', $hall);

        Flash::success('Hall updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('halls.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified Hall from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $hall = $this->hallRepository->find($id);

        if (empty($hall)) {
            Flash::error('Hall not found');

            return redirect()->back();
        }

        try {
            if ($hall->image) {
                removeImage($hall->image, HALL_IMAGE_PATH);
            }
            $hallAddonCosts = $hall->hallAddonCosts;
            foreach ($hallAddonCosts as $cost) {
                $cost->delete();
            }
            $this->hallRepository->delete($id);

            // Log Activity
            $this->activityLog('Hall details removed.', $hall);

            Flash::success('Hall deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'halls.index');
        }
    }
}
