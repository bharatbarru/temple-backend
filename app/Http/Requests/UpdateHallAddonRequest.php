<?php

namespace App\Http\Requests;

use App\Models\HallAddon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHallAddonRequest extends FormRequest
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
        $rules = HallAddon::$rules;

        $rules['name'] = $rules['name'] . $this->hallAddon;
        
        return $rules;
    }
}
