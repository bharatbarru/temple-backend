<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class BlogCategoryController extends AppBaseController
{
    /** @var BlogCategoryRepository $blogCategoryRepository*/
    private $blogCategoryRepository;

    public function __construct(BlogCategoryRepository $blogCategoryRepo)
    {
        $this->blogCategoryRepository = $blogCategoryRepo;

        $this->middleware('role_or_permission:add-blog_categories', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-blog_categories', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-blog_categories', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-blog_categories', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the BlogCategory.
     */
    public function index(Request $request)
    {
        return view('blog_categories.index');
    }

    /**
     * Show the form for creating a new BlogCategory.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('blog_categories.create');
    }

    /**
     * Store a newly created BlogCategory in storage.
     */
    public function store(CreateBlogCategoryRequest $request)
    {
        $input = $request->all();

        $blogCategory = $this->blogCategoryRepository->create($input);
        if ($request->hasfile('image')) {
            $blogCategory->image = uploadImage($request->file('image'), BLOG_CATEGORY_IMAGE_PATH);
        }
        $blogCategory->save();

        Flash::success('Blog Category saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('blogCategories.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified BlogCategory.
     */
    public function show($id)
    {
        $blogCategory = $this->blogCategoryRepository->find($id);

        if (empty($blogCategory)) {
            Flash::error('Blog Category not found');

            return redirect()->back();
        }

        return view('blog_categories.show')->with('blogCategory', $blogCategory);
    }

    /**
     * Show the form for editing the specified BlogCategory.
     */
    public function edit($id)
    {
        $blogCategory = $this->blogCategoryRepository->find($id);

        if (empty($blogCategory)) {
            Flash::error('Blog Category not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());

        return view('blog_categories.edit')->with('blogCategory', $blogCategory);
    }

    /**
     * Update the specified BlogCategory in storage.
     */
    public function update($id, UpdateBlogCategoryRequest $request)
    {
        $blogCategory = $this->blogCategoryRepository->find($id);

        if (empty($blogCategory)) {
            Flash::error('Blog Category not found');

            return redirect()->back();
        }

        
        if ($request->hasfile('image')) {
            removeImage($blogCategory->image, BLOG_CATEGORY_IMAGE_PATH);
        }

        $blogCategory = $this->blogCategoryRepository->update($request->all(), $id);
        
        if ($request->hasfile('image')) {
            $blogCategory->image = uploadImage($request->file('image'), BLOG_CATEGORY_IMAGE_PATH);
        }
        
        $blogCategory->save();
        
        Flash::success('Blog Category updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('blogCategories.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified BlogCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $blogCategory = $this->blogCategoryRepository->find($id);

        if (empty($blogCategory)) {
            Flash::error('Blog Category not found');

            return redirect()->back();
        }

        
        if ($blogCategory->image  != '') {
            removeImage($blogCategory->image, BLOG_CATEGORY_IMAGE_PATH);
        }

        try{
            $this->blogCategoryRepository->delete($id);
        }
        catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'blogCategories.index');
        }

        Flash::success('Blog Category deleted successfully.');

        return redirect()->back();
    }
}