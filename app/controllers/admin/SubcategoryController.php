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
        $subcategoriesModel = new Subcategory();
        $allCategoriesTitle = $subcategoriesModel->getAllCategoriesTitle();
        return $this->view('admin/subcategories/createSubcategory', compact('allCategoriesTitle'));
    }

    public function store() {
        if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['categoryTitle'])) {
            $subcategoriesModel = new Subcategory();
            $subcategoriesModel->createSubcategory($_POST['categoryTitle'], $_POST['title'], $_POST['description']);
            return $this->redirect('subcategory');
        }
    }

    public function update() {
        $subcategoriesModel = new Subcategory();
        $subcategory = $subcategoriesModel->getSubcategoryById($_GET['id']);
        return $this->view('admin/subcategories/updateSubcategory' , compact('subcategory'));
    }

    public function edit() {
        if (isset($_POST['title']) && isset($_POST['description'])) {
            $subcategoriesModel = new Subcategory();
            $subcategoriesModel->updateSubcategory($_POST['title'], $_POST['description'], $_POST['subcategoryId']);
        }
        return $this->redirect('subcategory');
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $subcategoriesModel = new Subcategory();
            $subcategoriesModel->deleteSubcategory($_GET['id']);
        }
        return $this->redirect('subcategory');
    }
}