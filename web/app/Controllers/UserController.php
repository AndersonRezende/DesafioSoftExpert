<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Core\Redirect;
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
        if ($user === false) {
            Redirect::to('/user');
        }
        return View::render('user/show', ['user' => $user]);
    }

    public function create()
    {
        return View::render('user/create');
    }

    public function list()
    {

    }
}