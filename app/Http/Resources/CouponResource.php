<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'coupon_code' => $this->coupon_code,
            'image' => $this->image,
            'discount_type' => $this->discount_type,
            'discount_value' => $this->discount_value,
            'min_order_amount' => $this->min_order_amount,
            'valid_from' => $this->valid_from,
            'valid_until' => $this->valid_until,
            'usage_limit' => $this->usage_limit,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
