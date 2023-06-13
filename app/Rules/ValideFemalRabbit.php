<?php

namespace App\Rules;

use Closure;
use App\Models\Rabbit;
use Illuminate\Contracts\Validation\ValidationRule;

class ValideFemalRabbit implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function __construct(private $mother_id){}
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $rabbit = Rabbit::find((int) $this->mother_id);

        if($rabbit->gender !== "Femelle")
        {
            $fail('The selected rabbit is not female');
        }
    }
}
