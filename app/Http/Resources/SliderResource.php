<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'image' => $this->image,
            'image_alt_text' => $this->image_alt_text,
            'title' => $this->title,
            'tagline' => $this->tagline,
            'button_name' => $this->button_name,
            'button_url' => $this->button_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
