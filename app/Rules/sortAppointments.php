<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class sortAppointments implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validParams = ['createdDate', 'updateDate', 'letra', 'id'];
        
        $validParamsString = implode(', ', $validParams);
        if(!in_array($value, $validParams)){
            $fail("Debe utilizar un parametro valido: $validParamsString");
        }
    }
}
