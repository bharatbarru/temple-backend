<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteleResource extends JsonResource
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
            'clientele_category_id' => $this->clientele_category_id,
            'image' => $this->image,
            'image_alt_text' => $this->image_alt_text,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'url' => $this->url,
            'new_window' => $this->new_window,
            'publish' => $this->publish,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
