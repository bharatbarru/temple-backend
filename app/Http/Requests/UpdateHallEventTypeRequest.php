<?php

namespace App\Http\Requests;

use App\Models\HallEventType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHallEventTypeRequest extends FormRequest
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
        $rules = HallEventType::$rules;

        $rules['name'] = $rules['name'] . $this->hallEventType;
        
        return $rules;
    }
}
