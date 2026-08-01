<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'event_category_id' => $this->event_category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'image_alt_text' => $this->image_alt_text,
            'start_date_time' => $this->start_date_time,
            'end_date_time' => $this->end_date_time,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'custom_url' => $this->custom_url,
            'seo_title' => $this->seo_title,
            'seo_keywords' => $this->seo_keywords,
            'seo_description' => $this->seo_description,
            'sort' => $this->sort,
            'publish' => $this->publish,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
