<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'team_categories_id' => $this->team_categories_id,
            'name' => $this->name,
            'image' => $this->image,
            'image_alt_text' => $this->image_alt_text,
            'designation' => $this->designation,
            'description' => $this->description,
            'linkedin_url' => $this->linkedin_url,
            'facebook_url' => $this->facebook_url,
            'instagram_url' => $this->instagram_url,
            'twitter_url' => $this->twitter_url,
            'github_url' => $this->github_url,
            'other' => $this->other,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
