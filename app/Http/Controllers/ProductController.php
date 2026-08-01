<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\AppBaseController;
use App\Http\Livewire\ProductCategoriesTable;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Flash;

class ProductController extends AppBaseController
{
    /** @var ProductRepository $productRepository*/
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
        $this->middleware('role_or_permission:add-products', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-products', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-products', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-products', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Product.
     */
    public function index(Request $request)
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new Product.
     */
    public function create()
    {
        $categories = ProductCategory::all()->pluck('name', 'id');
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created Product in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        $product = $this->productRepository->create($input);

        if ($request->hasfile('image')) {
            $product->image = uploadImage($request->file('image'), PRODUCT_IMAGE_PATH);
        }
        
        $product->image_gallery = uploadMultipleImage($request->file('image_gallery'), PRODUCT_IMAGE_PATH, $request->multiple_alt_textgallery, null);
        $product->save();

        Flash::success('Product saved successfully.');

        return redirect(route('products.index'));
    }

    /**
     * Display the specified Product.
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     */
    public function edit($id)
    {
        $categories = ProductCategory::all()->pluck('name', 'id');
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified Product in storage.
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        if ($request->hasfile('image')) {
            removeImage($product->image, PRODUCT_IMAGE_PATH);
        }

        $fieldsToUpdate = $request->except('image_gallery');

        $product = $this->productRepository->update($fieldsToUpdate, $id);

        if ($request->hasfile('image')) {
            $product->image = uploadImage($request->file('image'), PRODUCT_IMAGE_PATH);
        }
        $product->image_gallery = uploadMultipleImage($request->file('image_gallery'), PRODUCT_IMAGE_PATH, $request->multiple_alt_textgallery, $product->image_gallery);
        $product->save();

        Flash::success('Product updated successfully.');

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        if ($product->image  != '') {
            removeImage($product->image, PRODUCT_IMAGE_PATH);
        }

        
        if ($product->image_gallery != '') {
            foreach (json_decode($product->image_gallery, true) as $gal) {
                removeImage($gal['path'], PRODUCT_IMAGE_PATH);
            }
        }

        try{
            $this->productRepository->delete($id);
        }
        catch (\Illuminate\Database\QueryException $e) {
           return HandleForeignKeyConstraintViolation::handle($e, 'users.index');
        }

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }
    public function removeGalleryItem($id, $key)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            $data = json_decode($product->image_gallery, true);
            removeImage($data[$key]['path'], PRODUCT_IMAGE_PATH);
            unset($data[$key]);
            $product->image_gallery = json_encode(array_values($data));
            $product->save();
            Flash::success('Image Removed Successfully.');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}