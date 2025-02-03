<?php

namespace app\controllers\site;

use app\vendor\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $username = 'Oleksandr';

        return $this->view('site/index', compact('username'));
    }
}