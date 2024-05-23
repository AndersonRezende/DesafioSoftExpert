<?php

namespace DesafioSoftExpert\Rules;

use DesafioSoftExpert\Rules\BaseRule;

class DescriptionRule implements BaseRule
{

    public static function validate($input)
    {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
}