<?php

namespace App\Http\Requests\Administrator\Protection;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ngay_ban_giao' => 'required',
            'so_luong' => 'required',
            'personal_id' => 'required',
            'warehouse_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'ngay_ban_giao.required' => 'Bắt buộc',
            'so_luong.required' => 'Bắt buộc',
            'personal_id.required' => 'Bắt buộc',
            'warehouse_id.required' => 'Bắt buộc',
        ];
    }
}
