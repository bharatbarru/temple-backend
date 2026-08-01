<?php

namespace App\Http\Controllers\ApplicationSettings;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateApplicationSettingRequest;
use App\Http\Requests\UpdateApplicationSettingRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\ApplicationSetting;
use App\Models\ApplicationSettingCategory;
use App\Models\ApplicationSettingType;
use App\Repositories\ApplicationSettingRepository;
use Illuminate\Http\Request;
use Flash;

class ApplicationSettingController extends AppBaseController
{
    /** @var ApplicationSettingRepository $applicationSettingRepository*/
    private $applicationSettingRepository;

    public function __construct(ApplicationSettingRepository $applicationSettingRepo)
    {
        $this->applicationSettingRepository = $applicationSettingRepo;
        $this->middleware('role_or_permission:add-application-settings', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-application-settings', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-application-settings', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-application-settings', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the ApplicationSetting.
     */
    public function index(Request $request)
    {
        return view('application-settings.application_settings.index');
    }

    /**
     * Show the form for creating a new ApplicationSetting.
     */
    public function create()
    {
        $categories = ApplicationSettingCategory::all()->pluck('name', 'id');
        $types = ApplicationSettingType::all()->pluck('type', 'id');
        session()->put('previous_url', url()->previous());
        return view('application-settings.application_settings.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created ApplicationSetting in storage.
     */
    public function store(CreateApplicationSettingRequest $request)
    {
        $input = $request->all();

        $applicationSetting = $this->applicationSettingRepository->create($input);

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['field name' => $request->field_name])
            ->log('Application Settings / Settings - New settings created.');

        Flash::success('Application Setting saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('applicationSettings.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified ApplicationSetting.
     */
    public function show($id)
    {
        $applicationSetting = $this->applicationSettingRepository->find($id);

        if (empty($applicationSetting)) {
            Flash::error('Application Setting not found');

            return redirect()->back();
        }

        return view('application-settings.application_settings.show')->with('applicationSetting', $applicationSetting);
    }

    /**
     * Show the form for editing the specified ApplicationSetting.
     */
    public function edit($id)
    {
        $applicationSetting = $this->applicationSettingRepository->find($id);

        if (empty($applicationSetting)) {
            Flash::error('Application Setting not found');

            return redirect()->back();
        }

        $categories = ApplicationSettingCategory::all()->pluck('name', 'id');
        $types = ApplicationSettingType::all()->pluck('type', 'id');

        session()->put('previous_url', url()->previous());
        return view('application-settings.application_settings.edit', compact('applicationSetting', 'categories', 'types'));
    }

    /**
     * Update the specified ApplicationSetting in storage.
     */
    public function update($id, UpdateApplicationSettingRequest $request)
    {
        $applicationSetting = $this->applicationSettingRepository->find($id);

        if (empty($applicationSetting)) {
            Flash::error('Application Setting not found');

            return redirect()->back();
        }

        $applicationSetting = $this->applicationSettingRepository->update($request->all(), $id);

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['field name' => $request->field_name])
            ->log('Application Settings / Settings - Setting details updated.');

        Flash::success('Application Setting updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('applicationSettings.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified ApplicationSetting from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $applicationSetting = $this->applicationSettingRepository->find($id);

        if (empty($applicationSetting)) {
            Flash::error('Application Setting not found');

            return redirect()->back();
        }

        try {
            $this->applicationSettingRepository->delete($id);

            // Log Activity
            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['field name' => $applicationSetting->field_name])
                ->log('Application Settings / Settings - Setting details removed.');

            Flash::success('Application Setting deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'users.index');
        }
    }

    public function settingsView(Request $request)
    {
        $type = ApplicationSettingType::where('slug', $request->type)->first();
        if (!empty($type)) {
            $settings = ApplicationSetting::where('application_setting_type_id', $type->id)->orderBy('sort', 'asc')->get();
            return view('application-settings.settings', compact('type', 'settings'));
        }
        Flash::error('Application Setting Type Not Found.');
        return redirect()->back();
    }

    public function updateSettings(Request $request)
    {
        $settings = ApplicationSetting::where('application_setting_type_id', $request->setting_type_id)->get();

        foreach ($settings as $setting) {
            $name = $setting->id;
            switch ($setting->input_type) {
                case 'file':
                    if ($request->hasfile($setting->id)) {
                        $setting->value = uploadImage($request->file($setting->id), APPLICATION_SETTING_IMAGE_PATH);
                    }
                    break;
                case 'multiple-files':
                    $multiple_alt_text = 'multiple_alt_text' . $name;
                    $setting->value = uploadMultipleImage($request->file($setting->id), APPLICATION_SETTING_IMAGE_PATH, $request->$multiple_alt_text, $setting->value);
                    break;
                case 'switch':
                    $setting->value = $request->has('switch-' . $setting->id) ? 1 : 0;
                    break;
                case 'radio':
                    $radio = 'radio' . $name;
                    $setting->value = $request->$radio;
                    break;
                case 'checkbox':
                    $checkbox = 'checkbox' . $name;
                    $setting->value = implode(',', $request->$checkbox);
                    break;
                default:
                    $setting->value = $request->$name;
                    break;
            }
            $alt_text = 'alt_text' . $name;
            $setting->alt_text = $request->$alt_text;
            $setting->update();
        }
        Flash::success('Setting updated successfully.');
        return redirect(url('admin/settings?type=' . $request->setting_type_slug));
    }

    public function removeGalleryItem($id, $key)
    {
        $setting = ApplicationSetting::find($id);
        if (!empty($setting)) {
            $data = json_decode($setting->value, true);
            removeImage($data[$key]['path'], APPLICATION_SETTING_IMAGE_PATH);
            unset($data[$key]);
            $setting->value = json_encode(array_values($data));
            $setting->save();
            Flash::success('Image Removed Successfully.');
            return redirect(url('admin/settings?type=' . $setting->applicationSettingType->slug));
        } else {
            return redirect()->back();
        }
    }
}
