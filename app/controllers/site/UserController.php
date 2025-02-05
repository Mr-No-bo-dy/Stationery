<?php

namespace app\controllers\site;

use app\vendor\Controller;
use app\models\site\User;
use Exception;

class UserController extends Controller
{

    public function register()
    {
        if (!isset($_POST['name']) && !isset($_POST['surname']) && !isset($_POST['email']) && !isset($_POST['phone']) && !isset($_POST['role']) && !isset($_POST['password'])) {
            return $this->view('site/register');
        }
        $user = new User();
        $user->register($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['phone'], $_POST['role'], $_POST['password']);
        return $this->view('site/index');


    }

    public function login()
    {
        if (isset($_POST['name']) && isset($_POST['password'])) {
            try {
                $user = new User();

                if ($user->login($_POST['name'], $_POST['password'])) {
                    return $this->view('site/index');
                }

            } catch (Exception $e) {

                throw new Exception($e->getMessage());

                return $this->view('site/login');

            }
        }
        return $this->view('site/login');
    }

}