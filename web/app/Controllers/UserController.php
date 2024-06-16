<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Core\Redirect;
use DesafioSoftExpert\Core\View;
use DesafioSoftExpert\Repositories\UserRepository;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $users = $this->userRepository->all();
        return View::render('user/index', ['users' => $users]);
    }

    public function show($id)
    {
        $user = $this->userRepository->find($id);
        if ($user === false) {
            Redirect::to('/user');
        }
        return View::render('user/show', ['user' => $user]);
    }

    public function create()
    {
        return View::render('user/create');
    }
}