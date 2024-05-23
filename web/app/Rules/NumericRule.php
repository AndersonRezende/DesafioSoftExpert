<?php

namespace DesafioSoftExpert\Rules;

class NumericRule implements BaseRule
{

    public static function validate($input)
    {
        return is_numeric($input);
    }
}