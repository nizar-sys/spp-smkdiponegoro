<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateSpp extends FormRequest
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
            'siswa_id' => 'required|exists:siswas,id',
            'nominal' => 'required|numeric',
            'tanggal' => 'required',
            'tahun' => 'required',
            'bulan' => 'required'
        ];
    }
}
