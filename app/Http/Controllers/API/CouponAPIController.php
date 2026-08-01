<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCouponAPIRequest;
use App\Http\Requests\API\UpdateCouponAPIRequest;
use App\Models\Coupon;
use App\Repositories\CouponRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CouponResource;

/**
 * Class CouponController
 */

class CouponAPIController extends AppBaseController
{
    /** @var  CouponRepository */
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepository = $couponRepo;
    }

    /**
     * @OA\Get(
     *      path="/coupons",
     *      summary="getCouponList",
     *      tags={"Coupon"},
     *      description="Get all Coupons",
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
     *                  @OA\Items(ref="#/components/schemas/Coupon")
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
        $coupons = $this->couponRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CouponResource::collection($coupons), 'Coupons retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/coupons",
     *      summary="createCoupon",
     *      tags={"Coupon"},
     *      description="Create Coupon",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Coupon")
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
     *                  ref="#/components/schemas/Coupon"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCouponAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $coupon = $this->couponRepository->create($input);

        return $this->sendResponse(new CouponResource($coupon), 'Coupon saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/coupons/{id}",
     *      summary="getCouponItem",
     *      tags={"Coupon"},
     *      description="Get Coupon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Coupon",
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
     *                  ref="#/components/schemas/Coupon"
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
        /** @var Coupon $coupon */
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            return $this->sendError('Coupon not found');
        }

        return $this->sendResponse(new CouponResource($coupon), 'Coupon retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/coupons/{id}",
     *      summary="updateCoupon",
     *      tags={"Coupon"},
     *      description="Update Coupon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Coupon",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Coupon")
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
     *                  ref="#/components/schemas/Coupon"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCouponAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Coupon $coupon */
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            return $this->sendError('Coupon not found');
        }

        $coupon = $this->couponRepository->update($input, $id);

        return $this->sendResponse(new CouponResource($coupon), 'Coupon updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/coupons/{id}",
     *      summary="deleteCoupon",
     *      tags={"Coupon"},
     *      description="Delete Coupon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Coupon",
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
        /** @var Coupon $coupon */
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            return $this->sendError('Coupon not found');
        }

        $coupon->delete();

        return $this->sendSuccess('Coupon deleted successfully');
    }
}
