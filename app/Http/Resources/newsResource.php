<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class newsResource extends JsonResource
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
            'news_category_id' => $this->news_category_id,
            'title' => $this->title,
            'tagline' => $this->tagline,
            'image' => $this->image,
            'image_alt' => $this->image_alt,
            'date' => $this->date,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'gallery' => $this->gallery,
            'custom_url' => $this->custom_url,
            'new_window' => $this->new_window,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
