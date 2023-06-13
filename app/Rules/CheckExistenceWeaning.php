<?php

namespace App\Rules;

use App\Models\Whelping;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckExistenceWeaning implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function __construct(private $whelping_id){}
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $whelping = Whelping::find($this->whelping_id);

        if($whelping->weaning()->exists())
        {
            $fail('You had already weaned this whelping');
        }
    }
}
