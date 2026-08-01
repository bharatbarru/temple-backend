<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
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
            'slug' => $this->slug,
            'display_name' => $this->display_name,
            'image' => $this->image,
            'image_alt_text' => $this->image_alt_text,
            'icon' => $this->icon,
            'description' => $this->description,
            'tagline' => $this->tagline,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
