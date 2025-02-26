<?php

namespace app\controllers\site;

use app\vendor\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->view('site/index');
    }

    public function changeColorTheme()
    {
        if ($this->getPost('uri')) {
            $uri = $_POST["uri"];
            if (preg_match('#^/?stationery#i', $uri)) {
                $uri = preg_replace('#^/?[^/]+?/#', '', $_POST["uri"]);
            }

            setcookie("colorTheme", !isset($_COOKIE['colorTheme']) || $_COOKIE['colorTheme'] == 'light' ? 'dark' : 'light' , time() + 86400 * 30);

            return $this->redirect($uri ? $uri : 'home');
        }
        return $this->redirect('home');
    }
}