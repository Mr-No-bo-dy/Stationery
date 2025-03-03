<?php

namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Product;

class ProductsController extends Controller
{
    // direction to the catalog view 
    public function catalog()
    {
        $subCategories = Product::getSubcategoryTitle();
      
        $filters = [];
        if(!empty($_GET['title'])){
            $filters["title"] = $_GET['title'];
        }
        if(!empty($_GET['minPrice'])){
            $filters["minPrice"] = $_GET['minPrice'];
        }

        if(!empty($_GET['maxPrice'])){
            $filters["maxPrice"] = $_GET['maxPrice'];
        }

        if(!empty($_GET['subcategory_id']) && $_GET['subcategory_id'] != 'All'){
            $filters["subcategory_id"] = $_GET['subcategory_id'];
        }
        $products = Product::getProducts($filters);
        $title = "Stationary - catalog";

        return $this->view("site/products/catalog", compact("products", "subCategories"));
    }

     // direction to the card view 
    public function card()  
    {
        $product = Product::getProduct($this->getGet('id'));
        $title = "Stationary -" . $product["title"];

        return $this->view("site/products/productCard", compact("product"));
    }
}
