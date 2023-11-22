<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255|min:5',
            'guard_name'=>'required|max:255|min:5',
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Trường name không được bỏ trống',
            'name.max'=>'Trường name tối đa 255 kí tự',
            'name.min'=>'Trường name tối thiểu 5 kí tự',

            'guard_name.required'=>'Trường guard_name không được bỏ trống',
            'guard_name.max'=>'Trường guard_name tối đa 255 kí tự',
            'guard_name.min'=>'Trường guard_name tối thiểu 5 kí tự',
        ];

    }
}
