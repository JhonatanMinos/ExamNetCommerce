<?php

namespace App\Http\Requests;

use App\Rules\MaxPedding;
use Illuminate\Foundation\Http\FormRequest;

class StoretasksRequest extends FormRequest
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
        return [
            'company_id' => 'required|exists:company,id',
            'user_id' => ['required', 'exists:users,id', new MaxPedding()],
            'name' => 'required|string',
            'description' => 'nullable|string',
            'is_completed' => 'nullable|boolean',
            'start_at' => 'nullable|date',
            'expired_at' => 'nullable|date'
        ];
    }
}
