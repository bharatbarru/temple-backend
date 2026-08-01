<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateTempleTourRequest;
use App\Http\Requests\UpdateTempleTourRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\OrderStatus;
use App\Repositories\TempleTourRepository;
use Illuminate\Http\Request;
use Flash;

class TempleTourController extends AppBaseController
{
    /** @var TempleTourRepository $templeTourRepository*/
    private $templeTourRepository;

    public function __construct(TempleTourRepository $templeTourRepo)
    {
        $this->templeTourRepository = $templeTourRepo;
        $this->middleware('role_or_permission:add-temple-tours', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-temple-tours', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-temple-tours', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-temple-tours', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the TempleTour.
     */
    public function index(Request $request)
    {
        return view('temple_tours.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $templeTour)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Tour Request Id' => $templeTour->tour_request_id,
                'Name' => $templeTour->name,
                'Tour Date' => $templeTour->tour_date,
            ])
            ->log('Temple Tour - ' . $description);
    }

    /**
     * Show the form for creating a new TempleTour.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return redirect()->back();
        // return view('temple_tours.create');
    }

    /**
     * Store a newly created TempleTour in storage.
     */
    public function store(CreateTempleTourRequest $request)
    {
        $input = $request->all();

        $templeTour = $this->templeTourRepository->create($input);

        // Log Activity
        $this->activityLog('New Temple Tour Created.', $templeTour);

        Flash::success('Temple Tour saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('templeTours.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified TempleTour.
     */
    public function show($id)
    {
        $templeTour = $this->templeTourRepository->find($id);

        if (empty($templeTour)) {
            Flash::error('Temple Tour not found');

            return redirect()->back();
        }

        return view('temple_tours.show')->with('templeTour', $templeTour);
    }

    /**
     * Show the form for editing the specified TempleTour.
     */
    public function edit($id)
    {
        session()->put('previous_url', url()->previous());
        return redirect()->back();
        // $templeTour = $this->templeTourRepository->find($id);

        // if (empty($templeTour)) {
        //     Flash::error('Temple Tour not found');

        //     return redirect()->back();
        // }

        // return view('temple_tours.edit')->with('templeTour', $templeTour);
    }

    /**
     * Update the specified TempleTour in storage.
     */
    public function update($id, UpdateTempleTourRequest $request)
    {
        $templeTour = $this->templeTourRepository->find($id);

        if (empty($templeTour)) {
            Flash::error('Temple Tour not found');

            return redirect()->back();
        }

        $templeTour = $this->templeTourRepository->update($request->all(), $id);

        // Log Activity
        $this->activityLog('Temple Tour details updated.', $templeTour);

        Flash::success('Temple Tour updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('templeTours.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified TempleTour from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $templeTour = $this->templeTourRepository->find($id);

        if (empty($templeTour)) {
            Flash::error('Temple Tour not found');

            return redirect()->back();
        }

        try {
            OrderStatus::where('temple_tour_order_id', $id)->delete();
            $this->templeTourRepository->delete($id);

            // Log Activity
            $this->activityLog('Temple Tour details removed.', $templeTour);

            Flash::success('Temple Tour deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'templeTours.index');
        }
    }
}
