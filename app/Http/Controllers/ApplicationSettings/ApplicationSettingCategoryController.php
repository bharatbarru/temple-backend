<?php

namespace App\Http\Controllers\ApplicationSettings;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateApplicationSettingCategoryRequest;
use App\Http\Requests\UpdateApplicationSettingCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ApplicationSettingCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class ApplicationSettingCategoryController extends AppBaseController
{
    /** @var ApplicationSettingCategoryRepository $applicationSettingCategoryRepository*/
    private $applicationSettingCategoryRepository;

    public function __construct(ApplicationSettingCategoryRepository $applicationSettingCategoryRepo)
    {
        $this->applicationSettingCategoryRepository = $applicationSettingCategoryRepo;
        $this->middleware('role_or_permission:add-application-setting-categories', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-application-setting-categories', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-application-setting-categories', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-application-setting-categories', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the ApplicationSettingCategory.
     */
    public function index(Request $request)
    {
        return view('application-settings.application_setting_categories.index');
    }

    /**
     * Show the form for creating a new ApplicationSettingCategory.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('application-settings.application_setting_categories.create');
    }

    /**
     * Store a newly created ApplicationSettingCategory in storage.
     */
    public function store(CreateApplicationSettingCategoryRequest $request)
    {
        $input = $request->all();

        $applicationSettingCategory = $this->applicationSettingCategoryRepository->create($input);

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['name' => $request->name])
            ->log('Application Settings / Categories - New category created.');

        Flash::success('Application Setting Category saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('applicationSettingCategories.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified ApplicationSettingCategory.
     */
    public function show($id)
    {
        $applicationSettingCategory = $this->applicationSettingCategoryRepository->find($id);

        if (empty($applicationSettingCategory)) {
            Flash::error('Application Setting Category not found');

            return redirect()->back();
        }

        return view('application-settings.application_setting_categories.show')->with('applicationSettingCategory', $applicationSettingCategory);
    }

    /**
     * Show the form for editing the specified ApplicationSettingCategory.
     */
    public function edit($id)
    {
        $applicationSettingCategory = $this->applicationSettingCategoryRepository->find($id);

        if (empty($applicationSettingCategory)) {
            Flash::error('Application Setting Category not found');

            return redirect()->back();
        }

        return view('application-settings.application_setting_categories.edit')->with('applicationSettingCategory', $applicationSettingCategory);
    }

    /**
     * Update the specified ApplicationSettingCategory in storage.
     */
    public function update($id, UpdateApplicationSettingCategoryRequest $request)
    {
        $applicationSettingCategory = $this->applicationSettingCategoryRepository->find($id);

        if (empty($applicationSettingCategory)) {
            Flash::error('Application Setting Category not found');

            return redirect()->back();
        }

        $applicationSettingCategory = $this->applicationSettingCategoryRepository->update($request->all(), $id);

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['name' => $request->name])
            ->log('Application Settings / Categories - Category details updated.');

        Flash::success('Application Setting Category updated successfully.');

        return redirect()->back();
    }

    /**
     * Remove the specified ApplicationSettingCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $applicationSettingCategory = $this->applicationSettingCategoryRepository->find($id);

        if (empty($applicationSettingCategory)) {
            Flash::error('Application Setting Category not found');

            return redirect()->back();
        }

        try {
            $this->applicationSettingCategoryRepository->delete($id);

            // Log Activity
            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['name' => $applicationSettingCategory->name])
                ->log('Application Settings / Categories - category details removed.');

            Flash::success('Application Setting Category deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'applicationSettingCategories.index');
        }
    }
}
