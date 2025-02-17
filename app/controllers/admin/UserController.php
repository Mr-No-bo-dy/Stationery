<?php

namespace app\controllers\admin;

use App\models\User;
use app\vendor\Controller;

class UserController extends Controller
{


    public function logout()
    {
        unset($_SESSION['user']);
        return $this->redirect('../home');

    }

    public function index()
    {
        return $this->view('admin/index');
    }

    public function getAll()
    {

        $users = User::getAll();

        return $this->view('admin/user/users', compact('users'));
    }

    public function delete()
    {

        if (isset($_POST['delete'])) {

            $thisUserId = $_POST['userId'];
            $message = User::delete($thisUserId) ? 'user is deleted successfully' : 'something went wrong';

            return $this->view('admin/index', compact('message'));

        }
    }

    public function edit()
    {

        if (isset($_POST['userId'])) {

            $thisUserId = $_POST['userId'];
            $user = User::getById($thisUserId);

            return $this->view('admin/user/edit', compact('user'));

        } else if (isset($_POST['saveUserChanges'])){

            $message = User::edit($_POST['user']) ? 'user is edited successfully' : 'something went wrong';

            return $this->view('admin/index', compact('message'));


        }

    }

}