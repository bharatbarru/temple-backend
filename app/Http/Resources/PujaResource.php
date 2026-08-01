<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PujaResource extends JsonResource
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
            'name' => $this->name,
            'home_amount' => $this->home_amount,
            'temple_amount' => $this->temple_amount,
            'sort' => $this->sort,
            'publish' => $this->publish,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
