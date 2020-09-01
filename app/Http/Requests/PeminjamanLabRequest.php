<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PeminjamanLabRequest extends FormRequest
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
            'id_lab' => 'required',
            'id_jadwal' => 'required',
            'tanggal' => 'required|date',
            'jam_pinjam' => 'required',
            'jam_kembali' => 'required',
            'keperluan' => 'required|string',
            'kategori' => 'required|string',
            'status' => 'required|string',
        ];
    }
}
