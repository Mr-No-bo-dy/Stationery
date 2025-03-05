<?php
namespace app\controllers\admin;

use app\models\Category;
use app\vendor\Controller;
use app\models\traits\Pagination;

class CategoryController extends Controller
{
    // view all categories
    public function index()
    {
        $title = "Admin List Of Stationery Categories";

        $orderBy = $_GET['sort'] ?? 'id';
        $categoriesModel = new Category();
        $allCategories = $categoriesModel->getCategories($orderBy, $_GET['filter'] ?? "");

        $pagination = new Pagination(count($allCategories), 5);
        $pageNumber = $_GET['page'] ?? 1;
        $allCategories = $pagination->getItemsPerPage($allCategories, $pageNumber);
        $links = $pagination->getLinks($pageNumber);

        return $this->view('admin/categories/categories', compact('allCategories', 'title', 'links'));
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
