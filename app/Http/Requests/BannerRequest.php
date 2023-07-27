<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'title' => 'required|min:5',
            'summary' =>'required|min:10',
            'path' => 'required',
            'photo' => 'image'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min kí tự',
            'photo' => 'Định dạng hình ảnh không hợp lệ'
        ];
    }
    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'summary' =>'Mô tả',
            'path' => 'Liên kết',
            'photo' => 'Hình ảnh'
        ];
    }
}
