<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanAlatRequest extends FormRequest
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
            'id_alat' => 'required',
            'tanggal_pinjam' => 'required|date',
            'jam_pinjam' => 'required',
            'jam_kembali' => 'required',
            'tanggal_kembali' => 'required|date',
            'jumlah_pinjam' => 'required|numeric',
            'keperluan' => 'required|string',
            'status' => 'required'
        ];
    }
}
