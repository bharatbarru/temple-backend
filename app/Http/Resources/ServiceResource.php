<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'service_category_id' => $this->service_category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'sub_title' => $this->sub_title,
            'image' => $this->image,
            'image_alt_text' => $this->image_alt_text,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'custom_url' => $this->custom_url,
            'new_window' => $this->new_window,
            'gallery' => $this->gallery,
            'video_url' => $this->video_url,
            'video_iframe' => $this->video_iframe,
            'page_title' => $this->page_title,
            'seo_title' => $this->seo_title,
            'seo_keywords' => $this->seo_keywords,
            'seo_description' => $this->seo_description,
            'icon' => $this->icon,
            'publish' => $this->publish,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
