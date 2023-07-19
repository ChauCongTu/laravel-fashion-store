<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:5|max:100',
            'email' => 'required|email|min:5|unique:users',
            'phone' => 'required|numeric|unique:users',
            'address' => 'required|min:10|max:255'
        ];
        if ($this->route()->getName() == 'register') {
            $rules['password'] = 'required|min:6|max:16';
        }
        return $rules;
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min kí tự',
            'max' => ':attribute chỉ được có tối đa :max kí tự',
            'email' => 'Địa chỉ email không đúng định dạng',
            'numeric' => ':attribute chỉ được nhập số',
            'regex' => 'Mật khẩu phải có ít nhất 1 số và 1 kí tự đặc biệt',
            'unique' => ':attribute đã tồn tại'
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Họ tên',
            'email' => 'Địa chỉ email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'password' => 'Mật khẩu'
        ];
    }
}
