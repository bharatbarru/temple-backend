<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HallResource extends JsonResource
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
            'description' => $this->description,
            'image' => $this->image,
            'image_alt_text' => $this->image_alt_text,
            'monday_cost' => $this->monday_cost,
            'tuesday_cost' => $this->tuesday_cost,
            'wednesday_cost' => $this->wednesday_cost,
            'thursday_cost' => $this->thursday_cost,
            'friday_cost' => $this->friday_cost,
            'saturday_cost' => $this->saturday_cost,
            'sunday_cost' => $this->sunday_cost,
            'sort' => $this->sort,
            'publish' => $this->publish,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
