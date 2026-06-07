<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // User info
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',

            // Employee info
            'emp_code' => 'required|string|max:50|unique:employees,emp_code',
            'fullname' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'sex' => 'nullable|in:nam,nữ',
            'phone' => 'nullable|string|max:20',

            // Work info
            'hire_date' => 'nullable|date',
            'status' => 'nullable|integer',
            'manager_id' => 'nullable|integer|exists:employees,id',

            // Relations
            'depart_id' => 'required|integer|exists:departments,depart_id',
            'pos_id' => 'required|integer|exists:positions,pos_id',
            'role_id' => 'required|integer|exists:role,role_id',
        ];
    }

    public function messages(): array
    {
        return [
           
            // Email
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',

            // Password
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',

            // Employee code
            'emp_code.required' => 'Mã nhân viên là bắt buộc',
            'emp_code.unique' => 'Mã nhân viên đã tồn tại',

            // Fullname
            'fullname.required' => 'Họ tên là bắt buộc',

            // Sex
            'sex.in' => 'Giới tính không hợp lệ',

            // Department
            'depart_id.required' => 'Phòng ban là bắt buộc',
            'depart_id.exists' => 'Phòng ban không tồn tại',

            // Position
            'pos_id.required' => 'Chức vụ là bắt buộc',
            'pos_id.exists' => 'Chức vụ không tồn tại',

            // Role
            'role_id.required' => 'Vai trò là bắt buộc',
            'role_id.exists' => 'Vai trò không tồn tại',
        ];
    }
}