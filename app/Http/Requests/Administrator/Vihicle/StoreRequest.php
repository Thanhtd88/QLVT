<?php

namespace App\Http\Requests\Administrator\Vihicle;

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
            'so_xe' => 'required|min:10|max:10|unique:vihicle,so_xe',
            'loai_thung' => 'required',
            'hieu_luc_kiem_dinh' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'so_xe.required' => 'Bắt buộc',
            'so_xe.min' => 'Phải có :min ký tự',
            'so_xe.max' => 'Phải có :max ký tự',
            'so_xe.unique' => 'Đã tồn tại',
            'loai_thung.required' => 'Bắt buộc',
            'hieu_luc_kiem_dinh.required' => 'Bắt buộc'
        ];
    }
}
