<?php

namespace DesafioSoftExpert\Rules;

use DesafioSoftExpert\Rules\BaseRule;

class PasswordConfirmationRule implements BaseRule
{

    public static function validate($input)
    {
        return $input[0] === $input[1];
    }
}