<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostResource extends JsonResource
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
            'blog_category_id' => $this->blog_category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'sub_title' => $this->sub_title,
            'post_date' => $this->post_date,
            'image' => $this->image,
            'image_alt_text' => $this->image_alt_text,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'image_gallery' => $this->image_gallery,
            'video_gallery' => $this->video_gallery,
            'video_url' => $this->video_url,
            'video_iframe' => $this->video_iframe,
            'custom_url' => $this->custom_url,
            'map_url' => $this->map_url,
            'map_iframe' => $this->map_iframe,
            'page_title' => $this->page_title,
            'seo_title' => $this->seo_title,
            'seo_keywords' => $this->seo_keywords,
            'seo_description' => $this->seo_description,
            'publish' => $this->publish,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
