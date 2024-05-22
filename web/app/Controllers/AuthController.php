<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Core\Redirect;
use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Core\Response;
use DesafioSoftExpert\Core\View;
use DesafioSoftExpert\Repositories\UserRepository;
use DesafioSoftExpert\Requests\AuthRegisterRequest;
use DesafioSoftExpert\Requests\BaseRequest;

class AuthController extends Controller
{
    public function login()
    {
        return View::render('auth/login');
    }

    public function logout()
    {

    }

    public function authenticate()
    {

    }

    public function register($request)
    {
        $errors = $request->get('error');
        return View::render('auth/register', ['errors' => $errors]);
    }

    public function registerPost(Request $request)
    {
        $isValid = (new AuthRegisterRequest($request))->validate();
        if ($isValid === true) {
            $userRepository = new UserRepository();
            $result = $userRepository->create($request->getPostVars());
            if ($result) {
                Redirect::to('/login');
            } else {
                $errors = ['error' => ['Erro ao criar o registro!' => 0]];
                Redirect::to('/register', $errors);
            }
        } else {
            Redirect::to('/register', $isValid);
        }
    }

}