<?php

namespace app\controllers\admin;

use App\models\User;
use app\vendor\Controller;

class UserController extends Controller
{
    //open admin panel
    public function index()
    {
        return $this->view('admin/index');
    }

    //open users page
    public function getAll()
    {
        $users = User::getAll();

        return $this->view('admin/user/users', compact('users'));
    }


    //try to delete user
    public function delete()
    {
        if (isset($_POST['delete'])) {

            $thisUserId = $_POST['userId'];
            $message = User::delete($thisUserId) ? 'user is deleted successfully' : 'something went wrong';

            return $this->view('admin/index', compact('message'));

        }
        return $this->redirect('users');
    }


    //open edit page
    public function edit()
    {
        if (isset($_POST['userId'])) {

            $thisUserId = $_POST['userId'];
            $user = User::getById($thisUserId);

            return $this->view('admin/user/update', compact('user'));
        }
        return $this->redirect('users');
    }

    //try to update user data
    public function update()
    {
      if (isset($_POST['user'])){

//          $message = is_null(User::edit($_POST['user'])) ? 'user is edited successfully' : User::edit($_POST['user']);
            $message = User::edit($_POST['user']) ?? 'user is edited successfully';
          return $this->view('admin/index', compact('message'));
      }

      return $this->redirect('users');
    }

    //logout
    public function logout()
    {
        unset($_SESSION['user']);
        return $this->redirect('../home');
    }
}