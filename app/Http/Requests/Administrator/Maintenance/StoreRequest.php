<?php

namespace App\Http\Requests\Administrator\Maintenance;

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
            // 'ngay_thuc_hien' => 'required',
            // 'so_luong' => 'required',
            // 'nhan_hieu' => 'required',
            // 'vihicle_id ' => 'required',
            // 'warehouse_id ' => 'required',
            // 'loai' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'ngay_thuc_hien.required' => 'Bắt buộc',
            'so_luong.required' => 'Bắt buộc',
            'nhan_hieu.required' => 'Bắt buộc',
            'vihicle_id.required' => 'Bắt buộc',
            'warehouse_id.required' => 'Bắt buộc',
            'loai.required' => 'Bắt buộc',
        ];
    }
}
