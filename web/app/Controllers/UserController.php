<?php

namespace DesafioSoftExpert\Controllers;

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

    public function show($id)
    {
        $userRepository = new UserRepository();
        $user = $userRepository->find($id);
        return View::render('user/show', ['user' => $user]);
    }

    public function list()
    {

    }
}