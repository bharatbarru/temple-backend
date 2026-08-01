<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
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
            'faq_categories_id' => $this->faq_categories_id,
            'question' => $this->question,
            'answer' => $this->answer,
            'button_name' => $this->button_name,
            'button_url' => $this->button_url,
            'new_window' => $this->new_window,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
