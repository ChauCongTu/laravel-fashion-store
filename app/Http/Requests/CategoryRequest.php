<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required',
            'summary' => 'required|min:10',
            'photo' => 'image',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute là trường bắt buộc',
            'min' => ':min phải có ít nhất :min kí tự',
            'image' => 'Định dạng hình ảnh không hợp lệ'
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Tên danh mục',
            'summary' => 'Mô tả',
            'photo' => 'Ảnh thumb'
        ];
    }
}
