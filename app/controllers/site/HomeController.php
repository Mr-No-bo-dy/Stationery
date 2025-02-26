<?php

namespace app\controllers\site;

use app\vendor\Controller;

class HomeController extends Controller
{
    public function index()
    {
        if (!isset($_COOKIE["colorTheme"])) {

            setcookie("colorTheme", "light", time() + 86400 * 30);
        }

        return $this->view('site/index');
    }

    public function changeColorTheme()
    {
        if ($this->getPost('uri')) {
            $uri = $_POST["uri"];
            if (preg_match('#^/?stationery#i', $uri)) {
                $uri = preg_replace('#^/?[^/]+?/#', '', $_POST["uri"]);
            }
            setcookie("colorTheme",  $_COOKIE['colorTheme'] == 'light' ? 'dark' : 'light' , time() + 86400 * 30);

            return $this->redirect($uri);
        }
        return $this->redirect('home');
    }
}