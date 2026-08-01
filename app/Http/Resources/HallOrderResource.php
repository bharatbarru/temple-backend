<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HallOrderResource extends JsonResource
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
            'hall_request_id' => $this->hall_request_id,
            'type_of_event' => $this->type_of_event,
            'user_id' => $this->user_id,
            'hall_event_type_id' => $this->hall_event_type_id,
            'other_event_type' => $this->other_event_type,
            'date_of_event' => $this->date_of_event,
            'alternate_date_of_event' => $this->alternate_date_of_event,
            'start_time' => $this->start_time,
            'duration' => $this->duration,
            'comments' => $this->comments,
            'total_amount' => $this->total_amount,
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
