<?php

namespace DesafioSoftExpert\Rules;

use DesafioSoftExpert\Requests\BaseRequest;

class ProductTypeRule implements BaseRule
{

    public static function validate($input)
    {
        if (is_array($input)) {
            foreach ($input as $item) {
                if (filter_var($item, FILTER_VALIDATE_INT) === false) {
                    return false;
                }
            }
            return true;
        } else {
            return filter_var($input, FILTER_VALIDATE_INT);
        }
    }
}