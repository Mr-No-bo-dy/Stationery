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

    public function productCard()
    {
        $products = Product::getProducts();
        $product = null;
        foreach ($products as $productValue) {
            if (isset($_GET["title"]) && $productValue['title'] === $_GET["title"]) {
                $product = new Product(
                    [
                        'id' => $productValue['id'],
                        'subcategory_id' => $productValue['subcategory_id'],
                        'title' => $productValue['title'],
                        'description' => $productValue['description'],
                        'price' => $productValue['price'],
                        'stock' => $productValue['stock'],
                        'image' => $productValue['image']
                    ]
                );

                return $this->view("site/products/productCard", [
                    'product' => $product,
                    'products' => $products,
                ]);
            } 
        }
        return $this->view("templates/404", [
            'error' => "undefined error"
        ]);
    }
}
