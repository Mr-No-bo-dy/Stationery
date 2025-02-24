<?php

namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Product;

class ProductsController extends Controller
{

    public function products()
    {
        $products = Product::getProducts();
        return $this->view("admin/products/products", compact("products"));
    }
    // product creation and routing to the product card
    public function productEdit()
    {
        $conn = Product::builder();
        $product = Product::getProduct($this->getGet('id'));
        $allSubcategories = Product::getSubcategories();
        return $this->view("admin/products/edit", compact("product", "allSubcategories"));
    }

    public function update()
    {
        Product::updateProduct();
        return $this->redirect("products#" . $this->getPost('id'));
    }
    public function productCreating()
    {
        $allSubcategories = Product::getSubcategories();

        return $this->view("admin/products/create", compact("allSubcategories"));
    }

    public function save()
    {
        $uploadDir = "app/resources/img/products";

        $id = Product::getNewImageId();

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $file = $id . '.' . str_replace("image/", "", $_FILES['image']['type']);
        $fileDir = $uploadDir . '/' . $file;
        move_uploaded_file($_FILES['image']['tmp_name'], $fileDir);

        Product::createProduct($this->getPost(), $file);

        return $this->redirect("products#" . $id);
    }
}
