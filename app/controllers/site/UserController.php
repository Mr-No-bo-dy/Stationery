<?php

namespace app\controllers\site;

use App\models\User;
use app\vendor\Controller;
use Exception;

class UserController extends Controller
{

    // User registration
    public function register()
    {
        // if not post
        if (!isset($_POST['user'])) {
            return $this->view('site/user/register');
        }
        // if data has been sent
        $registerError = '';
        try {
            User::register($_POST['user']);

            return $this->view('site/user/login');

        } catch (Exception $e) {

            $registerError = $e->getMessage();

            return $this->view('site/user/register', compact('registerError'));

        }
    }

    public function login(): void
    {

        $loginError = '';
        if (isset($_POST['login']) && isset($_POST['password'])) {

            try {

                if (User::login($_POST['login'], $_POST['password'])) {

                    $_SESSION['user']['role'] === 'admin' ?
                        $this->redirect('admin/home') :
                        $this->redirect('home');
                }

            } catch (Exception $e) {

                $loginError = $e->getMessage();
            }
        }
        $this->view('site/user/login', compact('loginError'));
    }

    public function profile()
    {
        $this->view('site/user/profile');
    }

    public function edit(): void
    {
        if (isset($_POST['edit'])) {

            $this->view('site/user/edit');

        } else if (isset($_POST['saveEdit'])){


            $message = User::update($_POST['user']) === null ? 'user is edited successfully' : 'something went wrong';

            $this->view('site/user/profile', compact('message'));


        }

    }

    public function logout(): void
    {
        unset($_SESSION['user']);

        $this->redirect('home');
    }

}