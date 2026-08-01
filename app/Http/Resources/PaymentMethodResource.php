<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
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
            'payment_method_name' => $this->payment_method_name,
            'display_name' => $this->display_name,
            'slug' => $this->slug,
            'sandbox_key' => $this->sandbox_key,
            'sandbox_secret' => $this->sandbox_secret,
            'live_key' => $this->live_key,
            'live_secret' => $this->live_secret,
            'publish' => $this->publish,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
