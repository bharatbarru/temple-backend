<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsRequest;
use App\Http\Requests\UpdateCmsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Cms;
use App\Repositories\CmsRepository;
use Illuminate\Http\Request;
use Flash;

class CmsController extends AppBaseController
{
    /** @var CmsRepository $cmsRepository*/
    private $cmsRepository;

    public function __construct(CmsRepository $cmsRepo)
    {
        $this->cmsRepository = $cmsRepo;
        $this->middleware('role_or_permission:add-cms', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-cms', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-cms', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-cms', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Cms.
     */
    public function index(Request $request)
    {
        return view('cms.index');
    }

    /**
     * Show the form for creating a new Cms.
     */
    public function create()
    {
        $pages = Cms::pluck('title', 'id');
        session()->put('previous_url', url()->previous());
        return view('cms.create', compact('pages'));
    }

    /**
     * Store a newly created Cms in storage.
     */
    public function store(CreateCmsRequest $request)
    {
        $fieldsToUpdate = $request->except('gallery');
        $cms = $this->cmsRepository->create($fieldsToUpdate);
        if ($request->hasfile('banner_image')) {
            $cms->banner_image = uploadImage($request->file('banner_image'), CMS_IMAGE_PATH);
        }
        $cms->main_menu = $request->has('main_menu') ? 1 : 0;
        $cms->top_menu = $request->has('top_menu') ? 1 : 0;
        $cms->side_menu = $request->has('side_menu') ? 1 : 0;
        $cms->footer_menu = $request->has('footer_menu') ? 1 : 0;

        $cms->gallery = uploadMultipleImage($request->file('gallery'), CMS_IMAGE_PATH, $request->multiple_alt_textgallery, null);
        $cms->save();

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['title' => $cms->title, 'slug' => $cms->slug])
            ->log('CMS - New page created.');

        Flash::success('Cms saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('cms.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified Cms.
     */
    public function show($id)
    {
        $cms = $this->cmsRepository->find($id);

        if (empty($cms)) {
            Flash::error('Cms not found');

            return redirect()->back();
        }

        return view('cms.show')->with('cms', $cms);
    }

    /**
     * Show the form for editing the specified Cms.
     */
    public function edit($id)
    {
        $cms = $this->cmsRepository->find($id);

        if (empty($cms)) {
            Flash::error('Cms not found');

            return redirect()->back();
        }

        $pages = Cms::pluck('title', 'id');

        session()->put('previous_url', url()->previous());
        return view('cms.edit', compact('cms', 'pages'));
    }

    /**
     * Update the specified Cms in storage.
     */
    public function update($id, UpdateCmsRequest $request)
    {
        $cms = $this->cmsRepository->find($id);

        if (empty($cms)) {
            Flash::error('Cms not found');

            return redirect()->back();
        }

        if ($request->hasfile('banner_image')) {
            removeImage($cms->banner_image, CMS_IMAGE_PATH);
        }
        $fieldsToUpdate = $request->except('gallery');
        $cms = $this->cmsRepository->update($fieldsToUpdate, $id);
        if ($request->hasfile('banner_image')) {
            $cms->banner_image = uploadImage($request->file('banner_image'), CMS_IMAGE_PATH);
        }
        $cms->main_menu = $request->has('main_menu') ? 1 : 0;
        $cms->top_menu = $request->has('top_menu') ? 1 : 0;
        $cms->side_menu = $request->has('side_menu') ? 1 : 0;
        $cms->footer_menu = $request->has('footer_menu') ? 1 : 0;
        $cms->gallery = uploadMultipleImage($request->file('gallery'), CMS_IMAGE_PATH, $request->multiple_alt_textgallery, $cms->gallery);
        $cms->save();

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['title' => $cms->title, 'slug' => $cms->slug])
            ->log('CMS - Page details updated.');

        Flash::success('Cms updated successfully.');

        $previousUrl = session()->get('previous_url', route('cms.index'));
        session()->forget('previous_url');
        return redirect($previousUrl);
    }

    /**
     * Remove the specified Cms from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cms = $this->cmsRepository->find($id);

        if (empty($cms)) {
            Flash::error('Cms not found');

            return redirect()->back();
        }

        if (getSubMenu($cms->id)->count() > 0) {
            Flash::error('Unable to delete because this page contains sub pages.');
        } else {
            if ($cms->banner_image != '') {
                removeImage($cms->banner_image, CMS_IMAGE_PATH);
            }

            if ($cms->gallery != '') {
                foreach (json_decode($cms->gallery, true) as $gal) {
                    removeImage($gal['path'], CMS_IMAGE_PATH);
                }
            }

            $this->cmsRepository->delete($id);

            // Log Activity
            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['title' => $cms->title, 'slug' => $cms->slug])
                ->log('CMS -Page details removed.');

            Flash::success('Cms deleted successfully.');
        }

        return redirect()->back();
    }
}
