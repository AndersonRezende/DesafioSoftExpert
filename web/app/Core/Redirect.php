<?php

namespace DesafioSoftExpert\Core;

class Redirect
{
    public static function to($url, $params = null, $status = 200)
    {
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        header("Location: $url", true, $status);
        exit;
    }
}