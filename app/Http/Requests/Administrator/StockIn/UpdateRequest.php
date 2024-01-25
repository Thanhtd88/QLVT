<?php

namespace App\Http\Requests\Administrator\StockIn;

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
            'ngay_nhap_kho' => 'required',
            'warehouse_id' => 'required',
            'so_luong_nhap' => 'required',
            'don_gia_nhap' => 'required',
            'supplier_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'ngay_nhap_kho.required' => 'Bắt buộc',
            'warehouse_id.required' => 'Bắt buộc',
            'don_gia_nhap.required' => 'Bắt buộc',
            'so_luong_nhap.required' => 'Bắt buộc',
            'supplier_id.required' => 'Bắt buộc',
        ];
    }
}
