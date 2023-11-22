<?php

namespace App\Http\Requests;

use App\Rules\RequiredIfFieldExists;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LessonRequest extends FormRequest
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

    protected $rules = [
        'title'         => 'required',
        'section_id'    => 'required',
        'video_url'     => 'sometimes|required',
        'attachment.*'  => 'nullable|mimes:doc,docx,pdf,zip,rar'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return $this->rules;
    }

    protected function prepareForValidation()
    {
        if($this->get('lesson_type') == 'video' && request()->method() == 'POST') $this->rules['video_file'] = 'required|mimes:mp4,ogx,oga,ogv,ogg,webm';
        if($this->get('lesson_type') == 'document' && request()->method() == 'POST') $this->rules['doc_file'] = 'required|mimes:doc,docx,pdf';
        if($this->get('lesson_type') == 'video' && request()->method() == 'PUT') $this->rules['video_file'] = 'nullable|mimes:mp4,ogx,oga,ogv,ogg,webm';
        if($this->get('lesson_type') == 'document' && request()->method() == 'PUT') $this->rules['doc_file'] = 'nullable|mimes:doc,docx,pdf';
    }

    public function messages(){
        return [
            'required'      => ':attribute không được để trống',
            'mimes'         => 'Sai định dạng cho phép'
        ];
    }

    public function attributes()
    {
        return [
            'title'         => 'Tên bài học',
            'section_id'    => 'Chương học',
            'video_file'    => 'Tệp video',
            'video_url'     => 'Link video',
            'doc_file'      => 'Tệp tài liệu'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->wantsJson() || $this->ajax()) {
            $errors = (new ValidationException($validator))->errors();
            throw new HttpResponseException(
                response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            );
        }
        parent::failedValidation($validator);
    }
}
