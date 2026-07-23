<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest {
    public function authorize(): bool { return auth()->user()->can('create-reports'); }
    public function rules(): array {
        return [
            'distribution_id' => ['required', 'unique:reports,distribution_id', 'exists:distributions,id'],
            'report_date' => ['required', 'date'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:pending,approved,rejected'],
        ];
    }
    public function messages(): array {
        return [
            'distribution_id.unique' => 'Laporan untuk distribusi ini sudah ada.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
