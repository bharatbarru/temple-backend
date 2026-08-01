<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceTypeRequest;
use App\Http\Requests\UpdateServiceTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ServiceTypeRepository;
use Illuminate\Http\Request;
use Flash;

class ServiceTypeController extends AppBaseController
{
    /** @var ServiceTypeRepository $serviceTypeRepository*/
    private $serviceTypeRepository;

    public function __construct(ServiceTypeRepository $serviceTypeRepo)
    {
        $this->serviceTypeRepository = $serviceTypeRepo;
        $this->middleware('role_or_permission:add-service-types', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-service-types', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-service-types', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-service-types', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the ServiceType.
     */
    public function index(Request $request)
    {
        return view('service_types.index');
    }

    /**
     * Show the form for creating a new ServiceType.
     */
    public function create()
    {
        return view('service_types.create');
    }

    /**
     * Store a newly created ServiceType in storage.
     */
    public function store(CreateServiceTypeRequest $request)
    {
        $input = $request->all();

        $serviceType = $this->serviceTypeRepository->create($input);

        $htmlMenuCode = '<li class="nav-item">
                        <a href="{{ url(\'admin/services?main=' . $serviceType->slug . '\') }}"
                            class="nav-link {{ request()->input("type") == "'. $serviceType->slug .'"
                                ? "active" : "" }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>' . $serviceType->name . '</p>
                        </a>
                    </li>';
        $filePath = resource_path('views/layouts/menu.blade.php');
        file_put_contents($filePath, $htmlMenuCode, FILE_APPEND);

        Flash::success('Service Type saved successfully.');

        return redirect(route('serviceTypes.index'));
    }

    /**
     * Display the specified ServiceType.
     */
    public function show($id)
    {
        $serviceType = $this->serviceTypeRepository->find($id);

        if (empty($serviceType)) {
            Flash::error('Service Type not found');

            return redirect(route('serviceTypes.index'));
        }

        return view('service_types.show')->with('serviceType', $serviceType);
    }

    /**
     * Show the form for editing the specified ServiceType.
     */
    public function edit($id)
    {
        $serviceType = $this->serviceTypeRepository->find($id);

        if (empty($serviceType)) {
            Flash::error('Service Type not found');

            return redirect(route('serviceTypes.index'));
        }

        return view('service_types.edit')->with('serviceType', $serviceType);
    }

    /**
     * Update the specified ServiceType in storage.
     */
    public function update($id, UpdateServiceTypeRequest $request)
    {
        $serviceType = $this->serviceTypeRepository->find($id);

        if (empty($serviceType)) {
            Flash::error('Service Type not found');

            return redirect(route('serviceTypes.index'));
        }

        $serviceType = $this->serviceTypeRepository->update($request->all(), $id);

        Flash::success('Service Type updated successfully.');

        return redirect(route('serviceTypes.index'));
    }

    /**
     * Remove the specified ServiceType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $serviceType = $this->serviceTypeRepository->find($id);

        if (empty($serviceType)) {
            Flash::error('Service Type not found');

            return redirect(route('serviceTypes.index'));
        }

        $this->serviceTypeRepository->delete($id);

        Flash::success('Service Type deleted successfully.');

        return redirect(route('serviceTypes.index'));
    }
}