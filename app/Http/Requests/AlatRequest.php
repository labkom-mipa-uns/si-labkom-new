<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlatRequest extends FormRequest
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
            'nama_alat' => 'required|string|max:50',
            'harga_alat' => 'required|numeric'
        ];
    }
}
