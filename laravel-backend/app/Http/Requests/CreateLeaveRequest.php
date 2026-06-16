<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateLeaveRequest extends FormRequest
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
        'tu_ngay' => ['required', 'date'],
        'den_ngay' => ['required', 'date', 'after_or_equal:tu_ngay'],
        'so_gio' => ['nullable', 'numeric', 'min:0.5'],
        'ly_do' => ['required', 'string', 'max:1000'],
        'loai_nghi' => ['required', 'exists:leave_types,type_id'],
    ];
}
}
