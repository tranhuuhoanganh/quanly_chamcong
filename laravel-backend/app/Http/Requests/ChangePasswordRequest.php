<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password_old' =>'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'password_old.required' => 'Mật khẩu là bắt buộc',
            'password_old.string' => 'Mật khẩu phải là chuỗi',
            'password_old.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.string' => 'Mật khẩu phải là chuỗi',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password_confirmation.required' => 'Mật khẩu là bắt buộc',
            'password.confirmed' => 'Mật khẩu không khớp',
        ];
    }
}
