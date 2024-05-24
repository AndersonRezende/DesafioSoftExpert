<?php

namespace DesafioSoftExpert\Rules;

use DesafioSoftExpert\Rules\BaseRule;

class ImageRule implements BaseRule
{

    public static function validate($input)
    {
        return isset($input) && $input['error'] == UPLOAD_ERR_OK && $input['size'] > 0 && $input['size'] <= 4000000;
    }
}