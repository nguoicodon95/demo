<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editPageRequest extends FormRequest
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

    public function forbiddenResponse() {
        return redirect()->back()->withErrors([
            'error' => 'Đã có sự cố trong vấn đề giới hạn quyền hạn của bạn nên bạn không thể thực hiện chức năng này. Hãy thử lại.'
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string|max:255|required',
            'slug' => 'string|max:255|alpha_dash|required|unique:pages,slug,'.$this->route('page'),
            'status' => 'in:activated,disabled',
        ];
    }
}
