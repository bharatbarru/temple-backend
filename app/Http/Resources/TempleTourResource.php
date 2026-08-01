<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TempleTourResource extends JsonResource
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
            'tour_request_id' => $this->tour_request_id,
            'name' => $this->name,
            'tour_date' => $this->tour_date,
            'tour_time' => $this->tour_time,
            'alternate_tour_date' => $this->alternate_tour_date,
            'alternate_tour_time' => $this->alternate_tour_time,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'total_visitors' => $this->total_visitors,
            'age_range_of_group' => $this->age_range_of_group,
            'last_visit_to_temple' => $this->last_visit_to_temple,
            'comment' => $this->comment,
            'admin_comments' => $this->admin_comments,
            'terms_conditions' => $this->terms_conditions,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
