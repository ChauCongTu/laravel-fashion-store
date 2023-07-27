<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'required|unique:coupons',
            'value' => 'required|numeric',
            'usage_limit' => 'required|numeric'
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống',
            'unique' => 'Mã khuyến mãi đã tồn tại',
            'numeric' => ':attribute phải là số'
        ];
    }
    public function attributes(): array
    {
        return [
            'code' => 'Mã khuyến mãi',
            'value' => 'Giá trị',
            'usage_limit' => 'Số lượng sử dụng'
        ];
    }
}
