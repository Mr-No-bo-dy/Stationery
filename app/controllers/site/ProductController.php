<?php

namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Product;
use app\models\traits\Pagination;

class ProductController extends Controller
{
    // direction to the catalog view 
    public function catalog()
    {
        $subCategories = Product::getSubcategoryTitle();

        $filters = [];
        if (!empty($_GET['title'])) {
            $filters["title"] = $_GET['title'];
        }
        if (!empty($_GET['minPrice'])) {
            $filters["minPrice"] = $_GET['minPrice'];
        }

        if (!empty($_GET['maxPrice'])) {
            $filters["maxPrice"] = $_GET['maxPrice'];
        }

        if (!empty($_GET['subcategory_id']) && $_GET['subcategory_id'] != 'All') {
            $filters["subcategory_id"] = $_GET['subcategory_id'];
        }

        $sortBy = "Default sort";
        if (isset($_GET["sort"]) && $_GET["sort"] != "Default sort") {
            $sortBy = $_GET["sort"];
        }

        $products = Product::getProducts($filters, $sortBy);
        $title = "Stationery - catalog";

        $pagination = new Pagination(count($products), 20);
        $pageNumber = $_GET['page'] ?? 1;
        $products =  $pagination->getItemsPerPage($products, $pageNumber);
        $links = $pagination->getLinks($pageNumber);

        return $this->view("site/products/catalog", compact("products", "subCategories", "links"));
    }

    // direction to the card view 
    public function card()
    {
        $product = Product::getProduct($this->getGet('id'));
        $title = "Stationery -" . $product["title"];

        return $this->view("site/products/productCard", compact("product"));
    }
}
