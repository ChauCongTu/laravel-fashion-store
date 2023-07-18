<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => 'required|min:5|max:500'
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập nội dung bình luận',
            'min' => 'Nội dung bình luận phải ít nhất :min kí tự',
            'max' => 'Nội dung bình luận không được quá :max kí tự'
        ];
    }
}
