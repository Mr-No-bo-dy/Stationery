<?php
namespace app\controllers\site;

use app\models\Category;
use app\models\Subcategory;
use app\models\traits\Pagination;
use app\vendor\Controller;

class SubcategoryController extends Controller
{
    // view all subcategories
    public function index()
    {
        $title = "List Of Stationery Subcategory";

        $subcategoriesModel = new Subcategory();
        $subcategories = $subcategoriesModel->getSubcategoriesByCategoryId($_GET['categoryId']);

        $pagination = new Pagination(count($subcategories), 2);
        $pageNumber = $_GET['page'] ?? 1;
        $subcategories = $pagination->getItemsPerPage($subcategories, $pageNumber);
        $links = $pagination->getLinks($pageNumber);

        return $this->view('site/subcategories/subcategories', compact('subcategories', 'title', 'links'));
    }
}