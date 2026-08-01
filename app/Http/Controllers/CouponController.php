<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CouponRepository;
use Illuminate\Http\Request;
use Flash;

class CouponController extends AppBaseController
{
    /** @var CouponRepository $couponRepository*/
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepository = $couponRepo;
        $this->middleware('role_or_permission:add-coupons', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-coupons', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-coupons', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-coupons', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Coupon.
     */
    public function index(Request $request)
    {
        return view('coupons.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $coupon)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Coupon Code' => $coupon->coupon_code,
                'Discount Type' => $coupon->discount_type,
                'Discount Value' => $coupon->discount_value,
                'Min Order Amount' => $coupon->min_order_amount
            ])
            ->log('Coupons - ' . $description);
    }

    /**
     * Show the form for creating a new Coupon.
     */
    public function create()
    {
        return view('coupons.create');
    }

    /**
     * Store a newly created Coupon in storage.
     */
    public function store(CreateCouponRequest $request)
    {
        $input = $request->all();

        $coupon = $this->couponRepository->create($input);

        if ($request->hasfile('image')) {
            $coupon->image = uploadImage($request->file('image'), COUPON_IMAGE_PATH);
            $coupon->save();
        }

        // Log Activity
        $this->activityLog('New Coupon Created.', $coupon);

        Flash::success('Coupon saved successfully.');

        return redirect(route('coupons.index'));
    }

    /**
     * Display the specified Coupon.
     */
    public function show($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('coupons.index'));
        }

        return view('coupons.show')->with('coupon', $coupon);
    }

    /**
     * Show the form for editing the specified Coupon.
     */
    public function edit($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('coupons.index'));
        }

        return view('coupons.edit')->with('coupon', $coupon);
    }

    /**
     * Update the specified Coupon in storage.
     */
    public function update($id, UpdateCouponRequest $request)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('coupons.index'));
        }


        if ($request->hasfile('image')) {
            removeImage($coupon->image, COUPON_IMAGE_PATH);
        }

        $coupon = $this->couponRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $coupon->image = uploadImage($request->file('image'), COUPON_IMAGE_PATH);
            $coupon->save();
        }
        // Log Activity
        $this->activityLog('Coupon details updated.', $coupon);

        Flash::success('Coupon updated successfully.');

        return redirect(route('coupons.index'));
    }

    /**
     * Remove the specified Coupon from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('coupons.index'));
        }

        try {
            $this->couponRepository->delete($id);

            // Log Activity
            $this->activityLog('Coupon details removed.', $coupon);

            Flash::success('Coupon deleted successfully.');

            return redirect(route('coupons.index'));
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'coupons.index');
        }
    }
}
