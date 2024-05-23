<?php

namespace DesafioSoftExpert\Middleware;

use DesafioSoftExpert\Core\Redirect;
use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Core\Session;
use DesafioSoftExpert\Repositories\UserRepository;

class AuthMiddleware extends BaseMiddleware
{
    public static function handle(Request $request)
    {
        if (!isset($_SESSION['user_id']) ) {
            Redirect::to('/login');
        } else {
            $user = (new UserRepository())->getByToken($_SESSION['session_token']);
            if ($user === false || $user->getSessionToken() !== Session::get('session_token')) {
                Redirect::to('/login');
            }
        }
    }
}