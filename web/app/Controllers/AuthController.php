<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Core\Redirect;
use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Core\Session;
use DesafioSoftExpert\Core\View;
use DesafioSoftExpert\Repositories\UserRepository;
use DesafioSoftExpert\Requests\AuthRegisterRequest;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $errors = $request->get('error');
        return View::render('auth/login', ['errors' => $errors]);
    }

    public function logout()
    {
        Session::destroy();
        Redirect::to('/login');
    }

    public function authenticate(Request $request)
    {
        $userRepository = new UserRepository();
        $result = $userRepository->login($request->get('email'), $request->get('password'));
        if ($result === false) {
            $errors = ['error' => ['Login e/ou senha incorreto!' => 0]];
            Redirect::to('/login', $errors);
        } else {
            $token = Session::auth($result);
            if ($token != false) {
                $result = $userRepository->setToken($result->getId(), $token);
                if ($result === false) {
                    $errors = ['error' => ['Não foi possível iniciar a sessão!' => 0]];
                    Redirect::to('/login', $errors);
                } else {
                    Redirect::to('/');
                }
            } else {
                $errors = ['error' => ['Não foi possível iniciar a sessão!' => 0]];
                Redirect::to('/login', $errors);
            }
        }
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