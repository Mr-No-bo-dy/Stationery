<?php

namespace app\vendor;

class Controller
{
    // __construct
    public function __construct()
    {
        // Start Session, if not started already
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $uri = explode('/', preg_replace('#^/?[^/]+?/#', '', $_SERVER['REQUEST_URI']));
        if ($uri[0] == 'admin' && (!isset($_SESSION['user']) || ($_SESSION['user']['role'] != 'admin' && $_SESSION['user']['role'] != 'SuperAdmin'))) {
            unset($_SESSION['user']);
            return $this->redirect('../login');
        }
    }

    // Render view file with data
    public function view(string $name, array $data = []): void
    {
        $viewPath = 'app/resources/views/' . $name . '.php';
        if (file_exists($viewPath)) {
            extract($data);
            include($viewPath);
        }
    }

    // Redirect to specified URI
    public function redirect($uri): void
    {
        header('Location: ' . $uri);
        exit;
    }

    // Handy var_dump
    public function dd(...$vars): void
    {
        echo '<pre>';
        foreach ($vars as $var) {
            var_dump($var);
            echo '<hr>';
        }
        echo '</pre>';
        die;
    }

    // Get data from $_POST
    public function getPost(string $key = null): mixed
    {
        $postData = [];
        if (!empty($_POST)) {
            $postData = $_POST;
            if (!is_null($key)) {
                $postData = $_POST[$key] ?? null;
            }
        }

        return $postData;
    }

    // Get data from $_GET
    public function getGet(string $key = null): mixed
    {
        $getData = [];
        if (!empty($_GET)) {
            $getData = $_GET;
            if (!is_null($key)) {
                $getData = $_GET[$key] ?? null;
            }
        }

        return $getData;
    }
}
