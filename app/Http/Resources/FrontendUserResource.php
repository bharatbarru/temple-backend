<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FrontendUserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'address' => $this->address,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'pincode' => $this->pincode,
            'dob' => $this->dob,
            'rashi' => $this->rashi,
            'birth_star' => $this->birth_star,
            'gothram' => $this->gothram,
            'spouse_name' => $this->spouse_name,
            'children_name' => $this->children_name,
            'publish' => $this->publish,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
