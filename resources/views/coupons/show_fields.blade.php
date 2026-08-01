<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card callout callout-success puja-card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h1 class="card-title" style="font-size:24px">
                                Coupon Details
                            </h1>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-danger float-right" style="color: #fff; text-decoration:none"
                                href="{{ route('coupons.index') }}">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p class="col-md-4">Coupon Code:</p>
                        <p class="col-md-8" style="font-weight:bold">{{ $coupon->coupon_code }}</p>

                        <p class="col-md-4">Image:</p>
                        <div class="col-md-8" style="font-weight:bold">
                            @if (!empty($coupon->image))
                               <img src="{{ asset(COUPON_IMAGE_PATH . $coupon->image) }}" alt="" height="50">
                            @endif
                        </div>

                        <p class="col-md-4">Discount Type:</p>
                        <p class="col-md-8" style="font-weight:bold">{{ $coupon->discount_type }}</p>

                        <p class="col-md-4">Discount Value:</p>
                        <p class="col-md-8" style="font-weight:bold">{!! $coupon->getFormattedDiscountValue() !!}</p>

                        <p class="col-md-4">Min Order Amount:</p>
                        <p class="col-md-8" style="font-weight:bold">{!! formatAmount($coupon->min_order_amount) !!}</p>

                        <p class="col-md-4">Valid From:</p>
                        <p class="col-md-8" style="font-weight:bold">{{ formatDate($coupon->valid_from) }}</p>

                        <p class="col-md-4">Valid Until:</p>
                        <p class="col-md-8" style="font-weight:bold">{{ formatDate($coupon->valid_until) }}</p>

                        <p class="col-md-4">Usage Limit:</p>
                        <p class="col-md-8" style="font-weight:bold">{{ $coupon->usage_limit }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
