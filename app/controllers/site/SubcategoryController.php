<?php
namespace app\controllers\site;

use app\models\Category;
use app\models\Subcategory;
use app\vendor\Controller;

class SubcategoryController extends Controller
{
    // view all subcategories
    public function index()
    {
        $subcategoriesModel = new Subcategory();
        $subcategories = $subcategoriesModel->getSubcategoriesByCategoryId($_GET['categoryId']);
        return $this->view('site/subcategories/subcategories', compact('subcategories'));
    }
}