<?php

namespace DesafioSoftExpert\Rules;

use DesafioSoftExpert\Requests\BaseRequest;

class ProductTypeRule implements BaseRule
{

    public static function validate($input)
    {
        return filter_var($input, FILTER_VALIDATE_INT);
    }
}