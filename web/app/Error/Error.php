<?php

namespace DesafioSoftExpert\Error;

use DesafioSoftExpert\Controllers\ErrorController;

class Error
{
    public const NOT_FOUND = 404;
    public static function throwError($code, $message)
    {
        $controller = new ErrorController();
        $controller->show($code, $message);
    }

}