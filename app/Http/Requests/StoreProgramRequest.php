<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->can('create-programs');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'status' => ['required', 'in:draft,active,completed,cancelled'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama program wajib diisi.',
            'name.max' => 'Nama program maksimal 255 karakter.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'end_date.required' => 'Tanggal selesai wajib diisi.',
            'end_date.after' => 'Tanggal selesai harus setelah tanggal mulai.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'status.required' => 'Status program wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}
