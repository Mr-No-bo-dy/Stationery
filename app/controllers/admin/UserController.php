<?php

namespace app\controllers\admin;

use App\models\User;
use app\vendor\Controller;

class UserController extends Controller
{
    //open admin panel
    public function index()
    {
        $title = 'Admin Panel';
        return $this->view('admin/index', compact('title'));
    }

    //open users page
    public function getAll()
    {
        $users = $this->getGet('role') ? User::getAll($this->getGet('role')) : User::getAll();
        $title = 'Users';
        return $this->view('admin/user/users', compact('users', 'title'));
    }


    //try to delete user
    public function delete()
    {
        if ($this->getPost('delete')) {
            User::delete($this->getPost('delete'));
        }
        return $this->redirect('users');
    }


    //open edit page
    public function edit()
    {
        if ($this->getGet('id')) {

            $user = User::getById($this->getGet('id'));
            $title = 'Edit Page';

            return $this->view('admin/user/update', compact('user', 'title'));
        } else if ($this->getGet('search')) {

            $users = User::getBySearch($this->getGet('search'));
            if (is_array($users)) {
                $title = 'Searched Users';
                return $this->view('admin/user/users', compact('users', 'title'));
            }
        }

        return $this->redirect('users');
    }

    //try to update user data
    public function update()
    {
        if ($this->getPost()) {
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