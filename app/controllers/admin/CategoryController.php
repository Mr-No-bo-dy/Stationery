<?php
namespace app\controllers\admin;

use app\models\Category;
use app\vendor\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categoriesModel = new Category();
        $allCategories = $categoriesModel->getAllCategories();
        return $this->view('admin/categories/categories', compact('allCategories'));
    }

    public function create() {
        if (isset($_POST['newCategoryName']) && isset($_POST['newCategoryDescription'])) {
            $categoriesModel = new Category();
            $categoriesModel -> createCategory($_POST['newCategoryName'], $_POST['newCategoryDescription']);
            $_POST['newCategoryName'] = null;
            $_POST['newCategoryDescription'] = null;
            return $this->index();
        }
        return $this->view('admin/categories/createCategory');
    }
    public function update() {
        if (isset($_POST['newCategoryName']) && isset($_POST['newCategoryDescription'])) {
            $categoriesModel = new Category();
            $categoriesModel -> updateCategory($_POST['newCategoryName'], $_POST['newCategoryDescription'], $_POST['categoryId']);
            $_POST['newCategoryName'] = null;
            $_POST['newCategoryDescription'] = null;
            return $this->index();
        }
        return $this->view('admin/categories/updateCategory');
    }

    public function deleteCategory() {
        if (isset($_POST['categoryId'])) {
            $categoriesModel = new Category();
            $categoriesModel->deleteCategory($_POST['categoryId']);
            $allCategories = $categoriesModel->getAllCategories();
            return $this->view('admin/categories/categories', compact('allCategories'));
        } else {
            return $this->index();
        }
    }
}
