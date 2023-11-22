<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
            'desc'=>'required|max:255|min:5',

        ];
    }
    public function messages(){
        return [
        'name.required'=>'Trường name không được bỏ trống',
        'name.max'=>'Trường name tối đa 255 kí tự',
        'name.min'=>'Trường name tối thiểu 5 kí tự',

        'desc.required'=>'Trường desc không được bỏ trống',
        'desc.max'=>'Trường desc tối đa 255 kí tự',
        'desc.min'=>'Trường desc tối thiểu 5 kí tự',


        ];

    }
}
