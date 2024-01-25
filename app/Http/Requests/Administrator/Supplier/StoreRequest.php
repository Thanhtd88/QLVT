<?php

namespace App\Http\Requests\Administrator\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'ma_ncc' => 'required|unique:supplier,ma_ncc',
            'ten_ncc' => 'required',
            'dia_chi' => 'required',
            'sdt' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'ma_ncc.required' => 'Bắt buộc',
            'ma_ncc.unique' => 'Đã tồn tại',
            'ten_ncc.required' => 'Bắt buộc',
            'dia_chi.required' => 'Bắt buộc',
            'sdt.required' => 'Bắt buộc',
        ];
    }
}
