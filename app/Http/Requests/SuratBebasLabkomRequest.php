<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratBebasLabkomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id_mahasiswa' => 'required',
            'tanggal' => 'required|date',
            'proses' => 'required',
        ];
    }
}
