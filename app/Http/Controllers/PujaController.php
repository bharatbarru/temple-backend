<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreatePujaRequest;
use App\Http\Requests\UpdatePujaRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PujaRepository;
use Illuminate\Http\Request;
use Flash;

class PujaController extends AppBaseController
{
    /** @var PujaRepository $pujaRepository*/
    private $pujaRepository;

    public function __construct(PujaRepository $pujaRepo)
    {
        $this->pujaRepository = $pujaRepo;
        $this->middleware('role_or_permission:add-pujas', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-pujas', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-pujas', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-pujas', ['only' => ['index', 'show']]);
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
            ->log('Pujas - ' . $description);
    }

    /**
     * Display a listing of the Puja.
     */
    public function index(Request $request)
    {
        return view('pujas.index');
    }

    /**
     * Show the form for creating a new Puja.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('pujas.create');
    }

    /**
     * Store a newly created Puja in storage.
     */
    public function store(CreatePujaRequest $request)
    {
        $input = $request->all();

        $puja = $this->pujaRepository->create($input);

        // Log Activity
        $this->activityLog('New Puja Created.', $puja);

        Flash::success('Puja saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('pujas.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified Puja.
     */
    public function show($id)
    {
        $puja = $this->pujaRepository->find($id);

        if (empty($puja)) {
            Flash::error('Puja not found');

            return redirect()->back();
        }

        return view('pujas.show')->with('puja', $puja);
    }

    /**
     * Show the form for editing the specified Puja.
     */
    public function edit($id)
    {
        $puja = $this->pujaRepository->find($id);

        if (empty($puja)) {
            Flash::error('Puja not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('pujas.edit')->with('puja', $puja);
    }

    /**
     * Update the specified Puja in storage.
     */
    public function update($id, UpdatePujaRequest $request)
    {
        $puja = $this->pujaRepository->find($id);

        if (empty($puja)) {
            Flash::error('Puja not found');

            return redirect()->back();
        }

        $puja = $this->pujaRepository->update($request->all(), $id);

        // Log Activity
        $this->activityLog('Puja details updated.', $puja);

        Flash::success('Puja updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('pujas.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified Puja from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $puja = $this->pujaRepository->find($id);

        if (empty($puja)) {
            Flash::error('Puja not found');

            return redirect()->back();
        }

        try {
            $this->pujaRepository->delete($id);

            // Log Activity
            $this->activityLog('Puja details removed.', $puja);

            Flash::success('Puja deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'pujas.index');
        }
    }
}
