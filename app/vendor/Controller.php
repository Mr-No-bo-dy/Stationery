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
    public function logout(): void
    {
        session_destroy();

        $this->redirect('home');
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
}
