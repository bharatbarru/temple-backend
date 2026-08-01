<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateServiceCategoryRequest;
use App\Http\Requests\UpdateServiceCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ServiceCategoryRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\ServiceType;

class ServiceCategoryController extends AppBaseController
{
    /** @var ServiceCategoryRepository $serviceCategoryRepository*/
    private $serviceCategoryRepository;

    public function __construct(ServiceCategoryRepository $serviceCategoryRepo)
    {
        $this->serviceCategoryRepository = $serviceCategoryRepo;
        $this->middleware('role_or_permission:add-service-categories', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-service-categories', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-service-categories', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-service-categories', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the ServiceCategory.
     */
    public function index(Request $request)
    {
        return view('service_categories.index');
    }

    /**
     * Show the form for creating a new ServiceCategory.
     */
    public function create()
    {
        $type = ServiceType::all()->pluck('name', 'id');
        return view('service_categories.create', compact('type'));
    }

    /**
     * Store a newly created ServiceCategory in storage.
     */
    public function store(CreateServiceCategoryRequest $request)
    {
        $input = $request->all();

        $serviceCategory = $this->serviceCategoryRepository->create($input);
        if ($request->hasfile('image')) {
            $serviceCategory->image = uploadImage($request->file('image'), SERVICE_IMAGE_PATH);
        }
        // $serviceCategory->new_window = $request->has('new_window') ? 1 : 0;
        $serviceCategory->save();

        $htmlMenuCode = '<li class="nav-item">
                        <a href="{{ url(\'admin/services?type=' . $serviceCategory->slug . '\') }}"
                            class="nav-link {{ request()->input("type") == "'. $serviceCategory->slug .'"
                                ? "active" : "" }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>' . $serviceCategory->name . '</p>
                        </a>
                    </li>';
        $filePath = resource_path('views/layouts/menu.blade.php');
        file_put_contents($filePath, $htmlMenuCode, FILE_APPEND);

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['name' => $serviceCategory->name])
            ->log('Service Categories - New category created.');

        Flash::success('Service Category saved successfully.');

        return redirect(route('serviceCategories.index'));
    }

    /**
     * Display the specified ServiceCategory.
     */
    public function show($id)
    {
        $serviceCategory = $this->serviceCategoryRepository->find($id);

        if (empty($serviceCategory)) {
            Flash::error('Service Category not found');

            return redirect(route('serviceCategories.index'));
        }

        return view('service_categories.show')->with('serviceCategory', $serviceCategory);
    }

    /**
     * Show the form for editing the specified ServiceCategory.
     */
    public function edit($id)
    {
        $serviceCategory = $this->serviceCategoryRepository->find($id);

        $type = ServiceType::all()->pluck('name', 'id');

        if (empty($serviceCategory)) {
            Flash::error('Service Category not found');

            return redirect(route('serviceCategories.index'));
        }

        return view('service_categories.edit', compact('type'))->with('serviceCategory', $serviceCategory);
    }

    /**
     * Update the specified ServiceCategory in storage.
     */
    public function update($id, UpdateServiceCategoryRequest $request)
    {
        $serviceCategory = $this->serviceCategoryRepository->find($id);

        if (empty($serviceCategory)) {
            Flash::error('Service Category not found');

            return redirect(route('serviceCategories.index'));
        }

        if ($request->hasfile('image')) {
            removeImage($serviceCategory->image, SERVICE_IMAGE_PATH);
        }
        $serviceCategory = $this->serviceCategoryRepository->update($request->all(), $id);
        if ($request->hasfile('image')) {
            $serviceCategory->image = uploadImage($request->file('image'), SERVICE_IMAGE_PATH);
        }
        // $serviceCategory->new_window = $request->has('new_window') ? 1 : 0;
        $serviceCategory->save();

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['name' => $serviceCategory->name])
            ->log('Service Categories - Category details updated.');

        Flash::success('Service Category updated successfully.');

        return redirect(route('serviceCategories.index'));
    }

    /**
     * Remove the specified ServiceCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $serviceCategory = $this->serviceCategoryRepository->find($id);

        if (empty($serviceCategory)) {
            Flash::error('Service Category not found');

            return redirect(route('serviceCategories.index'));
        }
        try {
            $this->serviceCategoryRepository->delete($id);
            if ($serviceCategory->image) {
                removeImage($serviceCategory->image, SERVICE_IMAGE_PATH);
            }
            // Log Activity
            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['name' => $serviceCategory->name])
                ->log('Service Categories - Category details removed.');

            Flash::success('Service Category deleted successfully.');

            return redirect(route('serviceCategories.index'));
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'serviceCategories.index');
        }
    }
}