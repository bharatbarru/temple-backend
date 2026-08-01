<?php

namespace App\Http\Requests;

use App\Models\HallOrder;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHallOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = HallOrder::$rules;

        $rules['hall_request_id'] = $rules['hall_request_id'] . $this->hallOrder;
        
        return $rules;
    }
}
