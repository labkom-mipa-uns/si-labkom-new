<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
            'nim' => 'required|size:8',
            'nama_mahasiswa' => 'required|string|max:60',
            'jenis_kelamin' => 'required|string',
            'kelas' => 'required|string|max:5',
            'id_prodi' => 'required',
            'angkatan' => 'required',
            'no_hp' => 'required|max:13'
        ];
    }
}
