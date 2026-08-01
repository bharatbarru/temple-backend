<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateFaqCategoryRequest;
use App\Http\Requests\UpdateFaqCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\FaqCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class FaqCategoryController extends AppBaseController
{
    /** @var FaqCategoryRepository $faqCategoryRepository*/
    private $faqCategoryRepository;

    public function __construct(FaqCategoryRepository $faqCategoryRepo)
    {
        $this->faqCategoryRepository = $faqCategoryRepo;
        $this->middleware('role_or_permission:add-faq_categories', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-faq_categories', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-faq_categories', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-faq_categories', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the FaqCategory.
     */
    public function index(Request $request)
    {
        return view('faq_categories.index');
    }

    /**
     * Show the form for creating a new FaqCategory.
     */
    public function create()
    {
        return view('faq_categories.create');
    }

    /**
     * Store a newly created FaqCategory in storage.
     */
    public function store(CreateFaqCategoryRequest $request)
    {
        $input = $request->all();

        $faqCategory = $this->faqCategoryRepository->create($input);

        Flash::success('Faq Category saved successfully.');

        return redirect(route('faqCategories.index'));
    }

    /**
     * Display the specified FaqCategory.
     */
    public function show($id)
    {
        $faqCategory = $this->faqCategoryRepository->find($id);

        if (empty($faqCategory)) {
            Flash::error('Faq Category not found');

            return redirect(route('faqCategories.index'));
        }

        return view('faq_categories.show')->with('faqCategory', $faqCategory);
    }

    /**
     * Show the form for editing the specified FaqCategory.
     */
    public function edit($id)
    {
        $faqCategory = $this->faqCategoryRepository->find($id);

        if (empty($faqCategory)) {
            Flash::error('Faq Category not found');

            return redirect(route('faqCategories.index'));
        }

        return view('faq_categories.edit')->with('faqCategory', $faqCategory);
    }

    /**
     * Update the specified FaqCategory in storage.
     */
    public function update($id, UpdateFaqCategoryRequest $request)
    {
        $faqCategory = $this->faqCategoryRepository->find($id);

        if (empty($faqCategory)) {
            Flash::error('Faq Category not found');

            return redirect(route('faqCategories.index'));
        }

        $faqCategory = $this->faqCategoryRepository->update($request->all(), $id);

        Flash::success('Faq Category updated successfully.');

        return redirect(route('faqCategories.index'));
    }

    /**
     * Remove the specified FaqCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $faqCategory = $this->faqCategoryRepository->find($id);

        if (empty($faqCategory)) {
            Flash::error('Faq Category not found');

            return redirect(route('faqCategories.index'));
        }
        try {
            $this->faqCategoryRepository->delete($id);
            Flash::success('Faq Category deleted successfully.');

            return redirect(route('faqCategories.index'));
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'faqCategories.index');
        }
    }

    public function getPageNamesList(Request $request)
    {
        $pageNames = getPageNames($request->type, null);

        return response()->json($pageNames);
    }
}
