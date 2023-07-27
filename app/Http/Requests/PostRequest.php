<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'tag' => 'required',
            'photo' => 'image'
        ];
    }
    public function messages():array {
        return [
            'required' => ':attribute không được để trống',
            'image' => 'Hình ảnh không đúng định dạng'
        ];
    }
    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'content' => 'Nội dung',
            'tag' => 'Hashtag',
            'photo' => 'Hình ảnh'
        ];
    }
}
