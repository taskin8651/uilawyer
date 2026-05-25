<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MeaningfulText implements Rule
{
    private int $minLength;
    private int $minWords;

    public function __construct(int $minLength = 3, int $minWords = 1)
    {
        $this->minLength = $minLength;
        $this->minWords = $minWords;
    }

    public function passes($attribute, $value)
    {
        $text = trim(preg_replace('/\s+/', ' ', strip_tags((string) $value)));
        $lower = strtolower($text);

        if (mb_strlen($text) < $this->minLength) {
            return false;
        }

        if (str_word_count($text) < $this->minWords) {
            return false;
        }

        $dummyWords = [
            'test', 'testing', 'dummy', 'demo', 'sample', 'asdf', 'qwerty',
            'abcd', 'abcde', 'xyz', 'na', 'n/a', 'none', 'nil', 'no',
            'random', 'lorem', 'ipsum',
        ];

        if (in_array($lower, $dummyWords, true)) {
            return false;
        }

        if (preg_match('/(.)\1{4,}/u', $lower)) {
            return false;
        }

        if (preg_match('/^[^a-z0-9]+$/i', $text)) {
            return false;
        }

        if (! preg_match('/[aeiou]/i', $text) && mb_strlen($text) > 5) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'Please enter genuine and meaningful details.';
    }
}
