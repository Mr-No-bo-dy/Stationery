<?php
namespace app\controllers\admin;

use app\models\Category;
use app\models\Subcategory;
use app\vendor\Controller;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategoriesModel = new Subcategory();
        $allSubcategories = $subcategoriesModel->getAllSubcategories();
        return $this->view('admin/subcategories/subcategories', compact('allSubcategories'));
    }

    public function create() {
        if (isset($_POST['newSubcategoryName']) && isset($_POST['newSubcategoryDescription']) && isset($_POST['categoryId'])) {
            $categoriesModel = new Subcategory();
            $categoriesModel -> createSubcategory($_POST['categoryId'], $_POST['newSubcategoryName'], $_POST['newSubcategoryDescription']);
            return $this->index();
        }
        return $this->view('admin/subcategories/createSubcategory');
    }
}