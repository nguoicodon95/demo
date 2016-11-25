<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(auth()->guard('dev')->user()->role == 'administrator')
            return true;

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:properties,name,'.$this->route('property')],
            'slug' => ['required', 'unique:properties,name,'.$this->route('property')]
        ];
    }
}
