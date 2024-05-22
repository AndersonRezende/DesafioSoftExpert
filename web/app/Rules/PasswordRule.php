<?php

namespace DesafioSoftExpert\Rules;

use DesafioSoftExpert\Rules\BaseRule;

class PasswordRule implements BaseRule
{

    public static function validate($input)
    {
        $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$/';

        return filter_var($input, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => $pattern]]);
    }
}