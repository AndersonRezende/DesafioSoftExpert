<?php

namespace DesafioSoftExpert\Controllers;

class ErrorController extends Controller
{
    public function show(int $code, $message)
    {
        echo "<h1>$message</h1>";
    }
}