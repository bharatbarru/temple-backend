<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateTestimonialCategoryRequest;
use App\Http\Requests\UpdateTestimonialCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\TestimonialCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class TestimonialCategoryController extends AppBaseController
{
    /** @var TestimonialCategoryRepository $testimonialCategoryRepository*/
    private $testimonialCategoryRepository;

    public function __construct(TestimonialCategoryRepository $testimonialCategoryRepo)
    {
        $this->testimonialCategoryRepository = $testimonialCategoryRepo;

        $this->middleware('role_or_permission:add-testimonial_categories', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-testimonial_categories', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-testimonial_categories', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-testimonial_categories', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the TestimonialCategory.
     */
    public function index(Request $request)
    {
        return view('testimonial_categories.index');
    }

    /**
     * Show the form for creating a new TestimonialCategory.
     */
    public function create()
    {
        return view('testimonial_categories.create');
    }

    /**
     * Store a newly created TestimonialCategory in storage.
     */
    public function store(CreateTestimonialCategoryRequest $request)
    {
        $input = $request->all();

        $testimonialCategory = $this->testimonialCategoryRepository->create($input);

        Flash::success('Testimonial Category saved successfully.');

        return redirect(route('testimonialCategories.index'));
    }

    /**
     * Display the specified TestimonialCategory.
     */
    public function show($id)
    {
        $testimonialCategory = $this->testimonialCategoryRepository->find($id);

        if (empty($testimonialCategory)) {
            Flash::error('Testimonial Category not found');

            return redirect(route('testimonialCategories.index'));
        }

        return view('testimonial_categories.show')->with('testimonialCategory', $testimonialCategory);
    }

    /**
     * Show the form for editing the specified TestimonialCategory.
     */
    public function edit($id)
    {
        $testimonialCategory = $this->testimonialCategoryRepository->find($id);

        if (empty($testimonialCategory)) {
            Flash::error('Testimonial Category not found');

            return redirect(route('testimonialCategories.index'));
        }

        return view('testimonial_categories.edit')->with('testimonialCategory', $testimonialCategory);
    }

    /**
     * Update the specified TestimonialCategory in storage.
     */
    public function update($id, UpdateTestimonialCategoryRequest $request)
    {
        $testimonialCategory = $this->testimonialCategoryRepository->find($id);

        if (empty($testimonialCategory)) {
            Flash::error('Testimonial Category not found');

            return redirect(route('testimonialCategories.index'));
        }

        $testimonialCategory = $this->testimonialCategoryRepository->update($request->all(), $id);

        Flash::success('Testimonial Category updated successfully.');

        return redirect(route('testimonialCategories.index'));
    }

    /**
     * Remove the specified TestimonialCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $testimonialCategory = $this->testimonialCategoryRepository->find($id);

        if (empty($testimonialCategory)) {
            Flash::error('Testimonial Category not found');

            return redirect(route('testimonialCategories.index'));
        }
    try{
        $this->testimonialCategoryRepository->delete($id);

    }
    catch (\Illuminate\Database\QueryException $e) {
       return HandleForeignKeyConstraintViolation::handle($e, 'users.index');
    }

        Flash::success('Testimonial Category deleted successfully.');

        return redirect(route('testimonialCategories.index'));
    }
}
