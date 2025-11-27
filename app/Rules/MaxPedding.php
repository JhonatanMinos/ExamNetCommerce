<?php

namespace App\Rules;

use App\Models\Tasks;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxPedding implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkTaskPedding = Tasks::where('user_id', $value)
            ->where('is_completed', false)
            ->count();

        if ($checkTaskPedding >= 5) {
            $fail('El usuario ya cuenta con 5 tareas pendientes.');
        }
    }
}
