<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordStrength implements Rule
{
    /**
     * Minimum number of characters
     *
     * @var int
     */
    protected $minLength = 8;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (strlen($value) >= $this->minLength) &&
            ((bool) preg_match('/(?:[A-Z].*[0-9])|(?:[0-9].*[A-Z])/', $value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute must be minimum of {$this->minLength} characters and have at least one capital letter and one numeric character.";
    }
}
