<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeneficiaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->can('create-beneficiaries');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'size:16', 'unique:beneficiaries,nik', 'regex:/^[0-9]+$/'],
            'region_id' => ['required', 'exists:regions,id'],
            'address' => ['required', 'string', 'max:500'],
            'phone' => ['required', 'string', 'max:20'],
            'status' => ['required', 'in:active,inactive,pending'],
        ];
    }

    public function messages(): array
    {
        return [
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'region_id.required' => 'Wilayah wajib dipilih.',
            'region_id.exists' => 'Wilayah tidak valid.',
        ];
    }
}
