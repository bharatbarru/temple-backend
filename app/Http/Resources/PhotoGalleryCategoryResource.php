<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotoGalleryCategoryResource extends JsonResource
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
            'display_name' => $this->display_name,
            'icon' => $this->icon,
            'image' => $this->image,
            'image_alt_text' => $this->image_alt_text,
            'button_name' => $this->button_name,
            'button_url' => $this->button_url,
            'new_window' => $this->new_window,
            'type' => $this->type,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
