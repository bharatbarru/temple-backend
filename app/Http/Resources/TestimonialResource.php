<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
            'company' => $this->company,
            'designation' => $this->designation,
            'date' => $this->date,
            'image' => $this->image,
            'image_alt_text' => $this->image_alt_text,
            'icon' => $this->icon,
            'video_url' => $this->video_url,
            'video_iframe' => $this->video_iframe,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'custom_url' => $this->custom_url,
            'new_window' => $this->new_window,
            'testimonial_category_id' => $this->testimonial_category_id
        ];
    }
}
