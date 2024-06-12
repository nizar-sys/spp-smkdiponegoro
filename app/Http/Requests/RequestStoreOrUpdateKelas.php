<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateKelas extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kelas' => "required",
            'kompetensi_keahlian' => "required",
            'kode_kelas' => "required",
            'nominal_spp' => "required",
            'tahun_ajaran' => 'required'
        ];
    }

    public function attribute()
    {
        return [
            'kelas' => "Kelas",
            'kompetensi_keahlian' => "Kompetensi keahlian atau Jurusan",
            'kode_kelas' => "Kode Kelas",
            'nominal_spp' => "Nominal SPP",
            'tahun_ajaran' => 'Tahun Ajaran'
        ];
    }

    public function messages()
    {
        return [
            'kelas.required' => "Kelas atau Tingkatan wajib diisi.",
            'kompetensi_keahlian.required' => "Kompetensi keahlian atau Jurusan wajib diisi.",
            'kode_kelas.required' => "Kode Kelas wajib diisi.",
            'nominal_spp.required' => "Nominal SPP wajib diisi.",
            'tahun_ajaran.required' => 'Tahun Ajaran wajib diisi.'
        ];
    }
}
