<?php

namespace app\controllers\admin;

use App\models\User;
use app\vendor\Controller;

class UserController extends Controller
{
    public function logout(): void
    {
        unset($_SESSION['user']);
        $this->redirect('../home');

    }

    public function index(): void
    {
        $this->view('admin/index');
    }

    public function getAll(): void
    {
        $users = User::getAll();

        $this->view('admin/user/users', compact('users'));
    }

    public function delete(): void
    {
        if (isset($_POST['delete'])) {

            $thisUserId = $_POST['userId'];
            $message = User::delete($thisUserId) ? 'user is deleted successfully' : 'something went wrong';

            $this->view('admin/index', compact('message'));

        }
    }

    public function edit(): void
    {
        if (isset($_POST['userId'])) {

            $thisUserId = $_POST['userId'];
            $user = User::getById($thisUserId);

            $this->view('admin/user/edit', compact('user'));

        } else if (isset($_POST['saveUserChanges'])){

            $message = User::edit($_POST['user']) ? 'user is edited successfully' : 'something went wrong';

            $this->view('admin/index', compact('message'));


        }

    }

}