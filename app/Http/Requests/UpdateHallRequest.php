<?php

namespace App\Http\Requests;

use App\Models\Hall;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHallRequest extends FormRequest
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
        $rules = Hall::$rules;

        $rules['name'] = $rules['name'] . $this->hall;
        
        return $rules;
    }
}
