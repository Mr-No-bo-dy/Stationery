<?php

namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Product;
use app\vendor\Database;

class ProductsController extends Controller
{
    public function productCreating()
    {
        $data = Controller::getPost();

        if ($data != []) {
            $uploadDir = __DIR__ . 'app/resources/img/products';
            $conn = Database::connection();
            $stm = $conn->prepare('SELECT MAX(`id`) FROM products');
            $stm->execute();
            $id = $stm->fetchAll();
            // if (!is_dir($uploadDir)) {
            //     mkdir($uploadDir, 0755, true);
            // }
            // $image = $_FILES["image"];
            // print_r($_FILES["image"]);
            // $fileExtension = pathinfo($_FILES['image'], PATHINFO_EXTENSION);
            // $fileName = $uploadDir . '/' . $id["MAX(`id`)"] . '.' . $fileExtension;
            // move_uploaded_file($_FILES['image']['tmp_name'], $fileName);

            // То усьо, галімий недописок коду, не звертайте уваги.
            $stm = $conn->prepare('INSERT INTO products (subcategory_id, title, description, price, stock, image) VALUES (:subcategory_id, :title, :description, :price, :stock, :image)');
            $stm->bindParam('subcategory_id', $data["subcategory_id"]);
            $stm->bindParam('title', $data["title"]);
            $stm->bindParam('description', $data["description"]);
            $stm->bindParam('price', $data["price"]);
            $stm->bindParam('stock', $data["stock"]);
            $stm->bindParam('image', $data["image"]);

            $product = $stm->fetchAll();
        }
        return $this->view("admin/products/create");
    }
}
