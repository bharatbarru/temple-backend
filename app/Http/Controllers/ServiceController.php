<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceType;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Flash;

class ServiceController extends AppBaseController
{
    /** @var ServiceRepository $serviceRepository*/
    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepo)
    {
        $this->serviceRepository = $serviceRepo;
        $this->middleware('role_or_permission:add-services', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-services', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-services', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-services', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Service.
     */
    public function index(Request $request)
    {
        if (empty($request->type) && empty($request->main)) {
            return redirect()->back();
        }
        return view('services.index');
    }

    /**
     * Show the form for creating a new Service.
     */
    public function create(Request $request)
    {
        if (empty($request->type) && empty($request->main)) {
            return redirect()->back();
        }
        $serviceCategory = ServiceCategory::where('slug', $request->type)->first();
        if($request->main) {
            $serviceType = ServiceType::where('slug', $request->main)->first();
            $serviceCategories = ServiceCategory::where('service_type_id', $serviceType->id)->pluck('name', 'id');
        }else {
            $serviceCategories = null;
        }
        return view('services.create', compact('serviceCategory', 'serviceCategories'));
    }

    /**
     * Store a newly created Service in storage.
     */
    public function store(CreateServiceRequest $request)
    {
        $input = $request->all();

        $service = $this->serviceRepository->create($input);
        if ($request->hasfile('image')) {
            $service->image = uploadImage($request->file('image'), SERVICE_IMAGE_PATH);
        }
        if ($request->hasfile('banner_image')) {
            $service->banner_image = uploadImage($request->file('banner_image'), SERVICE_IMAGE_PATH);
        }

        $service->new_window = $request->has('new_window') ? 1 : 0;
        $service->gallery = uploadMultipleImage($request->file('gallery'), SERVICE_IMAGE_PATH, $request->multiple_alt_textgallery, null);
        $service->save();


        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['title' => $service->title])
            ->log('Services - New service created.');

        Flash::success('Service saved successfully.');

        if($request->main) {
            return redirect(route('services.index') . '?main=' . $request->main);
        }
        return redirect(route('services.index') . '?type=' . $request->type);
    }

    /**
     * Display the specified Service.
     */
    public function show($id, Request $request)
    {
        if (empty($request->type) && empty($request->main)) {
            return redirect()->back();
        }
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('services.index'));
        }

        return view('services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified Service.
     */
    public function edit($id, Request $request)
    {
        if (empty($request->type) && empty($request->main)) {
            return redirect()->back();
        }
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error('Service not found');
            return redirect(route('services.index'));
        }

        $serviceCategory = ServiceCategory::where('slug', $request->type)->first();
        if($request->main) {
            $serviceType = ServiceType::where('slug', $request->main)->first();
            $serviceCategories = ServiceCategory::where('service_type_id', $serviceType->id)->pluck('name', 'id');
        }else {
            $serviceCategories = null;
        }

        return view('services.edit', compact('service', 'serviceCategory', 'serviceCategories'));
    }

    /**
     * Update the specified Service in storage.
     */
    public function update($id, UpdateServiceRequest $request)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('services.index'));
        }


        if ($request->hasfile('image')) {
            removeImage($service->image, SERVICE_IMAGE_PATH);
        }
        if ($request->hasfile('banner_image')) {
            removeImage($service->banner_image, SERVICE_IMAGE_PATH);
        }
        $fieldsToUpdate = $request->except('gallery');
        $service = $this->serviceRepository->update($fieldsToUpdate, $id);
        if ($request->hasfile('image')) {
            $service->image = uploadImage($request->file('image'), SERVICE_IMAGE_PATH);
        }
        if ($request->hasfile('banner_image')) {
            $service->image = uploadImage($request->file('banner_image'), SERVICE_IMAGE_PATH);
        }
        $service->new_window = $request->has('new_window') ? 1 : 0;
        $service->gallery = uploadMultipleImage($request->file('gallery'), SERVICE_IMAGE_PATH, $request->multiple_alt_textgallery, $service->gallery);
        $service->save();

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['title' => $service->title])
            ->log('Services - Service details updated.');

        Flash::success('Service updated successfully.');

        if($request->main) {
            return redirect(route('services.index') . '?main=' . $request->main);
        }
        return redirect(route('services.index') . '?type=' . $request->type);
    }

    /**
     * Remove the specified Service from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('services.index'));
        }

        if ($service->image != '') {
            removeImage($service->image, SERVICE_IMAGE_PATH);
        }

        if ($service->banner_image != '') {
            removeImage($service->banner_image, SERVICE_IMAGE_PATH);
        }

        if ($service->gallery != '') {
            foreach (json_decode($service->gallery, true) as $gal) {
                removeImage($gal['path'], SERVICE_IMAGE_PATH);
            }
        }

        try {
            $this->serviceRepository->delete($id);

            // Log Activity
            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['title' => $service->title])
                ->log('Services - Service details removed.');

            Flash::success('Service deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'services.index');
        }
    }

    public function removeGalleryItem($id, $key)
    {
        $service = Service::find($id);
        if (!empty($service)) {
            $data = json_decode($service->gallery, true);
            removeImage($data[$key]['path'], SERVICE_IMAGE_PATH);
            unset($data[$key]);
            $service->gallery = json_encode(array_values($data));
            $service->save();
            Flash::success('Image Removed Successfully.');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
