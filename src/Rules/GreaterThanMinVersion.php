<?php

namespace IrfanChowdhury\VersionElevate\Rules;

use Illuminate\Contracts\Validation\Rule;

class GreaterThanMinVersion implements Rule
{
    protected $minVersion;

    public function __construct($minVersion)
    {
        $this->minVersion = $minVersion;
    }

    public function passes($attribute, $value)
    {
        return version_compare($value, $this->minVersion, '>=');
    }

    public function message()
    {
        return 'The :attribute number must be greater than or equal ' . $this->minVersion;
    }
}

