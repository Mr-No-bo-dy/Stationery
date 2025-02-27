<?php

namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Product;

class ProductsController extends Controller
{

    //direction to the view of products page in admin
    public function products()
    
    {
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
        $subCategories = Product::getSubcategoryTitle();
        return $this->view("admin/products/products", compact("products", "subCategories"));
    }

    // product creation and routing to the product card
    public function productEdit()
    {
        $product = Product::getProduct($this->getGet('id'));
        $allSubcategories = Product::getSubcategories();

        return $this->view("admin/products/edit", compact("product", "allSubcategories"));
    }

    // Make changes pointing to admin/productEditing
    public function update()
    {
        Product::updateProduct();

        return $this->redirect("products#" . $this->getPost('id'));
    }

    // direction to the 'view' of product creation
    public function productCreating()
    {
        $allSubcategories = Product::getSubcategories();

        return $this->view("admin/products/create", compact("allSubcategories"));
    }

    // Creating a new product in the admin panel 
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

    // product removal 
    public function remove()
    {
        $stmt = Product::builder()->prepare('DELETE FROM `products` WHERE id = :id');
        $stmt->bindParam(":id", $_POST["remove"]);
        $stmt->execute();

        return $this->redirect("products");
    }
}
