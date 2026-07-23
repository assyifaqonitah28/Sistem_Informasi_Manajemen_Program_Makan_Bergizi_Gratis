<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreDistributionRequest extends FormRequest {
    public function authorize(): bool { return auth()->user()->can('create-distributions'); }
    public function rules(): array {
        return [
            'program_id' => ['required', 'exists:programs,id'],
            'beneficiary_id' => ['required', 'exists:beneficiaries,id'],
            'distribution_date' => ['required', 'date'],
            'quantity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:scheduled,distributed,failed,cancelled'],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }
    public function messages(): array {
        return [
            'program_id.required' => 'Program wajib dipilih.',
            'beneficiary_id.required' => 'Penerima manfaat wajib dipilih.',
            'distribution_date.required' => 'Tanggal distribusi wajib diisi.',
            'quantity.min' => 'Jumlah porsi minimal 1.',
        ];
    }
}
