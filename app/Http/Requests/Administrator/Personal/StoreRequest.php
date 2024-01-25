<?php

namespace App\Http\Requests\Administrator\Personal;

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
            'ma_nv' => 'required|min:5|max:5|unique:personal,ma_nv',
            'ho_ten' => 'required|max:255|min:5',
            'ngay_sinh' => 'required',
            'sdt' => 'required|min:10|max:11',
            'dia_chi' => 'required|max:255',
            'cccd' => 'required|min:12|max:15',
            'ngay_cap_cccd' => 'required',
            'noi_cap_cccd' => 'required|max:255',
            'noi_cap_gplx' => 'max:255',
            'ngay_vao' => 'required',
            'department_id' => 'required',
            'unit_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'ma_nv.required' => 'Bắt buộc',
            'ma_nv.min' => 'Độ dài bắt buộc :min ký tự',
            'ma_nv.max' => 'Độ dài bắt buộc :max ký tự',
            'ma_nv.unique' => 'Đã tồn tại',
            'ho_ten.required' => 'Bắt buộc',
            'ho_ten.min' => 'Tên nhân viên phải có ít nhất :min ký tự',
            'ho_ten.max' => 'Tên nhân viên chỉ có nhiều nhất :max ký tự',
            'ngay_sinh.required' => 'Bắt buộc',
            'sdt.required' => 'Bắt buộc',
            'sdt.min' => 'Số điện thoại phải có ít nhất :min ký tự',
            'sdt.max' => 'Số điện thoại chỉ có nhiều nhất :max ký tự',
            'dia_chi.required' => 'Bắt buộc',
            'dia_chi.max' => 'Địa chỉ chỉ có nhiều nhất :max ký tự',
            'cccd.required' => 'Bắt buộc',
            'cccd.min' => 'CCCD phải có ít nhất :min ký tự',
            'cccd.max' => 'CCCD chỉ có nhiều nhất :max ký tự',
            'cccd.unique' => 'Số CCCD đã tồn tại',
            'ngay_cap_cccd.required' => 'Bắt buộc',
            'noi_cap_cccd.required' => 'Bắt buộc',
            'noi_cap_cccd.max' => 'Nơi cấp CCCD chỉ có nhiều nhất :max ký tự',
            'gplx.unique' => 'Số GPLX đã tồn tại',
            'ngay_vao.required' => 'Bắt buộc',
            'department_id.required' => 'Bắt buộc',
            'unit_id.required' => 'Bắt buộc'
        ];
    }
}
