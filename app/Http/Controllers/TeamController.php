<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\TeamCategory;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Flash;

class TeamController extends AppBaseController
{
    /** @var TeamRepository $teamRepository*/
    private $teamRepository;

    public function __construct(TeamRepository $teamRepo)
    {
        $this->teamRepository = $teamRepo;

        
        $this->middleware('role_or_permission:add-teams', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-teams', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-teams', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-teams', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Team.
     */
    public function index(Request $request)
    {
        return view('teams.index');
    }

    /**
     * Show the form for creating a new Team.
     */
    public function create()
    {
        $categories = TeamCategory::all()->pluck('name', 'id');

        session()->put('previous_url', url()->previous());
        return view('teams.create', compact('categories'));
    }

    /**
     * Store a newly created Team in storage.
     */
    public function store(CreateTeamRequest $request)
    {
        $input = $request->all();

        $team = $this->teamRepository->create($input);

        if ($request->hasfile('image')) {
            $team->image = uploadImage($request->file('image'), TEAM_IMAGE_PATH);
        }
        $team->save();

        Flash::success('Team saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('teams.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified Team.
     */
    public function show($id)
    {
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Team not found');

            return redirect()->back();
        }

        return view('teams.show')->with('team', $team);
    }

    /**
     * Show the form for editing the specified Team.
     */
    public function edit($id)
    {
        $categories = TeamCategory::all()->pluck('name', 'id');

        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Team not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('teams.edit', compact('categories'))->with('team', $team);
    }

    /**
     * Update the specified Team in storage.
     */
    public function update($id, UpdateTeamRequest $request)
    {
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Team not found');

            return redirect()->back();
        }
        if ($request->hasfile('image')) {
            removeImage($team->image, TEAM_IMAGE_PATH);
        }

        $team = $this->teamRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $team->image = uploadImage($request->file('image'), TEAM_IMAGE_PATH);
        }
        $team->save();

        Flash::success('Team updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('teams.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified Team from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Team not found');

            return redirect()->back();
        }

        if ($team->image  != '') {
            removeImage($team->image, TEAM_IMAGE_PATH);
        }
    
    try{
        $this->teamRepository->delete($id);
    }
    catch (\Illuminate\Database\QueryException $e) {
       return HandleForeignKeyConstraintViolation::handle($e, 'teams.index');
   }
   
        Flash::success('Team deleted successfully.');

        return redirect()->back();
    }
}