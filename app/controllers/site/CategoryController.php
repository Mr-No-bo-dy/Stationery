<?php
namespace app\controllers\site;

use app\models\Category;
use app\vendor\Controller;
use app\models\traits\Pagination;

class CategoryController extends Controller
{
    // view all categories
    public function index()
    {
        $title = "List Of Stationery Categories";
        $categoriesModel = new Category();
        $allCategories = $categoriesModel->getAllCategories($_GET['filter'] ?? null);

        $pagination = new Pagination(count($allCategories), 2);
        $pageNumber = $_GET['page'] ?? 1;
        $allCategories = $pagination->getItemsPerPage($allCategories, $pageNumber);
        $links = $pagination->getLinks($pageNumber);

        return $this->view('site/categories/categories', compact('allCategories', 'title', 'links'));
    }
}
