<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'orderid' => $this->orderid,
            'customer_id' => $this->customer_id,
            'guest_name' => $this->guest_name,
            'guest_email' => $this->guest_email,
            'guest_phone' => $this->guest_phone,
            'order_type' => $this->order_type,
            'subtotal_amount' => $this->subtotal_amount,
            'coupon_discount' => $this->coupon_discount,
            'royalty_points_amount' => $this->royalty_points_amount,
            'tax_amount' => $this->tax_amount,
            'delivery_charge' => $this->delivery_charge,
            'total_amount' => $this->total_amount,
            'coupon_id' => $this->coupon_id,
            'delivery_address' => $this->delivery_address,
            'contact_number' => $this->contact_number,
            'payment_method_id' => $this->payment_method_id,
            'transaction_id' => $this->transaction_id,
            'payment_status' => $this->payment_status,
            'order_status' => $this->order_status,
            'reason_for_cancellation' => $this->reason_for_cancellation,
            'order_date' => $this->order_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
