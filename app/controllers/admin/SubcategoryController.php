<?php

namespace app\controllers\admin;

use app\models\Category;
use app\models\Subcategory;
use app\models\traits\Pagination;
use app\vendor\Controller;

class SubcategoryController extends Controller
{
    // view all subcategories
    public function index()
    {
        $title = "Admin List Of Stationery Subcategory";

        $orderBy = $_GET['sort'] ?? 'id'; // За замовчуванням сортуємо по ID
        $allSubcategories = Subcategory::getSubcategories($orderBy, $_GET['filter'] ?? "");

        $pagination = new Pagination(count($allSubcategories), 5);
        $pageNumber = $_GET['page'] ?? 1;
        $allSubcategories = $pagination->getItemsPerPage($allSubcategories, $pageNumber);
        $links = $pagination->getLinks($pageNumber);

        return $this->view('admin/subcategories/subcategories', compact('allSubcategories', 'title', 'links'));
    }

    // view to create subcategory page
    public function create()
    {
        $allCategoriesTitle = Category::getAllCategoriesTitle();
        return $this->view('admin/subcategories/createSubcategory', compact('allCategoriesTitle'));
    }

    // create subcategory redirect to main page
    public function store()
    {
        if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['categoryId'])) {
            Subcategory::createSubcategory($_POST['categoryId'], $_POST['title'], $_POST['description']);
            return $this->redirect('subcategory');
        }
    }

    // view to update subcategory page
    public function edit()
    {
        Subcategory::getSubcategoryById($_GET['id']);
        $allCategoriesTitle = Category::getAllCategoriesTitle();
        $presentCategoriesTitle = Subcategory::getPresentCategoriesTitle($_GET['id']);
        return $this->view('admin/subcategories/updateSubcategory', compact('subcategory', 'allCategoriesTitle', 'presentCategoriesTitle'));
    }

    // edit category redirect to main page
    public function update()
    {
        if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['categoryTitle'])) {
            Subcategory::updateSubcategory($_POST['title'], $_POST['description'], $_POST['subcategoryId'], $_POST['categoryTitle']);
            return $this->redirect('subcategory');
        }
    }

    // delete subcategory by id
    public function delete()
    {
        if (isset($_POST['id'])) {
            Subcategory::deleteSubcategory($_POST['id']);
        }
        return $this->redirect('subcategory');
    }
}