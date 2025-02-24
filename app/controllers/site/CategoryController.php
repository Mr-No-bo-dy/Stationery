<?php
namespace app\controllers\site;

use app\models\Category;
use app\vendor\Controller;

class CategoryController extends Controller
{
    // view all categories
    public function index()
    {
        $categoriesModel = new Category();
        $allCategories = $categoriesModel->getAllCategories();
        return $this->view('site/categories/categories', compact('allCategories'));
    }
}
