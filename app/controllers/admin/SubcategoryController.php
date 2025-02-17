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
            $subcategoriesModel = new Subcategory();
            $subcategoriesModel -> createSubcategory($_POST['categoryId'], $_POST['newSubcategoryName'], $_POST['newSubcategoryDescription']);
            return $this->index();
        }
        return $this->view('admin/subcategories/createSubcategory');
    }

    public function update() {
        if (isset($_POST['newSubcategoryName']) && isset($_POST['newSubcategoryDescription'])) {
            $subcategoriesModel = new Subcategory();
            $subcategoriesModel -> updateSubcategory($_POST['newSubcategoryName'], $_POST['newSubcategoryDescription'], $_POST['subcategoryId']);
            $categoriesModel = new Category();
            $allCategories = $categoriesModel->getAllCategories();
            return $this->view('admin/categories/categories', compact('allCategories'));
        }
        return $this->view('admin/subcategories/updateSubcategory');
    }

    public function delete() {
        if (isset($_POST['subcategoryId'])) {
            $subcategoriesModel = new Subcategory();
            $subcategoriesModel->deleteSubcategory($_POST['subcategoryId']);

            $categoriesModel = new Category();
            $allCategories = $categoriesModel->getAllCategories();
            return $this->view('admin/categories/categories', compact('allCategories'));
        } else {
            return $this->index();
        }
    }
}