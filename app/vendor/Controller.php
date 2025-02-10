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

    // Simple handy var_dump
    public function dd($var): void
    {
        echo '<pre>';
        var_dump($var);
        die;
    }

    // Get data from $_POST
    public function getPost(string $key = null): array
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
    public function getGet(string $key = null): array
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
