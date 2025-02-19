<?php

namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Product;
use PDO;

class ProductsController extends Controller
{
    // product creation and routing to the product card
    public function productEdit()
    {
        return $this->view("admin/products/edit");
    }
    public function productCreating()
    {
        $conn = Product::builder();

        $stmt = $conn->prepare('SELECT * FROM subcategories');
        $stmt->execute();
        $subcateg = $stmt->fetchAll();

        if (isset($_POST["title"])) {
            $data = $this->getPost();
            $uploadDir = "app/resources/img/products"; // still need to figure it out


            $stmt = $conn->prepare('SELECT MAX(`id`) FROM products'); // get the largest id to add 1 to it and get the id of the next product
            $stmt->execute();
            $id = $stmt->fetch();
            $id = $id["MAX(`id`)"] + 1;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $file = $id . '.' . str_replace("image/", "", $_FILES['image']['type']);
            $fileDir = $uploadDir . '/' . $file;
            move_uploaded_file($_FILES['image']['tmp_name'], $fileDir);

            $stmt = $conn->prepare('INSERT INTO products (subcategory_id, title, description, price, stock, image) VALUES (:subcategory_id, :title, :description, :price, :stock, :image)');
            $stmt->bindParam(':subcategory_id', $data["subcategory_id"]);
            $stmt->bindParam(':title', $data["title"]);
            $stmt->bindParam(':description', $data["description"]);
            $stmt->bindParam(':price', $data["price"]);
            $stmt->bindParam(':stock', $data["stock"]);
            $stmt->bindParam(':image', $file);
            $stmt->execute();
            $stmt->fetchAll();

            return $this->redirect("productEdit");
        }
        return $this->view("admin/products/create", compact("subcateg"));
    }
}
