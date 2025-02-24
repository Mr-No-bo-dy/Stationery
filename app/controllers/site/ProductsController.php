<?php

namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Product;

class ProductsController extends Controller
{


    public function catalog()
    {
        $products = Product::getProducts();
        return $this->view("site/products/catalog", compact("products"));
    }

    public function card()  
    {
        $product = Product::getProduct($this->getGet('id'));
        return $this->view("site/products/productCard", compact("product"));
        
    }
}
