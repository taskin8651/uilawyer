<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPhoneNumber implements Rule
{
    public function passes($attribute, $value)
    {
        $digits = preg_replace('/\D+/', '', (string) $value);

        if (! in_array(strlen($digits), [10, 12], true)) {
            return false;
        }

        if (strlen($digits) === 12) {
            if (! str_starts_with($digits, '91')) {
                return false;
            }

            $digits = substr($digits, 2);
        }

        if (! preg_match('/^[6-9][0-9]{9}$/', $digits)) {
            return false;
        }

        if (preg_match('/^(\d)\1{9}$/', $digits)) {
            return false;
        }

        $blocked = ['1234567890', '9876543210', '9999999999', '8888888888', '7777777777', '6666666666'];

        return ! in_array($digits, $blocked, true);
    }

    public function message()
    {
        return 'Please enter a valid Indian mobile number.';
    }
}
