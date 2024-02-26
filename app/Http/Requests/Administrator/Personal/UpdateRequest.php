<?php

namespace App\Http\Requests\Administrator\Personal;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'ma_nv' => 'required|min:5|max:5',
            'ho_ten' => 'required|max:255|min:5',
            'ngay_sinh' => 'required',
            'sdt' => 'required|min:10|max:11',
            'dia_chi' => 'required|max:255',
            'cccd' => 'required|min:12|max:15',
            'ngay_cap_cccd' => 'required|date|date_format:d/m/Y',
            'noi_cap_cccd' => 'required|max:255',
            'noi_cap_gplx' => 'max:255',
            'ngay_vao' => 'required|date|date_format:d/m/Y',
            'department_id' => 'required',
            'unit_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ma_nv.required' => 'Mã không được để trống',
            'ma_nv.min' => 'Mã phải có :min ký tự',
            'ma_nv.max' => 'Mã chỉ có :max ký tự',
            'ma_nv.unique' => 'Mã đã tồn tại',
            'ho_ten.required' => 'Tên không được để trống',
            'ho_ten.min' => 'Tên nhân viên phải có ít nhất :min ký tự',
            'ho_ten.max' => 'Tên nhân viên chỉ có nhiều nhất :max ký tự',
            'ngay_sinh.required' => 'Ngày sinh không được để trống',
            'sdt.required' => 'không được để trống',
            'sdt.min' => 'Số điện thoại phải có ít nhất :min ký tự',
            'sdt.max' => 'Số điện thoại chỉ có nhiều nhất :max ký tự',
            'dia_chi.required' => 'Địa chỉ không được để trống',
            'dia_chi.max' => 'Địa chỉ chỉ có nhiều nhất :max ký tự',
            'cccd.required' => 'CCCD không được để trống',
            'cccd.min' => 'CCCD phải có ít nhất :min ký tự',
            'cccd.max' => 'CCCD chỉ có nhiều nhất :max ký tự',
            'ngay_cap_cccd.required' => 'Ngày cấp CCCD không được để trống',
            'ngay_cap_cccd.date' => 'Vui lòng nhập đúng định dạng d/m/yyyy',
            'ngay_cap_cccd.date_format' => 'Vui lòng nhập đúng định dạng d/m/yyyy',
            'noi_cap_cccd.required' => 'Nơi cấp CCCD không được để trống',
            'noi_cap_cccd.max' => 'Nơi cấp CCCD có ít nhất :min ký tự',
            'noi_cap_gplx.max' => 'Nơi cấp GPLX có tối đa :max ký tự',
            'ngay_vao.required' => 'Ngày vào không được để trống',
            'ngay_vao.date' => 'Vui lòng nhập đúng định dạng d/m/yyyy',
            'ngay_vao.date_format' => 'Vui lòng nhập đúng định dạng d/m/yyyy',
            'department_id.required' => 'Phòng ban không được để trống',
            'unit_id.required' => 'Đơn vị không được để trống',
        ];
    }
}
