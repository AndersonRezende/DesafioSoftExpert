<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Controllers\Controller;
use DesafioSoftExpert\Core\View;
use DesafioSoftExpert\Repositories\UserRepository;

class UserController extends Controller
{
    public function index()
    {
        $userRepository = new UserRepository();
        $users = $userRepository->all();
        return View::render('user/index', ['users' => $users]);
    }
}