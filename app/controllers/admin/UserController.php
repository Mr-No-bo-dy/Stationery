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
        if ($this->getGet('id')) {

            $message = User::delete($this->getGet('id')) ? 'user is deleted successfully' : 'something went wrong';

            return $this->view('admin/index', compact('message'));

        }
        return $this->redirect('users');
    }


    //open edit page
    public function edit()
    {
        if ($this->getGet('id')) {

            $user = User::getById($this->getGet('id'));

            return $this->view('admin/user/update', compact('user'));
        }
        return $this->redirect('users');
    }

    //try to update user data
    public function update()
    {
      if (!empty($this->getPost())){
            User::edit($this->getPost());
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