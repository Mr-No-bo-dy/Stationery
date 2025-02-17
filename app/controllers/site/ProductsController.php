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
        $conn = Product::builder();
        $id = $this->getGet('id');
        $stmt = $conn->prepare('SELECT * FROM `products` WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetchAll();
        $product = $product[0];
        return $this->view("site/products/productCard", compact("product"));
        
    }
}
