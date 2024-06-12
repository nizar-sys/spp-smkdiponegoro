<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateSiswa extends FormRequest
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
        $rules = [
            'nis' => "required|numeric",
            'nama' => "required",
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'tempat_tanggal_lahir' => 'required',
        ];

        if ($this->isMethod('POST')) {
            $rules['nis'] .= '|unique:siswas,nis';
            $rules['password'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [

            'nis.required' => 'Kolom NIS harus diisi.',
            'nis.numeric' => 'Kolom NIS harus berupa angka.',
            'nis.unique' => 'NIS sudah terdaftar di database.',

            'nama.required' => 'Kolom Nama harus diisi.',

            'kelas_id.required' => 'Kolom Kelas harus diisi.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',

            'alamat.required' => 'Kolom Alamat harus diisi.',

            'no_hp.required' => 'Kolom No. HP harus diisi.',
            'no_hp.numeric' => 'Kolom No. HP harus berupa angka.',

            'jenis_kelamin.required' => 'Kolom Jenis Kelamin harus diisi.',
            'tempat_tanggal_lahir.required' => 'Kolom Tempat Tanggal Lahir harus diisi.',
            'password.required' => 'Kolom Password harus diisi.'
        ];
    }

    public function attributes()
    {
        return [
            'kelas_id' => "Kelas siswa",
            'no_hp' => "Nomor telpon"
        ];
    }
}
