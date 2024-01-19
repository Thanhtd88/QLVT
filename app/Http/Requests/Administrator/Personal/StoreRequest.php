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
            'ma_nv.required' => 'Mã nhân viên không được để trống',
            'ma_nv.min' => 'Mã nhân viên phải có :min ký tự',
            'ma_nv.max' => 'Mã nhân viên phải có :max ký tự',
            'ma_nv.unique' => 'Mã nhân viên đã tồn tại',
            'ho_ten.required' => 'Tên nhân viên không được để trống',
            'ho_ten.min' => 'Tên nhân viên phải có ít nhất :min ký tự',
            'ho_ten.max' => 'Tên nhân viên chỉ có nhiều nhất :max ký tự',
            'ngay_sinh.required' => 'Ngày sinh không được để trống',
            'sdt.required' => 'Số điện thoại không được để trống',
            'sdt.min' => 'Số điện thoại phải có ít nhất :min ký tự',
            'sdt.max' => 'Số điện thoại chỉ có nhiều nhất :max ký tự',
            'dia_chi.required' => 'Địa chỉ không được để trống',
            'dia_chi.max' => 'Địa chỉ chỉ có nhiều nhất :max ký tự',
            'cccd.required' => 'CCCD không được để trống',
            'cccd.min' => 'CCCD phải có ít nhất :min ký tự',
            'cccd.max' => 'CCCD chỉ có nhiều nhất :max ký tự',
            'cccd.unique' => 'Số CCCD đã tồn tại',
            'ngay_cap_cccd.required' => 'Ngày cấp CCCD không được để trống',
            'noi_cap_cccd.required' => 'Nơi cấp CCCD không được để trống',
            'noi_cap_cccd.max' => 'Nơi cấp CCCD chỉ có nhiều nhất :max ký tự',
            'gplx.unique' => 'Số GPLX đã tồn tại',
            'ngay_vao.required' => 'Ngày vào làm không được để trống',
            'department_id.required' => 'Phòng ban không được để trống',
            'unit_id.required' => 'Đơn vị không được để trống'
        ];
    }
}
