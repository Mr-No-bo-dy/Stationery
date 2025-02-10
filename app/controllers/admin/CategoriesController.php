<?php
namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Categories;

class CategoriesController extends Controller
{
    public function index()
    {
        $categoriesModel = new Categories();
        if (isset($_POST) && isset($_POST['categoryName']) && isset($_POST['categoryDescription']) && $_POST['categoryName'] != "" && $_POST != "") {
            $categoriesModel->createCategory($_POST['categoryName'], $_POST['categoryDescription']);
        }

        $allCategories = $categoriesModel->getAllCategories();
        return $this->view('admin/categories/categories', compact('allCategories'));
    }
}
