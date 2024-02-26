<?php

namespace App\Http\Requests\Administrator\Vehicle;

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
            'loai_thung' => 'required',
            'nhan_hieu' => 'required',
            'khoi_luong_hang_hoa' => 'required',
            'hieu_luc_kiem_dinh' => 'required',
            'unit_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'loai_thung.required' => 'Loại thùng không để trống',
            'nhan_hieu.required' => 'Nhãn hiệu không để trống',
            'khoi_luong_hang_hoa.required' => 'Trọng tải không để trống',
            'hieu_luc_kiem_dinh.required' => 'Hạn kiểm định không để trống',
            'hieu_luc_bhds.required' => 'Hạn BHDS không để trống',
            'unit_id.required' => 'Đơn vị không để trống'
        ];
    }
}
