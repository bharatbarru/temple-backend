<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProductCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class ProductCategoryController extends AppBaseController
{
    /** @var ProductCategoryRepository $productCategoryRepository*/
    private $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepo)
    {
        $this->productCategoryRepository = $productCategoryRepo;
        $this->middleware('role_or_permission:add-product_categories', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-product_categories', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-product_categories', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-product_categories', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the ProductCategory.
     */
    public function index(Request $request)
    {
        return view('product_categories.index');
    }

    /**
     * Show the form for creating a new ProductCategory.
     */
    public function create()
    {
        return view('product_categories.create');
    }

    /**
     * Store a newly created ProductCategory in storage.
     */
    public function store(CreateProductCategoryRequest $request)
    {
        $input = $request->all();

        $productCategory = $this->productCategoryRepository->create($input);
        if ($request->hasfile('image')) {
            $productCategory->image = uploadImage($request->file('image'), PRODUCT_CATEGORY_IMAGE_PATH);
        }
        $productCategory->save();

        Flash::success('Product Category saved successfully.');

        return redirect(route('productCategories.index'));
    }

    /**
     * Display the specified ProductCategory.
     */
    public function show($id)
    {
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            Flash::error('Product Category not found');

            return redirect(route('productCategories.index'));
        }

        return view('product_categories.show')->with('productCategory', $productCategory);
    }

    /**
     * Show the form for editing the specified ProductCategory.
     */
    public function edit($id)
    {
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            Flash::error('Product Category not found');

            return redirect(route('productCategories.index'));
        }

        return view('product_categories.edit')->with('productCategory', $productCategory);
    }

    /**
     * Update the specified ProductCategory in storage.
     */
    public function update($id, UpdateProductCategoryRequest $request)
    {
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            Flash::error('Product Category not found');

            return redirect(route('productCategories.index'));
        }

        if ($request->hasfile('image')) {
            removeImage($productCategory->image, BLOG_CATEGORY_IMAGE_PATH);
        }

        $productCategory = $this->productCategoryRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $productCategory->image = uploadImage($request->file('image'), PRODUCT_CATEGORY_IMAGE_PATH);
        }
        
        $productCategory->save();

        Flash::success('Product Category updated successfully.');

        return redirect(route('productCategories.index'));
    }

    /**
     * Remove the specified ProductCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            Flash::error('Product Category not found');

            return redirect(route('productCategories.index'));
        }

        if ($productCategory->image  != '') {
            removeImage($productCategory->image, PRODUCT_CATEGORY_IMAGE_PATH);
        }

        try{
            $this->productCategoryRepository->delete($id);
    
        }
        catch (\Illuminate\Database\QueryException $e) {
           return HandleForeignKeyConstraintViolation::handle($e, 'users.index');
        }

        Flash::success('Product Category deleted successfully.');

        return redirect(route('productCategories.index'));
    }
}