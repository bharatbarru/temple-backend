<?php

namespace App\Http\Requests;

use App\Models\PujaOrder;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePujaOrderRequest extends FormRequest
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
        $rules = PujaOrder::$rules;

        $rules['name'] = $rules['name'] . $this->pujaOrder;
        
        return $rules;
    }
}
