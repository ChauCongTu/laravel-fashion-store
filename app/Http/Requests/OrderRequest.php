<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'required|min:5',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address2' => 'required',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min kí tự',
            'numeric' => ':attribute phải là số',
            'email' => 'Địa chỉ email không đúng định dạng',
            'city.required' => 'Vui lòng chọn tỉnh thành',
            'district.required' => 'Vui lòng chọn quận huyện',
            'ward.required' => 'Vui lòng chọn xã phường',
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Tên người mua',
            'phone' => 'Số điện thoại',
            'email' => 'Địa chỉ email',
            'address1' => 'Địa chỉ 1',
            'address2' => 'Địa chỉ 2'
        ];
    }
}
