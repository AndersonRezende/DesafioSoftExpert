<?php

namespace DesafioSoftExpert\Rules;

use DesafioSoftExpert\Rules\BaseRule;

class EmailRule implements BaseRule
{

    public static function validate($input)
    {
        return filter_var($input, FILTER_VALIDATE_EMAIL);
    }
}