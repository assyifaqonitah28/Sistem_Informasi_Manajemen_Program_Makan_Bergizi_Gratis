<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Pastikan user yang login memiliki permission 'edit-reports'
        return auth()->user()->can('edit-reports');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'report_date' => [
                'required',
                'date',
            ],
            'description' => [
                'required',
                'string',
                'max:1000',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048', // Maksimal 2MB
            ],
            'status' => [
                'required',
                'in:pending,approved,rejected',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'report_date.required' => 'Tanggal laporan wajib diisi.',
            'report_date.date' => 'Format tanggal tidak valid.',

            'description.required' => 'Deskripsi/keterangan wajib diisi.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',

            'image.image' => 'File yang diupload harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',

            'status.required' => 'Status verifikasi wajib dipilih.',
            'status.in' => 'Pilihan status tidak valid.',
        ];
    }
}
