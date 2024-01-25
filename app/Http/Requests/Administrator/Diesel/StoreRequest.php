<?php

namespace App\Http\Requests\Administrator\Diesel;

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
            'odo' => 'required',
            'ngay_do' => 'required',
            'noi_do' => 'required',
            'so_lit' => 'required',
            'vihicle_id' => 'required',
            'personal_id' => 'required',            
        ];
    }
    public function messages()
    {
        return [
            'odo.required' => 'Bắt buộc',
            'ngay_do.required' => 'Bắt buộc',
            'noi_do.required' => 'Bắt buộc',
            'so_lit.required' => 'Bắt buộc',
            'vihicle_id.required' => 'Bắt buộc',
            'personal_id.required' => 'Bắt buộc',  
        ];
    }
}
