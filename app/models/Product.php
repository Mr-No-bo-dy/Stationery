<?php

namespace App\models;

use app\vendor\Model;

class Product extends Model
{
    protected $primary_key;
    public $fillable = [
        'title',
        'description',
        "price",
        "stock",
        "image",
    ];
    public $table = "products";


    public static function getProducts(): array
    {
        $stm = self::builder()->prepare("SELECT * FROM `products`");
        $stm->execute();
        return $stm->fetchAll();
    }

    public static function getNewImageId()
    {
        $conn = self::builder();
        $stmt = $conn->prepare('SELECT MAX(`id`) FROM products'); // get the largest id to add 1 to it and get the id of the next product
        $stmt->execute();
        $id = $stmt->fetch();
        return $id["MAX(`id`)"] + 1;
    }

    public static function createProduct($data, $file)
    {
        $conn = self::builder();
        $stmt = $conn->prepare('INSERT INTO products (subcategory_id, title, description, price, stock, image) VALUES (:subcategory_id, :title, :description, :price, :stock, :image)');
        $stmt->bindParam(':subcategory_id', $data["subcategory_id"]);
        $stmt->bindParam(':title', $data["title"]);
        $stmt->bindParam(':description', $data["description"]);
        $stmt->bindParam(':price', $data["price"]);
        $stmt->bindParam(':stock', $data["stock"]);
        $stmt->bindParam(':image', $file);

        $stmt->execute();
    }

    public static function updateProduct()
    {
        $conn = self::builder();
        $stmt = $conn->prepare('
        UPDATE products
        SET subcategory_id = :subcategory_id, title = :title, description = :description, price = :price, stock = :stock
        WHERE id = :id;');
        $stmt->bindParam(':id', $_POST["id"]);
        $stmt->bindParam(':subcategory_id', $_POST["subcategory_id"]);
        $stmt->bindParam(':title', $_POST["title"]);
        $stmt->bindParam(':description', $_POST["description"]);
        $stmt->bindParam(':price', $_POST["price"]);
        $stmt->bindParam(':stock', $_POST["stock"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function getSubcategories()
    {
        $conn = self::builder();
        $stmt = $conn->prepare('SELECT * FROM subcategories');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function getProduct($id){
        $conn = self::builder();
        $stmt = $conn->prepare('SELECT * FROM `products` WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
