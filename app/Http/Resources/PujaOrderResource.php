<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PujaOrderResource extends JsonResource
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
            'puja_request_id' => $this->puja_request_id,
            'user_id' => $this->user_id,
            'puja_location' => $this->puja_location,
            'date_of_puja' => $this->date_of_puja,
            'time_of_puja' => $this->time_of_puja,
            'alternate_date_of_puja1' => $this->alternate_date_of_puja1,
            'alternate_time_of_puja2' => $this->alternate_time_of_puja2,
            'total_amount' => $this->total_amount,
            'priest_name' => $this->priest_name,
            'comments' => $this->comments,
            'admin_comments' => $this->admin_comments,
            'cancelled_by' => $this->cancelled_by,
            'cancelled_comments' => $this->cancelled_comments,
            'changed_by' => $this->changed_by,
            'changed_comments' => $this->changed_comments,
            'payment_status' => $this->payment_status,
            'terms_conditions' => $this->terms_conditions,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
