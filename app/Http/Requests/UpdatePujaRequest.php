<?php

namespace App\Http\Requests;

use App\Models\Puja;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePujaRequest extends FormRequest
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
        $rules = Puja::$rules;

        $rules['name'] = $rules['name'] . $this->puja;
        
        return $rules;
    }
}
