<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'summary' => 'required|max:191',
            'description' => 'required|min:10',
            'photo' => 'image',
            'size' => 'required',
            'color' => 'required|min:3',
            'stock' => 'required|numeric',
            'price' => 'required|numeric'
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute chỉ được phép tối đa :max kí tự',
            'min' => ':attribute phải có ít nhất :min kí tự',
            'image' => 'Định dạng hình ảnh không hợp lệ',
            'numeric' => ':attribute phải là số'
        ];
    }
    public function attributes(): array {
        return [
            'name' => 'Tên sản phẩm',
            'summary' => 'Mô tả',
            'description' => 'Chi tiết',
            'photo' => 'Ảnh thumb',
            'size' => 'Kích thước',
            'color' => 'Màu',
            'stock' => 'Số lượng',
            'price' => 'Giá bán'
        ];
    }
}
