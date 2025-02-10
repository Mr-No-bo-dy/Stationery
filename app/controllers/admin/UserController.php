<?php

namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\admin\User;
use Exception;

class UserController extends Controller
{
    public function logout(): void
    {
        session_destroy();
        $this->redirect('../home');

    }

    public function index()
    {
        $users = User::getAll();

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

    public function edit(){
        if (isset($_POST['edit'])) {

            $thisUserId = $_POST['edit'];
            $user = User::getById($thisUserId);

            return $this->view('admin/user/edit', compact('user'));

        } else if (isset($_POST['saveEdit'])){

            $message = User::edit($_POST['id'],$_POST['name'], $_POST['surname'], $_POST['email'], $_POST['phone'], $_POST['role']) ? 'user is edited successfully' : 'something went wrong';

            return $this->view('admin/index', compact('message'));


        }

    }

}