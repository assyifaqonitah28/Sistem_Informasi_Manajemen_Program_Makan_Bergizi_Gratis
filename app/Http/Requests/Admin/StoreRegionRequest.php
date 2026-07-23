<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->can('create-regions');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('regions')->where(function ($query) {
                    return $query->where('parent_id', $this->parent_id);
                }),
            ],
            'type' => ['required', 'in:provinsi,kabupaten,kecamatan,desa'],
            'parent_id' => ['nullable', 'exists:regions,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wilayah wajib diisi.',
            'name.unique' => 'Nama wilayah sudah ada di level yang sama.',
            'type.required' => 'Tipe wilayah wajib dipilih.',
            'type.in' => 'Tipe wilayah tidak valid.',
            'parent_id.exists' => 'Wilayah induk tidak valid.',
        ];
    }
}
