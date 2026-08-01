<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreatePhotoGalleryCategoryRequest;
use App\Http\Requests\UpdatePhotoGalleryCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PhotoGalleryCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class PhotoGalleryCategoryController extends AppBaseController
{
    /** @var PhotoGalleryCategoryRepository $photoGalleryCategoryRepository*/
    private $photoGalleryCategoryRepository;

    public function __construct(PhotoGalleryCategoryRepository $photoGalleryCategoryRepo)
    {
        $this->photoGalleryCategoryRepository = $photoGalleryCategoryRepo;
        $this->middleware('role_or_permission:add-photo-gallery-categories', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-photo-gallery-categories', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-photo-gallery-categories', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-photo-gallery-categories', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the PhotoGalleryCategory.
     */
    public function index(Request $request)
    {
        return view('photo_gallery_categories.index');
    }

    /**
     * Show the form for creating a new PhotoGalleryCategory.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('photo_gallery_categories.create');
    }

    /**
     * Store a newly created PhotoGalleryCategory in storage.
     */
    public function store(CreatePhotoGalleryCategoryRequest $request)
    {
        $input = $request->all();
        $photoGalleryCategory = $this->photoGalleryCategoryRepository->create($input);
        if ($request->hasfile('image')) {
            $photoGalleryCategory->image = uploadImage($request->file('image'), PHOTO_GALLERY_IMAGE_PATH);
        }
        $photoGalleryCategory->save();
        Flash::success('Photo Gallery Category saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('photoGalleryCategories.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified PhotoGalleryCategory.
     */
    public function show($id)
    {
        $photoGalleryCategory = $this->photoGalleryCategoryRepository->find($id);

        if (empty($photoGalleryCategory)) {
            Flash::error('Photo Gallery Category not found');

            return redirect()->back();
        }

        return view('photo_gallery_categories.show')->with('photoGalleryCategory', $photoGalleryCategory);
    }

    /**
     * Show the form for editing the specified PhotoGalleryCategory.
     */
    public function edit($id)
    {
        $photoGalleryCategory = $this->photoGalleryCategoryRepository->find($id);

        if (empty($photoGalleryCategory)) {
            Flash::error('Photo Gallery Category not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('photo_gallery_categories.edit')->with('photoGalleryCategory', $photoGalleryCategory);
    }

    /**
     * Update the specified PhotoGalleryCategory in storage.
     */
    public function update($id, UpdatePhotoGalleryCategoryRequest $request)
    {
        $photoGalleryCategory = $this->photoGalleryCategoryRepository->find($id);

        if (empty($photoGalleryCategory)) {
            Flash::error('Photo Gallery Category not found');

            return redirect()->back();
        }

        if ($request->hasfile('image')) {
            removeImage($photoGalleryCategory->image, PHOTO_GALLERY_IMAGE_PATH);
        }

        $photoGalleryCategory = $this->photoGalleryCategoryRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $photoGalleryCategory->image = uploadImage($request->file('image'), PHOTO_GALLERY_IMAGE_PATH);
        }
        // $photoGalleryCategory->new_window = $request->has('new_window') ? 1 : 0;
        $photoGalleryCategory->save();

        Flash::success('Photo Gallery Category updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('photoGalleryCategories.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified PhotoGalleryCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $photoGalleryCategory = $this->photoGalleryCategoryRepository->find($id);

        if (empty($photoGalleryCategory)) {
            Flash::error('Photo Gallery Category not found');

            return redirect()->back();
        }
        try {
            $this->photoGalleryCategoryRepository->delete($id);
            if ($photoGalleryCategory->image) {
                removeImage($photoGalleryCategory->image, PHOTO_GALLERY_IMAGE_PATH);
            }
            Flash::success('Photo Gallery Category deleted successfully.');
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'photoGalleryCategories.index');
        }
    }
}