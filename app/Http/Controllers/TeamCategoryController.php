<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateTeamCategoryRequest;
use App\Http\Requests\UpdateTeamCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\TeamCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class TeamCategoryController extends AppBaseController
{
    /** @var TeamCategoryRepository $teamCategoryRepository*/
    private $teamCategoryRepository;

    public function __construct(TeamCategoryRepository $teamCategoryRepo)
    {
        $this->teamCategoryRepository = $teamCategoryRepo;

        $this->middleware('role_or_permission:add-team_categories', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-team_categories', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-team_categories', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-team_categories', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the TeamCategory.
     */
    public function index(Request $request)
    {
        return view('team_categories.index');
    }

    /**
     * Show the form for creating a new TeamCategory.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('team_categories.create');
    }

    /**
     * Store a newly created TeamCategory in storage.
     */
    public function store(CreateTeamCategoryRequest $request)
    {
        $input = $request->all();

        $teamCategory = $this->teamCategoryRepository->create($input);

        if ($request->hasfile('image')) {
            $teamCategory->image = uploadImage($request->file('image'), TEAM_CATEGORY_IMAGE_PATH);
        }
        $teamCategory->save();

        Flash::success('Team Category saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('teamCategories.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified TeamCategory.
     */
    public function show($id)
    {
        $teamCategory = $this->teamCategoryRepository->find($id);

        if (empty($teamCategory)) {
            Flash::error('Team Category not found');

            return redirect()->back();
        }

        return view('team_categories.show')->with('teamCategory', $teamCategory);
    }

    /**
     * Show the form for editing the specified TeamCategory.
     */
    public function edit($id)
    {
        $teamCategory = $this->teamCategoryRepository->find($id);

        if (empty($teamCategory)) {
            Flash::error('Team Category not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('team_categories.edit')->with('teamCategory', $teamCategory);
    }

    /**
     * Update the specified TeamCategory in storage.
     */
    public function update($id, UpdateTeamCategoryRequest $request)
    {
        $teamCategory = $this->teamCategoryRepository->find($id);

        if (empty($teamCategory)) {
            Flash::error('Team Category not found');

            return redirect()->back();
        }
        
        if ($request->hasfile('image')) {
            removeImage($teamCategory->image, TEAM_CATEGORY_IMAGE_PATH);
        }

        $teamCategory = $this->teamCategoryRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $teamCategory->image = uploadImage($request->file('image'), TEAM_CATEGORY_IMAGE_PATH);
        }
        $teamCategory->save();

        Flash::success('Team Category updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('teamCategories.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified TeamCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $teamCategory = $this->teamCategoryRepository->find($id);

        if (empty($teamCategory)) {
            Flash::error('Team Category not found');

            return redirect()->back();
        }

        if ($teamCategory->image  != '') {
            removeImage($teamCategory->image, TEAM_CATEGORY_IMAGE_PATH);
        }
    try{
        $this->teamCategoryRepository->delete($id);
    }
    catch (\Illuminate\Database\QueryException $e) {
        return HandleForeignKeyConstraintViolation::handle($e, 'teamCategories.index');
    }
        Flash::success('Team Category deleted successfully.');

        return redirect()->back();
    }
}
