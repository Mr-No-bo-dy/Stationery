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
        return $this->view("admin/products/edit");
    }
    public function productCreating()
    {

       
        $allSubcategories = Product::getSubcategories();

        if (isset($_POST["title"])) {
            $data = $this->getPost();
            $uploadDir = "app/resources/img/products"; // still need to figure it out
            
            $id = Product::getNewImageId();
            
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $file = $id . '.' . str_replace("image/", "", $_FILES['image']['type']);
            $fileDir = $uploadDir . '/' . $file;
            move_uploaded_file($_FILES['image']['tmp_name'], $fileDir);

            Product::createProduct($data, $file);
            

            return $this->redirect("productEdit");
        }
        return $this->view("admin/products/create", compact("allSubcategories"));
    }
}
