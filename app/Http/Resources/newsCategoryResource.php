<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class newsCategoryResource extends JsonResource
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
            'title' => $this->title,
            'tag_line' => $this->tag_line,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
