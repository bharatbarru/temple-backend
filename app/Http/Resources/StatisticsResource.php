<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatisticsResource extends JsonResource
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
            'title' => $this->title,
            'number' => $this->number,
            'prefix' => $this->prefix,
            'suffix' => $this->suffix,
            'url' => $this->url,
            'new_window' => $this->new_window,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
