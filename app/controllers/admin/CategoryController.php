<?php
namespace app\controllers\admin;

use app\models\Category;
use app\vendor\Controller;

class CategoryController extends Controller
{
    // view all categories
    public function index()
    {
        $title = "Admin List Of Stationery Categories";
        $orderBy = $_GET['sort'] ?? 'id'; // За замовчуванням сортуємо по ID
        $categoriesModel = new Category();

        if ($orderBy === 'title') {
            $allCategories = $categoriesModel->sortByTitle();
        } else {
            $allCategories = $categoriesModel->sortById();
        }

        return $this->view('admin/categories/categories', compact('allCategories', 'title'));
    }

    // view to create category page
    public function create()
    {
        return $this->view('admin/categories/createCategory');
    }

    // create category redirect to main page
    public function store()
    {
        if (isset($_POST['title']) && isset($_POST['description'])) {
            $categoriesModel = new Category();
            $categoriesModel->createCategory($_POST['title'], $_POST['description']);
        }
        $this->redirect('category');
    }

    // view to update category page
    public function edit()
    {
        $categoriesModel = new Category();
        $category = $categoriesModel->getCategoryById($_GET['id']);
        return $this->view('admin/categories/updateCategory', compact('category'));
    }

    // edit category redirect to main page
    public function update()
    {
        if (isset($_POST['title']) && isset($_POST['description'])) {
            $categoriesModel = new Category();
            $categoriesModel->updateCategory($_POST['title'], $_POST['description'], $_POST['categoryId']);
        }
        return $this->redirect('category');
    }

    // Used to delete a category
    public function deleteCategory()
    {
        if (isset($_GET['id'])) {
            $categoriesModel = new Category();
            $categoriesModel->deleteCategory($_GET['id']);
        }
        return $this->redirect('category');
    }
}
