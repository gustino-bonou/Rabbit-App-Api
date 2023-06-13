<?php

namespace App\Rules;

use App\Models\Rabbit;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValideRabbitsInPairing implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

     public function __construct(private $father_id)
     {

     }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        $rabbit = Rabbit::find((int) $this->father_id);

        if($rabbit->gender !== "Mal")
        {
            $fail('The selected rabbit is not male');
        }
    }
}
