<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStatisticsRequest;
use App\Http\Requests\UpdateStatisticsRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\StatisticsRepository;
use Illuminate\Http\Request;
use Flash;

class StatisticsController extends AppBaseController
{
    /** @var StatisticsRepository $statisticsRepository*/
    private $statisticsRepository;

    public function __construct(StatisticsRepository $statisticsRepo)
    {
        $this->statisticsRepository = $statisticsRepo;
        $this->middleware('role_or_permission:add-statistics', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-statistics', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-statistics', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-statistics', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Statistics.
     */
    public function index(Request $request)
    {
        return view('statistics.index');
    }

    /**
     * Show the form for creating a new Statistics.
     */
    public function create()
    {
        return view('statistics.create');
    }

    /**
     * Store a newly created Statistics in storage.
     */
    public function store(CreateStatisticsRequest $request)
    {
        $input = $request->all();

        $statistics = $this->statisticsRepository->create($input);

        Flash::success('Statistics saved successfully.');

        return redirect(route('statistics.index'));
    }

    /**
     * Display the specified Statistics.
     */
    public function show($id)
    {
        $statistics = $this->statisticsRepository->find($id);

        if (empty($statistics)) {
            Flash::error('Statistics not found');

            return redirect(route('statistics.index'));
        }

        return view('statistics.show')->with('statistics', $statistics);
    }

    /**
     * Show the form for editing the specified Statistics.
     */
    public function edit($id)
    {
        $statistics = $this->statisticsRepository->find($id);

        if (empty($statistics)) {
            Flash::error('Statistics not found');

            return redirect(route('statistics.index'));
        }

        return view('statistics.edit')->with('statistics', $statistics);
    }

    /**
     * Update the specified Statistics in storage.
     */
    public function update($id, UpdateStatisticsRequest $request)
    {
        $statistics = $this->statisticsRepository->find($id);

        if (empty($statistics)) {
            Flash::error('Statistics not found');

            return redirect(route('statistics.index'));
        }

        $statistics = $this->statisticsRepository->update($request->all(), $id);

        Flash::success('Statistics updated successfully.');

        return redirect(route('statistics.index'));
    }

    /**
     * Remove the specified Statistics from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $statistics = $this->statisticsRepository->find($id);

        if (empty($statistics)) {
            Flash::error('Statistics not found');

            return redirect(route('statistics.index'));
        }

        $this->statisticsRepository->delete($id);

        Flash::success('Statistics deleted successfully.');

        return redirect(route('statistics.index'));
    }
}