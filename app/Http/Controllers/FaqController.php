<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\FaqCategory;
use App\Repositories\FaqRepository;
use Illuminate\Http\Request;
use Flash;

class FaqController extends AppBaseController
{
    /** @var FaqRepository $faqRepository*/
    private $faqRepository;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->faqRepository = $faqRepo;
        $this->middleware('role_or_permission:add-faqs', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-faqs', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-faqs', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-faqs', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Faq.
     */
    public function index(Request $request)
    {
        return view('faqs.index');
    }

    /**
     * Show the form for creating a new Faq.
     */
    public function create()
    {
        $categories = FaqCategory::all()->pluck('name', 'id');
        return view('faqs.create', compact('categories'));
    }

    /**
     * Store a newly created Faq in storage.
     */
    public function store(CreateFaqRequest $request)
    {
        $input = $request->all();

        $faq = $this->faqRepository->create($input);
        $faq->save();
        Flash::success('Faq saved successfully.');

        return redirect(route('faqs.index'));
    }

    /**
     * Display the specified Faq.
     */
    public function show($id)
    {
        $faq = $this->faqRepository->find($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('faqs.index'));
        }

        return view('faqs.show')->with('faq', $faq);
    }

    /**
     * Show the form for editing the specified Faq.
     */
    public function edit($id)
    {
        $faq = $this->faqRepository->find($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('faqs.index'));
        }
        $categories = FaqCategory::all()->pluck('name', 'id');


        return view('faqs.edit', compact('categories'))->with('faq', $faq);
    }

    /**
     * Update the specified Faq in storage.
     */
    public function update($id, UpdateFaqRequest $request)
    {
        $faq = $this->faqRepository->find($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('faqs.index'));
        }

        $faq = $this->faqRepository->update($request->all(), $id);
        $faq->save();
        Flash::success('Faq updated successfully.');

        return redirect(route('faqs.index'));
    }

    /**
     * Remove the specified Faq from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $faq = $this->faqRepository->find($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('faqs.index'));
        }
    try{
        $this->faqRepository->delete($id);
    }
    catch (\Illuminate\Database\QueryException $e) {
       return HandleForeignKeyConstraintViolation::handle($e, 'users.index');
    }
        Flash::success('Faq deleted successfully.');

        return redirect(route('faqs.index'));
    }
}
