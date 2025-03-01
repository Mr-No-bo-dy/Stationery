<?php
namespace app\controllers\admin;

use app\models\Category;
use app\models\Subcategory;
use app\vendor\Controller;

class SubcategoryController extends Controller
{
    // view all subcategories
    public function index()
    {
        $title = "Admin List Of Stationery Subcategory";

        $orderBy = $_GET['sort'] ?? 'id'; // За замовчуванням сортуємо по ID
        $subcategoriesModel = new Subcategory();

        if ($orderBy == 'id') {
            $allSubcategories = $subcategoriesModel->sortById();
        } else if ($orderBy == 'category') {
            $allSubcategories = $subcategoriesModel->sortByCategory();
        } else {
            $allSubcategories = $subcategoriesModel->sortByTitle();
        }

        return $this->view('admin/subcategories/subcategories', compact('allSubcategories', 'title'));
    }

    // view to create subcategory page
    public function create() {
        $subcategoriesModel = new Subcategory();
        $allCategoriesTitle = $subcategoriesModel->getAllCategoriesTitle();
        return $this->view('admin/subcategories/createSubcategory', compact('allCategoriesTitle'));
    }

    // create subcategory redirect to main page
    public function store() {
        if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['categoryTitle'])) {
            $subcategoriesModel = new Subcategory();
            $subcategoriesModel->createSubcategory($_POST['categoryTitle'], $_POST['title'], $_POST['description']);
            return $this->redirect('subcategory');
        }
    }

    // view to update subcategory page
    public function edit() {
        $subcategoriesModel = new Subcategory();
        $subcategory = $subcategoriesModel->getSubcategoryById($_GET['id']);
        $allCategoriesTitle = $subcategoriesModel->getAllCategoriesTitle();
        $presentCategoriesTitle = $subcategoriesModel->getPresentCategoriesTitle($_GET['id']);
        return $this->view('admin/subcategories/updateSubcategory' , compact('subcategory', 'allCategoriesTitle', 'presentCategoriesTitle'));
    }

    // edit category redirect to main page
    public function update() {
        if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['categoryTitle'])) {
            $subcategoriesModel = new Subcategory();
            $subcategoriesModel->updateSubcategory($_POST['title'], $_POST['description'], $_POST['subcategoryId'], $_POST['categoryTitle']);
            return $this->redirect('subcategory');
        }
    }

    // delete subcategory by id
    public function delete() {
        if (isset($_GET['id'])) {
            $subcategoriesModel = new Subcategory();
            $subcategoriesModel->deleteSubcategory($_GET['id']);
        }
        return $this->redirect('subcategory');
    }
}