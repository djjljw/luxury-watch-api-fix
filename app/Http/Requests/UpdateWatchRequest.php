<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWatchRequest extends FormRequest
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
        $isPatch = $this->isMethod('patch');

        return [
            'nama' => [$isPatch ? 'sometimes' : 'required', 'string', 'max:255'],
            'brand' => [$isPatch ? 'sometimes' : 'required', 'string', 'max:100'],
            'harga' => [$isPatch ? 'sometimes' : 'required', 'numeric', 'min:0'],
            'tahun_rilis' => [$isPatch ? 'sometimes' : 'required', 'integer', 'min:1800', 'max:' . (date('Y') + 1)],
            'tipe_gerakan' => [$isPatch ? 'sometimes' : 'required', 'string', 'in:Automatic,Manual,Quartz'],
            'material' => [$isPatch ? 'sometimes' : 'required', 'string', 'max:100'],
            'status' => [$isPatch ? 'sometimes' : 'required', 'string', 'in:tersedia,terjual'],
            'foto' => [$isPatch ? 'sometimes' : 'required', 'url', 'max:2048'],
        ];
    }

    /**
     * Custom validation error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama jam tangan wajib diisi.',
            'brand.required' => 'Brand jam tangan wajib diisi.',
            'harga.required' => 'Harga jam tangan wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'tahun_rilis.required' => 'Tahun rilis wajib diisi.',
            'tahun_rilis.integer' => 'Tahun rilis harus berupa angka tahun yang valid.',
            'tipe_gerakan.required' => 'Tipe gerakan wajib dipilih.',
            'tipe_gerakan.in' => 'Tipe gerakan harus salah satu dari: Automatic, Manual, Quartz.',
            'material.required' => 'Material jam tangan wajib diisi.',
            'status.required' => 'Status ketersediaan wajib dipilih.',
            'status.in' => 'Status harus salah satu dari: tersedia, terjual.',
            'foto.required' => 'URL foto jam tangan wajib diisi.',
            'foto.url' => 'Foto harus berupa format URL yang valid.',
        ];
    }
}
