<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'title'     => 'required|min:6',
            'slug'      => 'required',
            'content'   => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg',
            'category_id'  => 'required',
            'config'    => 'required|numeric'
        ];
    }

    public function messages(){
        return [
            'required'  => ':attribute không được để trống',
            'image'     => 'Sai định dạng hình ảnh',
            'numeric'   => ':attribute phải là số',
            'min'       => ':attribute tối thiểu :min kí tự',
            'max'       => ':attribute tối đa :max kí tự',
        ];
    }

    public function attributes()
    {
        return [
            'title'     => 'Tên khóa học',
            'slug'      => 'Đường dẫn',
            'content'   => 'Nội dung',
            'thumbnail' => 'Ảnh khóa học',
            'category_id'  => 'Danh mục',
            'config'    => '% tiến độ khóa học'
        ];
    }    
}
