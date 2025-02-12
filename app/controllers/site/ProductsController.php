<?php

namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Product;
use app\vendor\Database;

class ProductsController extends Controller
{


    public function catalog()
    {
        $products = Product::getProducts();
        return $this->view("site/products/catalog", compact("products"));
    }

    public function productCard()
    {
        $conn = Database::connection();
        $stm = $conn->prepare('SELECT * FROM `products` WHERE id = ' . $_GET["id"]);
        $stm->execute();
        $product = $stm->fetchAll();
        // echo "<pre>";
        // print_r($product);
        // echo "</pre>";
        $product = $product[0];
        return $this->view("site/products/productCard", compact("product"));
        
    }
}
