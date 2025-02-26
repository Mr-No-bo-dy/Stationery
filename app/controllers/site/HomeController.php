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
        $uri = $_POST["uri"];
        if (preg_match('#^/?stationery#i', $uri)) {
            $uri = preg_replace('#^/?[^/]+?/#', '', $_POST["uri"]);
        }

        if (($_COOKIE["colorTheme"] == "light")) {
            setcookie("colorTheme", "dark", time() + 86400 * 30);
            return $this->redirect($uri);
        }

        setcookie("colorTheme", "light", time() + 86400 * 30);
        return $this->redirect($uri);
    }
}