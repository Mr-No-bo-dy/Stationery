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

    public function login()
    {

        $loginError = '';
        if (isset($_POST['login']) && isset($_POST['password'])) {

            try {

                if (User::login($_POST['login'], $_POST['password'])) {

                    return $_SESSION['user']['role'] === 'admin' ?
                        $this->redirect('admin/home') :
                        $this->redirect('home');
                }

            } catch (Exception $e) {

                $loginError = $e->getMessage();
            }
        }
        return $this->view('site/user/login', compact('loginError'));
    }

    public function profile()
    {
        return $this->view('site/user/profile');
    }

    public function edit()
    {
        if (isset($_POST['edit'])) {

            return $this->view('site/user/edit');

        } else if (isset($_POST['saveEdit'])){


            $message = User::update($_POST['user']) === null ? 'user is edited successfully' : 'something went wrong';

            return $this->view('site/user/profile', compact('message'));


        }

    }

    public function passwordChange()
    {
        if (isset($_POST['changePassword'])) {
            if (is_null(User::passwordChange($_POST['oldPassword'], $_POST['repeatPassword'], $_POST['newPassword']))) {
                $message = 'password changed successfully';
            } else {
                $message = User::passwordChange($_POST['oldPassword'], $_POST['repeatPassword'], $_POST['newPassword']);
            }

            return $this->view('site/user/profile', compact('message'));
        }


        return $this->view('site/user/passwordChange');

    }

    public function setPhoto()
    {
        $message = User::setProfilePhoto($_FILES['photo']);
        $this->view('site/user/profile', compact('message'));
    }

    public function logout()
    {
        unset($_SESSION['user']);

        return $this->redirect('home');
    }

}