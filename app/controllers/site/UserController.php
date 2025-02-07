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
        if (!isset($_POST['name']) && !isset($_POST['surname']) && !isset($_POST['email']) && !isset($_POST['phone']) && !isset($_POST['password'])) {
            return $this->view('site/user/register');
        }
        // if data has been sent
        $user = new User();
        $registerError = '';

        try {

            $user->register($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['phone'], $_POST['password']);

            return $this->view('site/user/login', compact('registerError'));

        } catch (Exception $e) {

            $registerError = $e->getMessage();

            return $this->view('site/user/register', compact('registerError'));

        }
    }

    public function login()
    {
        if (isset($_POST['name']) && isset($_POST['password'])) {

            try {

                $user = new User();

                if ($user->login($_POST['name'], $_POST['password'])) {

                    return $_SESSION['user']->fillable['role'] === 'admin'
                        ? $this->redirect('admin/home')
                        : $this->redirect('home');
                }

            } catch (Exception $e) {

                $loginError = $e->getMessage();

                return $this->view('site/user/login', compact('loginError'));


            }
        }

        return $this->view('site/user/login');
    }

    public function logout(): void
    {
        session_destroy();

        $this->redirect('home');
    }

}