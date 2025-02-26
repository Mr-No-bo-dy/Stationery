<?php

namespace app\controllers\site;

use App\models\User;
use app\vendor\Controller;
use Exception;

class UserController extends Controller
{

//open registration page
    public function registration()
    {
        return $this->view('site/user/registration');
    }

    //try to register
    public function signUp()
    {
        if (!empty($this->getPost())) {
            $message = '';
            try {
                User::register($this->getPost());

                return $this->view('site/user/login');

            } catch (Exception $e) {

                $message = $e->getMessage();

                return $this->view('site/user/registration', compact('message'));
            }
        }
        return $this->redirect('registration');
    }


    //open login page
    public function login()
    {
        return $this->view('site/user/login');
    }

    //try to sign in
    public function signIn()
    {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $message = '';

            try {

                if (User::login($_POST['login'], $_POST['password']) === null) {
                    if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'SuperAdmin') {

                        return $this->redirect('admin/home');

                    } else if ($_SESSION['user']['role'] === 'user') {

                        return $this->redirect('home');
                    }
                }

            } catch (Exception $e) {

                $message = $e->getMessage();
            }
            return $this->view('site/user/login', compact('message'));
        }
        return $this->redirect('login');
    }

    //open profile page
    public function profile()
    {
        if (isset($_SESSION['user'])) {
            return $this->view('site/user/profile');
        }
        return $this->redirect('home');
    }


    //open edit page
    public function edit()
    {
        if (isset($_SESSION['user'])) {
            return $this->view('site/user/edit');
        }
        return $this->redirect('home');
    }

    //try to update data
    public function update()
    {
        if (isset($_POST['user'])) {
            if (User::update($_POST['user']) === null) {
                $message = 'data updated successfully';
                return $this->view('site/user/profile', compact('message'));
            }
            $message = User::update($_POST['user']);
            return $this->view('site/user/edit', compact('message'));

        }
        return $this->redirect('home');
    }

    //open password change page
    public function passwordChange()
    {
        if (isset($_SESSION['user'])) {
            return $this->view('site/user/passwordChange');
        }
        return $this->redirect('home');
    }

    //try to change password
    public function passwordUpdate()
    {
        if (isset($_SESSION['user']) && isset($_POST['changePassword'])) {

            if (is_null(User::passwordChange($_POST['oldPassword'], $_POST['repeatPassword'], $_POST['newPassword']))) {
                $message = 'password changed successfully';
                return $this->view('site/user/profile', compact('message'));

            } else {
                $message = User::passwordChange($_POST['oldPassword'], $_POST['repeatPassword'], $_POST['newPassword']);

            }
            return $this->view('site/user/passwordChange', compact('message'));
        }
        return $this->redirect('home');

    }

//try to set profile photo
    public function setPhoto()
    {
        if (isset($_SESSION['user']) && isset($_FILES['photo'])) {
            $message = User::setProfilePhoto($_FILES['photo']);
            return $this->view('site/user/profile', compact('message'));
        }
        return $this->redirect('home');
    }

    //try to set profile photo
    public function deletePhoto()
    {
        if (isset($_SESSION['user'])) {
            $message = User::deleteProfilePhoto();
            return $this->view('site/user/profile', compact('message'));
        }
        return $this->redirect('profile');
    }

    //logout
    public function logout()
    {
        unset($_SESSION['user']);

        return $this->redirect('home');
    }

}
