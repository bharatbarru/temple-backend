<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatenewsRequest;
use App\Http\Requests\UpdatenewsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\news;
use App\Repositories\newsRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\newsCategory;

class newsController extends AppBaseController
{
    /** @var newsRepository $newsRepository*/
    private $newsRepository;

    public function __construct(newsRepository $newsRepo)
    {
        $this->newsRepository = $newsRepo;
        $this->middleware('role_or_permission:add-news', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-news', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-news', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-news', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the news.
     */
    public function index(Request $request)
    {
        return view('news.index');
    }

    /**
     * Show the form for creating a new news.
     */
    public function create()
    {
        $categories = NewsCategory::all()->pluck('name', 'id');

        return view('news.create', compact('categories'));
    }

    /**
     * Store a newly created news in storage.
     */
    public function store(CreatenewsRequest $request)
    {
        $input = $request->all();

        $news = $this->newsRepository->create($input);
        
        if ($request->hasfile('image')) {
            $news->image = uploadImage($request->file('image'), NEWS_IMAGE_PATH);
        }

        // $news->gallery = uploadMultipleImage($request->file('gallery'), NEWS_IMAGE_PATH, $request->multiple_alt_textgallery, null);

        $news->save();
        
        Flash::success('News saved successfully.');

        return redirect(route('news.index'));
    }

    /**
     * Display the specified news.
     */
    public function show($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        return view('news.show')->with('news', $news);
    }

    /**
     * Show the form for editing the specified news.
     */
    public function edit($id)
    {
        $categories = NewsCategory::all()->pluck('name', 'id');

        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        return view('news.edit', compact('categories'))->with('news', $news);
    }

    /**
     * Update the specified news in storage.
     */
    public function update($id, UpdatenewsRequest $request)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        if ($request->hasfile('image')) {
            removeImage($news->image, NEWS_IMAGE_PATH);
        }
        

        $fieldsToUpdate = $request->except('gallery');

        $news = $this->newsRepository->update($fieldsToUpdate, $id);
        if ($request->hasfile('image')) {
            $news->image = uploadImage($request->file('image'), NEWS_IMAGE_PATH);
        }

        $news->gallery = uploadMultipleImage($request->file('gallery'), NEWS_IMAGE_PATH, $request->multiple_alt_textgallery, $news->gallery);
        $news->save();        

        Flash::success('News updated successfully.');

        return redirect(route('news.index'));
    }

    /**
     * Remove the specified news from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        if ($news->image  != '') {
            removeImage($news->image, NEWS_IMAGE_PATH);
        }
        
        if ($news->gallery != '') {
            foreach (json_decode($news->gallery, true) as $gal) {
                removeImage($gal['path'], NEWS_IMAGE_PATH);
            }
        }

    try{
        $this->newsRepository->delete($id);
    }
     catch (\Illuminate\Database\QueryException $e) {
        return HandleForeignKeyConstraintViolation::handle($e, 'users.index');
    }

        Flash::success('News deleted successfully.');

        return redirect(route('news.index'));
    }

    public function removeGalleryItem($id, $key)
    {
        $news = News::find($id);
        if (!empty($service)) {
            $data = json_decode($news->gallery, true);
            removeImage($data[$key]['path'], NEWS_IMAGE_PATH);
            unset($data[$key]);
            $news->gallery = json_encode(array_values($data));
            $news->save();
            Flash::success('Image Removed Successfully.');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}