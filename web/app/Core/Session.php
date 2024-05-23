<?php

namespace DesafioSoftExpert\Core;

use DesafioSoftExpert\Models\User;
use Exception;

class Session
{
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function start()
    {
        session_start();
    }

    public static function close()
    {
        session_write_close();
    }

    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function getAll()
    {
        return $_SESSION;
    }

    public static function auth(User $user): string
    {
        try {
            $sessionToken = bin2hex(random_bytes(32));
        } catch (Exception $e) {
            return false;
        }
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['session_token'] = $sessionToken;
        return $sessionToken;
    }
}