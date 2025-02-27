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
        $products = Product::getProducts();
        return $this->view("site/products/catalog", compact("products", "subCategories"));
    }

     // direction to the card view 
    public function card()  
    {
        $product = Product::getProduct($this->getGet('id'));

        return $this->view("site/products/productCard", compact("product"));
    }
}
