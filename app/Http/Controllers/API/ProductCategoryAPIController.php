<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductCategoryAPIRequest;
use App\Http\Requests\API\UpdateProductCategoryAPIRequest;
use App\Models\ProductCategory;
use App\Repositories\ProductCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ProductCategoryResource;

/**
 * Class ProductCategoryController
 */

class ProductCategoryAPIController extends AppBaseController
{
    /** @var  ProductCategoryRepository */
    private $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepo)
    {
        $this->productCategoryRepository = $productCategoryRepo;
    }

    /**
     * @OA\Get(
     *      path="/product-categories",
     *      summary="getProductCategoryList",
     *      tags={"ProductCategory"},
     *      description="Get all ProductCategories",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/ProductCategory")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $productCategories = $this->productCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ProductCategoryResource::collection($productCategories), 'Product Categories retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/product-categories",
     *      summary="createProductCategory",
     *      tags={"ProductCategory"},
     *      description="Create ProductCategory",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ProductCategory")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/ProductCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $productCategory = $this->productCategoryRepository->create($input);

        return $this->sendResponse(new ProductCategoryResource($productCategory), 'Product Category saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/product-categories/{id}",
     *      summary="getProductCategoryItem",
     *      tags={"ProductCategory"},
     *      description="Get ProductCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ProductCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/ProductCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id): JsonResponse
    {
        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }

        return $this->sendResponse(new ProductCategoryResource($productCategory), 'Product Category retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/product-categories/{id}",
     *      summary="updateProductCategory",
     *      tags={"ProductCategory"},
     *      description="Update ProductCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ProductCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ProductCategory")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/ProductCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }

        $productCategory = $this->productCategoryRepository->update($input, $id);

        return $this->sendResponse(new ProductCategoryResource($productCategory), 'ProductCategory updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/product-categories/{id}",
     *      summary="deleteProductCategory",
     *      tags={"ProductCategory"},
     *      description="Delete ProductCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ProductCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id): JsonResponse
    {
        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }
        try{
            $productCategory->delete();
    
        }
        catch (\Illuminate\Database\QueryException $e) {
            return $this->sendError('Cannot delete record because it has related records in another table.');
        }

        

        return $this->sendSuccess('Product Category deleted successfully');
    }
}