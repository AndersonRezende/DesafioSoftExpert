<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Repositories\UserRepository;

class HomeController
{
    public function index()
    {
        $userRepository = new UserRepository();
        $users = $userRepository->all();
        include __DIR__ . '/../Views/home/index.php';
    }
}