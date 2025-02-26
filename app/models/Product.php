<?php

namespace App\models;

use app\vendor\Model;

class Product extends Model
{
    public $table = "products";
    protected $primary_key;
    public $fillable = [
        'title',
        'description',
        "price",
        "stock",
        "image",
    ];

    // obtaining products data
    public static function getProducts(): array
    {
        $stm = self::builder()->prepare("SELECT * FROM `products`");
        $stm->execute();
        return $stm->fetchAll();
    }

    // obtaining an id of the product that is currently being created
    public static function getNewImageId()
    {
        $stmt = self::builder()->prepare('SELECT MAX(`id`) FROM products'); // get the largest id to add 1 to it and get the id of the next product
        $stmt->execute();
        $id = $stmt->fetch();
        return $id["MAX(`id`)"] + 1;
    }

    // request to the database to save a new product
    public static function createProduct($data, $file)
    {
        $stmt = self::builder()->prepare('INSERT INTO products (subcategory_id, title, description, price, stock, image) VALUES (:subcategory_id, :title, :description, :price, :stock, :image)');
        $stmt->bindParam(':subcategory_id', $data["subcategory_id"]);
        $stmt->bindParam(':title', $data["title"]);
        $stmt->bindParam(':description', $data["description"]);
        $stmt->bindParam(':price', $data["price"]);
        $stmt->bindParam(':stock', $data["stock"]);
        $stmt->bindParam(':image', $file);
        $stmt->execute();
    }

    // request to the database to save changes in the product that were specified in admin/productEditing
    public static function updateProduct()
    {
        $stmt = self::builder()->prepare('UPDATE products
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

    // obtaining subcategories data
    public static function getSubcategories()
    {
        $stmt = self::builder()->prepare('SELECT * FROM subcategories');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    //obtaining product data
    public static function getProduct($id)
    {
        $stmt = self::builder()->prepare('SELECT * FROM `products` WHERE id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }
    public static function getSubcategoryTitle()
    {
        $stmt = self::builder()->prepare("SELECT id, title FROM subcategories");
        $stmt->execute();
        $categoriesIdAndTitle = $stmt->fetchAll();
        $categories = [];
        foreach ($categoriesIdAndTitle as $category) {
            $categories[$category["id"]] = $category["title"];
        }
        return $categories;
    }
}
