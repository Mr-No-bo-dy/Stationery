<?php

namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Product;
use app\models\traits\Pagination;
use app\services\ProductOrganizing;

class ProductController extends Controller
{
    // direction to the catalog view 
    public function catalog()
    {
        $title = "Stationery - products catalog";
        $defaultSort = "Default sort";
        
        $subCategories = Product::getSubcategoryTitle();
        $params = ProductOrganizing::organizing();
        $filters = $params["filters"];
        $sortBy = $params["sortBy"];
        $products = $params["products"];
        $subCategories = $params["subCategories"];
        $links = $params["links"];
        $pageNumber = $params["pageNumber"];
        
        return $this->view("site/products/catalog", compact("products", "subCategories", "links", "defaultSort"));
    }

    // direction to the card view 
    public function card()
    {
        $product = Product::getProduct($this->getGet('id'));
        $title = "Stationery -" . $product["title"];

        return $this->view("site/products/productCard", compact("product"));
    }
}
