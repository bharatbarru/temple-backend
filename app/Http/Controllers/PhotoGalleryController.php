<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhotoGalleryRequest;
use App\Http\Requests\UpdatePhotoGalleryRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\PhotoGallery;
use App\Models\PhotoGalleryCategory;
use App\Repositories\PhotoGalleryRepository;
use Illuminate\Http\Request;
use Flash;

class PhotoGalleryController extends AppBaseController
{
    /** @var PhotoGalleryRepository $photoGalleryRepository*/
    private $photoGalleryRepository;
    public function __construct(PhotoGalleryRepository $photoGalleryRepo)
    {
        $this->photoGalleryRepository = $photoGalleryRepo;
        $this->middleware('role_or_permission:add-photo-galleries', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-photo-galleries', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-photo-galleries', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-photo-galleries', ['only' => ['index', 'show']]);
    }
    /**
     * Display a listing of the PhotoGallery.
     */
    public function index(Request $request)
    {
        return view('photo_galleries.index');
    }
    /**
     * Show the form for creating a new PhotoGallery.
     */
    public function create()
    {
        $categories = PhotoGalleryCategory::all()->pluck('name', 'id');
        session()->put('previous_url', url()->previous());
        return view('photo_galleries.create', compact('categories'));
    }
    /**
     * Store a newly created PhotoGallery in storage.
     */
    public function store(CreatePhotoGalleryRequest $request)
    {
        $input = $request->except(['image_gallery']);
        $photoGallery = $this->photoGalleryRepository->create($input);
        $photoGallery->image_gallery = uploadMultipleImage($request->file('image_gallery'), PHOTO_GALLERY_IMAGE_PATH, $request->multiple_alt_textimage_gallery, null);
        $photoGallery->save();
        Flash::success('Photo Gallery saved successfully.');
        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('photoGalleries.index'));
        return redirect($previousUrl);
    }
    /**
     * Display the specified PhotoGallery.
     */
    public function show($id)
    {
        $photoGallery = $this->photoGalleryRepository->find($id);
        if (empty($photoGallery)) {
            Flash::error('Photo Gallery not found');
            return redirect()->back();
        }
        return view('photo_galleries.show')->with('photoGallery', $photoGallery);
    }
    /**
     * Show the form for editing the specified PhotoGallery.
     */
    public function edit($id)
    {
        $photoGallery = $this->photoGalleryRepository->find($id);
        if (empty($photoGallery)) {
            Flash::error('Photo Gallery not found');
            return redirect()->back();
        }
        $categories = PhotoGalleryCategory::all()->pluck('name', 'id');
        
        session()->put('previous_url', url()->previous());
        return view('photo_galleries.edit', compact('photoGallery', 'categories'));
    }
    /**
     * Update the specified PhotoGallery in storage.
     */
    public function update($id, UpdatePhotoGalleryRequest $request)
    {
        $photoGallery = $this->photoGalleryRepository->find($id);
        if (empty($photoGallery)) {
            Flash::error('Photo Gallery not found');
            return redirect()->back();
        }
        $photoGallery = $this->photoGalleryRepository->update($request->except(['image_gallery']), $id);
        $photoGallery->image_gallery = uploadMultipleImage(
            $request->file('image_gallery'),
            PHOTO_GALLERY_IMAGE_PATH,
            $request->multiple_alt_textimage_gallery,
            $photoGallery->image_gallery
        );
        $photoGallery->save();
        Flash::success('Photo Gallery updated successfully.');
        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('photoGalleries.index'));
        return redirect($previousUrl);
    }
    /**
     * Remove the specified PhotoGallery from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $photoGallery = $this->photoGalleryRepository->find($id);
        if (empty($photoGallery)) {
            Flash::error('Photo Gallery not found');
            return redirect()->back();
        }
        if ($photoGallery->image_gallery != '') {
            foreach (json_decode($photoGallery->image_gallery, true) as $gal) {
                removeImage($gal['path'], PHOTO_GALLERY_IMAGE_PATH);
            }
        }
        $this->photoGalleryRepository->delete($id);
        Flash::success('Photo Gallery deleted successfully.');
        return redirect()->back();
    }
    public function removeGalleryItem($id, $key)
    {
        $photoGallery = PhotoGallery::find($id);
        if (!empty($photoGallery)) {
            $data = json_decode($photoGallery->image_gallery, true);
            removeImage($data[$key]['path'], PHOTO_GALLERY_IMAGE_PATH);
            unset($data[$key]);
            $photoGallery->image_gallery = json_encode(array_values($data));
            $photoGallery->save();
            Flash::success('Image Removed Successfully.');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}