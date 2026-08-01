<?php

namespace App\Http\Controllers\ApplicationSettings;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateApplicationSettingTypeRequest;
use App\Http\Requests\UpdateApplicationSettingTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ApplicationSettingTypeRepository;
use Illuminate\Http\Request;
use Flash;

class ApplicationSettingTypeController extends AppBaseController
{
    /** @var ApplicationSettingTypeRepository $applicationSettingTypeRepository*/
    private $applicationSettingTypeRepository;

    public function __construct(ApplicationSettingTypeRepository $applicationSettingTypeRepo)
    {
        $this->applicationSettingTypeRepository = $applicationSettingTypeRepo;
        $this->middleware('role_or_permission:add-application-setting-types', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-application-setting-types', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-application-setting-types', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-application-setting-types', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the ApplicationSettingType.
     */
    public function index(Request $request)
    {
        return view('application-settings.application_setting_types.index');
    }

    /**
     * Show the form for creating a new ApplicationSettingType.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('application-settings.application_setting_types.create');
    }

    /**
     * Store a newly created ApplicationSettingType in storage.
     */
    public function store(CreateApplicationSettingTypeRequest $request)
    {
        $input = $request->all();

        $applicationSettingType = $this->applicationSettingTypeRepository->create($input);

        $htmlMenuCode = '<li class="nav-item">
                            <a href="{{ url(\'admin/settings?type=' . $applicationSettingType->slug . '\') }}" class="nav-link {{ request()->input("type") == "'. $applicationSettingType->slug .'" ? "active" : "" }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>' . $applicationSettingType->type . '</p>
                            </a>
                        </li>';
        $filePath = resource_path('views/layouts/menu.blade.php');
        file_put_contents($filePath, $htmlMenuCode, FILE_APPEND);

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['name' => $request->type])
            ->log('Application Settings / Types - New type created.');

        Flash::success('Application Setting Type saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('applicationSettingTypes.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified ApplicationSettingType.
     */
    public function show($id)
    {
        $applicationSettingType = $this->applicationSettingTypeRepository->find($id);

        if (empty($applicationSettingType)) {
            Flash::error('Application Setting Type not found');

            return redirect()->back();
        }

        return view('application-settings.application_setting_types.show')->with('applicationSettingType', $applicationSettingType);
    }

    /**
     * Show the form for editing the specified ApplicationSettingType.
     */
    public function edit($id)
    {
        $applicationSettingType = $this->applicationSettingTypeRepository->find($id);

        if (empty($applicationSettingType)) {
            Flash::error('Application Setting Type not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('application-settings.application_setting_types.edit')->with('applicationSettingType', $applicationSettingType);
    }

    /**
     * Update the specified ApplicationSettingType in storage.
     */
    public function update($id, UpdateApplicationSettingTypeRequest $request)
    {
        $applicationSettingType = $this->applicationSettingTypeRepository->find($id);

        if (empty($applicationSettingType)) {
            Flash::error('Application Setting Type not found');

            return redirect()->back();
        }

        $applicationSettingType = $this->applicationSettingTypeRepository->update($request->all(), $id);

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['name' => $request->type])
            ->log('Application Settings / Types - type details updated.');

        Flash::success('Application Setting Type updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('applicationSettingTypes.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified ApplicationSettingType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $applicationSettingType = $this->applicationSettingTypeRepository->find($id);

        if (empty($applicationSettingType)) {
            Flash::error('Application Setting Type not found');

            return redirect()->back();
        }

        try {
            $this->applicationSettingTypeRepository->delete($id);

            // Log Activity
            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['name' => $applicationSettingType->type])
                ->log('Application Settings / Types - type details removed.');

            Flash::success('Application Setting Type deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'users.index');
        }
    }
}
