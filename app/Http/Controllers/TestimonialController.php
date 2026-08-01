<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Testimonial;
use App\Models\TestimonialCategory;
use App\Repositories\TestimonialRepository;
use Illuminate\Http\Request;
use Flash;

class TestimonialController extends AppBaseController
{
    /** @var TestimonialRepository $testimonialRepository*/
    private $testimonialRepository;

    public function __construct(TestimonialRepository $testimonialRepo)
    {
        $this->testimonialRepository = $testimonialRepo;

        $this->middleware('role_or_permission:add-testimonials', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-testimonials', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-testimonials', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-testimonials', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Testimonial.
     */
    public function index(Request $request)
    {
        return view('testimonials.index');
    }

    /**
     * Show the form for creating a new Testimonial.
     */
    public function create()
    {
        $categories = TestimonialCategory::all()->pluck('name', 'id');

        return view('testimonials.create', compact('categories'));
    }

    /**
     * Store a newly created Testimonial in storage.
     */
    public function store(CreateTestimonialRequest $request)
    {
        $input = $request->all();

        $testimonial = $this->testimonialRepository->create($input);

        if ($request->hasfile('image')) {
            $testimonial->image = uploadImage($request->file('image'), TESTIMONIAL_IMAGE_PATH);
        }
        $testimonial->new_window = $request->has('new_window') ? 1 : 0;
        $testimonial->save();
        Flash::success('Testimonial saved successfully.');

        return redirect(route('testimonials.index'));
    }

    /**
     * Display the specified Testimonial.
     */
    public function show($id)
    {
        $testimonial = $this->testimonialRepository->find($id);

        if (empty($testimonial)) {
            Flash::error('Testimonial not found');

            return redirect(route('testimonials.index'));
        }

        return view('testimonials.show')->with('testimonial', $testimonial);
    }

    /**
     * Show the form for editing the specified Testimonial.
     */
    public function edit($id)
    {
        
        $categories = TestimonialCategory::all()->pluck('name', 'id');

        $testimonial = $this->testimonialRepository->find($id);

        if (empty($testimonial)) {
            Flash::error('Testimonial not found');

            return redirect(route('testimonials.index'));
        }

        return view('testimonials.edit',compact('categories'))->with('testimonial', $testimonial);
    }

    /**
     * Update the specified Testimonial in storage.
     */
    public function update($id, UpdateTestimonialRequest $request)
    {
        $testimonial = $this->testimonialRepository->find($id);

        if (empty($testimonial)) {
            Flash::error('Testimonial not found');

            return redirect(route('testimonials.index'));
        }

        if ($request->hasfile('image')) {
            removeImage($testimonial->image, TESTIMONIAL_IMAGE_PATH);
        }
        $testimonial = $this->testimonialRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $testimonial->image = uploadImage($request->file('image'), TESTIMONIAL_IMAGE_PATH);
        }
        $testimonial->new_window = $request->has('new_window') ? 1 : 0;

        $testimonial->save();

        Flash::success('Testimonial updated successfully.');

        return redirect(route('testimonials.index'));
    }

    /**
     * Remove the specified Testimonial from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $testimonial = $this->testimonialRepository->find($id);

        if (empty($testimonial)) {
            Flash::error('Testimonial not found');

            return redirect(route('testimonials.index'));
        }
        
        if ($testimonial->image != '') {
            removeImage($testimonial->image, TESTIMONIAL_IMAGE_PATH);
        }
    try{
        $this->testimonialRepository->delete($id);
        
        Flash::success('Testimonial deleted successfully.');

        return redirect(route('testimonials.index'));
    }
    catch (\Illuminate\Database\QueryException $e) {
       return HandleForeignKeyConstraintViolation::handle($e, 'users.index');
    }

    }
}
