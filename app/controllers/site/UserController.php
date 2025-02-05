<?php

namespace app\controllers\site;

use app\vendor\Controller;
use app\models\site\User;
use Exception;

class UserController extends Controller
{

    // User registration
    public function register()
    {
        // if not post
        if (!isset($_POST['name']) && !isset($_POST['surname']) && !isset($_POST['email']) && !isset($_POST['phone']) && !isset($_POST['role']) && !isset($_POST['password'])) {
            return $this->view('site/register');
        }
        // if data has been sent
        $user = new User();
        $registerError = '';
        try {
            $user->register($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['phone'], $_POST['role'], $_POST['password']);
            $_SESSION['user'] = $user;
            return $this->view('site/index', compact('registerError'));
        } catch (Exception $e) {
            $registerError = $e->getMessage();
            return $this->view('site/register', compact('registerError'));
        }


    }

    public function login()
    {
        $loginError = '';
        if (isset($_POST['name']) && isset($_POST['password'])) {
            try {
                $user = new User();

                if ($user->login($_POST['name'], $_POST['password'])) {
                    return $this->view('site/index');
                }

            } catch (Exception $e) {

                $loginError = $e->getMessage();

                return $this->view('site/login', compact('loginError'));


            }
        }
        return $this->view('site/login');
    }

    public function logout(): void
    {
        session_destroy();

        $this->redirect('home');
    }

}