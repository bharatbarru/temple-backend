<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatenewsCategoryRequest;
use App\Http\Requests\UpdatenewsCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\newsCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class newsCategoryController extends AppBaseController
{
    /** @var newsCategoryRepository $newsCategoryRepository*/
    private $newsCategoryRepository;

    public function __construct(newsCategoryRepository $newsCategoryRepo)
    {
        $this->newsCategoryRepository = $newsCategoryRepo;
        $this->middleware('role_or_permission:add-news', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-news', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-news', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-news', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the newsCategory.
     */
    public function index(Request $request)
    {
        return view('news_categories.index');
    }

    /**
     * Show the form for creating a new newsCategory.
     */
    public function create()
    {
        return view('news_categories.create');
    }

    /**
     * Store a newly created newsCategory in storage.
     */
    public function store(CreatenewsCategoryRequest $request)
    {
        $input = $request->all();

        $newsCategory = $this->newsCategoryRepository->create($input);

        Flash::success('News Category saved successfully.');

        return redirect(route('newsCategories.index'));
    }

    /**
     * Display the specified newsCategory.
     */
    public function show($id)
    {
        $newsCategory = $this->newsCategoryRepository->find($id);

        if (empty($newsCategory)) {
            Flash::error('News Category not found');

            return redirect(route('newsCategories.index'));
        }

        return view('news_categories.show')->with('newsCategory', $newsCategory);
    }

    /**
     * Show the form for editing the specified newsCategory.
     */
    public function edit($id)
    {
        $newsCategory = $this->newsCategoryRepository->find($id);

        if (empty($newsCategory)) {
            Flash::error('News Category not found');

            return redirect(route('newsCategories.index'));
        }

        return view('news_categories.edit')->with('newsCategory', $newsCategory);
    }

    /**
     * Update the specified newsCategory in storage.
     */
    public function update($id, UpdatenewsCategoryRequest $request)
    {
        $newsCategory = $this->newsCategoryRepository->find($id);

        if (empty($newsCategory)) {
            Flash::error('News Category not found');

            return redirect(route('newsCategories.index'));
        }

        $newsCategory = $this->newsCategoryRepository->update($request->all(), $id);

        Flash::success('News Category updated successfully.');

        return redirect(route('newsCategories.index'));
    }

    /**
     * Remove the specified newsCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $newsCategory = $this->newsCategoryRepository->find($id);

        if (empty($newsCategory)) {
            Flash::error('News Category not found');

            return redirect(route('newsCategories.index'));
        }

        $this->newsCategoryRepository->delete($id);

        Flash::success('News Category deleted successfully.');

        return redirect(route('newsCategories.index'));
    }
}