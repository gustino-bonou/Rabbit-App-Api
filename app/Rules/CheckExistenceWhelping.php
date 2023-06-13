<?php

namespace App\Rules;

use App\Models\Pairing;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckExistenceWhelping implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function __construct(private $pairing_id){}
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pairing = Pairing::find($this->pairing_id);

        if($pairing->whelping()->exists())
        {
            $fail("You had already registered a farrowing for this pairing");
        }
    }
}
