<?php
namespace app\controllers\site;

use app\models\Category;
use app\models\Subcategory;
use app\vendor\Controller;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategoriesModel = new Subcategory();
        $allSubcategories = $subcategoriesModel->getAllSubcategories();
        return $this->view('site/subcategories/subcategories', compact('allSubcategories'));
    }
}