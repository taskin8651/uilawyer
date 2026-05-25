<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PersonName implements Rule
{
    public function passes($attribute, $value)
    {
        $name = trim(preg_replace('/\s+/', ' ', (string) $value));
        $lower = strtolower($name);

        if (mb_strlen($name) < 3 || mb_strlen($name) > 120) {
            return false;
        }

        if (! preg_match('/^[a-zA-Z][a-zA-Z .\'-]*[a-zA-Z]$/', $name)) {
            return false;
        }

        if (preg_match('/(.)\1{3,}/', $lower)) {
            return false;
        }

        $blocked = ['test', 'testing', 'dummy', 'demo', 'sample', 'asdf', 'qwerty', 'abc', 'xyz', 'na', 'n/a'];

        return ! in_array($lower, $blocked, true);
    }

    public function message()
    {
        return 'Please enter a valid real name.';
    }
}
