<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBeneficiaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('edit-beneficiaries');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'nik' => [
                'required',
                'string',
                'size:16',
                'regex:/^[0-9]+$/',
                Rule::unique('beneficiaries', 'nik')->ignore($this->beneficiary->id),
            ],
            'region_id' => [
                'required',
                'exists:regions,id',
            ],
            'address' => [
                'required',
                'string',
                'max:500',
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
            ],
            'status' => [
                'required',
                'in:active,inactive,pending',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama penerima manfaat wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',

            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar pada penerima manfaat lain.',
            'nik.regex' => 'NIK hanya boleh berisi angka (0-9).',

            'region_id.required' => 'Wilayah wajib dipilih.',
            'region_id.exists' => 'Wilayah yang dipilih tidak valid.',

            'address.required' => 'Alamat wajib diisi.',
            'address.max' => 'Alamat maksimal 500 karakter.',

            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',

            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nama',
            'nik' => 'NIK',
            'region_id' => 'wilayah',
            'address' => 'alamat',
            'phone' => 'nomor telepon',
            'status' => 'status',
        ];
    }
}
