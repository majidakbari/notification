<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IranianPhoneNumberValidationRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (!is_string($value)) {
            return false;
        }
        return preg_match('/^(\\+98|0|0098|98)?9\\d{9}$/', $value);
    }

    public function message(): string
    {
        return trans('validation.iranian_mobile_number');
    }
}
