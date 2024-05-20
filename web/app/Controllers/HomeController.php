<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Core\View;

class HomeController extends Controller
{
    public function index()
    {
        return View::render('home/index');
    }
}