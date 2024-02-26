<?php

namespace App\Http\Requests\administrator\TransferHistories;

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
            'loai_bien_ban' => 'required',
            'd_personal_id' => 'required',
            'r_personal_id' => 'required',
            'vihicle_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'loai_bien_ban.required' => 'Vui lòng chọn loại biên bản',
            'd_personal_id.required' => 'Vui lòng chọn người bàn giao',
            'r_personal_id.required' => 'Vui lòng chọn người nhận bàn giao',
            'vihicle_id.required' => 'Vui lòng chọn xe bàn giao',
        ];
    }
}
