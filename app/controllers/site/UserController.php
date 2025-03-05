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
        $title = 'Registration Page';
        return $this->view('site/user/registration', compact('title'));
    }

    //try to register
    public function signUp()
    {
        if (!empty($this->getPost())) {
            $message = User::register($this->getPost());

            if (is_null($message)) {
                $title = 'Login Page';
                return $this->view('site/user/login');
            }
        }
        $title = 'Registration Page';
        return $this->view('site/user/registration', !empty($message) ? compact('message', 'title') : ['title']);

    }

    //open login page
    public function login()
    {
        $title = 'Login Page';
        return $this->view('site/user/login', compact('title'));
    }

    //try to sign in
    public function signIn()
    {
        if (!empty($this->getPost())) {
            $message = User::login($_POST['login'], $_POST['password']);

            if (is_null($message)) {
                if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'SuperAdmin') {

                    return $this->redirect('admin/home');

                } else if ($_SESSION['user']['role'] === 'user') {

                    return $this->redirect('home');
                }
            }
        }
        $title = 'Login Page';
        return $this->view('site/user/login', !empty($message) ? compact('message', 'title') : compact('title'));
    }

    //open profile page
    public function profile()
    {
        if (isset($_SESSION['user'])) {
            $title = 'Profile Page';
            return $this->view('site/user/profile', compact('title'));
        }
        return $this->redirect('home');
    }


    //open edit page
    public function edit()
    {
        if (isset($_SESSION['user'])) {
            $title = 'Edit Profile Page';
            return $this->view('site/user/edit', compact('title'));
        }
        return $this->redirect('home');
    }

    //try to update data
    public function update()
    {
        if ($this->getPost('user')) {
            $message = User::update($this->getPost('user'));
            if (is_null($message)) {
                $title = 'Profile Page';
                return $this->view('site/user/profile', compact('message', 'title'));
            }
            $title = 'Edit Page';
            return $this->view('site/user/edit', compact('message', 'title'));
        }
        return $this->redirect('home');
    }

    //open password change page
    public function passwordChange()
    {
        if (isset($_SESSION['user'])) {
            $title = 'Change password page';
            return $this->view('site/user/passwordChange', compact('title'));
        }
        return $this->redirect('home');
    }

    //try to change password
    public function passwordUpdate()
    {
        if (isset($_POST['changePassword'])) {

            $message = User::passwordChange($_POST['oldPassword'], $_POST['repeatPassword'], $_POST['newPassword']);

            if (is_null($message)) {
                $message = 'password changed successfully';
                $title = 'Profile Page';
                return $this->view('site/user/profile', compact('message', 'title'));

            }
            $title = 'Change password page';
            return $this->view('site/user/passwordChange', compact('message', 'title'));
        }
        return $this->redirect('home');

    }

//try to set profile photo
    public function setPhoto()
    {
        if (isset($_SESSION['user']) && isset($_FILES['photo'])) {
            $message = User::setProfilePhoto($_FILES['photo']);
            $title = 'Profile Page';
            return $this->view('site/user/profile', compact('message', 'title'));
        }
        return $this->redirect('home');
    }

    //try to set profile photo
    public function deletePhoto()
    {
        if (isset($_SESSION['user'])) {
            $message = User::deleteProfilePhoto();
            $title = 'Profile Page';
            return $this->view('site/user/profile', compact('message', 'title'));
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
