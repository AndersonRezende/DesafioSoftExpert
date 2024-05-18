<?php

namespace DesafioSoftExpert\Controllers;

class HomeController
{
    public function index()
    {
        //$userRepository = new UserRepository();
        //$users = $userRepository->all();
        include __DIR__ . '/../Views/home/index.php';
    }
}