<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UserRequest extends FormRequest
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
            'name'=>['required','max:255','min:5'],
            'email' => ['required', 'email', 'max:255',
              Rule::unique('users')->ignore($this->user)],
            'password'=>['required','min:6','max:50'],
            'password_confirm' => 'required|same:password',
            'avatar' => [ 'mimes:jpeg,jpg,png,gif','required','image','max:5120'],
            

        ];
    }
    public function messages(){
        return [
            'name.required'=>'Trường name không được bỏ trống',
            'name.max'=>'Trường name tối đa 255 kí tự',
            'name.min'=>'Trường name tối thiểu 5 kí tự',
            'email.required'=>'Trường email bắt buộc nhập',
            'email.email'=>'Nhập đúng định dạng email',
            'email.max'=>'Trường email tối đa 255 kí tự',
            'email.unique'=>'Trường email đã tồn tại',
            'password.required'=>'Bắt buộc nhập pass',
            'password.min'=>'Nhỏ nhất là 6 kí tự',
            'password.max'=>'Nhiều nhất 50 kí tự',
            'avatar.required'=>'Trường avatar không được bỏ trống',
            'avatar.image'=>'Trường avatar bắt buộc là ảnh',
            'avatar.max'=>'Ảnh vượt quá 5mb',
            'avatar.mimes'=>'Phải là dạng ảnh',
            'same' => 'Mật khẩu phải trùng nhau',
            'password_confirm.required' => 'Password Comfirm không được để chống'
        ];

    }
}
