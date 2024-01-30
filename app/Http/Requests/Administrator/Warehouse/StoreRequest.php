<?php

namespace App\Http\Requests\Administrator\Warehouse;

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
            // 'ma_vat_tu' => 'required|unique:warehouse,ma_vat_tu',
            // 'vat_tu' => 'required',
            // 'don_vi_tinh' => 'required',
            // 'the_loai ' => 'required',
            // 'supplier_id  ' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'ma_vat_tu.required' => 'Bắt buộc',
            'ma_vat_tu.unique' => 'Đã tồn tại',
            'vat_tu.required' => 'Bắt buộc',
            'don_vi_tinh.required' => 'Bắt buộc',
            'the_loai.required' => 'Bắt buộc',
            'supplier_id.required' => 'Bắt buộc',
        ];
    }
}
