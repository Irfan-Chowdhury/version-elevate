<?php

namespace IrfanChowdhury\VersionElevate\Rules;

use Illuminate\Contracts\Validation\Rule;

class VersionNumber implements Rule
{
    public function passes($attribute, $value)
    {
        // Validate that $value is in the format "x.y.z"
        return preg_match('/^\d+\.\d+\.\d+$/', $value);
    }

    public function message()
    {
        return 'The :attribute must be in the format "x.y.z"';
    }
}

